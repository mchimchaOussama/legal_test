<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\InvoiceMail;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Thematique;
use App\Models\Invoice;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;
use PayPal\Api\PaymentExecution;

class PaymentController extends Controller
{
    protected $paypalService;

    public function __construct(PayPalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    // Méthode pour créer un paiement via PayPal
    public function create(Request $request)
    {
        $total = $request->price;
        //dd($total);
        $payment = $this->paypalService->createPayment($total); // Montant à payer
        return redirect($payment->getApprovalLink());
    }

    // Méthode pour gérer la réussite du paiement via PayPal
    public function success(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');

        if (!$paymentId || !$payerId) {
            return redirect()->route('payment.cancel')->with('error', 'Une erreur est survenue lors du traitement de votre paiement.');
        }

        try {
            $payment = \PayPal\Api\Payment::get($paymentId, $this->paypalService->getApiContext());
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            $cart = session()->get('cart', []);
            $total = 0;
            $methode="Paypal";
            $this->processCartPayment($cart, $total, $paymentId,$methode);

            $result = $payment->execute($execution, $this->paypalService->getApiContext());

            $this->createInvoiceAndSendEmail($total,$paymentId);

            session()->forget('cart'); // Vider le panier

            return $this->getSuccessView($total);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return redirect()->route('payment.cancel')->with('error', 'Erreur de connexion à PayPal : ' . $ex->getMessage());
        } catch (\Exception $ex) {
            return redirect()->route('payment.cancel')->with('error', 'Le paiement a échoué. Veuillez réessayer.' . $ex->getMessage());
        }
    }

    // Méthode pour annuler un paiement
    public function cancel()
    {
        return $this->getCancelView();
    }

    // Méthode pour afficher la page de paiement
    public function showPayment(Request $request)
    {
        $total = $request->price;
        if (session()->has('client_hom')) {
            return $this->getPaymentView($total);
        } else {
            return redirect()->back()->with("failed", "Veuillez vous connecter pour effectuer le paiement");
        }
    }

    // Méthode pour créer une session de paiement Stripe
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => ['name' => 'Le montant total à payer :'],
                            'unit_amount' => $request->price * 100, // Montant en cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.successStripe'),
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $ex) {
            return redirect()->route('payment.cancel')->with('error', 'Le paiement a échoué. Veuillez réessayer.' . $ex->getMessage());
        }
    }

    // Méthode pour gérer la réussite d'un paiement via Stripe
    public function successStripe(Request $request)
    {
        $total = 0;
        $cart = session()->get('cart', []);
        $idPayment = bin2hex(random_bytes(15 / 2)); // Générer un ID de paiement Stripe
        $methode="Stripe";
        $this->processCartPayment($cart, $total, $idPayment,$methode);

        $this->createInvoiceAndSendEmail($total,$idPayment);

        session()->forget('cart'); // Vider le panier

        return $this->getSuccessView($total);
    }

    // Traitement du paiement pour chaque lead dans le panier
    private function processCartPayment($cart, &$total, $paymentId,$methode)
    {
        foreach ($cart as $itemCart) {
            if ($itemCart['checked']) {
                $total += $itemCart['prix'];
                $lead = Lead::find($itemCart['id']); // Assurez-vous d'utiliser 'id' et non un objet complet

                // Enregistrement du paiement pour chaque lead sélectionné
                $this->savePaymentDetails($lead, $paymentId,$methode);
            }
        }
    }

    // Enregistrer les détails du paiement dans la base de données
    private function savePaymentDetails($lead, $paymentId,$methode)
    {
        $nouveauPayment = new Payment();
        $nouveauPayment->client_id = session('client_hom')->id;
        $nouveauPayment->prix = $lead->prix;
        $nouveauPayment->methode = $methode; 
        $nouveauPayment->lead_id = $lead->id;
        $nouveauPayment->user_id = $lead->user_id;
        $nouveauPayment->prospect_id = $lead->prospect_id;
        $nouveauPayment->thematique_id = $lead->thematique_id;
        $nouveauPayment->ville_id = $lead->ville_id;
        $nouveauPayment->departement_id = $lead->departement_id;
        $nouveauPayment->publication_id = 1;
        $nouveauPayment->paypal_payment_id = $paymentId;
        $nouveauPayment->save();

        Lead::where('id', $lead->id)->update(['payer' => 1 ,'publier'=>0]);
    }

    // Créer une facture et envoyer un email avec la facture en pièce jointe
    private function createInvoiceAndSendEmail($total,$payment_id)
    {

        $idp=Payment::where('paypal_payment_id',$payment_id)->first();
        $client = Client::find(session('client_hom')->id);
        $invoice = Invoice::create([
            'client_id' => $client->id,
            'amount' => $total,
            'payment_id'=>$idp->id
        ]);
        Mail::to($client->email)->send(new InvoiceMail($invoice));
    }

    // Récupérer les thématiques populaires et leurs statistiques
    private function getThematicsData()
    {
        return [
            'thematiques' => Thematique::withCount('leads')
                ->orderBy('leads_count', 'desc')
                ->limit(5)
                ->get(),
            'thematiquesStatistiques' => Thematique::withCount('leads')
                ->orderBy('leads_count', 'desc')
                ->limit(4)
                ->get(),
        ];
    }

    // Retourner la vue de paiement réussi avec les données des thématiques
    private function getSuccessView($total)
    {
        $data = $this->getThematicsData();
        $thematiques=$data['thematiques'];
        $thematiquesStatistiques=$data['thematiquesStatistiques'];
        return view('Marketplace.paiement.success', compact('total', 'thematiques','thematiquesStatistiques'));
   
    }

    // Retourner la vue de paiement annulé avec les données des thématiques
    private function getCancelView()
    {
        $data = $this->getThematicsData();
        $thematiques=$data['thematiques'];
        $thematiquesStatistiques=$data['thematiquesStatistiques'];
        return view('Marketplace.paiement.cancel', compact('total', 'thematiques','thematiquesStatistiques'));
   
    }

    // Retourner la vue de paiement avec les données des thématiques
    private function getPaymentView($total)
    {
        $data = $this->getThematicsData();
        $thematiques=$data['thematiques'];
        $thematiquesStatistiques=$data['thematiquesStatistiques'];
        return view('Marketplace.paiement.showpaiement', compact('total', 'thematiques','thematiquesStatistiques'));
    }



}
