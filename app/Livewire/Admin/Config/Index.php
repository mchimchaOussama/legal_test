<?php

namespace App\Livewire\Admin\Config;

use Livewire\Component;

class Index extends Component
{

    public $logo, $email, $tel, $adresse;

    public function contact_info()
    {
        
        $this->validate(
            [
                'email'             => 'required|min:6|email',
                'tel'               => 'required|numeric|digits:10',
                'adresse'           => 'required|unique:users|min:6|max:20',
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

    }


    public function render()
    {
        return view('livewire.admin.config.index');
    }
}
