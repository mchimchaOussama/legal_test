<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;


class AdminLoginController extends Controller
{
    
    public function login_post(request $request)
    {

        $request->validate(
            [
                'nom_utilisateur'   => 'required|exists:users,nom_utilisateur',
                'password'          => 'required',
            ],
            [
                'required'          => 'Ce champ est obligatoire',
                'exists'            => "Nom d'utilisateur n'existe pas",
            ]
        );

        $user = User::where([
            ["nom_utilisateur", "=", $request->nom_utilisateur],
            ["activer",         "=", 1]
        ])->get();

         


        if($user->count() == 0)
        {
            return back()->with('failed', "Ce compte est désactivé");
        }


        $password = $user->first()->mot_de_passe;
        

        if(Hash::check($request->password, $password)){

            $user = User::with("role")->where("nom_utilisateur", $request->nom_utilisateur)->first();

            $request->session()->put("auth",
                [
                    "id"              => $user->id,
                    "nom"             => $user->nom,
                    "prenom"          => $user->prenom,
                    'nom_utilisateur' => $user->nom_utilisateur,
                    "role"            => $user->role->role,
                    "profil_image"    => $user->profil_image
                ]
            );

            return redirect()->route("admin.accueil");

        }else{

            return redirect()->back()->with("failed", "Mot de passe est incorrect");

        }

    }

    public function logout()
    {

        session()->forget("auth");
        
        return redirect()->route("admin.login-view");

    } 
    
}
