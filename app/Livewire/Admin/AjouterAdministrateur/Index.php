<?php

namespace App\Livewire\Admin\AjouterAdministrateur;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Hash;


class Index extends Component
{
    use WithFileUploads;

    /////// Attributes ////////
    public $profil_file;
    public $nom;
    public $prenom;
    public $nom_utilisateur;
    public $role;
    public $password;
    public $password_confirmation;
    public $roles;

    ////////// Supprimer Profil Image ////////////
    public function supprimer_profil()
    {
        return $this->profil_file = "";
    }


    //////////// Ajouter un Compte ///////////
    public function ajouter_compte()
    {

        $this->validate(
            [
                'nom'               => 'required|min:3|max:20',
                'prenom'            => 'required|min:3|max:20',
                'nom_utilisateur'   => 'required|unique:users|min:6|max:20',
                'role'              => 'required|integer|exists:roles,id',
                'password'          => 'required|min:6|max:30|confirmed'
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'min'               => 'Ce champ doit comporter au moins :min caractères',
                'max'               => 'Ce champ ne doit pas dépasser :max caractères',
                'unique'            => "Nom d'utilisateur est déjà utilisé",
                'confirmed'         => 'Mot de passe incorrect',
                'exists'            => "Ce rôle n'existe pas",
                'integer'           => "Valeur incorrecte"
            ]
        );

        if($this->profil_file)
        {
            $path = $this->profil_file->store("uploads", "public");
        }else{
            $path = "";
        }

        User::create([
            "nom"               =>  $this->nom,
            "prenom"            =>  $this->prenom,
            "nom_utilisateur"   =>  $this->nom_utilisateur,
            "role_id"           =>  $this->role,
            "mot_de_passe"      =>  Hash::make($this->password),
            "profil_image"      =>  $path
        ]);

        $this->profil_file = "";

        $this->reset('nom', 'prenom', 'nom_utilisateur', 'password', 'password_confirmation', 'role');

        $this->dispatch('toast-success', message: "Compte créé avec succès");

    }


    public function render()
    {
        return view('livewire.admin.ajouter-administrateur.index');
    }


}
