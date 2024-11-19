<?php

namespace App\Livewire\Admin\Lead;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Lead;
use App\Models\Prospect;
use App\Models\Ville;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Client;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


class Index extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $deleted_id = "";
    
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
    public function delete_lead($id)
    {
        $this->deleted_id = $id;
        return $this->dispatch("confirm", targeted_function:"yes-delete-lead");
    }

    #[On('yes-delete-lead')]
    public function yes_delete_lead()
    {
        return dd("Okay");
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


    ///// send email /////
    public function sendEmail($id) 
    {

        $lead = Lead::where('id', $id)->first();

        if ($lead->sned_email === 1) {
            
            return $this->dispatch("toast-failed", message:'Email déjà envoyé');

        }


        if ($lead->payer === 1) {  
            return $this->dispatch("toast-failed", message:'Lead déjà payer');
        }


        $clientAlls = Client::with('departement', 'thematique')
            ->whereHas('departement', function ($query) use ($lead) {
                $query->where('departement_id', $lead->departement_id);
            })
            ->whereHas('thematique', function ($query) use ($lead) {
                $query->where('thematique_id', $lead->thematique_id);
            })
            ->get();
    
        if (!$clientAlls->isEmpty()) {
            foreach ($clientAlls as $client) {
                // Ensure we are accessing the first thematique and departement, if multiple exist
                $thematique = $client->thematique->first();
                $departement = $client->departement->first();
    
                // Generate the reset link
                $resetLink = URL::temporarySignedRoute(
                    'get.marketplace',
                    now()->addMinutes(60),
                    ['id' => $lead->id, 'token' => Str::random(60)]
                );
    
                // Send the email
                Mail::send('mail.newLead', [
                    'lead' => $lead,
                    'client' => $client,
                    'thematique' => $thematique, 
                    'departement' => $departement,
                    'resetLink' => $resetLink
                ], function ($message) use ($client) {
                    $message->to($client->email)
                            ->subject('Nouveau Lead Disponible');
                });
            }
    
            $lead->sned_email = 1 ;
            $lead->save();

            return $this->dispatch("toast-success");
        } else {
            return $this->dispatch("toast-failed");
        }
    }
    


    ////////////////////////////////////////////////////////
    public function activation($statut, $id)
    {
        $lead_count = Lead::where("id", $id)->get()->count();

        if($lead_count == 0)
        {
            
            return $this->dispatch("toast-failed");
        }

        Lead::where("id", $id)->update(["publier"   =>  !$statut]);

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
        
        $leads = Lead::query()->with(["thematique", "departement", "prospect"]);
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

        return view('livewire.admin.lead.index', [
           'leads' => $leads,
        ]);
    }

}
