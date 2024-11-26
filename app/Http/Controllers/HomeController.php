<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Ville;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Review;
use App\Models\Newsletter;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Models\Commande;



class HomeController extends Controller
{

    public function getLeads(Request $request)
    {
        // Check if the thematique_id is provided
        $thematiqueId = $request->input('thematique_id');
    
        // Validate only if the thematique_id is present
        if ($thematiqueId) {
            $request->validate([
                'thematique_id' => 'exists:thematiques,id', // Assuming you have a Thematiques table
            ]);
        }
    
        // If no thematique_id, get the first thematic ID or a default
        if (!$thematiqueId) {
            $defaultThematique = Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
            ->where('commande',0)
            ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante
            ->first(); // Fetch the first thematique
            $thematiqueId = $defaultThematique ? $defaultThematique->id : null;
        }
    
        // Fetch the latest 4 leads for the selected thematic
        $leads = Lead::with('thematique','ville','departement') // Ensure you have the relationship defined in the Lead model
            ->where('thematique_id', $thematiqueId)
            ->where('payer', 0)
            ->where('publier', 1)
            ->where('commande',0)
            ->withCount('viewedByClients')
            ->latest()
            ->take(8)
            ->get(['id', 'adresse_cache', 'prix', 'description','thematique_id','ville_id','modeConsommation','updated_at','code_postale','departement_id']); // Adjust fields as necessary
        // Return the leads as a JSON response
        return response()->json(['leads' => $leads]);
    }


