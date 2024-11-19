<?php

namespace App\Livewire\Admin\Review;

use Livewire\Component;

use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Ville;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Review;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class Index extends Component
{

    use WithPagination, WithoutUrlPagination;

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
    public $notation    = '';

    public $f_search      = '';
    public $f_thematique  = '';
    public $f_departement = '';
    public $f_ville       = '';
    public $f_publier     = '';
    public $f_payer       = '';
    public $f_notation    = '';

    /////////// Deelete Lead ////////////
    public function delete_review($id)
    {

        $lead_count = Review::where("id", $id)->get()->count();
        
        if($lead_count == 0)
        {
            return dispatch("toast-failed");
        }


        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-Review");

    }


    #[On('yes-delete-Review')]
    public function yes_delete_Lead(){
      
        $find_lead = Review::where("id", $this->deleted_id)->get()->count();

        if($find_lead == 0) return;

        Review::find($this->deleted_id)->delete();

        $this->deleted_id = "";

        return $this->dispatch("toast-success");

    }

    ////////// Publier Lead ////////
    public function publier()
    {

        $lead_count = Lead::where("id", $id)->get()->count();

        if($lead_count == 0)
        {
            return $this->dispatch("toast-failed");
        }

        Lead::where("id", $id)->update(["publier"   =>  !$statut]);

    }


    public function activation($statut, $id)
    {
        $lead_count = Review::where("id", $id)->get()->count();

        if($lead_count == 0)
        {  
            return $this->dispatch("toast-failed");
        }

        Review::where("id", $id)->update(["publier"   =>  !$statut]);
    }



    public function mount()
    {
        $this->thematiques  = Thematique::latest()->get();
        $this->departements = Departement::latest()->get();
        $this->publier      = "";
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
        $this->f_publier     = $this->publier;
        $this->f_payer       = $this->payer;
        $this->f_notation    = $this->notation;
    }


    public function render()
    {
      

        $leads = Review::query()->with(["client"]);
        $search_query = trim($this->f_search);
        $search_query = $search_query;

        if(strlen($search_query) > 0){

            $leads->where(function($query) use ($search_query){

                $query->where("review", "like", "%".$search_query."%");
            })
            ->orWhereHas('client', function ($query) use ($search_query) {
                $query->where("nom", "like", "%".$search_query."%")
                        ->orWhere("prenom", "like", "%".$search_query."%")
                        ->orWhere(DB::raw("CONCAT(nom,' ', prenom)"), 'like', "%$search_query%")
                        ->orWhere("tel", "like", "%".$search_query."%")->orWhere("email", "like", "%".$search_query."%");
            });

        }

        if($this->f_thematique)
        {
            $leads->where("thematique_id", $this->f_thematique);
        }

        if($this->f_departement)
        {
            $leads->where("departement_id", $this->f_departement);
        }
    

        if($this->f_publier == "non")
        {
            $leads->where("publier", 0);
        }

        if($this->f_publier == "oui")
        {
            $leads->where("publier", 1);
        }

        $leads = $leads->latest()->paginate(6);

        return view('livewire.admin.review.index',[
            'leads' => $leads,
         ]);
    }
}
