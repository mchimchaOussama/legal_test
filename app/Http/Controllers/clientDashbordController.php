<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thematique;
use App\Models\Payment;
use App\Models\Client;
use App\Models\Departement;
use App\Models\Invoice;
use App\Models\Review;
use App\Models\Commande;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;



class clientDashbordController extends Controller
{


    public function fetchInvoiceDetails(Request $request)
    {
        $invoiceId = $request->invoice_id;
        
        // Fetch the payment based on the provided invoice ID
        $paiement = Payment::where('id', $invoiceId)->first();
        
        if ($paiement) {
            // Get all payments with the same PayPal payment ID
            $details = Payment::where('paypal_payment_id', $paiement->paypal_payment_id)->get();
            
            // Create the HTML table
            $html = '<table class="table table-bordered">';
            $html .= '<thead><tr><th>Thematique</th><th>Sous Thematique</th><th>Departement</th><th>Prix</th><th>Methode</th><th>Date</th></tr></thead><tbody>';
            
            foreach ($details as $detail) {
                $html .= '<tr>';
                $html .= '<td>' . (($detail->thematique->theme ?? 'N/A') == 'enr' ? 'énergie gaz/électrique' : ($detail->thematique->theme ?? 'N/A'))  . '</td>'; // Replace with actual column if different
                $html .= '<td>' . ($detail->thematique->thematique ?? 'N/A') . '</td>'; // Replace with actual column if different
                $html .= '<td>' . ($detail->departement->departement ?? 'N/A') . '</td>'; // Replace with actual column if different
                $html .= '<td>' . ($detail->prix) . ' €</td>'; // Replace with actual column if different
                $html .= '<td>' . ($detail->methode ?? 'N/A') . '</td>'; // Replace with actual column if different
                $html .= '<td>' . \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') . '</td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody></table>';
            
            // Return the HTML in a JSON response
            return response()->json(['html' => $html]);
        } else {
            return response()->json(['error' => 'Payment not found'], 404);
        }
        
    }
    

    public function fetchleads(Request $request)
    {
        $clientId = session('client_hom')->id;
        
        // Start query and filter by client_id, order by created_at in descending order
        $query = Payment::where('client_id', $clientId)->orderBy('created_at', 'desc');
    
        // Apply additional filters if set
        if ($request->departement) {
            $query->where('departement_id', $request->departement);
        }
    
        if ($request->thematique) {
            $query->where('thematique_id', $request->thematique);
        }
    
        if ($request->type) {
            $query->whereHas('thematique', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }
    
        // Fetch filtered and ordered results with pagination (10 per page)
        $details = $query->paginate(10);
    
        // Build HTML table structure with CSS for borders
        $html = '<table class="table table-bordered">';
        $html .= '<thead><tr><th>Thématique</th><th>Sous Thématique</th><th>Departement</th><th>Prix</th><th>Methode</th><th>Date</th><th>Action</th></tr></thead><tbody>';
        
        foreach ($details as $detail) {
            // Generate each row of the table
            $html .= '<tr>';
            $html .= '<td>' . (($detail->thematique->theme ?? 'N/A') == 'enr' ? 'énergie gaz/électrique' : ($detail->thematique->theme ?? 'N/A'))  . '</td>';
            $html .= '<td>' . ($detail->thematique->thematique ?? 'N/A') . '</td>';
            $html .= '<td>' . ($detail->departement->departement ?? 'N/A') . '</td>';
            $html .= '<td>' . ($detail->prix) . ' €</td>';
            $html .= '<td>' . ($detail->methode ?? 'N/A') . '</td>';
            $html .= '<td>' . \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') . '</td>';
        
            // Add action button linking to the route 'detaiachatlead' with the correct parameter 'leadid'
            $html .= '<td>';
            $html .= '<a href="' . route('detaiachatlead', ['leadid' => $detail->id]) . '" class="btn btn-outline-danger  btn-sm">View Details</a>';
            $html .= '</td>';
        
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table>';
    
        // Add pagination controls
        $html .= '<div class="pagination-container mb-2">';
        $html .= $details->links('pagination::bootstrap-4'); // This will generate pagination links
        $html .= '</div>';
    
        // Return the HTML in a JSON response
        return response()->json(['html' => $html]);
    }
    
    
    public function dashbord_get()
    {

        if (empty(session('client_hom'))) {
            return redirect()->route('get.home');
        }


        $clientId = session('client_hom')->id;


        if(empty($clientId)) {
            return redirect()->route('get.home');
        }


        $invoices = Invoice::where('client_id', $clientId)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $invoicesStat   = Invoice::where('client_id', $clientId)->count();
        $totalPayments  = Invoice::where('client_id', $clientId)->sum('amount');
        $Commande       = Commande::where('client_id', $clientId)->count();
        $nbrFact        = $invoices->count();
    

        $data           = $this->getThematicsData();
        $thematiques    = $data['thematiques'];
        $departements   = $data['departements'];


        $statLead = Payment::where('client_id', $clientId)->count();


        foreach ($invoices as $invoice) {
            $Payment = Payment::where('id', $invoice->payment_id)->first();
            $leadCount = Payment::where('paypal_payment_id',$Payment->paypal_payment_id)->count();
            $invoice->lead_count = $leadCount;
        }

        
        $leads = Payment::where('client_id',$clientId)->get();
        

        $commandes  =   Commande::join("leads", "commandes.lead_id", "=", "leads.id")->where([
                            ["commandes.statut",     "=",   1],
                            ["commandes.prix",       ">",   0],
                            ["commandes.excel_path", "!=", ""],
                            ["commandes.client_id",  "=",  session("client_hom")["id"]],
                            ["commandes.updated_at", "<=", Carbon::now()->toDateTimeString()],
                            ["leads.payer", "=", 0]
                        ])->orderBy("commandes.created_at", "desc")->get();
        
                    
        ///// last code /////
        return view('marketplace.dashbord.dashbord', compact('commandes', 'thematiques', 'departements', 'invoices', 'nbrFact', 'statLead','invoicesStat','totalPayments','leads','Commande'));
        

    }


    public function detailPayment($idPayment){

        $paiements=Payment::where('id',$idPayment)->first();

        $details = Payment::where('paypal_payment_id',$paiements->paypal_payment_id)->get();
        $nbrFact = Payment::where('paypal_payment_id',$paiements->paypal_payment_id)->count();

        $data = $this->getThematicsData();
        $thematiques=$data['thematiques'];
        $departements=$data['departements'];
        return view('marketplace.dashbord.detailsClient',compact('thematiques','departements','details','nbrFact'));
   
    }


    public function downloadInvoice($invoiceId)
    {
        // Construire le chemin du fichier
        $filePath = storage_path('invoices/invoice_' . $invoiceId . '.pdf');

        // Vérifier si le fichier existe
        if (file_exists($filePath)) {
            // Retourner le fichier en réponse pour le téléchargement
            return response()->download($filePath);
        } else {
            // Si le fichier n'existe pas, afficher un message d'erreur
            return redirect()->back()->with('error', 'Facture non trouvée.');
        }
    }


    public function update(Request $request)
    {

        // Validate input data
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'tel' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'addresse' => 'required|string|max:255',
            'mot_de_passe' => 'nullable|min:8|confirmed', // Password must match its confirmation
            'ancien_mot_de_passe' => 'nullable|required_with:mot_de_passe',
        
            // You can add more validation rules here
        ],[
            'nom.required' => 'Le champ Nom est requis.',
            'prenom.required' => 'Le champ Prénom est requis.',
            'tel.required' => 'Le champ Téléphone est requis.',
            'email.required' => 'Le champ Email est requis.',
            'email.email' => 'Le format de l\'Email est invalide.',
            'addresse.required' => 'Le champ Adresse est requis.',
            'departements.array' => 'Le champ Départements doit être un tableau.',
            'departements.*.integer' => 'Chaque département doit être un entier.',
            'mot_de_passe.min' => 'Le mot de passe doit comporter au moins 8:min caractères.',
            'mot_de_passe.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'ancien_mot_de_passe.required_with' => 'Le champ Ancien Mot de passe est requis si un nouveau mot de passe est fourni.',
        ]);


        // Update client data

        $client = Client::find(session('client_hom')->id);
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->tel = $request->input('tel');
        $client->email = $request->input('email');
        $client->addresse = $request->input('addresse');
        $client->numero_identification = $request->input('numero_identification');
        $client->entreprise = $request->input('entreprise');
        $client->rcs = $request->input('rcs');
        $client->siren = $request->input('siren');
        $client->siret = $request->input('siret');
        $client->save();

    
        if ($request->has('departements')) { // Ensure the field name matches what's sent
            $departments = json_decode($request->input('departements', '[]'), true); // Decode the JSON
            $client->departement()->sync($departments); // Sync with the client model
        }
        
        // Sync selected thematiques
        if ($request->has('thematiques')) { // Ensure the field name matches what's sent
            $thematiques = json_decode($request->input('thematiques', '[]'), true); // Decode the JSON
            $client->thematique()->sync($thematiques); // Sync with the client model
        }

        // Update password if provided
        if ($request->mot_de_passe) {
            if (!Hash::check($request->ancien_mot_de_passe, $client->mot_de_passe)) {
                return back()->withErrors(['ancien_mot_de_passe' => 'Ancien mot de passe incorrect']);
            }  
            $client->password = Hash::make($request->mot_de_passe);
            $client->save();
        }

        // Redirect back with success message
        return response()->json(['success' => true, 'message' => 'Profil mis à jour avec succès !']);
    }


    public function get_resetPassword(Request $request)
    {
        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return response()->json(['message' => 'No client found with this email.'], 404);
        }

        // Generate the reset link
        $resetLink = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(60),
            ['id' => $client->id, 'token' => Str::random(60)]
        );

