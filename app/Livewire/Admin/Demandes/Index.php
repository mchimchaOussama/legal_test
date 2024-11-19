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




class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $deleted_id = "";
    public $entreprise, $nom_prenom, $email, $tel, $quantite, $date, $thematique, $departement, $description, $statut, $target_id;

    public $excel, $progress = 0, $commande_id = "";


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


        $this->progress    = 100;
        $this->commande_id = "";
        $this->excel       = "";



        $commande = Commande::where([
            ["id",          "=",  $this->commande_id],
            ["excel_path",  "!=", "" ],
            ["statut",      "=",  1  ],
            ["prix",        ">", 0   ]
        ]);


        if($commande->count() > 0)
        {

            $cmd = Commande::where("id", $this->commande_id)->first();
            $client = $cmd->client;

            Mail::send('mail.commandeAgre', ['cmd' => $cmd], function ($message) use ($cmd) {
                $message->to($cmd->client->email)
                        ->subject('Votre commande a été Accéptée');
            });

        }

        return;
    }


    #[On('modifier-prix')]
    public function modifier_prix($value, $id)
    {

        $value = floatval($value);

        if($value <= 0) return;

        $commande = Commande::where("id", $id);

        if($commande->count() == 0) return;

        Commande::where("id", $id)->update(["prix" => $value]);

        return;

    }


    public function render()
    {

        if($this->excel)
        {
            $this->upload_excel_file();
        }

        $commandes = Commande::latest()->paginate(10);

        return view('livewire.admin.demandes.index', ["commandes"   =>  $commandes]);
        
    }



}
