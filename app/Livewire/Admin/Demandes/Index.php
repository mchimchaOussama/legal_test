<?php

namespace App\Livewire\Admin\Demandes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Commande;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Thematique;
use App\Models\Departement;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;



class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $deleted_id = "";
    public $entreprise, $nom_prenom, $email, $tel, $quantite, $date, $thematique, $departement, $description, $statut, $target_id, $prix;

    public $excel, $progress = 0, $commande_id = "";
    public $results= [], $search = "";


    public function changer_statut($id, $value)
    {

        $commande = Commande::where("id", $id);

        if($commande->count() == 0) return;

        $commande->update(["statut" =>  $value]);

    }


    public function changer_statut_modal($id, $value)
    {

        $commande = Commande::where("id", $id);

        if($commande->count() == 0) return;

        $commande->update(["statut" =>  $value]);

        $this->statut       = intval($value);

    }


    public function commande_detail($id)
    {
        $commande = Commande::where("id", $id);

        if($commande->count() == 0) return;

        $commande = $commande->first();

        $this->entreprise   = $commande->client->entreprise;
        $this->nom_prenom   = $commande->client->nom." ".$commande->client->prenom;
        $this->email        = $commande->client->email;
        $this->tel          = $commande->client->tel;   
        $this->quantite     = $commande->nombre_leads;
        $this->date         = Carbon::parse($commande->date_livraison)->format("d/m/Y");
        $this->thematique   = $commande->thematique;
        $this->departement  = $commande->departement;
        $this->description  = $commande->description;
        $this->statut       = $commande->statut;
        $this->target_id    = $commande->id;
        $this->prix         = $commande->prix;
    }


    public function supprimer_commande($id)
    {

        $this->deleted_id = $id;
        return $this->dispatch("confirm", targeted_function:"yes-delete-commande");

    }


    #[On('yes-delete-commande')]
    public function yes_delete_commande()
    {

        $commande = Commande::where("id", $this->deleted_id);

        if($commande->count() == 0) return;

        Commande::find($this->deleted_id)->delete();

        $this->deleted_id = "";
        
    }


    public function importer_file_id($id)
    {
        $this->commande_id = $id;
        $this->progress    = 0;
    }


    public function upload_excel_file()           
    {

        $commande = Commande::where("id", $this->commande_id);

        if($commande->count() == 0 || empty($this->commande_id)) return;
        

        $path = $this->excel->store("leads_excel", "public");
        $path = storage_path("app/public/".$path);        


        Commande::where("id", $this->commande_id)->update(["excel_path" => $path]);


        $commande = Commande::where([
            ["id",          "=",  $this->commande_id],
            ["excel_path",  "!=", "" ],
            ["statut",      "=",  1  ],
            ["prix",        ">", 0   ]
        ]);


        if($commande->count() > 0)
        {

            /////// Ajouter Lead (Leads en quantite) /////////
            $leadId = Lead::create([
                "reference"         =>  time().session("auth")["id"],
                "adresse_cache"     =>  "-",
                "adresse_reelle"    =>  "-",
                "client_id"         =>  $commande->first()->client_id,
                "prix"              =>  $commande->first()->prix,
                "commande"          =>  1,
                "thematique_id"     =>  999999,
                "departement_id"    =>  999999,
                "ville_id"          =>  999999,
                "code_postale_id"   =>  999999,
                "code_postale"      =>  "commande",
                "prospect_id"       =>  999999999,
                "user_id"           =>  999999999,
            ])->id;
            

            Commande::where("id", $this->commande_id)->update(["lead_id"    =>  $leadId]);
            

            $cmd    = Commande::where("id", $this->commande_id)->first();
            $client = $cmd->client;
            
            
            Mail::send('mail.commandeAgre', ['cmd' => $cmd], function ($message) use ($cmd) {
                $message->to($cmd->client->email)->subject('Votre commande a été Accéptée');
            });
            

        }

        $this->progress    = 100;
        $this->commande_id = "";
        $this->excel       = "";

        return;

    }


    #[On('modifier-prix')]
    public function modifier_prix($value, $id)
    {

        $value = trim($value, " ");

        $value = floatval($value);

        if($value <= 0) return;

        $commande = Commande::where("id", $id);

        if($commande->count() == 0) return;

        Commande::where("id", $id)->update(["prix" => $value]);

        return;

    }


    #[On("search")]
    public function search($value)
    {

        $value = trim($value," ");

        if(!empty($value))
        {

            $this->results = Commande::where("thematique",       "like", "%$value%")
                                        ->orWhere("departement", "like", "%$value%")
                                        ->orWhere("description", "like", "%$value%")
                                        ->orWhereHas("client", function($query) use ($value){
                                            $query->where("nom", "like", "%$value%")
                                                    ->orWhere("prenom", "like", "%$value%")
                                                    ->orWhere("entreprise", "like", "%$value%")
                                                    ->orWhere("email", "like", "%$value%")
                                                    ->orWhere("tel", "like", "%$value%")
                                                    ->orWhere("numero_identification", "like", "%$value%")
                                                    ->orWhere("siren", "like", "%$value%")
                                                    ->orWhere("siret", "like", "%$value%")
                                                    ->orWhere("rcs", "like", "%$value%");
                                        })
                                        ->get();
            
        }else{
            $this->results = [];
        }

    }


    public function render()
    {

        if($this->excel)
        {
            $this->upload_excel_file();
        }


        if(sizeof($this->results) > 0)
        {
            $commandes = $this->results;
        }else{
            $commandes = Commande::latest()->paginate(10);
        }

        
        return view('livewire.admin.demandes.index', ["commandes"   =>  $commandes]);

    }



}
