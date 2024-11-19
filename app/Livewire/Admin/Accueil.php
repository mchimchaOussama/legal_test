<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Payment;
use App\Models\Lead;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;



class Accueil extends Component
{
 
    public $thematique_array  = [];
    public $departement_array = [];

    public $thematique, $departement, $date_debut, $date_fin, $sales_rate = 0;

    #[Url]
    public $search_thematique = '', $search_departement = '', $search_date_debut = '', $search_date_fin = '';


    public function render()
    {

        $this->thematique_array  = Thematique::all();
        $this->departement_array = Departement::all(); 
        $this->date_debut        = Carbon::now()->format("Y-m-d");
        $this->date_fin          = Carbon::now()->addMonth()->format("Y-m-d");


        /////// Search ////////
        if($this->search_thematique)
        {
            $this->thematique = $this->search_thematique;
        }
        
        if($this->search_departement){
            $this->departement   = $this->search_departement;
        }

        if($this->search_date_debut)
        {
            $this->date_debut = $this->search_date_debut;
        }

        if($this->search_date_fin){
            $this->date_fin   = $this->search_date_fin;
        }
        ////// End Search //////


        $leads      = Lead::query();
        $clients    = Client::query()->where("activer", 1);
        $date_debut = $this->date_debut;
        $date_fin   = $this->date_fin;

        $sales_total = Payment::query()->whereBetween("created_at", [$date_debut, $date_fin]);

        if($this->search_thematique)
        {
            $sales_total->where("thematique_id", $this->search_thematique);
        }

        if($this->search_departement)
        {
            $sales_total->where("departement_id", $this->search_departement);
        }

        $sales_total = $sales_total->get()->count();


        $sales = Payment::query()->select(DB::raw("DATE(created_at) as date_sale"), DB::raw("count(*) as sale_count"))
                            ->groupBy("date_sale")
                            ->orderBy("date_sale", "asc")
                            ->whereBetween("created_at", [$date_debut, $date_fin]);

        ////////// Filter By Thematique //////////
        $thematique = $this->thematique;

        if($this->search_thematique)
        {

            $leads->where("thematique_id", $thematique);

            $clients->whereHas("thematique", function($query) use ($thematique){
                $query->where("thematique_id", $thematique);
            });

            $sales->where("thematique_id", $thematique);

        }


        /////////// Filter By Departement////////////
        $departement = $this->search_departement;

        if($this->search_departement)
        {

            $leads->where("departement_id", $this->search_departement);

            $clients->whereHas("departement", function($query) use ($departement){
                $query->where("departement_id", $departement);
            });

            $sales->where("departement_id", $departement);

        }


        ///// Leads Final Step ////
        $leads = $leads->get();

        ///// Sales Final Step ////
        $sales = $sales->get();

        $sales_data  = $sales->pluck("sale_count")->toArray();
        $sales_dates = $sales->pluck("date_sale")->toArray();





        /////////// Top 10 Clients /////////
        $top_clients = Client::query()->with("payments", function($query) use ($date_debut, $date_fin){
                                $query->whereBetween("created_at", [$date_debut, $date_fin]);
                            })
                            ->withCount("payments")
                            ->orderByDesc("payments_count")
                            ->limit(10)
                            ->get();
        ////////// End Top Clients //////////
        
        
        
        /////////// Top 5 Thematiques //////////
        $top_thematiques  = Thematique::query()->with("payments", function($query) use ($date_debut, $date_fin){
                                    $query->whereBetween("created_at", [$date_debut, $date_fin]);
                                })
                                ->withCount("payments")
                                ->orderByDesc("payments_count")
                                ->limit(5)
                                ->get();
        ///////// End Top thematiques /////////
        


        //////// Top 5 departements /////////
        $top_departements = Departement::query()->with("payments", function($query) use ($date_debut, $date_fin){
                                    $query->whereBetween("created_at", [$date_debut, $date_fin]);
                                })
                                ->withCount("payments")
                                ->orderByDesc("payments_count")
                                ->limit(5)
                                ->get(); 
        ///////// End Top departements ////////

        



        return view('livewire.admin.accueil',[
            "leads"                   => $leads,
            "clients"                 => $clients,
            "sales"                   => $sales,
            "top_thematiques"         => $top_thematiques,
            "top_departements"        => $top_departements,
            "top_clients"             => $top_clients,
            "sales_data"              => $sales_data,
            "sales_dates"             => $sales_dates,
            "sales_total"             => $sales_total
        ]);

        
    }
    
}
