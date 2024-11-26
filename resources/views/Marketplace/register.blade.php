@extends('components.app_client') 
@section('title', 'Detai') 
@section('content')






<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<!-- Mirrored from themesflat.co/html/homzen/my-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 22:36:10 GMT -->
<head>
    <meta charset="utf-8">
    <title>Homzen - Real Estate HTML Template</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- font -->
   <link rel="stylesheet" href="fonts/fonts.css">
   <!-- Icons -->
   <link rel="stylesheet" href="fonts/font-icons.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet"type="text/css" href="css/jqueryui.min.css"/>

   <link rel="stylesheet"type="text/css" href="css/styles.css"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/favicon.png">
<link rel="apple-touch-icon-precomposed" href="images/logo/favicon.png">

<style>
.badge {
    padding: 0.5em 0.75em;
    font-size: 0.875rem;
}

#selected-departements {
    display: flex;
    flex-wrap: wrap;
}

#departements-list {
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    max-height: 200px; /* Hauteur maximale avant que le scroll n'apparaisse */
    overflow-y: auto; /* Activer le scroll si la liste dépasse la hauteur définie */
}


.tag {
    display: inline-block;
    background-color: #e9ecef;
    border: 1px solid #007bff;
    padding: 5px;
    margin: 2px;
    border-radius: 5px;
    color: #007bff;
}

.remove-tag {
    margin-left: 5px;
    cursor: pointer;
}

.dropdown-menu {
    border: 1px solid #ccc; /* Optional: Add a border */
    background-color: #fff; /* Background color for dropdown */
    z-index: 1000; /* Ensure dropdown is above other content */
}

.dropdown {
    max-height: 200px; /* Définir la hauteur maximale */
    overflow-y: auto;  /* Activer le défilement vertical */
   /*  border: 1px solid #ccc; Ajouter une bordure pour plus de visibilité */
    background-color: #fff; /* Couleur de fond pour le dropdown */
    padding: 10px; /* Ajouter un peu de rembourrage */
    margin-top: 5px; /* Espacement entre le champ de recherche et le dropdown */
}

.card {
    margin-top: 10px; /* Espacement entre les éléments */
}

.custom-input {
        height: 40px; /* Hauteur des inputs à 100 pixels */
    }

</style>


</head>

