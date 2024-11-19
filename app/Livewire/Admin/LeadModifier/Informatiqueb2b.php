<?php

namespace App\Livewire\Admin\LeadModifier;

use Livewire\Component;
use App\Models\Thematique;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Lead;
use App\Models\Prospect;

class Informatiqueb2b extends Component
{





      //////////// Array //////////
      public $thematique_array, $ville_array, $departement_array;
      public $prospect;

      //////////// Lead //////////
      public $lead;
      public $lead_id;


      /////// Prospect ////////
      public $nom, $prenom, $tel, $email, $civilite,$gerantNonSalarie,$nombreDeSalarie,$lange;
      
      /////// Appel /////////
      public $agent, $heure, $date, $disponibilite, $mp3Original, $commentaireAgent;
  
      //////// publication //////////
      public $ville, $departement, $code_postale, $proprietaire, $metrage, $adresse;
  
      ////////// Lead ////////////
      public $thematique, $modeConsommation, $commentaireAuditeur, $mp3Bipe, $adresse_cache,$maison,$interetAmeliorationHabitat;
  
      ///////// Publicite /////////
      public $image, $prix, $adresse_reelle, $description;

      public function mount($leadId)
      {
          // Charger le Lead avec son Prospect
          $this->lead = Lead::with('prospect')->findOrFail($leadId);
          $this->lead_id = $leadId;
          // Récupérer le Prospect lié au Lead
          $this->prospect = $this->lead->prospect;
      
          // Charger les autres données nécessaires
          $this->thematique_array  = Thematique::all();
          $this->departement_array = Departement::all();
          $this->ville_array       = Ville::all();
      
          // Initialiser la propriété  avec la valeur du Prospect associé
          $this->nom = $this->prospect->nom;
          $this->prenom = $this->prospect->prenom;
          $this->tel = $this->prospect->tel;
          $this->email = $this->prospect->email;
          $this->civilite = $this->prospect->civilite;
           // Initialiser la propriété  avec la valeur du Appel associé
           $this->agent = $this->lead->agent;
           $this->heure = $this->lead->heure;
           $this->date = $this->lead->date;
           $this->disponibilite = $this->lead->disponibilite;
           $this->mp3Original = $this->lead->lienMp3;
           $this->commentaireAgent = $this->lead->commentaireAgent;
           // Initialiser la propriété  avec la valeur du Localisation associé
           $this->ville = $this->lead->ville_id;
           $this->departement = $this->lead->departement_id;
           $this->code_postale = $this->lead->code_postale;
           $this->proprietaire = $this->lead->proprietaire;
           $this->metrage = $this->lead->metrage;
           $this->adresse = $this->lead->adressePostale;
           // Initialiser la propriété  avec la valeur du Lead associé
           $this->thematique = $this->lead->thematique_id;
           $this->modeConsommation = $this->lead->modeConsommation;
           $this->commentaireAuditeur = $this->lead->commentaireAuditeur;
           $this->mp3Bipe = $this->lead->lienMp3Bip;
           $this->nombreDeSalarie = $this->lead->nombreDeSalarie;
           $this->gerantNonSalarie = $this->lead->gerantNonSalarie;
           $this->adresse_cache = $this->lead->adresse_cache;
           // Initialiser la propriété  avec la valeur du Publicité associé
           $this->prix = $this->lead->prix;
           $this->lange = $this->lead->lange;
           $this->adresse_reelle = $this->lead->adresse_reelle;
           $this->description = $this->lead->description;      
      }

      public  function update_lead(){


          $this->validate(
              [
                  //////// Prospect //////
                  'nom'               => 'required|min:3|max:20',
                  'prenom'            => 'required|min:3|max:20',
                  'tel'               => 'required|numeric|digits:10',        //|unique:prospects,tel',
                  'email'             => 'required|email', //unique:prospects,email|email',
                  'civilite'          => 'required|in:Mr,Mme',
                  //////// Appel ////////
                  'agent'             => 'required',
                  'heure'             => 'required',
                  'date'              => 'required',
                  'disponibilite'     => 'required|in:matin,apres midi,soiree',
                  //'lienMp3'           => 'required',
                  'commentaireAgent'  => 'required',
                  //////// Localisation ////////
                  'ville'             => 'required|exists:villes,id',
                  'departement'       => 'required|exists:departements,id',
                  'code_postale'      =>  'required|min:3',
               //   'proprietaire'      =>  'required|in:oui,non',
                 // 'metrage'           =>  'required',
                  //'adresse'           =>  'required|min:3',
                  ///////// Lead ////////
                  'thematique'          => 'required|exists:thematiques,id',
                  'lange'    => 'required',
                  'commentaireAuditeur' => 'required',
                  'nombreDeSalarie' => 'required',
                  'adresse_cache'       => 'required|min:10',
                  'gerantNonSalarie' => 'required',
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
                  'digits'            => "Invalide :attribute",
                  'in'                =>  "Invalide :attribute"
              ]
          );



      // Find the lead record
      $new_lead = $this->lead;
      // Update lead fields
      $new_lead->agent = $this->agent;
      $new_lead->heure = $this->heure;
      $new_lead->date = $this->date;
      $new_lead->disponibilite = $this->disponibilite;
      $new_lead->lienMp3 = $this->mp3Original;
      $new_lead->commentaireAgent = $this->commentaireAgent;
      $new_lead->ville_id = $this->ville;
      $new_lead->departement_id = $this->departement;
      $new_lead->code_postale = $this->code_postale;
      $new_lead->proprietaire = $this->proprietaire;
      $new_lead->metrage = $this->metrage;
      $new_lead->adressePostale = $this->adresse;
      $new_lead->thematique_id = $this->thematique;
      $new_lead->modeConsommation = $this->modeConsommation;
      $new_lead->commentaireAuditeur = $this->commentaireAuditeur;
      $new_lead->lienMp3Bip = $this->mp3Bipe;
      $new_lead->adresse_cache = $this->adresse_cache;
      $new_lead->prix = $this->prix;
      $new_lead->adresse_reelle = $this->adresse_reelle;
      $new_lead->description = $this->description;
      $new_lead->nombreDeSalarie = $this->nombreDeSalarie;
      $new_lead->gerantNonSalarie = $this->gerantNonSalarie;
      $new_lead->lange = $this->lange;
      // Save the lead
      $new_lead->save();
      // Also update the Prospect model related to the lead
      $new_prospect = $new_lead->prospect;
      $new_prospect->nom = $this->nom;
      $new_prospect->prenom = $this->prenom;
      $new_prospect->tel = $this->tel;
      $new_prospect->email = $this->email;
      $new_prospect->civilite = $this->civilite;
      // Save the prospect
      $new_prospect->save();
      return $this->dispatch("toast-success"); 
      } 




    public function render()
    {
        return view('livewire.admin.lead-modifier.informatiqueb2b',['thematique_array' => $this->thematique_array , 'departement_array' => $this->departement_array , 'ville_array'=>$this->ville_array]);
    }
}
