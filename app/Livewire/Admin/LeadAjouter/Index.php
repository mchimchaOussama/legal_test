<?php

namespace App\Livewire\Admin\LeadAjouter;

use Livewire\Component;
use App\Models\Lead;
use App\Models\Thematique;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\CodePostale;
use Livewire\WithFileUploads;
use App\Models\Prospect;
use Livewire\Attributes\On;


class Index extends Component
{

    //////////// Array //////////
    public $thematique_array, $ville_array, $departement_array;

    /////// Prospect ////////
    public $nom, $prenom, $tel, $email, $civilite;
    
    /////// Appel /////////
    public $agent, $heure, $date, $disponibilite, $lienMp3, $commentaireAgent;

    //////// publication //////////
    public $ville, $departement, $code_postale, $proprietaire, $metrage, $adresse;

    ////////// Lead ////////////
    public $thematique,$maison,$interetAmeliorationHabitat, $modeConsommation, $commentaireAuditeur, $lienMp3bip, $adresse_cache;

    ///////// Publicite /////////
    public /*$lead_image ,*/ $prix, $adresse_reelle, $description;

    public $prospect_id;


    use WithFileUploads;


    public function mount()
    {
        $this->thematique_array  = Thematique::where('theme','enrRenouvelabl')->get();
        $this->departement_array = Departement::all();
        $this->ville_array       = Ville::all();
    }


    public function supprimer_image()
    {
        $this->lead_image = "";
    }



    public $step = 1; // Initialize with step 1
    public $maxSteps = 5;

    // Function to move to the next step
    public function nextSection()
    {
        if($this->step < $this->maxSteps){
            $this->step++;
        }
    }

    // Function to move to the previous step
    public function previousSection()
    {
        if($this->step > 1){
            $this->step--;
        }
    }
    

    public function cute($text)
    {
        return strip_tags(trim($text));
    }


    public function ajouter_lead_step1()
    {
        $this->validate(
            [
                //////// Prospect //////
                'nom'               => 'required|min:3|max:20',
                'prenom'            => 'required|min:3|max:20',
                'tel'               => 'required|numeric|digits:10',        //|unique:prospects,tel',
                'email'             => 'required|email', //unique:prospects,email|email',
                'civilite'          => 'required|in:Mr,Mme',

            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'numeric'           => ':attribute Invalide',
                'unique'            => ':atribute existe déjà',
                'email'             => ':attribute Invalide',
                'exists'            => ":attribute n'existe pas",
                'digits'            => "Invalide :attribute",
                'in'                =>  "Invalide :attribute"
            ]
        );

        if($this->step < $this->maxSteps){
            $this->step++;
        }
    }


    public function ajouter_lead_step2()
    {
        $this->validate(
            [
                //////// Appel ////////
                'agent'             => 'required',
                'heure'             => 'required',
                'date'              => 'required',
                'disponibilite'     => 'required|in:matin,apres midi,soiree',
                //'lienMp3'           => 'required',
                'commentaireAgent'  => 'required',

            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'numeric'           => ':attribute Invalide',
                'unique'            => ':atribute existe déjà',
                'email'             => ':attribute Invalide',
                'exists'            => ":attribute n'existe pas",
                'in'                =>  "Invalide :attribute"
            ]
        );

        if($this->step < $this->maxSteps){
            $this->step++;
        }
    }


    public function ajouter_lead_step3()
    {
        $this->validate(
            [
                //////// Localisation ////////
                'ville'             => 'required|exists:villes,id',
                'departement'       => 'required|exists:departements,id',
                'code_postale'      =>  'required|min:3',
                'proprietaire'      =>  'required|in:oui,non',
                'metrage'           =>  'required',
                //'adresse'           =>  'required|min:3',

            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'numeric'           => ':attribute Invalide',
                'unique'            => ':atribute existe déjà',
                'email'             => ':attribute Invalide',
                'exists'            => ":attribute n'existe pas",
                'in'                =>  "Invalide :attribute"
            ]
        );

        if($this->step < $this->maxSteps){
            $this->step++;
        }

    }