<body class="body bg-surface">

    <div class="preload preload-container">
        <div class="boxes ">
            <div class="box">
                <div></div> <div></div> <div></div> <div></div>
            </div>
            <div class="box">
                <div></div> <div></div> <div></div> <div></div>
            </div>
            <div class="box">
                <div></div> <div></div> <div></div> <div></div>
            </div>
            <div class="box">
                <div></div> <div></div> <div></div> <div></div>
            </div>
        </div>
    </div>
    
    <!-- /preload -->

    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="layout-wrap">
                <!-- header -->
                <header class="main-header fixed-header header-dashboard">
                    <!-- Header Lower -->
                    <div class="header-lower">
                        <div class="row">                      
                            <div class="col-lg-12">         
                                <div class="inner-container d-flex justify-content-between align-items-center">
                                    <!-- Logo Box -->
                                    <div class="logo-box d-flex">
                                        <div class="logo">  <a class="navbar-brand ms-5" href="{{ url('/') }}"><img src="{{ asset('assetsMarketplace/images/logo.png') }}"  width="174" height="44"     alt="logo"  /></a></div>
                                        <div class="button-show-hide">
                                            <span class="icon icon-categories"></span>
                                        </div>
                                    </div>
                                    <div class="nav-outer">
                                        <!-- Main Menu -->
                                        <nav class="main-menu show navbar-expand-md">
                                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                                <ul class="navigation clearfix">
                                                <li class=" home "><a href="{{route('get.home')}}">Accueil</a>

                                                <li class="dropdown2"><a href="{{route('get.marketplace')}}">Thematique</a>
                                                    <ul>
                                                        @foreach($thematiques as $thematique)
                                                        <li><a href="{{route('get.marketplace')}}">@if ($thematique->theme == 'enr' ) gaz /électrique  @else {{$thematique->theme}} @endif  </a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                <li class=""><a href="{{route('get.marketplace')}}">Marketplace</a></li>

                                                <li class=""><a href="{{route('get.about_us')}}">A Propos</a></li>

                                                <li class=""><a href="{{route('get.faq')}}">FAQ</a>
                                                </li>
                                                @if(session()->has('client_hom'))
                                                    <li class=""><a href="{{route('marketplace.demandes')}}">
                                                    Commandez en Quantité
                                                    </a></li>
                                                @endif
                                                <li class=""><a href="{{route('get.contact')}}">Contact</a>
                                                    
                                                @if(session()->has('client_hom'))

                                                <li class="dropdown2"><a href="#">Bienvenue, {{ session('client_hom')->nom }}</a>
                                                    <ul>
                                                        <li><a href="{{route('get.dashbord.client')}}">Dashboard</a></li>   
                                                        <li><a href="{{route('get.register.marketplace')}}">Profil</a></li>
                                                        <li> 
                                                        <a href="#">
                                                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" style="border: none; background: none;  cursor: pointer;">
                                                                déconnecter
                                                            </button>
                                                        </form>
                                                        </a>

                                                        </li>
                                                    </ul>
                                                </li>
                                                @endif
                                                </ul>
                                            </div>
                                        </nav>
                                        <!-- Main Menu End-->
                                    </div>
                                    <div class="header-account">

                                    </div>
                                    
                                    <div class="mobile-nav-toggler mobile-button"><span></span></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Header Lower -->
                
                    <!-- Mobile Menu  -->
                    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>    
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>                            
                        <nav class="menu-box">
                            <div class="nav-logo"><a href="index.html"><img src="images/logo/logo%402x.png" alt="nav-logo" width="174" height="44"></a></div>
                            <div class="bottom-canvas">
                                <div class="menu-outer"></div>
                                <div class="button-mobi-sell">
                                    <a class="tf-btn primary" href="add-property.html">Submit Property</a>
                                </div> 
                                <div class="mobi-icon-box">
                                    <div class="box d-flex align-items-center">
                                        <span class="icon icon-phone2"></span>
                                        <div>1-333-345-6868</div>
                                    </div>
                                    <div class="box d-flex align-items-center">
                                        <span class="icon icon-mail"></span>
                                        <div>themesflat@gmail.com</div>
                                    </div>
                                </div>
                            </div>
                        </nav>                
                    </div>
                    <!-- End Mobile Menu -->
                
                </header>
                <!-- end header -->
                <!-- sidebar dashboard -->
               
                <div class="sidebar-menu-dashboard">
                    <ul class="box-menu-dashboard">
                        <li class="nav-menu-item"><a class="nav-menu-link" href="{{route('get.dashbord.client')}}"><span class="icon icon-dashboard"></span> Dashboard</a></li>
                        <li class="nav-menu-item active"><a class="nav-menu-link" href="{{route('get.register.marketplace')}}"><span class="icon icon-profile"></span> Profil</a></li>
                        <li class="nav-menu-item">
                            <a class="nav-menu-link" href="{{route('dashboard.client-commandes')}}">
                                <span class="icon icon-list-dashes"></span>
                                Commandes
                            </a>
                        </li>
                        <li class="nav-menu-item"><a class="nav-menu-link" href="{{ route('logout') }}"><span class="icon icon-sign-out"></span> Déconnecter</a></li>
                    </ul>
                </div>

                <!-- end sidebar dashboard -->
                <div class="main-content">
                    <div class="main-content-inner wrap-dashboard-content-2">
                        <div class="button-show-hide show-mb">
                        
                        </div>
                        <div class="widget-box-2">
                        <div class="box">
                            <h6 class="title"></h6>     
                            @if (!$allFilled)  
                            <div class="box-agent-account">
                                    <p class="note">Merci pour votre inscription. Veuillez terminer la configuration de votre compte afin de procéder à son activation. Si vous avez des questions, n'hésitez pas à nous contacter.</p>
                                @else
                                    <!-- Traitement lorsque tous les champs sont remplis -->
                                    <!-- Vous pouvez afficher d'autres informations ici si nécessaire -->          
                            </div>
                            @endif

                       
                            <form  method="POST" id="submitForm">
                                @csrf
                                <h6 class="title">Profile</h6>

                                <div class="row mb-2">

                                <div class="col-lg-6">
                                        <!-- Nom et Prénom -->
                                        <div class="box box-fieldset">
                                            <label for="nom">Nom:<span>*</span></label>
                                            <input type="text" name="nom" class="form-control form-control-sm custom-input mb-2" value='{{$client->nom}}' placeholder="Remplir votre nom !" required @if($client->activer == 1) readonly @endif>
                                            @error('nom')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box box-fieldset">
                                            <label for="prenom">Prénom:<span>*</span></label>
                                            <input type="text" name="prenom" class="form-control mb-2 custom-input mb-2" placeholder="Remplir votre Prenom !" value='{{$client->prenom}}' required  @if($client->activer == 1) readonly @endif>
                                            @error('prenom')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                            <div class="col-lg-6">
                                                <!-- Téléphone et Email -->
                                                <div class="box box-fieldset">
                                                    <label for="tel">Téléphone:<span>*</span></label>
                                                    <input type="tel" name="tel" class="form-control mb-2 custom-input mb-2" placeholder="Remplir votre Téléphone !" value='{{$client->tel}}' required  @if($client->activer == 1) readonly @endif>
                                                    @error('tel')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                            </div>

                                            <div class="col-lg-6 ">
                                                <div class="box box-fieldset">
                                                    <label for="email">Email:<span>*</span></label>
                                                    <input type="email" name="email" class="form-control mb-2 custom-input mb-2" placeholder="Remplir votre Email !" value='{{$client->email}}' required  @if($client->activer == 1) readonly @endif>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                <div class='row'>
                                    <!-- Adresse -->
                                    <div class="col-lg-6 mb-4">
                                        <div class="box box-fieldset">
                                            <label for="addresse">Adresse:<span>*</span></label>
                                            <input type="text" name="addresse" class="form-control mb-2 custom-input mb-2" value='{{$client->addresse}}' placeholder="Remplir votre Adresse !" required  >
                                            @error('addresse')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                
                                <h6 class="title"> Entreprise</h6>
                                
                                <div class="row mb-2">

                                <div class="col-lg-6">
                                        <!-- Nom et Prénom -->
                                        <div class="box box-fieldset">
                                            <label for="nom">Numero Identification:</label>
                                            <input type="text" name="numero_identification" class="form-control form-control-sm custom-input mb-2" value='{{$client->numero_identification}}' placeholder="Remplir votre Numero De Identification!"   @if($client->activer == 1) readonly @endif>
                                            @error('numero_identification')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <div class="box box-fieldset">
                                            <label for="prenom">Entreprise:</label>
                                            <input type="text" name="entreprise" class="form-control mb-2 custom-input mb-2" value='{{$client->entreprise}}'  placeholder="Remplir votre Entreprise !"   @if($client->activer == 1) readonly @endif>
                                            @error('entreprise')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">

                                <div class="col-lg-6">
                                        <!-- Nom et Prénom -->
                                        <div class="box box-fieldset">
                                            <label for="nom">Rcs:</label>
                                            <input type="text" name="rcs" class="form-control form-control-sm custom-input mb-2" value='{{$client->rcs}}' placeholder="Remplir votre Rcs !"   @if($client->activer == 1) readonly @endif>
                                            @error('rcs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="box box-fieldset">
                                            <label for="prenom">Siren:</label>
                                            <input type="text" name="siren" class="form-control mb-2 custom-input mb-2" value='{{$client->siren}}' placeholder="Remplir votre Siren !"   @if($client->activer == 1) readonly @endif>
                                            @error('Siren')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
      
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                        <div class="box box-fieldset">
                                            <label for="prenom">Siret:</label>
                                            <input type="text" name="siret" class="form-control mb-2 custom-input mb-2" value='{{$client->siret}}' placeholder="Remplir votre Siret !"   @if($client->activer == 1) readonly @endif>
                                            @error('Siret')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                        </div>
                            
                                        <h6 class="title">Lead</h6>
                                            <div class="container">
                                                <div class="row mb-4">
                                                    <!-- Départements -->
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <label for="">Départements <span class='text-danger'>*</span> </label>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="text" class="form-control-sm custom-input" id="departementSearch" placeholder="Rechercher un département...">
                                                                    <div id="departementDropdown" class="dropdown"></div>
                                                                    <input type="hidden" id="departmentsInput" name="departements" value="">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Thématiques Sélectionnées -->
                                                 <!--   <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <label for="">Départements Sélectionnées</label>
                                                            </div>
                                                            <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                                                <div id="selectedDepartments"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                -->
                                                <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <label for="">Thématiques <span class='text-danger'>*</span></label>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="text" class="form-control-sm custom-input" id="thematiqueSearch" placeholder="Rechercher une thématique...">
                                                                    <div id="thematiqueDropdown" class="dropdown"></div>
                                                                    <input type="hidden" id="thematiquesInput">
                                                                    <input type="hidden" id="thematiquesInput" name="thematiques" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<!--
                                                <div class="row mb-4">
                                            
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <label for="">Thématiques <span class='text-danger'>*</span></label>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="text" class="form-control-sm custom-input" id="thematiqueSearch" placeholder="Rechercher une thématique...">
                                                                    <div id="thematiqueDropdown" class="dropdown"></div>
                                                                    <input type="hidden" id="thematiquesInput">
                                                                    <input type="hidden" id="thematiquesInput" name="thematiques" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                             
                                                    <div class="col-lg-4">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <label for="">Thématiques Sélectionnées</label>
                                                            </div>
                                                            <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                                                                <div id="selectedThematiques"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
-->

                                <h6 class="title">Mot de passe</h6>
                                <!-- Mot de passe -->
                                <div class="box grid-3 gap-30">

                                <div class="box-fieldset">
                                        <label for="mot_de_passe"> Ancien  Mot de passe: </label>
                                        <input type="password" name="ancien_mot_de_passe" class="form-control style-1 custom-input mb-2" placeholder="Ancien Mot de passe">
                                        @error('ancien_mot_de_passe')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="box-fieldset">
                                        <label for="mot_de_passe">Nouveau Mot de passe:</label>
                                        <input type="password" name="mot_de_passe" class="form-control style-1 custom-input mb-2" placeholder="Mot de passe">
                                        @error('mot_de_passe')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="box-fieldset">
                                        <label for="confirm_pass">Confirmer mot de passe: </label>
                                        <input type="password" name="mot_de_passe_confirmation" class="form-control style-1 custom-input mb-2" placeholder="confermer Mot de passe">
                                        @error('mot_de_passe_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                </div>

                                <input type="hidden" name="departements" id="departmentsInput">

                                <div class="box">
                                    <button type="submit" class="tf-btn   primary w-25">Envoyer</button>
                                </div>
                            </form>

        <!-- /#page -->

    </div>
    <!-- go top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
   
    <script src="{{ asset('assetsMarketplace/js/my-js/register.js') }}"></script>

</body>


<!-- Mirrored from themesflat.co/html/homzen/my-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 22:36:12 GMT -->
</html>








@endsection