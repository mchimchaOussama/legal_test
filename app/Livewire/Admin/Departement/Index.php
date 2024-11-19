<?php

namespace App\Livewire\Admin\Departement;

use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    public $departement, $num;
    public $deleted_id;
    public $modified_id;
    

    public function ajouter_departement(){

        $this->validate(
            [
                'departement'        => 'required|max:30|unique:departements,departement',
                'num'                => 'required|min:2|unique:departements,num'
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'unique'            => ':attribute existe déjà',
                'in'                =>  'Invalide type'
            ]
        );

        Departement::create([
            "num"          =>  $this->num,
            "departement"  =>  $this->departement,
        ]);

        $this->reset('departement', "num");
        
        $this->dispatch('close-modal');

        return $this->dispatch('toast-success');

    }

    //////////// Delete ////////////
    public function delete_departement($id){
        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-departement");
    }

    #[On('yes-delete-departement')]
    public function yes_delete_departement(){
        
        $find_departement = Departement::where("id", $this->deleted_id)->get()->count();

        if($find_departement == 0) return;

        Departement::find($this->deleted_id)->delete();
        $this->deleted_id = "";
        return $this->dispatch("toast-success");
        
    } 
   

    ////////// Update //////////
    public $new_num, $new_departement; 

    public function modifier_departement($id)
    {

        $departement = Departement::where("id", $id)->get();

        if($departement->count() == 0) return redirect()->route("admin.accueil");
        
        $departement = $departement->first();

        $this->new_num              = $departement->num;
        $this->new_departement      = $departement->departement;

        $this->modified_id = $id;

        return $this->dispatch("show-edit-modal");

    }


    public function modifier_departement_yes()
    {

        $this->validate(
            [
                'new_departement'   => 'required|max:30',
                'new_num'           => 'required|min:2',
            ],
            [
                'required'     =>  'Ce champ est obligatoire',
                'min'           => 'Ce champ doit comporter au moins :min caractères',
                'max'           => 'Ce champ ne doit pas dépasser :max caractères',
                'unique'        => 'existe déjà',
                'in'            => 'Invalide type',
            ]
        );

        $data               = [];
        $data["departement"] = $this->new_departement;
        $data["num"]         = $this->new_num;

        Departement::where("id", $this->modified_id)->update($data);


        $this->dispatch("close-modal");

        return $this->dispatch("toast-success", message:"département modifié avec succès");

    }

    public function render()
    {
        return view('livewire.admin.departement.index',[
            'departements' => Departement::withCount('leads')->latest()->paginate(10), 
        ]);
    }
}
