<?php

namespace App\Livewire\Admin\Administrateurs;
use Illuminate\Contracts\Database\Eloquent\Builder;

use Livewire\Component;
use App\Models\User;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Hash;




class Index extends Component
{

    use WithPagination, WithoutUrlPagination; 

    public $deleted_id;
    public $modified_id;

    //////////// Activation /////////////
    public function activation($status , $id)
    {
        
        $status = !$status;

        User::where("id", $id)->update(["activer" => $status]);

    }


    /////////// Deelete User ////////////
    public function delete_user($id)
    {
        $this->deleted_id = $id;
        $this->dispatch("confirm", targeted_function:"yes-delete-user");
    }

    #[On('yes-delete-user')]
    public function yes_delete_user(){
        
        $find_user = User::where("id", $this->deleted_id)->get()->count();

        if($find_user == 0) return;

        User::find($this->deleted_id)->delete();

        $this->deleted_id = "";
        
        return $this->dispatch("toast-success");
    }
    

    /////////// Update User //////////////

    public $new_nom , $new_prenom , $new_nom_utilisateur , $new_role , $new_password , $new_password_confirmation; 

    public function modifier_user($id)
    {
        
        $user = User::where("id", $id)->get();

        if($user->count() == 0) return redirect()->route("admin.accueil");
        
        $user = $user->first();

        $this->new_nom                   = $user->nom;
        $this->new_prenom                = $user->prenom;
        $this->new_nom_utilisateur       = $user->nom_utilisateur;
        $this->new_role                  = $user->role_id;

        $this->modified_id = $id;

    }

    public function modifier_user_yes()
    {


        $this->validate(
            [
                'new_nom'               => 'required|min:3|max:20',
                'new_prenom'            => 'required|min:3|max:20',
                'new_nom_utilisateur'   => 'required|min:6|max:20',
                'new_role'              => 'required|integer|exists:roles,id',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'exists'            => "Ce rôle n'existe pas",
                'integer'           => "Valeur incorrecte"
            ]
        );

        $data = [];
        $data["nom"]     = $this->new_nom;
        $data["prenom"]  = $this->new_nom;
        $data["role_id"] = $this->new_role;


        //////// Verify new password /////////////
        $old_username = User::where("id", $this->modified_id)->first()->nom_utilisateur;

        if($old_username != $this->new_nom_utilisateur){
            
            $this->validate(
                [
                    'new_nom_utilisateur'   => 'required|unique:users,nom_utilisateur|min:6|max:20',
                ],
                [
                    'required'          => 'Ce champ est obligatoire',
                    'min'               => 'Ce champ doit comporter au moins :min caractères',
                    'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                    'unique'            => "Nom d'utilisateur est déjà utilisé",
                ]
            );

            $data["nom_utilisateur"] = $this->new_nom_utilisateur;

        }


        /////// Verify new Password ///////
        if($this->new_password || $this->new_password_confirmation){

            $this->validate(
                [
                    'new_password'      => 'required|min:6|max:30|confirmed'
                ],
                [
                    'required'          => 'Ce champ est obligatoire',
                    'min'               => 'Ce champ doit comporter au moins :min caractères',
                    'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                    'confirmed'         => 'Mot de passe incorrect',
                ]
            );

            $data["mot_de_passe"] = Hash::make($this->new_password);

        }


        User::where("id", $this->modified_id)->update($data);

        $this->dispatch("close-modal");

        return $this->dispatch("toast-success", message:"Compte modifié avec succès");

    }



    public function render()
    {

        $users = User::withWhereHas("role" , function($query){
            $query->where("role", "=", "administrateur");
        })->latest()->paginate(10);

        return view('livewire.admin.administrateurs.index', compact("users"));

    }

}
