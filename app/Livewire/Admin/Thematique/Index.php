<?php

namespace App\Livewire\Admin\Thematique;

use Livewire\Component;
use App\Models\Thematique;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\WithPagination;



class Index extends Component
{

    use WithFileUploads, WithPagination;

    public $thematique;
    public $business_type;
    public $deleted_id;
    public $modified_id;
    public $image;
    public $new_thematique;
    public $new_type_business;
    public $new_image = '';
    public $upload_thematique_image;
    public $theme;
    public $new_theme;
    public $results= [], $search = "";


    public function supprimer_image()
    {
        return $this->image = "";
    }


    public function supprimer_new_image()
    {
        return $this->new_image = "";
    }



    /////////// Ajouter ////////////
    public function ajouter_thematique(){

        $this->validate(
            [ 
                'theme'             => 'required',
                'thematique'        => 'required|min:3',
                'business_type'     => 'required|min:3|max:3|in:B2B,B2C',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'in'                =>  'Invalide type'
            ]
        );

        if($this->image)
        {   
            $path = $this->image->store("uploads", "public");
        }else{
            $path = "";
        }


        Thematique::create([
            "thematique"  =>  $this->thematique,
            "type"        =>  $this->business_type,
            "image"       =>  $path,
            "theme"       =>  $this->theme,
        ]);

        $this->reset(['thematique', 'business_type']);
        $this->image = "";
        
        $this->dispatch('close-modal');

        return $this->dispatch('toast-success');

    }


    //////////// Supprimer ////////////
    public function delete_thematique($id){
        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-thematique");
    }

    #[On('yes-delete-thematique')]
    public function yes_delete_thematique(){
        
        $find_thematique = Thematique::where("id", $this->deleted_id)->get()->count();

        if($find_thematique == 0) return;

        Thematique::find($this->deleted_id)->delete();
        $this->deleted_id = "";
        return $this->dispatch("toast-success");
        
    } 
   

    ////////// Modifier //////////
    public function modifier_thematique($id)
    {

        $this->upload_thematique_image = "";

        $thematique = Thematique::where("id", $id)->get();

        if($thematique->count() == 0) return redirect()->route("admin.accueil");
        
        $thematique = $thematique->first();

        $this->new_thematique      = $thematique->thematique;
        $this->new_type_business   = $thematique->type;
        $this->new_image           = $thematique->image;
        $this->modified_id         = $id;
        $this->new_theme           = $thematique->theme;


        return $this->dispatch("show-edit-modal");

    }


    public function modifier_thematique_yes()
    {

        $this->validate(
            [
                'new_thematique'      => 'required|min:3',
                'new_type_business'   => 'required|in:B2B,B2C',
            ],
            [
                'required'     => 'Ce champ est obligatoire',
                'min'           => 'Ce champ doit comporter au moins :min caractères',
                'max'           => 'Ce champ ne doit pas dépasser :max caractères',
                'in'            => "Invalide type",
            ]
        );

        $data = [];

        if($this->upload_thematique_image)
        {

            $old_image = Thematique::where("id", $this->modified_id)->first()->image;
/*
            if(!empty($old_image))
            {

                try{
                    unlink(storage_path("app/public/".$old_image));
                }catch(Exception $e)
                {
                    //
                }
                
            }
*/
            $path = $this->upload_thematique_image->store("uploads", "public");

            $data["image"]  = $path;
            
        }

        $data["thematique"] = $this->new_thematique;
        $data["type"]       = $this->new_type_business;
        $data["theme"]      = $this->new_theme;
        

        Thematique::where("id", $this->modified_id)->update($data);
        
        $this->upload_thematique_image = "";

        $this->dispatch("close-modal");
        
        $this->dispatch("toast-success", message:"Thématique modifié avec succès");

    }



    #[On("search")]
    public function search($value)
    {

        $value = trim($value," ");

        if(!empty($value))
        {
            
            $this->results = Thematique::withCount("leads")
                                            ->where("thematique", "like", "%$value%")
                                            ->orWhere("theme", "like", "%$value%")
                                            ->orWhere("type", "like", "%$value%")
                                            ->get();
            
        }else{
            $this->results = [];
        }
        
    }



    public function render()
    {
        
        if(sizeof($this->results) > 0)
        {
            $thematiques = $this->results;
        }
        else{
            $thematiques = Thematique::withCount("leads")->latest()->paginate(10);
        }

        return view('livewire.admin.thematique.index', compact("thematiques"));
        
    }
}
