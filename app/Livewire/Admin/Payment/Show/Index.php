<?php

namespace App\Livewire\Admin\Payment\Show;

use Livewire\Component;
use App\Models\Thematique;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Payment;

class Index extends Component
{

public $prospect;
//////////// Lead //////////
public $lead;
public $lead_id;
public $reference;

/////// Prospect ////////
public $nom, $prenom, $tel, $email, $civilite;

/////// Appel /////////
public $agent, $heure, $date, $disponibilite, $mp3Original, $commentaireAgent;

//////// publication //////////
public $ville, $departement, $code_postale, $proprietaire, $metrage, $adresse;

////////// Lead ////////////
public $thematique, $modeConsommation, $commentaireAuditeur, $mp3Bipe, $adresse_cache;

///////// Publicite /////////
public $image, $prix, $adresse_reelle, $description ,$methode;

public $nom_client, $prenom_client, $tel_client, $email_client, $addresse_client, $numero_identification, $siren, $siret ,$rcs , $nomPrenom_client ; 



public function mount($leadId)
{
        // Charger le Lead avec son Prospect
        $this->lead    = Payment::with('client','lead','departement','ville','thematique')->findOrFail($leadId);
        $this->lead_id = $leadId;
        // Récupérer le Prospect lié au Lead
        $this->prospect = $this->lead->lead->prospect;
        // Initialiser la propriété  avec la valeur du Prospect associé
        $this->reference = $this->lead->lead->reference;
        $this->nom = $this->prospect->nom;
        $this->prenom = $this->prospect->prenom;
        $this->tel = $this->prospect->tel;
        $this->email = $this->prospect->email;
        $this->civilite = $this->prospect->civilite;
        // Initialiser la propriété  avec la valeur du Appel associé
        $this->agent = $this->lead->lead->agent;
        $this->heure = $this->lead->lead->heure;
        $this->date = $this->lead->lead->date;
        $this->disponibilite = $this->lead->lead->disponibilite;
        $this->mp3Original = $this->lead->lead->lienMp3;
        $this->commentaireAgent = $this->lead->lead->commentaireAgent;
        // Initialiser la propriété  avec la valeur du Localisation associé
        $this->ville = $this->lead->ville->ville;
        $this->departement = $this->lead->departement->departement;
        $this->code_postale = $this->lead->lead->code_postale;
        $this->proprietaire = $this->lead->lead->proprietaire;
        $this->metrage = $this->lead->lead->metrage;
        $this->adresse = $this->lead->lead->adressePostale;
        // Initialiser la propriété  avec la valeur du Lead associé
        $this->thematique = $this->lead->thematique->thematique;
        $this->modeConsommation = $this->lead->lead->modeConsommation;
        $this->commentaireAuditeur = $this->lead->lead->commentaireAuditeur;
        $this->mp3Bipe = $this->lead->lead->lienMp3Bip;
        $this->adresse_cache = $this->lead->lead->adresse_cache;
        // Initialiser la propriété  avec la valeur du Publicité associé
        $this->prix = $this->lead->prix;
        $this->adresse_reelle = $this->lead->lead->adresse_reelle;
        $this->description = $this->lead->lead->description;  
        // Initialiser la propriété  avec la valeur du client associé    
        $this->nom_client = $this->lead->client->nom;
        $this->prenom_client = $this->lead->client->prenom;
        $this->nomPrenom_client = $this->nom_client.' '.$this->prenom_client; 
        $this->tel_client = $this->lead->client->tel;
        $this->email_client = $this->lead->client->email;
        $this->addresse_client = $this->lead->client->addresse;
        $this->numero_identification = $this->lead->client->numero_identification;
        $this->siren = $this->lead->client->siren;
        $this->siret = $this->lead->client->siret;
        $this->rcs = $this->lead->client->rcs;
        $this->methode = $this->lead->methode;
}

    public function render()
    {
        return view('livewire.admin.payment.show.index');
    }
}
