<?php

namespace App\Livewire\Admin\CouponAjouter;

use Livewire\Component;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Coupon;
use App\Models\Client_coupon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Index extends Component
{

    public $client_search_result = [];
    public $lead_search_result   = [];
    public $client;
    public $lead;
    public $add_lead_array       = [];
    public $add_client_array     = [];

    public $selected_lead    = [];
    public $selected_clients = [];
    public $coupon_code      = "";
    public $coupon_discount  = 0;
    public $client_ids       = [];
    public $lead_ids         = [];
    public $date_debut;
    public $date_fin;



    public function client_search()
    {

        $this->lead_search_result = [];

        $recherche2 = $this->client;

        if($recherche2)
        {
            
            $this->client_search_result = Client::where("nom", "like", "%".$recherche2."%")
                                                ->orWhere("entreprise", "like", "%".$recherche2."%")
                                                ->orWhere("prenom", "like", "%".$recherche2."%")
                                                ->orWhere(DB::raw("CONCAT(nom,' ', prenom)"), 'like', "%$recherche2%")
                                                ->orWhere("tel", "like", "%".$recherche2."%")
                                                ->orWhere("email", "like", "%".$recherche2."%")
                                                ->orWhere("numero_identification", "like", "%".$recherche2."%")
                                                ->orWhere("siren", "like", "%".$recherche2."%")
                                                ->orWhere("siret", "like", "%".$recherche2."%")
                                                ->orWhere("rcs", "like", "%".$recherche2."%")
                                                ->get();

        }else{
            $this->client_search_result = [];
        }

    }


    public function add_client($id)
    {

        $find_client = Client::where("id", $id)->get();
        
        if($find_client->count() == 0) return;


        if(in_array($id, $this->client_ids)) return;
        
        
        array_unshift($this->selected_clients, $find_client->first());
        array_push($this->client_ids, $id);

        $this->client_search_result = [];

        return;

    }


    public function delete_client($id, $index)
    {

        if(($key = array_search($id, $this->client_ids)) !== false) {
            unset($this->client_ids[$key]);
        }

        unset($this->selected_clients[$index]);
        return;

    }


    /*
    public function add_lead($id)
    {

        if(sizeof($this->selected_lead) > 0) return;


        $find_lead = Lead::where("id", $id)->get();
        
        if($find_lead->count() == 0) return;
        
        array_unshift($this->selected_lead, $find_lead->first());
        array_push($this->lead_ids, $id);

        $this->lead_search_result = [];

        return;

    }
    */

    /*
    public function delete_lead($id, $index)
    {

        if(($key = array_search($id, $this->lead_ids)) !== false) {
            unset($this->lead_ids[$key]);
        }
        unset($this->selected_lead[$index]);

        return;
    }
    */

    /*
    public function lead_search()
    {

        $this->client_search_result = [];

        $recherche1 = $this->lead;

        if($recherche1)
        {
            $this->lead_search_result = Lead::where("reference", "like", "%".$recherche1."%")->get();
        }else{
            $this->lead_search_result = [];
        }

    }
    */



    public function ajouter()
    {


        if(sizeof($this->client_ids) == 0) return;

        $this->validate(
            [
                "coupon_code"       => 'required|unique:coupons,coupon',
                "coupon_discount"   => 'required|numeric|gt:0',
                "date_debut"        => 'required',
                "date_fin"          => 'required',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Longueur: :min',
                'numeric'           => ':attribute Invalide',
                'unique'            => ':atribute existe déjà',
                'gt'                => 'minimum: 1%'
            ]
        );


        $inserted_coupon = Coupon::create([
            "coupon"            =>  $this->coupon_code,
            "reduction"         =>  $this->coupon_discount,
            "date_debut"        =>  $this->date_debut,
            "date_fin"          =>  $this->date_fin,
            "lead_id"           =>  1,
        ]);


        foreach($this->client_ids as $client_id)
        {

            DB::table('client_coupon')->insert(
                ['coupon_id' => $inserted_coupon->id, 'client_id' => $client_id, "lead_id" => 1]
            );

        }


        $this->js("$('#coupon-modal').modal('toggle')");
        return;

    }




    public function mount()
    {
        while(True)
        {

            $code = strtoupper(Str::random(10, true, true, false, false));
            
            $find_coupon = Coupon::where("coupon", $code)->count();

            if($find_coupon == 0)
            {
                $this->coupon_code = $code;
                break;
            }

        }

        $this->date_debut = Carbon::now()->format("Y-m-d");
        $this->date_fin   = Carbon::now()->addMonths(1)->format("Y-m-d");

    }


    public function render()
    {
        return view('livewire.admin.coupon-ajouter.index');
    }
    
}
