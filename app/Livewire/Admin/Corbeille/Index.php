<?php
namespace App\Livewire\Admin\Corbeille;
use Livewire\Component;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Ville;
use App\Models\Thematique;
use App\Models\Departement;
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

    public $f_search      = '';
    public $f_thematique  = '';
    public $f_departement = '';
    public $f_ville       = '';
    public $f_publier     = '';
    public $f_payer       = '';

    /////////// Deelete Lead ////////////
    public function delete_Lead_corbeille($id)
    {
        $lead_count = Lead::onlyTrashed()->where("id", $id)->get()->count();
        
        if($lead_count == 0)
        {
            return dispatch("toast-failed");
        }

        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-Lead");
    }


    #[On('yes-delete-Lead')]
    public function yes_delete_Lead(){
      
        $find_lead = Lead::onlyTrashed()->where("id", $this->deleted_id)->get()->count();

        if($find_lead == 0) return;

        $lead_deleted = Lead::withTrashed()->findOrFail($this->deleted_id);
        $lead_deleted->forceDelete();

        $this->deleted_id = "";
        return $this->dispatch("toast-success");

    }

    public function reply($id)
    {
        // Check if the soft-deleted lead exists
        $exists = Lead::onlyTrashed()->where('id', $id)->exists();
    
        if (!$exists) {   
            // Lead does not exist in the trashed state
            return $this->dispatch("toast-failed");
        } else {
            // Lead exists, restore it
            $lead = Lead::onlyTrashed()->findOrFail($id);
            $lead->restore();
    
            // Optionally, you can add a success message
            return $this->dispatch("toast-success");
        }
    }
    

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
        $this->f_publier     = $this->publier;
        $this->f_payer       = $this->payer;
    }


    public function render()
    {


        $leads = Lead::onlyTrashed() // Only soft-deleted leads
        ->with(["thematique", "departement", "prospect"]);
        
        $search_query = trim($this->f_search);
        $search_query = $search_query;

        if(strlen($search_query) > 0){

            $leads->where(function($query) use ($search_query){

                $query->where("reference", "like", "%".$search_query."%")
                ->orWhere("heure", "like", "%".$search_query."%")
                ->orWhere("code_postale", "like", "%".$search_query."%")->orWhere("modeConsommation", "like", "%".$search_query."%")
                ->orWhere("metrage", "like", "%".$search_query."%")->orWhere("adressePostale", "like", "%".$search_query."%")
                ->orWhere("commentaireAgent", "like", "%".$search_query."%")->orWhere("commentaireAuditeur", "like", "%".$search_query."%")
                ->orWhere("agent", "like", "%".$search_query."%");

            })
            ->orWhereHas('prospect', function ($query) use ($search_query) {

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

        $leads = $leads->latest()->paginate(5);


        return view('livewire.admin.corbeille.index', [
            'leads' => $leads,
         ] );
    }
}