    public function ajouter_lead_step4()
    {
            $this->validate(
                [
                    ///////// Lead ////////
                    'thematique'          => 'required|exists:thematiques,id',
                    'modeConsommation'    => 'required',
                    'commentaireAuditeur' => 'required',
                    'maison'          => 'required',
                    'adresse_cache'       => 'required|min:10',
                    'interetAmeliorationHabitat'  => 'required',
    
                ],
                [
                    'required'          => 'Ce champ est obligatoire',
                    'min'               => 'Ce champ doit comporter au moins :min caractères',
                    'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                    'numeric'           => ':attribute Invalide',
                    'unique'            => ':atribute existe déjà',
                    'email'             => ':attribute Invalide',
                    'exists'            => ":attribute n'existe pas",
                    'in'                =>  "Invalide :attribute"
                ]
            );


        if($this->step < $this->maxSteps){
            $this->step++;
        }
    }


    public function ajouter_lead_step5()
    {

        $this->validate(
            [
                ///////// Publicite //////////
                "prix"                => 'required|numeric',
                "adresse_reelle"      => 'required',

            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'numeric'           => ':attribute Invalide',
                'unique'            => ':atribute existe déjà',
                'email'             => ':attribute Invalide',
                'exists'            => ":attribute n'existe pas",
                'in'                =>  "Invalide :attribute"
            ]
        );


        $this->prospect_id = Prospect::firstOrCreate([
            "nom"       => $this->cute($this->nom),
            "prenom"    => $this->cute($this->prenom),
            "tel"       => $this->cute($this->tel),
            "email"     => $this->cute($this->email),
            "civilite"  => $this->cute($this->civilite)
        ]);
    

        $code_postale_id = CodePostale::firstOrCreate([
            "code_postale"  =>  $this->code_postale
        ])->id;


        Lead::create([
            'reference'         => time().session("auth")["id"],
            'agent'             => $this->cute($this->agent),
            'heure'             => $this->cute($this->heure),
            'date'              => $this->cute($this->date),
            'disponibilite'     => $this->cute($this->disponibilite),
            'lienMp3'           => $this->cute($this->lienMp3),
            'commentaireAgent'  => $this->cute($this->commentaireAgent),
            'ville_id'          => $this->cute($this->ville),
            'departement_id'    => $this->cute($this->departement),
            'code_postale'      => $this->cute($this->code_postale),
            'proprietaire'      => $this->cute($this->proprietaire),
            'metrage'           => $this->cute($this->metrage),
            'adressePostale'    => $this->cute($this->adresse),
            'thematique_id'     => $this->cute($this->thematique),
            'modeConsommation'  => $this->cute($this->modeConsommation),
            'commentaireAuditeur'=> $this->cute($this->commentaireAuditeur),
            'lienMp3Bip'        => $this->cute($this->lienMp3bip),
            'adresse_cache'     => $this->adresse_cache,
            'prix'              => $this->cute($this->prix),
            'adresse_reelle'    => $this->adresse_reelle,
            'user_id'           => session('auth')['id'],
            'prospect_id'       => $this->prospect_id->id,
            "description"       => $this->description,
            "code_postale_id"   => $code_postale_id,
            "maison"             => $this->maison,
            "interetAmeliorationHabitat"  => $this->interetAmeliorationHabitat
        ]);

        //$this->lead_image = "";

        $this->reset(
                    "prix", "adresse_reelle",
                    "description", "thematique", "modeConsommation", "commentaireAuditeur", "lienMp3bip", "adresse_cache",
                    "ville", "departement", "code_postale", "proprietaire", "metrage", "adresse",
                    "agent", "heure", "date", "disponibilite", "lienMp3", "commentaireAgent",
                    "nom", "prenom", "tel", "email", "civilite",'maison','interetAmeliorationHabitat'
                );

        return $this->dispatch("toast-success"); 

    }



    public function render()
    {
        return view('livewire.admin.lead-ajouter.index',['thematique_array'=>$this->thematique_array,'departement_array'=>$this->departement_array,'ville_array'=>$this->ville_array]);
    }
}