    public function get_home ()
    {
        $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
        ->get() // Récupère les résultats
        ->unique('theme'); 

        $thematiqueArrays = [] ;

        $themes  = Thematique::all();
            foreach ($themes as $theme) {   
                $thematiqueArrays[] = $theme->theme;
            }
        $thematiqueArrays = array_unique(Thematique::pluck('theme')->toArray());
     

        $DepartementFurstSlideSherchs =  Departement::all(); // Récupère les résultats

        $topThematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante
        ->first();  // Limite aux 5 thématiques avec le plus de leads

        $top3leadThematique = Lead::whereNull("client_id")->where([
            ['thematique_id', '=', $topThematiques->id], 
            ['payer', '=', 0]
        ])->withCount('viewedByClients')->limit(3)->get();


        $thematiquesStatistiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante
        ->limit(4) // Limite aux 5 thématiques avec le plus de leads
        ->get(); // Récupère les résultats*

        $villesSlide=  Ville::withCount('leads')
                                ->where('featured', 1)
                                ->orderBy('leads_count', 'desc')
                                ->limit(10)
                                ->get();


        $reviews = Review::with('client')->where('publier',1)->get();
  

        return view('Marketplace.Home',compact('thematiques','thematiquesStatistiques','thematiqueArrays','DepartementFurstSlideSherchs','topThematiques','top3leadThematique','villesSlide','reviews'));
    }

////////////////////////////////////////   Marketplace      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




public function marketplace_get(Request $request)
{

    // Retrieve the initial data for the view
    $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
    ->where('commande',0)
    ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
    ->get() // Récupère les résultats
    ->unique('theme'); 

    $thematiquesStatistiques = Thematique::withCount('leads')
        ->where('commande',0)
        ->orderBy('leads_count', 'desc')
        ->limit(4)
        ->get();

    $DepartementFurstSlideSherchs = Departement::all();

     $thematiquesFurstSlideSherchs = Thematique::where('commande',0)->get();

    ///////// theme filter

    $thematiqueArrays = [] ;

    $themes  = Thematique::where('commande',0)->get();
        foreach ($themes as $theme) {   
            $thematiqueArrays[] = $theme->theme;
        }
    $thematiqueArrays = array_unique(Thematique::where('commande',0)->pluck('theme')->toArray());

  


    ///////// end theme filter ///////////////////

    // Paginate results initially (this will be updated on filter)
    $leadAlls = session('leadAlls', Lead::whereNull("client_id")->where('payer', 0)->where('publier', 1)->withCount('viewedByClients')->latest('updated_at')->paginate(12));


    return view('Marketplace.marketplace', compact(
        'thematiques', 
        'thematiquesStatistiques', 
        'thematiquesFurstSlideSherchs', 
        'DepartementFurstSlideSherchs', 
        'leadAlls',
        'thematiqueArrays'
    ));
}

public function marketplace_filter(Request $request) 
{

    // Retrieve the initial data for the view
    $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
    ->where('commande',0)
    ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
    ->get() // Récupère les résultats
    ->unique('theme'); 


    $thematiquesStatistiques = Thematique::withCount('leads')
        ->orderBy('leads_count', 'desc')
        ->limit(4)
        ->get();

    $thematiquesFurstSlideSherchs = Thematique::all();
    $DepartementFurstSlideSherchs = Departement::all();


    $thematiqueArrays = [] ;

    $themes  = Thematique::all();
        foreach ($themes as $theme) {   
            $thematiqueArrays[] = $theme->theme;
        }
    $thematiqueArrays = array_unique(Thematique::pluck('theme')->toArray());

    // Start with all leads that are not paid and published
    $leadQuery = Lead::where('payer', 0)
        ->where('publier', 1)
        ->withCount('viewedByClients'); 

    // Apply search filter
    if ($request->filled('s')) {
        $leadQuery->where('modeConsommation', 'like', '%' . $request->input('s') . '%');
    }

    // Apply filters based on request parameters
    if ($request->filled('thematique_id')) {
        $leadQuery->where('thematique_id', $request->input('thematique_id'));
        session()->flash('thematique_id', $request->input('thematique_id'));
    }


    if ($request->filled('thematiqueArray')) {
        $leadQuery->whereHas('thematique', function($query) use ($request) {
            $query->where('theme', $request->input('thematiqueArray'));  
        });
        session()->flash('thematiqueArray', $request->input('thematiqueArray'));
    }


    if ($request->filled('thematiqueSelect')) {
        $leadQuery->whereHas('thematique', function($query) use ($request) {
            $query->where('thematique', $request->input('thematiqueSelect'));  
        });
        session()->flash('thematiqueArray', $request->input('thematiqueArray'));
    }



    if ($request->filled('departement_id')) {
        $leadQuery->where('departement_id', $request->input('departement_id'));
        session()->flash('departement_id', $request->input('departement_id'));
    }

    if ($request->filled('type')) {
        $leadQuery->whereHas('thematique', function($query) use ($request) {
            $query->where('type', $request->input('type'));  
        });
        session()->flash('type', $request->input('type'));
    }

    // Time-based filtering
    if($request->filled('time_filter')){

        $timeFilter = $request->input('time_filter');

        switch ($timeFilter){
            case 'today':
                $leadQuery->whereDate('created_at', now()->format('Y-m-d'));
                break;

            case 'this_week':
                $leadQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'this_month':
                $leadQuery->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                break;

            default:
                break;
        }

        session()->flash('time_filter', $timeFilter);
    }

    // Paginate the results
    $leadAlls = $leadQuery->latest('updated_at')->paginate(12);

    session()->flash('leadAlls', $leadAlls);
    
    // Redirect to the marketplace page with input
    return redirect()->route('get.marketplace')->withInput();
    
}
    


public function detai_get($id){

    if(Lead::where("id", $id)->where("payer", 1)->count() > 0) return redirect("/marketplace/marketplace");


        $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
        ->get() // Récupère les résultats
        ->unique('theme'); 


    $check_leady_type = Lead::where("id", $id)->whereNull("client_id");

    

    if($check_leady_type->count() > 0)
    {

        $view      = "Marketplace.detail";
        $detaiLead = Lead::find($id);

    }else{

        $view      = "Marketplace.detai-excel";
        $detaiLead = Lead::find($id);

        $commandeDetail = Commande::where("lead_id", $id)->first();

        $detaiLead->commande_details = $commandeDetail;

    }


    $thematiquesStatistiques = Thematique::withCount('leads')
                                            ->orderBy('leads_count', 'desc')
                                            ->limit(4)
                                            ->get();


    $slidePub = Lead::latest('updated_at')->limit(4)->get();


    return view($view,compact('thematiques','detaiLead','thematiquesStatistiques','slidePub'));

}

///////////////// faq ////////////////////////////////////////////////////////////////////////



    public function get_faq(){

    $thematiquesStatistiques = Thematique::withCount('leads')
                                            ->orderBy('leads_count', 'desc')
                                            ->limit(4)
                                            ->get();

                                            $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
                                            ->where('commande',0)
                                            ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
                                            ->get() // Récupère les résultats
                                            ->unique('theme'); 

    return view('Marketplace.faq',compact('thematiquesStatistiques','thematiques')); 

    }



    ////////////////////////  register   ///////////////////////////////////////////////


    public function get_register(){
        $thematiquesStatistiques = Thematique::withCount('leads')
        ->orderBy('leads_count', 'desc')
        ->limit(4)
        ->get();
    
        $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
        ->get() // Récupère les résultats
        ->unique('theme'); 

        $thematiqueselect=Thematique::all();
        $departementselect=Departement::all();
        $villeselect=Ville::all();
        $client = Client::find(session('client_hom')->id);
        $requiredFields = ['nom','prenom', 'email', 'tel','addresse']; // Remplacez par les champs réels que vous souhaitez vérifier
        $allFilled = true;
        foreach ($requiredFields as $field) {
            if (empty($client->{$field})) {
                $allFilled = false;
                break; // Sortir de la boucle si un champ est vide
            }
        }
        return view('Marketplace.register',compact('thematiquesStatistiques','thematiques','thematiqueselect','departementselect','villeselect','client','allFilled'));
    }



