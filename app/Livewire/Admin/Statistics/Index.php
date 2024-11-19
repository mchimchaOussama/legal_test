<?php

namespace App\Livewire\Admin\Statistics;

use Livewire\Component;
use App\Models\Thematique;
use App\Models\Departement;
use App\Models\Payment;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Ville;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;



class Index extends Component
{

    public $thematique_array  = [];
    public $departement_array = [];
    public $users_array       = [];

    public $thematique, $departement, $date_debut, $date_fin, $chart_filter, $admin;

    #[Url]
    public $search_thematique = '', $search_departement = '', $search_date_debut = '', $search_date_fin = '', $search_chart_filter = '', $search_admin='';



    public function render()
    {

        $this->thematique_array  = Thematique::all();
        $this->departement_array = Departement::all(); 
        $this->users_array       = User::all();
        $this->date_debut        = Carbon::now()->format("Y-m-d");
        $this->date_fin          = Carbon::now()->addMonth()->format("Y-m-d");

        
        ///////// Set Thematique ///////
        if($this->search_thematique)
        {
            $this->thematique = $this->search_thematique;
        }

        ///////// Set Department ////////
        if($this->search_departement){
            $this->departement   = $this->search_departement;
        }

        /////// Set Date Debut /////////
        if($this->search_date_debut)
        {
            $this->date_debut = $this->search_date_debut;
        }

        ///////// Set Date Fin ////////
        if($this->search_date_fin){
            $this->date_fin   = $this->search_date_fin;
        }

        //// Set Chart filter ////
        if($this->search_chart_filter)
        {
            $this->chart_filter = $this->search_chart_filter;
        }else{
            $this->chart_filter = "ventes";
        }



            $this->admin = $this->search_admin;



        $startDate = $this->date_debut;
        $endDate   = $this->date_fin;



        //////////////// Clients /////////////////
            $clients = Client::query()->with(['payment' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])->withCount("payment");


            /// Filter By Thematique ////
            if($this->thematique)
            {
                $clients->whereHas('thematique', function ($query){
                    $query->where('thematique_id', $this->thematique);
                });
            }

            //// Filter By Thematique ////
            if($this->departement)
            {
                $clients->whereHas('departement', function ($query){
                    $query->where('departement_id', $this->thematique);
                });
            }

            $clients = $clients->orderBy("payment_count", "desc")->get();
        ///////////// End Client ////////////////



        ///////// Thematiques ////////
        $thematiques  = Thematique::query()->with(['payments' => function($query) use ($startDate, $endDate) {
                            $query->whereBetween('created_at', [$startDate, $endDate]);
                        }])
                        ->withCount("payments")
                        ->orderByDesc("payments_count")
                        ->get();
        //////// End Thematiques ////////



        ///////// Departements ///////////
        $departements = Departement::query()->with(['payments' => function($query) use ($startDate, $endDate) {
                            $query->whereBetween('created_at', [$startDate, $endDate]);
                        }])
                        ->withCount("payments")
                        ->orderByDesc("payments_count")
                        ->get();
        ///////// End departements ///////////



        ////////// Villes ////////////
        $villes = Ville::query()->with(['payment' => function($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }])
                    ->withCount("payment")
                    ->orderByDesc("payment_count")
                    ->get();
        ///////// End Villes ///////////

        
        //////////////////////////// Progression //////////////////////////////
        if($this->chart_filter == "ventes"){

            $chart_ventes = Payment::query()
                                ->select(DB::raw('DATE(created_at) as date_vente'), DB::raw('sum(prix) as total_payments'))
                                ->groupBy('date_vente')
                                ->orderBy('date_vente', 'asc')
                                ->whereBetween("created_at", [$startDate, $endDate]);

            $total_leads = Lead::query()
                                ->select(DB::raw("count(*) as total_leads"))
                                ->whereBetween("created_at", [$startDate, $endDate]);

            if($this->search_admin)
            {
                $chart_ventes->where("user_id", $this->search_admin);
                $total_leads->where("user_id", $this->search_admin);
            }


            $chart_ventes       = $chart_ventes->get();
            $total_leads_achete = $total_leads->where("payer", 1)->count();

            $chart_dates  = $chart_ventes->pluck("date_vente")->toArray(); 
            $chart_data   = $chart_ventes->pluck("total_payments")->toArray();

            $total_leads  = $total_leads->get()->value("total_leads");

            $chart_total  = "<span>Totaux: € ".$chart_ventes->sum("total_payments")."</span><span class='ml-2 text-primary'>Total Leads: ".$total_leads_achete."</span>";

        }


        if($this->chart_filter == "leads"){

            $chart_leads = Lead::query()
                                ->select(DB::raw('DATE(created_at) as date_lead'), DB::raw("count(*) as leads_count"))
                                ->groupBy('date_lead')
                                ->orderBy('date_lead', 'asc')
                                ->whereBetween("created_at", [$startDate, $endDate]);
                                
            if($this->search_admin)
            {
                $chart_leads->where("user_id", $this->search_admin);
            }
            
            $chart_leads = $chart_leads->get();
            $chart_dates = $chart_leads->pluck("date_lead")->toArray();
            $chart_data  = $chart_leads->pluck("leads_count")->toArray();

            $chart_total = "Leads: ".$chart_leads->sum("leads_count");

        }
        ///////////////////////// End Progression ////////////////////////////
                    


        return view('livewire.admin.statistics.index', [
            "clients"       =>  $clients,
            "thematiques"   =>  $thematiques,
            "departements"  =>  $departements,
            "villes"        =>  $villes,
            "chart_dates"   =>  $chart_dates,
            "chart_data"    =>  $chart_data,
            "chart_is"      =>  $this->chart_filter,
            "chart_total"   =>  $chart_total,
        ]);


    }

}
