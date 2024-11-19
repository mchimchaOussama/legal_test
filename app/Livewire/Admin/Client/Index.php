<?php

namespace App\Livewire\Admin\Client;

use Livewire\Component;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Ville;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Client;
use App\Models\Payment;
use App\Models\ClientDepartement;
use App\Models\ClientThematique;
use App\Models\ClientVille;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;




class Index extends Component
{

    use WithPagination;

    public $deleted_id;
    
    public $thematiques  = [];
    public $departements = [];
    public $villes       = [];
    
    public $search      = '';
    public $thematique  = '';
    public $departement = '';
    public $ClientDepartement = '';
    public $ClientThematique = '';
    public $ClientVille = '';
    public $publier     = '';
    public $payer       = '';
    public $ville       = '';

    public $f_search      = '';
    public $f_thematique  = '';
    public $f_departement = '';
    public $f_ville       = '';
    public $f_publier     = '';
    public $f_payer       = '';
    public $f_date_debut, $f_date_fin;
    public $test;


    public function mount()
    {
        $this->thematiques  = Thematique::latest()->get();
        $this->departements = Departement::latest()->get();
        $this->publier      = "";
        $this->payer        = "";
        $this->villes       = Ville::latest()->get();

    }


    public function search_function()
    {
        $this->f_search      = $this->search;
        $this->f_thematique  = $this->thematique;
        $this->f_departement = $this->departement;
        $this->f_ville       = $this->ville;
    }


    //////////// Activation /////////////
    public function activation($status , $id)
    {
        
       $user = Client::find($id);

       if ($user->verification === 1) {

                Client::where("id", $id)->update([
                    "activer" => !$status ,
                    "accepter" => !$status
                ]);

                if ($user->accepter === 0) {
                // Send the email
                Mail::send('mail.finalStipRegister', ['user' => $user], function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Votre compte a été activé avec succès');
                });

                Client::where("id", $id)->update([
                    "firstActivateCompte" => $user->firstActivateCompte+1 ,
                ]);
                    
                }

            return $this->dispatch("toast-success");
            
       } else {
        return $this->dispatch("toast-failed", message : "L'appel n'a pas été accepté.");
       }

    }
    


    //////// Delete Client //////////////
    public function delete_client($id)
    {
        $this->deleted_id = $id;

        return $this->dispatch("confirm", targeted_function:"yes-delete-client");
    }


    #[On('yes-delete-client')]
    public function yes_delete_client()
    {
        $find = Client::where("id", $this->deleted_id)->get()->count();

        if($find == 0) return $this->dispatch("toast-failed");

        Client::find($this->deleted_id)->delete();

        $this->deleted_id = "";

        return $this->dispatch("toast-success");

    }


    public function render()
    {
        $leads = Client::query()->with(["ville", "departement","thematique"]);
        $search_query = trim($this->f_search);
        $search_query = $search_query;

        if(strlen($search_query) > 0){
            $leads->where(function($query) use ($search_query){
                $query->where("nom", "like", "%".$search_query."%")
                ->orWhere("prenom", "like", "%".$search_query."%")
                ->orWhere(DB::raw("CONCAT(nom,' ', prenom)"), 'like', "%$search_query%")
                ->orWhere("email", "like", "%".$search_query."%")
                ->orWhere("numero_identification", "like", "%".$search_query."%")
                ->orWhere("siren", "like", "%".$search_query."%")
                ->orWhere("siret", "like", "%".$search_query."%")
                ->orWhere("rcs", "like", "%".$search_query."%")
                ->orWhere("entreprise", "like", "%".$search_query."%")
                ->orWhere("tel", "like", "%".$search_query."%");
            });
        }
        
        if($this->f_date_debut)
        {
            $leads->whereDate("created_at", ">=", $this->f_date_debut);
        }

        if($this->f_date_fin)
        {
            $leads->whereDate("created_at", "<=", $this->f_date_fin);
        }

        if($this->f_date_fin){

        }

        if($this->f_thematique)
        {
            $leads->whereHas('thematique', function ($query) {
                $query->where('thematique_id', $this->f_thematique);
            });
        }

        if($this->f_departement)
        {
            $leads->whereHas('departement', function ($query) {
                $query->where('departement_id', $this->f_departement);
            });
        }
    
        if($this->f_ville)
        {
            $leads->whereHas('ville', function ($query) {
                $query->where('ville_id', $this->f_ville);
            });
        }

        $leads = $leads->latest()->paginate(10);

        return view('livewire.admin.client.index',[
            'leads' => $leads,
        ]);
        
    }


}