    public function getDepartements()
    {
        $clientId = session('client_hom')->id; // Récupérer l'ID du client à partir de la session
        // Utilisez find sans 'with' pour éviter les problèmes de collection
        $client = Client::find($clientId);
    
        // Récupérer tous les départements
        $departements = Departement::select('id', 'departement as name','num')->get();
    
        // Initialiser un tableau vide pour les IDs sélectionnés
        $selectedDepartements = [];
    
        // Vérifiez si le client existe et a des départements associés
        if ($client) {
            // Assurez-vous que la relation existe et récupérez les IDs
            if ($client->departement) {
                $selectedDepartements = $client->departement->pluck('id')->toArray();
            }
        }
    
        return response()->json(['departements' => $departements, 'selected' => $selectedDepartements]);
    }
    

    
    public function getThematiques()
    {
        $clientId = session('client_hom')->id; // Récupérer l'ID du client à partir de la session
        // Utilisez find sans 'with' pour éviter les problèmes de collection
        $client = Client::find($clientId);
    
        // Récupérer toutes les thématiques
        $thematiques = Thematique::select('id', 'thematique as name')->get();
    
        // Initialiser un tableau vide pour les IDs sélectionnés
        $selectedThematiques = [];
    
        // Vérifiez si le client existe et a des thématiques associées
        if ($client) {
            // Assurez-vous que la relation existe et récupérez les IDs
            if ($client->thematique) {
                $selectedThematiques = $client->thematique->pluck('id')->toArray();
            }
        }
    
        return response()->json(['thematiques' => $thematiques, 'selected' => $selectedThematiques]);
    }



    public function updateClientSelections(Request $request)
    {
        $clientId = session('client_hom'); // Get client ID from session
        $client = Client::find($clientId);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        // Update departments
        $selectedDepartments = $request->input('departments');
        $client->departement()->sync($selectedDepartments); // Sync the selected departments

        // Update thematiques
        $selectedThematiques = $request->input('thematiques');
        $client->thematique()->sync($selectedThematiques); // Sync the selected thematiques

        return response()->json(['success' => 'Selections updated successfully']);
    }


