<?php

namespace App\Livewire\Admin\Client\Show;

use Livewire\Component;
use App\Models\Thematique;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Payment;
use App\Models\Client;
use Livewire\WithPagination;

class Index extends Component
{

public $prospect;
//////////// Lead //////////
public $lead;
public $client;
public $lead_id;
public $payment_achet;
public $Payment;


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

public $nom_client, $prenom_client, $tel_client, $email_client, $numero_identification, $siren, $siret ,$rcs , $nomPrenom_client ,$entreprise; 


public function mount($leadId)
{
        $client_origin = Client::query()->with(["ville", "departement","thematique"])->where('id',$leadId)->get();

        $this->lead_id = $leadId;
        $this->client = $client_origin->first();
        $this->nomPrenom_client = $this->client->nom .' '. $this->client->prenom ;
        $this->entreprise = $this->client->entreprise;
        $this->rcs = $this->client->rcs;
        $this->siret = $this->client->siret;
        $this->siren = $this->client->siren;
        $this->numero_identification = $this->client->numero_identification;
        $this->email_client = $this->client->email;
        $this->tel_client = $this->client->tel;
        $this->thematique = $this->client->first()->thematique;
        $this->departement = $this->client->first()->departement;
        $this->ville = $this->client->first()->ville;
}


    public function render()
    {

       $Payment = Payment::with('lead',"ville", "departement","thematique",'prospect')
        ->where('client_id', $this->lead_id)
        ->paginate(5);

        return view('livewire.admin.client.show.index',[
            'thematiques'=>$this->thematique,
            'departements'=>$this->departement,
            'villes'=>$this->ville,
            'payments'=> $Payment
        ]);
    }
}
