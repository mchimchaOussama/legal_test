<?php

namespace App\Livewire\Admin\Coupon;

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
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Coupon;



class Index extends Component
{

    use WithPagination;


    public $deleted_id;


    //////////// Delete //////////////
    public function delete_coupon($id)
    {
        $this->deleted_id = $id;
        return $this->dispatch("confirm", targeted_function:"yes-delete-coupon");
    }


    #[On('yes-delete-coupon')]
    public function yes_delete_coupon()
    {
        $find = Coupon::where("id", $this->deleted_id)->count();

        if($find == 0) return $this->dispatch("toast-failed");

        Coupon::find($this->deleted_id)->delete();
        DB::table("client_coupon")->where("coupon_id", $this->deleted_id)->delete();

        $this->deleted_id = "";

        return $this->dispatch("toast-success");
        
    }



    public function render()
    {
        $coupons = Coupon::latest()->paginate(10);

        return view('livewire.admin.coupon.index', [
            "coupons"   =>  $coupons
        ]);
    }
}
