<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Ville;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Client;
use App\Models\Payment;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

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


    public function mount()
    {
        $this->thematiques  = Thematique::latest()->get();
        $this->departements = Departement::latest()->get();
        $this->publier      = "";
        $this->payer        = "";
        $this->villes       = Ville::latest()->get();
    }

    public function filterLeads()
    {
        $this->resetPage();
    }

    public function search_function()
    {
        $this->f_search      = $this->search;
        $this->f_thematique  = $this->thematique;
        $this->f_departement = $this->departement;
        $this->f_ville       = $this->ville;
    }

    public function render()
    {
        $leads = Payment::query()->with(["thematique", "departement", "prospect","client","lead"]);
        $search_query = trim($this->f_search);
        $search_query = $search_query;

        if(strlen($search_query) > 0){

            $leads->where(function($query) use ($search_query){

                $query->where("prix", "like", "%".$search_query."%")
                ->orWhere("methode", "like", "%".$search_query."%");
            })
            ->orWhereHas("lead", function ($query) use ($search_query) {
                $query->where("reference", "like", "%".$search_query."%");
            })
            ->orWhereHas('client', function ($query) use ($search_query) {
                $query->where("nom", "like", "%".$search_query."%")
                        ->orWhere("prenom", "like", "%".$search_query."%")
                        ->orWhere(DB::raw("CONCAT(nom,' ', prenom)"), 'like', "%$search_query%")
                        ->orWhere("tel", "like", "%".$search_query."%")->orWhere("email", "like", "%".$search_query."%")
                        ->orWhere("addresse", "like", "%".$search_query."%")->orWhere("numero_identification", "like", "%".$search_query."%")
                        ->orWhere("siren", "like", "%".$search_query."%")->orWhere("siret", "like", "%".$search_query."%")
                        ->orWhere("rcs", "like", "%".$search_query."%");

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
            $leads->where("thematique_id", $this->f_thematique);
        }

        if($this->f_departement)
        {
            $leads->where("departement_id", $this->f_departement);
        }
    
        if($this->f_ville)
        {
            $leads->where("ville_id", $this->f_ville);
        }

        if($this->f_publier == "non")
        {
            $leads->where("publier", 0);
        }
        if($this->f_publier == "oui")
        {
            $leads->where("publier", 1);
        }

        if($this->f_payer == "oui")
        {
            $leads->where("payer", 1);
        }
        if($this->f_payer == "non")
        {
            $leads->where("payer", 0);
        }
        $leads = $leads->latest()->paginate(10);  
      
        return view('livewire.admin.payment.index', [
            'leads' => $leads,
         ]);
    }

}
