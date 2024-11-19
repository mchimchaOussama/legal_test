<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Lead;
use App\Models\Thematique;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Ajouter un lead au panier
    public function addToCart(Lead $lead, string $src)
    {
        // Récupérer le panier depuis la session, ou initialiser un tableau vide si il n'existe pas
        $cart = session()->get('cart', []);

        // Si le lead n'existe pas encore dans le panier, on l'ajoute
        if (!isset($cart[$lead->id])) {
            $cart[$lead->id] = [
                'id' => $lead->id,
                'img' => $lead->thematique->image,
                'departement' => $lead->departement->departement,
                'mode' => $lead->modeConsommation,
                'prix' => $lead->prix,
                'checked' => true,
            ];
        }

        // Mettre à jour le panier dans la session
        session()->put('cart', $cart);

        // Rediriger en fonction de la source ('market' ou autre)
        if ($src == 'market') {
            return redirect()->route('get.marketplace');
        } else {
            return redirect()->route('cart_index');
        }
    }

    // Afficher le contenu du panier
    public function showCart()
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', []);
        $total = 0;

        // Calculer le total en fonction des éléments sélectionnés (checked)
        foreach ($cart as $item) {
            if ($item['checked']) {
                $total += $item['prix'];
            }
        }

        // Obtenir les 5 thématiques les plus populaires
        $thematiques = Thematique::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->limit(5)
            ->get();

        // Statistiques sur les thématiques
        $thematiquesStatistiques = Thematique::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->limit(4)
            ->get();

        // Retourner la vue avec les données du panier et des thématiques
        return view('Marketplace.cart.showCart2', compact('thematiques', 'thematiquesStatistiques', 'cart', 'total'));
    }

    // Supprimer un lead du panier
    public function removeCart($leadid)
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', []);

        // Si le lead existe dans le panier, on le supprime
        if (isset($cart[$leadid])) {
            unset($cart[$leadid]);
            session()->put('cart', $cart);
            return redirect()->route('cart_index');
        }

        // Si le lead n'existe pas dans le panier, on peut retourner une erreur ou une redirection
        return redirect()->route('cart_index');
    }

    // Vider le panier
    public function clearCart()
    {
        session()->forget('cart');
        // Optionnellement retourner une réponse JSON ou une redirection
        // return response()->json(['success' => 'Panier vidé.']);
    }

    // Mettre à jour le panier (etat de l'element checked ou non)
    public function update(Request $request)
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', []);
        $selectedItems = explode(",", $request->listitem);  // Liste des éléments sélectionnés
        $total = 0;

        // Mettre à jour les éléments du panier
        foreach ($cart as $key => $item) {
            // Vérifier si l'élément est sélectionné
            if (in_array($key, $selectedItems)) {
                $cart[$key]['checked'] = true;
                $total += $item['prix'];  // Ajouter le prix au total
            } else {
                $cart[$key]['checked'] = false;
            }
        }

        // Mettre à jour le panier dans la session après modification
        session()->put('cart', $cart);

        // Obtenir les 5 thématiques les plus populaires
        $thematiques = Thematique::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->limit(5)
            ->get();

        // Statistiques sur les thématiques
        $thematiquesStatistiques = Thematique::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->limit(4)
            ->get();

        // Retourner la vue avec le panier mis à jour
        return view('Marketplace.cart.showCart2', compact('thematiques', 'thematiquesStatistiques', 'cart', 'total'));
    }

    public function applyCoupon(Request $request){

        $codecoupon=$request->coupon;
        $coupon = Coupon::where('coupon', $codecoupon)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Coupon invalide ou expiré.'], 400);
        }

        if ( $coupon->date_fin < now()) {
            return response()->json(['error' => 'Le coupon a expiré.'], 400);
        }else{


            $cart = session()->get('cart', []);
           
            $total = 0;
    
            
            foreach ($cart as $item) {
                if ($item['checked']) {
                    $total += $item['prix'];
                }
            }

            $total=$total-$total*($coupon->reduction/100);

        }

         // Obtenir les 5 thématiques les plus populaires
         $thematiques = Thematique::withCount('leads')
         ->orderBy('leads_count', 'desc')
         ->limit(5)
         ->get();

     // Statistiques sur les thématiques
     $thematiquesStatistiques = Thematique::withCount('leads')
         ->orderBy('leads_count', 'desc')
         ->limit(4)
         ->get();

     // Retourner la vue avec les données du panier et des thématiques
     return view('Marketplace.cart.showCart2', compact('thematiques', 'thematiquesStatistiques', 'cart', 'total'));
 }




    }