        // Send the email
        Mail::send('mail.resetpassword', ['client' => $client, 'resetLink' => $resetLink], function ($message) use ($client) {
            $message->to($client->email)
                    ->subject('Réinitialisation de votre mot de passe');
        });

        return response()->json(['success' => 'Password reset email sent successfully.']);
    }



    public function get_newPassword($id){
        $client= Client::find($id);
        return view('mail.newPassword',compact('client'));
    }



    public function update_new_password(Request $request)
    {
        // Validate input data
        $request->validate([
            'password' => 'nullable|min:8|confirmed', // Password must match its confirmation
            // You can add more validation rules here
        ], [
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $client = Client::find($request->clientId);


        // Check if the client exists
        if (!$client) {
            return response()->json(['error' => 'Client non trouvé.'], 404); // Return JSON with error message and 404 status
        }

        // Update the client's password
        $client->mot_de_passe = Hash::make($request->password); // Use the validated password field
        $client->save();

        // Redirect to the homepage or a specific URL with a success message
        return response()->json(['success' => 'Mot de passe modifié avec succès.'], 200);
    }


    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:clients',
        ]);

        $email = $request->input('email');
        $code = random_int(100000, 999999); // Génère un code à 8 chiffres

        // Envoi de l'e-mail avec le code de vérification
        Mail::send('mail.verification', ['code' => $code], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Code de vérification');
        });

        return response()->json([
            'message' => 'Code de vérification envoyé.',
            'code' => $code // Renvoie le code pour stocker temporairement dans sessionStorage
        ]);
    }


    
    private function getThematicsData()
    {
        return [
            'thematiques' => Thematique::withCount('leads')
                ->orderBy('leads_count', 'desc')
                ->limit(5)
                ->get(),
            'departements' => Departement::all(),
        ];
    }



    public function leadsAchatDetai(Request $request , $leadid){

        $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
        ->get() // Récupère les résultats
        ->unique('theme'); 

        $thematiquesStatistiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante
        ->limit(4) // Limite aux 5 thématiques avec le plus de leads
        ->get(); // Récupère les résultats*


        $payment =  Payment::find($leadid);

        return view('Marketplace.dashbord.livrab',compact('thematiques','thematiquesStatistiques','payment'));

    }



    public function sendAvis(Request $request){

        $clientId = session('client_hom')->id;

        Review::firstOrCreate([
            'review' => $request->review,
            'rating' => $request->rating,
            'client_id' => $clientId,
            'thematique_id'=>$request->thematique_id,
            'departement_id'=>$request->departement_id,
        ]);

    }



    public function demandez_devis_view()
    {

        if(!session("client_hom") || empty(session("client_hom"))) return redirect("/");

        // session()->flash("success", "success");
        $thematiquesStatistiques =  Thematique::withCount('leads')
                                            ->orderBy('leads_count', 'desc')
                                            ->limit(4)
                                            ->get();

        $thematiques  = Thematique::latest()->get();
        $departements = Departement::latest()->get();


        return view("Marketplace.demandes",compact("thematiquesStatistiques", "thematiques", "departements"));

    }


    public function demandez_devis_post(Request $request)
    {

        $request->validate([
            'entreprise'        => 'required',
            'nom'               => 'required',
            'email'             => 'required|email',
            'tel'               => 'required|numeric|digits:10',
            'nombre_leads'      => 'required|integer|min:50',
            'date_livraison'    => 'required|date',
            'thematique'        => 'required|max:80',
            'departement'       => 'required|max:80',
            'description'       => 'required|max:1000'
        ]);


        Commande::create([
            "client_id"         =>  session("client_hom")["id"],
            "nombre_leads"      =>  $request->nombre_leads,
            "date_livraison"    =>  $request->date_livraison,
            "thematique"        =>  $request->thematique,
            "departement"       =>  $request->departement,
            "description"       =>  $request->description,

        ]);

        session()->flash("success", "success");
        
        return redirect()->route("marketplace.demandes");

    }



    public function client_commandes()
    {

        $commandes = Commande::where([
            ["client_id", "=", session('client_hom')["id"]]
        ])->latest()->get();


        return view("Marketplace.dashbord.commandes", compact("commandes"));

    }


    public function client_commande_download($id){

        $commande = Commande::where([
                        ["client_id", "=", session('client_hom')["id"]],
                        ["statut",    "=", 1]
                    ]);

        if($commande->count() == 0) return redirect()->back();

        return response()->download($commande->first()->excel_path, "leads-quantite.xlsx");

    }

}
