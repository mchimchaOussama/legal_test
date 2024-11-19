<?php

namespace App\Livewire\Admin\Profil;

session_start();

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Hash;

class Index extends Component
{

    use WithFileUploads;

    public $profil_file;
    public $nom;
    public $prenom;
    public $nom_utilisateur;
    public $role;


    ////////// Constructor //////////////
    public function mount()
    {
        $this->nom             = session("auth")["nom"];
        $this->prenom          = session("auth")["prenom"];
        $this->nom_utilisateur = session("auth")["nom_utilisateur"];
        $this->role            = session("auth")["role"];
    }
 

    ////////// Supprimer Profil Image ////////////
    public function supprimer_profil()
    {
        return $this->profil_file = "";
    }


    /////////////// Update Profile ////////////////
    public function update_profile()
    {

        $this->validate(
            [
                'nom'               => 'required|min:3|max:20',
                'prenom'            => 'required|min:3|max:20',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'unique'            => "Nom d'utilisateur est déjà utilisé",
                'confirmed'         => 'Mot de passe incorrect',
            ]
        );


        if($this->profil_file)
        {

            $session_profil_image = !empty(session('auth')["profil_image"]) ?  session('auth')["profil_image"] : 'uploads/default_profil.png';

            $filePath = storage_path("app/public/".$session_profil_image);

            if(file_exists($filePath)){
                unlink(storage_path("app/public/".$session_profil_image));
            }

            $path = $this->profil_file->store("uploads", "public");

        }else{
            $path = session('auth')["profil_image"];
        }


        $user_id = session('auth')["id"];


        User::where("id", $user_id)->update([
            "nom"             =>  $this->nom,
            "prenom"          =>  $this->prenom,
            "profil_image"    =>  $path,
            "nom_utilisateur" =>  $this->nom_utilisateur
        ]);


        session()->forget("auth");


        $user = User::with("role")->where("id", $user_id)->first();


        session()->put("auth",
            [
                "id"              => $user->id,
                "nom"             => $user->nom,
                "prenom"          => $user->prenom,
                'nom_utilisateur' => $user->nom_utilisateur,
                "role"            => $user->role->role,
                "profil_image"    => $user->profil_image
            ]
        );


        $this->nom             = $user->nom;
        $this->prenom          = $user->prenom;
        $this->nom_utilisateur = $user->nom_utilisateur;

        $this->dispatch('toast-success', message: "Profil modifié avec succès");
    
    }


    /////////// Update Password//////////////
    public $current_password , $password , $password_confirmation;

    public function update_password()
    {

        $this->validate(
            [
                'current_password'       => 'required',
                'password'               => 'required|confirmed',
                'password_confirmation'  => 'required',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'confirmed'         => 'Mot de passe incorrect',
            ]
        );

        $password = User::where("id", session("auth")["id"])->first()->mot_de_passe;
        

        if(!Hash::check($this->current_password, $password)){

            return $this->dispatch("toast-failed", message: "Mot de passe actuel est incorrect");

        }

        
        User::where("id", session("auth")["id"])->update([
            "mot_de_passe"      =>  Hash::make($this->password),
        ]);


        return $this->dispatch("toast-success", message: "Mot de passe modifié avec succès");


    }



    public function render()
    {
        return view('livewire.admin.profil.index');
    }

    
}
