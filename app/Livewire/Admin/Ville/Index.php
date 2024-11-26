<?php

namespace App\Livewire\Admin\Ville;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ville;
use App\Models\Departement;
use App\Models\CodePostale;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;


class Index extends Component
{

    use WithFileUploads;


    public $ville, $code_postale;
    public $deleted_id;
    public $modified_id;
    public $image, $featured;
    

    public function supprimer_image()
    {
        return $this->image = "";
    }



    public function ajouter_ville(){

        $this->validate(
            [
                'ville'        => 'required|max:30|unique:villes,ville',
                'code_postale' => 'required|numeric|min:4|unique:code_postales,code_postale',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'numeric'           => 'Invalide :attribute',
                'unique'            => ':attribute déja existe'
            ]
        );

        if($this->featured && empty($this->image)){
           return $this->dispatch('toast-failed', message:"Vous devez télécharger une image");
        }


        $code_postale_id = CodePostale::firstOrCreate([
            "code_postale"  =>  $this->code_postale
        ])->id;



        if($this->image)
        {   
            $path = $this->image->store("uploads", "public");
        }else{
            $path = "";
        }


        Ville::create([
            "ville"            =>  $this->ville,
            "code_postale_id"  =>  $code_postale_id,
            "featured"         =>  $this->featured,
            "image"            =>  $path,
        ]);


        $this->reset('ville', 'code_postale', "image");
        
        $this->dispatch('close-modal');

        return $this->dispatch('toast-success');

    }


    //////////// Delete ////////////
    public function delete_ville($id){
        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-ville");
    }


    #[On('yes-delete-ville')]
    public function yes_delete_ville(){
        
        $find_ville = Ville::where("id", $this->deleted_id)->get()->count();

        if($find_ville == 0) return;

        Ville::find($this->deleted_id)->delete();


        $this->deleted_id = "";
        return $this->dispatch("toast-success");
        
    } 
   

    ////////// Update //////////
    public $new_ville, $new_code_postale, $new_featured, $code_postale_id, $new_image, $upload_ville_image; 

    public function modifier_ville($id)
    {

        $ville = Ville::where("id", $id)->get();

        if($ville->count() == 0) return $this->dispatch("toast-failed");
        
        $ville                  = $ville->first();
        $this->new_ville        = $ville->ville;
        $this->new_code_postale = $ville->code_postale->code_postale;
        $this->code_postale_id  = $ville->code_postale_id;
        $this->new_image        = $ville->image;
        $this->new_featured     = $ville->featured;

        $this->modified_id = $id;

    }


    public function modifier_ville_yes()
    {


        $this->validate(
            [
                'new_ville'      => 'required|max:30',
            ],
            [
                'required'     => 'Ce champ est obligatoire',
                'min'           => 'Ce champ doit comporter au moins :min caractères',
                'max'           => 'Ce champ ne doit pas dépasser :max caractères',
            ]
        );

        if($this->new_featured && empty($this->upload_ville_image) && empty(Ville::where("id", $this->modified_id)->first()->image)){
            return $this->dispatch('toast-failed', message:"Vous devez télécharger une image");
        }

        if($this->upload_ville_image)
        {   
            $path = $this->upload_ville_image->store("uploads", "public");
        }else{
            $path = Ville::where("id", $this->modified_id)->first()->image;
        }

        $data             = [];
        $data["ville"]    = $this->new_ville;
        $data["featured"] = $this->new_featured;
        $data["image"]    = $path;

        Ville::where("id", $this->modified_id)->update($data);

        $data                 = [];
        $data["code_postale"] = $this->new_code_postale;
        CodePostale::where("id", $this->code_postale_id)->update($data);


        $this->dispatch("close-modal");

        $this->reset('new_ville', 'new_featured', "upload_ville_image");

        return $this->dispatch("toast-success", message:"ville modifié avec succès");

    }

    /*
    #[On("search")]
    public function search($value)
    {
        


    }
    */


    public function render()
    {
        return view('livewire.admin.ville.index',[
            'villes' => Ville::withCount("leads")->latest()->paginate(10), 
        ]);
    }
    
}