    public function getSelectedDepartements()
    {
        // Assuming you have a user model and a relationship for selected departments
        $user = Client::with('departement')->find(session('client_hom')); // Get the currently authenticated user
         
        // Replace 'selectedDepartments' with the actual relationship in your User model
        $selectedDepartements = $user->departement->pluck('id');

       
       

        return response()->json($selectedDepartements);
    }

    
    public function getSelectedThematiques()
    {
        // Assuming you have a user model and a relationship for selected themes
        $user = Client::find(session('client_hom')); // Get the currently authenticated user

        // Replace 'selectedThematiques' with the actual relationship in your User model
        $selectedThematiques = $user->thematique()->pluck('id'); 

        return response()->json($selectedThematiques);
    }



////       furst step regiter     /////////////////////////////////////////////////////////////////////////////////////////////////

public function furstStepRegister(Request $request)
{
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:clients',
        'password' => 'required|string|min:8|confirmed',
        'telephone' => 'required|string|max:15',
        'termsAccepted' => 'accepted', // Validate that terms are accepted
    ], [
        'termsAccepted.accepted' => "Vous devez accepter les Conditions d'Utilisation." // Custom error message
    ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

    // Create the user
    $user = Client::create([
        'nom' => $request->name,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'tel' => $request->telephone,
        'mot_de_passe' => Hash::make($request->password),
    ]);

        // Generate the reset link
        $resetLink = URL::temporarySignedRoute(
            'acepted.vocal',
            now()->addMinutes(60),
            ['id' => $user->id, 'token' => Str::random(60)]
        );

            // Send the email
    Mail::send('mail.succesCompte', ['client' => $user, 'resetLink' => $resetLink], function ($message) use ($user) {
        $message->to($user->email)
                ->subject("Réception de votre demande d'inscription sur Lead & Boost");
    });

    // Optionally, you can log the user in after registration
    // Auth::login($user);

    // Return success response
    return response()->json([
        'success' => true,
        'message' => 'Inscription réussie !',
    ]);
}
//////////////////////////acepted vocal email /////////

public function acepted_vocal($id){
    $user = Client::find($id);
    return view('mail.aceptedVocal',compact('user'));
}

public function updateVerification(Request $request)
{
   
    // Valider les données reçues
    $request->validate([
        'clientId' => 'required', // Vérifie si l'ID existe dans la table 'users'
    ]);

    // Récupérer le client par ID
    $client = Client::find($request->clientId);

    // Vérifier si le client est trouvé
    if ($client) {
        // Mettre à jour le statut de vérification
        $client->verification = 1;
        $client->save();

        return response()->json(['message' => 'Statut de vérification mis à jour avec succès.'], 200);
    }

    // Si le client n'est pas trouvé
    return response()->json(['message' => 'Client non trouvé.'], 404);
}



////////////////login///////////////////////////////////////////////

public function login(Request $request)
{
    // Validate the input data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find the user by email
    $user = Client::where('email', $request->input('email'))->first();

    // Check if the user exists and verify the password
    if (!$user) {
        return response()->json(['success' => false, 'errors' => ['email' => 'L\'adresse e-mail n\'est pas enregistrée.']]);
    }

    if (!Hash::check($request->input('password'), $user->mot_de_passe)) {
        return response()->json(['success' => false, 'errors' => ['password' => 'Mot de passe incorrect.']]);
    }

    if ($user->activer === 0) {
        return response()->json(['success' => false, 'errors' => ['verification' => 'votre compte ne pas activer .']]);
    }

    // Store user information in the session
    session(['client_hom' => $user]);

    // Respond with success
    return response()->json(['success' => true, 'message' => 'Connexion réussie !']);
}




public function logout()
{
    session()->forget('client_hom');

    // Optionally regenerate the session
    session()->regenerate();

    return redirect()->route('get.home'); // Redirect to the login page
}


/////////////////////  trackedViews  //////////////////////////////////////////////////////////////////

public function trackLeadView(Request $request)
{
    

    $clientId = $request->input('client_id');
    $leadId = $request->input('lead_id');

    // Check if the client already viewed the lead
    $viewExists = DB::table('client_lead') // assuming 'client_lead_views' is your middle/pivot table
        ->where('client_id', $clientId)
        ->where('lead_id', $leadId)
        ->exists();

    // If the view does not exist, add a new entry
    if (!$viewExists) {
        DB::table('client_lead')->insert([
            'client_id' => $clientId,
            'lead_id' => $leadId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    // Get the total view count for the lead
    $viewCount = DB::table('client_lead')
        ->where('lead_id', $leadId)
        ->count();

    // Return the count as JSON
    return response()->json(['view_count' => $viewCount]);
}


////////////////// about us ////////////////////////////////////////////////////////////////////////////


public function about_us(){


    $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
    ->where('commande',0)
    ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
    ->get() // Récupère les résultats
    ->unique('theme'); 

    $thematiquesStatistiques = Thematique::withCount('leads')
    ->orderBy('leads_count', 'desc')
    ->limit(4)
    ->get();


    return view('Marketplace.about_us',compact('thematiques','thematiquesStatistiques'));

}

public function contact(){


    $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
    ->where('commande',0)
    ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
    ->get() // Récupère les résultats
    ->unique('theme'); 

    $thematiquesStatistiques = Thematique::withCount('leads')
    ->orderBy('leads_count', 'desc')
    ->limit(4)
    ->get();


    return view('Marketplace.contact',compact('thematiques','thematiquesStatistiques'));
}


public function sendContact(Request $request)
{
    // Validate form inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'subject' => 'nullable|string|max:255',
        'message' => 'required',
    ]);

    // Prepare the email data
    $data = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'subject' => $request->input('subject') ?? 'No Sujet',
        'userMessage' => $request->input('message'),
    ];


    // Send the email to inboxtechnologica@gmail.com
    Mail::send('mail.messageMail', $data, function ($message) use ($data) {
        $message->from($data['email'], $data['name'], $data['phone'], $data['userMessage'],$data['subject']); // Set sender's email and name
        $message->to('oussamamchimcha@gmail.com'); // Recipient's email
        $message->subject($data['subject']); // Set the subject
    });

    return back()->with('success', 'Votre message a été envoyé avec succès !');
}

////////////////  subscribe/////////////////////////


public function subscribe(Request $request)
{

    $request->validate([
        'email' => 'required|email|unique:newsletters,email', // Adjust table name if different
    ]);

    // Save the email to database or perform the required action
    Newsletter::create(['email' => $request->email]);

    return response()->json(['success' => true, 'message' => 'Subscription successful!']);
}


    public function get_commandes()
    {

        $commandes   = Commande::where("client_id", session("client_hom")["id"])->latest()->get();

        $thematiques =  Thematique::withCount('leads') // Compte le nombre de leads pour chaque thématique
        ->where('commande',0)
        ->orderBy('leads_count', 'desc') // Trie par le nombre de leads de manière décroissante // Limite aux 5 thématiques avec le plus de leads
        ->get() // Récupère les résultats
        ->unique('theme'); 

        return view("Marketplace.dashbord.commandes", compact("commandes", "thematiques"));

    }


}
