@extends('components.app_client') 
@section('title', 'Achats') 
@section('content')

<body class="body">

<style>
    /* Unselected stars */
    #star-rating .fa-star {
        color: #ddd;
        cursor: pointer;
    }

    /* Selected stars */
    #star-rating .fa-star.selected {
        color: #FFD700;
    }
</style>

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
        <div id="pagee" class="clearfix">
            <!-- Main Header -->
            <header class="main-header fixed-header">
                <!-- Header Lower -->
                <div class="header-lower">
                    <div class="row">                      
                        <div class="col-lg-12">         
                            <div class="inner-container d-flex justify-content-between align-items-center">
                                <!-- Logo Box -->
                                <div class="logo-box">
                          <!--<div class="logo"><a href="index.html"><img src="images/logo/logo%402x.png" alt="logo" width="174" height="44"></a></div> -->   
                                    <a class="navbar-brand ms-5" href="/">
                                        <img src="{{ asset('assetsMarketplace/images/logo.png') }}"  width="174" height="44" alt="logo"  />
                                    </a>
                                </div>
                                <div class="nav-outer">
                                    <!-- Main Menu -->
                                    <nav class="main-menu show navbar-expand-md">
                                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                            <ul class="navigation clearfix">
                                                <li class=" home "><a href="{{route('get.home')}}">Accueil</a>
                                                </li>

                                                <li class="dropdown2"><a href="#">Thematique</a>
                                                    <ul>
                                                        @foreach($thematiques as $thematique)
                                                        <li><a href="{{route('get.marketplace')}}">{{$thematique->thematique}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                <li class="current"><a href="{{route('get.marketplace')}}">Marketplace</a>
                                                </li>

                                                <li class=""><a href="{{route('get.about_us')}}">A Propos</a>
                                                </li>


                                                <li class=""><a href="{{route('get.faq')}}">FAQ</a>
                                                </li>

                                                <li class=""><a href="{{route('get.contact')}}">Contact</a>
                        
                                                @if(session()->has('client_hom'))

                                                <li class="dropdown2"><a href="#">Bienvenue, {{ session('client_hom')->nom }}</a>
                                                    <ul>
                                                        <li><a href="{{route('get.dashbord.client')}}">Dashboard</a></li>   
                                                        <li><a href="{{route('get.register.marketplace')}}">Profile</a></li>
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
                                    <div class="register">
                                        <ul class="d-flex">
                                        @if(session()->has('client_hom'))
                                            
                                            @else
                                                <li><a href="#modalLogin" data-bs-toggle="modal">Login</a></li>
                                                <li>/</li>
                                                <li><a href="#modalRegister" data-bs-toggle="modal">Register</a></li>
                                            @endif
                                        </ul>
                                        @if (session('cart') && count(session('cart')) > 0)
                                        <a href="{{route('cart_index')}}" class="fw-bold"><img src="{{ asset('assetsMarketplace/images/panier.png') }}"  width="30" height="30" alt="panier"   /><span style="background-color: #ff1400;border-radius:50%;color:white;width:20px">({{ count(session('cart'))}})</span> </a> 
                                        @else
                                        <a href="{{route('cart_index')}}" class="fw-bold"><img src="{{ asset('assetsMarketplace/images/panier.png') }}"  width="30" height="30" alt="panier"  /> (0) </a>  
                                        @endif
                                    </div>
                                    <!--
                                    <div class="flat-bt-top">
                                        <a class="tf-btn primary" href="add-property.html">Submit Property</a>
                                    </div>  
                                    -->
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
                        <div class="nav-logo"><a href="index.html"><img src="{{ asset('assetsMarketplace/images/logo/logo%402x.png') }}" alt="nav-logo" width="174" height="44"></a></div>
                        
                        <div class="bottom-canvas">
                            <div class="login-box flex align-items-center">
                                <a href="#modalLogin" data-bs-toggle="modal">Login</a>
                                <span>/</span>
                                <a href="#modalRegister" data-bs-toggle="modal">Register</a>
                            </div>
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
          


            <section class="flat-section pt-0 flat-property-detail">
                <div class="container">
                    <div class="header-property-detail">
                        <div class="content-top d-flex justify-content-between align-items-center">
                            <div class="box-name">
                                <h4 class="title link">{{$payment->lead->thematique->thematique}}</h4>
                            </div>
                            <div class="box-price d-flex align-items-center">
                                <h4>{{$payment->prix}}</h4>
                                <span class="body-1 text-variant-1">/Euro</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="single-property-element single-property-desc">
                                <div class="h7 title fw-7">Description</div>
                                <p class="body-2 text-variant-1">{{$payment->lead->description}}</p>
                            </div>


                            <div class="single-property-element single-property-map">
                                <div class="h7 title fw-7">Map</div>
                                <div class="map-container">
                                {!! $payment->lead->adresse_reelle !!}
                                </div>
                            </div>
                                      <!--   part of  enrRenouvelabl -->
                            @if($payment->thematique->theme == "enrRenouvelabl")
                            <div class="single-property-element single-property-info">
                                <div class="h7 title fw-7">Details</div>
                                <div class="row">

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->thematique}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Sous Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->theme}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type:</span>
                                            <div class="content fw-7">{{$payment->thematique->type}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Departement:</span>
                                            <div class="content fw-7">{{$payment->departement->departement}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Adresse Postale :</span>
                                            <div class="content fw-7">{{$payment->lead->adressePostale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Code Postale:</span>
                                            <div class="content fw-7">{{$payment->lead->code_postale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Ville:</span>
                                            <div class="content fw-7">{{$payment->lead->ville->ville}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Mode De Consommation:</span>
                                            <div class="content fw-7">{{$payment->lead->modeConsommation}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Proprietaire:</span>
                                            <div class="content fw-7">{{$payment->lead->proprietaire}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Disponibilite:</span>
                                            <div class="content fw-7">{{$payment->lead->disponibilite}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Maison:</span>
                                            <div class="content fw-7">{{$payment->lead->maison}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="inner-box">
                                            <span class="label">Interet Amelioration De Habitat:</span>
                                            <div class="content fw-7">{{$payment->lead->interetAmeliorationHabitat}}</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif

    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->




       <!--   part of  telecom -->
       @if($payment->thematique->theme == "telecom")
                            <div class="single-property-element single-property-info">
                                <div class="h7 title fw-7">Details</div>
                                <div class="row">

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Entreprise:</span>
                                            <div class="content fw-7">{{$payment->lead->entreprise}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">fonction Entreprise:</span>
                                            <div class="content fw-7">{{$payment->lead->fonctionEntreprise}}</div>
                                        </div>
                                    </div>

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->thematique}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Sous Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->theme}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type:</span>
                                            <div class="content fw-7">{{$payment->thematique->type}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Departement:</span>
                                            <div class="content fw-7">{{$payment->departement->departement}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Adresse Postale :</span>
                                            <div class="content fw-7">{{$payment->lead->adressePostale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Code Postale:</span>
                                            <div class="content fw-7">{{$payment->lead->code_postale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Ville:</span>
                                            <div class="content fw-7">{{$payment->lead->ville->ville}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Disponibilite:</span>
                                            <div class="content fw-7">{{$payment->lead->disponibilite}}</div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Operation Actuel:</span>
                                            <div class="content fw-7">{{$payment->lead->operationActuel}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Nombre Line:</span>
                                            <div class="content fw-7">{{$payment->lead->nombreLineConcernees}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Telephon Fix:</span>
                                            <div class="content fw-7">{{$payment->lead->telephonFix}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Telephon Mobile:</span>
                                            <div class="content fw-7">{{$payment->lead->telephonMobile}}</div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type Services :</span>
                                            <div class="content fw-7">{{$payment->lead->typeServicesRecherche}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-8">
                                        <div class="inner-box">
                                            <span class="label">Date Changement :</span>
                                            <div class="content fw-7">{{$payment->lead->DatChangementOperateur}}</div>
                                        </div>
                                    </div>
                                    </div>


                                </div>
                            </div>
                            @endif
    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

                                          <!--   part of  enr -->
                                          @if($payment->thematique->theme == "enr")
                            <div class="single-property-element single-property-info">
                                <div class="h7 title fw-7">Details</div>
                                <div class="row">

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Entreprise:</span>
                                            <div class="content fw-7">{{$payment->lead->entreprise}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Activite:</span>
                                            <div class="content fw-7">{{$payment->lead->activite}}</div>
                                        </div>
                                    </div>

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->thematique}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Sous Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->theme}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type:</span>
                                            <div class="content fw-7">{{$payment->thematique->type}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Departement:</span>
                                            <div class="content fw-7">{{$payment->departement->departement}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Adresse Postale :</span>
                                            <div class="content fw-7">{{$payment->lead->adressePostale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Code Postale:</span>
                                            <div class="content fw-7">{{$payment->lead->code_postale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Ville:</span>
                                            <div class="content fw-7">{{$payment->lead->ville->ville}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Disponibilite:</span>
                                            <div class="content fw-7">{{$payment->lead->disponibilite}}</div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">gerant:</span>
                                            <div class="content fw-7">{{$payment->lead->gerant}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">mode Chauffage:</span>
                                            <div class="content fw-7">{{$payment->lead->modeChauffage}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">fournisseur Gaz:</span>
                                            <div class="content fw-7">{{$payment->lead->fournisseurGaz}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">fournisseur Electrecite:</span>
                                            <div class="content fw-7">{{$payment->lead->fournisseurElectrecite}}</div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">cout Gaz:</span>
                                            <div class="content fw-7">Plus De {{$payment->lead->coutGaz}}</div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">cout Electrecite:</span>
                                            <div class="content fw-7">Plus De {{$payment->lead->coutElectrecite}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->


                 <!--   part of  formationB2B -->
                 @if($payment->thematique->theme == "formationB2B")
                            <div class="single-property-element single-property-info">
                                <div class="h7 title fw-7">Details</div>
                                <div class="row">

                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Entreprise:</span>
                                            <div class="content fw-7">{{$payment->lead->entreprise}}</div>
                                        </div>
                                    </div>


                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->thematique}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Sous Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->theme}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type:</span>
                                            <div class="content fw-7">{{$payment->thematique->type}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Departement:</span>
                                            <div class="content fw-7">{{$payment->departement->departement}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Adresse Postale :</span>
                                            <div class="content fw-7">{{$payment->lead->adressePostale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Code Postale:</span>
                                            <div class="content fw-7">{{$payment->lead->code_postale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Ville:</span>
                                            <div class="content fw-7">{{$payment->lead->ville->ville}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Disponibilite:</span>
                                            <div class="content fw-7">{{$payment->lead->disponibilite}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">gerant NonSalarie:</span>
                                            <div class="content fw-7">{{$payment->lead->gerantNonSalarie}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">nombre De Salarie:</span>
                                            <div class="content fw-7">{{$payment->lead->nombreDeSalarie}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Lange:</span>
                                            <div class="content fw-7">
                                                
                                            @if($payment->lead->lange == "informatiqueMW")
                                            Informatique Marketing / Web Marketing
                                            @endif

                                            @if($payment->lead->lange == "ComptabilitéG")
                                            Comptabilité Gestion
                                            @endif

                                            @if($payment->lead->lange == "siteInetrnet")
                                            Création de site Internet
                                            @endif
                                                 
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

         <!--   part of  formationB2C -->
         @if($payment->thematique->theme == "formationB2C")
                            <div class="single-property-element single-property-info">
                                <div class="h7 title fw-7">Details</div>
                                <div class="row">
                                    
                                <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->thematique}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Sous Thematique:</span>
                                            <div class="content fw-7">{{$payment->thematique->theme}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Type:</span>
                                            <div class="content fw-7">{{$payment->thematique->type}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Departement:</span>
                                            <div class="content fw-7">{{$payment->departement->departement}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Adresse Postale :</span>
                                            <div class="content fw-7">{{$payment->lead->adressePostale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Code Postale:</span>
                                            <div class="content fw-7">{{$payment->lead->code_postale}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Ville:</span>
                                            <div class="content fw-7">{{$payment->lead->ville->ville}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Disponibilite:</span>
                                            <div class="content fw-7">{{$payment->lead->disponibilite}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">salarie:</span>
                                            <div class="content fw-7">{{$payment->lead->salarie}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">salarie:</span>
                                            <div class="content fw-7">Plus De {{$payment->lead->datSalarie}} Ans</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inner-box">
                                            <span class="label">Lange:</span>
                                            <div class="content fw-7">{{$payment->lead->lange2}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
    

                        </div>
                        <div class="col-lg-4">
                            <div class="widget-sidebar fixed-sidebar wrapper-sidebar-right">
                                <div class="widget-box single-property-contact bg-surface">
                                    <div class="h7 title fw-7">Info Lead</div>
                                    <div class="box-avatar">
                                        <div class="rounded">
                                        <img src="{{ asset('storage/' . $payment->thematique->image) }}" alt="img" style="width: 260px; height: 150px;" class=' px-4' />
                                        </div> 
                                    </div>
                                        <div class="ip-group">
                                            <label for="">Nom</label>
                                            <input type="text" placeholder="" class="form-control" value='{{$payment->lead->prospect->nom}}' readonly >
                                        </div>
                                        <div class="ip-group">
                                            <label for="">Prenom</label>
                                            <input type="text" placeholder="" class="form-control" value='{{$payment->lead->prospect->prenom}}' readonly >
                                        </div>
                                        <div class="ip-group">
                                            <label for="">Telephone</label>
                                            <input type="text" placeholder="" class="form-control" value='{{$payment->lead->prospect->tel}}' readonly>
                                        </div>
                                        <div class="ip-group mb-4">
                                            <label for="">Email</label>
                                            <input type="text" placeholder="" class="form-control" value='{{$payment->lead->prospect->email}}' readonly>
                                        </div>
                                        <div class="ip-group mb-4">
                                            <label for="">Civilite</label>
                                            <input type="text" placeholder="" class="form-control" value='{{$payment->lead->prospect->civilite}}' readonly>
                                        </div>
                                        <button class="btn w-100" style="background-color: #ED2027; color: white" id="send-avis">
                                            <i class="fas fa-star px-2" style="color: white"></i> Ajouter Avis
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            
                <div class="modal fade" id="avisModal" tabindex="-1" aria-labelledby="avisModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="avisModalLabel">Ajouter un Avis</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="avisForm">
                                    <!-- Text area for review content -->
                                    <div class="mb-3">
                                        <label for="review-text" class="form-label mb-2">Votre Avis</label>
                                        <div id="success-message-avis" class="alert alert-success mb-2" style="display: none;"></div>
                                        <div id="err-message-avis" class="alert alert-danger mb-2" style="display: none;"></div>
                                        <textarea class="form-control" id="review-text" name="review" rows="3" required></textarea>
                                    </div>
                                    <!-- Star rating input, centered and larger -->
                                    <div class="mb-3 text-center">
                                        <label class="form-label">Note</label>
                                        <div id="star-rating" class="d-flex justify-content-center">
                                            <!-- 5-star rating system with Font Awesome -->
                                            <i class="fas fa-star fa-lg" data-value="1"></i>
                                            <i class="fas fa-star fa-lg" data-value="2"></i>
                                            <i class="fas fa-star fa-lg" data-value="3"></i>
                                            <i class="fas fa-star fa-lg" data-value="4"></i>
                                            <i class="fas fa-star fa-lg" data-value="5"></i>
                                        </div>
                                        <input type="hidden" id="rating-value" name="rating" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" id="submit-avis">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- footer -->
            <footer class="footer">
                <div class="top-footer">
                  <div class="container">
                    <div class="content-footer-top">
                        <div class="footer-logo">
                          <img src="{{ asset('assetsMarketplace/images/logo.png') }}" alt="logo-footer" width="174" height="44" class="rounded" >
                        </div>

                    </div>
                  </div>
                </div>
                <div class="inner-footer">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <div class="footer-cl-1">
                          
                          <p class="text-variant-2">Acheter vos leads en direct ! à l'unité !</p>
                          <ul class="mt-12">

                          <li class="mt-12 d-flex align-items-center gap-8">
                                <i class="icon icon-commercial fs-20 text-variant-2"></i>
                                <p class="text-white"> AK Business Group  FZE   </p>
                            </li>
                            
                            <li class="mt-12 d-flex align-items-center gap-8">
                                <i class="icon icon-mail fs-20 text-variant-2"></i>
                                <p class="text-white">test@gmail.com</p>
                            </li>
                          </ul>
                          
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-cl-2">
                            <div class="fw-7 text-white">Page</div>
                            <ul class="mt-10 navigation-menu-footer">
                                <li> <a href="{{route('get.home')}}" class="caption-1 text-variant-2">Accueil</a> </li>

                                <li> <a href="{{route('get.about_us')}}" class="caption-1 text-variant-2">A Propos</a> </li>

                                <li> <a href="{{route('get.faq')}}" class="caption-1 text-variant-2">FAQ</a> </li>
                                <li> <a href="{{route('get.contact')}}" class="caption-1 text-variant-2">Contact</a> </li>

                            </ul>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-6">
                        <div class="footer-cl-3">
                            <div class="fw-7 text-white">Top Thematique</div>
                            <ul class="mt-10 navigation-menu-footer">
                                @foreach($thematiquesStatistiques as $thematiquesStatistique)
                                <li> <a href="{{route('get.marketplace')}}" class="caption-1 text-variant-2">{{$thematiquesStatistique->thematique}}</a> </li>
                                @endforeach
                               
                            </ul>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <div class="footer-cl-4">
                            <div class="fw-7 text-white">
                                Newsletter
                            </div>
                            <p class="mt-12 text-variant-2">Votre dose hebdomadaire/mensuelle de connaissances et d’inspiration</p>
                            <form class="mt-12" id="subscribe-form" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">
                                <div id="subscribe-content">
                                    <span class="icon-left icon-mail"></span>
                                    <input type="email" name="email" id="subscribe-email" placeholder="Votre adresse email" required />
                                    <button type="button" id="subscribe-News" class="button-subscribe"><i class="icon icon-send"></i></button>
                                </div>
                                <div id="subscribe-msg"></div>
                            </form>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
                <div class="bottom-footer">
                  <div class="container">
                    <div class="content-footer-bottom">
                        <div class="copyright">© 2024 LEAD & BOOST (Tous droits réservés).</div>
                     
                        <ul class="menu-bottom">
                          <li><a href="https://technologica.ma/" target="_blank">Créé par Technologica</a> </li>
                        <!--
                          <li><a href="pricing.html">Privacy Policy</a> </li>
                          <li><a href="contact.html">Cookie Policy</a> </li>
                         -->
                        </ul>
                     
                    </div>
                  </div>
                </div>
                
            </footer>
            <!-- end footer -->
        </div>
        <!-- /#page -->

    </div>
    
    <!-- go top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
  <!-- popup login -->
  <div class="modal fade" id="modalLogin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="flat-account bg-surface">
                <h3 class="title text-center">Se connecter</h3>
                <div id="success-message" class="text-success mt-1" style="display: none;"></div>
                <span class="close-modal icon-close2" data-bs-dismiss="modal"></span>
                <form id="loginForm">
                    @csrf
                  <fieldset class="box-fieldset">
                     <!--     <label for="name">Email<span>*</span>:</label>-->
                        <input type="text" class="form-contact style-1" placeholder="Remplir votre Email !" name="email" required>
                        <div id="email-error" class="text-danger mt-1" style="display: none;"></div> <!-- Error message for email -->
                    </fieldset>
                    <fieldset class="box-fieldset">
                      <!--  <label for="pass">Mot de passe<span>*</span>:</label>-->
                        <div class="box-password">
                            <input type="password" class="form-contact style-1 password-field" placeholder="Mot de passe" name="password" required>
                            <span class="show-pass">
                                <i class="icon-pass icon-eye"></i>
                                <i class="icon-pass icon-eye-off"></i>
                            </span>
                        </div>
                        <div id="password-error" class="text-danger mt-1" style="display: none;"></div> <!-- Error message for password -->
                    </fieldset>

                    <fieldset class="d-flex align-items-center gap-6">
                    <label for="cb1" class="caption-1 text-variant-1">J'ai lu et j'accepte <span class="fw-5 text-black">Contact du service.</span> and <span class="fw-5 text-black">Contact du service. </span>Politique de Confidentialité  <input type="checkbox" class="style-2" id="cb1" name="termsAccepted"> </label>
                    </fieldset>

                    <button type="submit" class="tf-btn primary w-100">Se connecter</button>
                    <div class="mt-12 text-variant-1 text-center noti">  <a href="#" id= 'resetPassword' class="text-black fw-5">Mot de passe oublié ?</a>/<a href="#modalRegister" data-bs-toggle="modal" class="text-black fw-5">S'inscrire.</a> </div>
                </form>
            </div>
        </div> 
    </div>
</div>




      <!-- popup register -->
      <div class="modal fade" id="modalRegister">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account bg-surface">
                    <h3 class="title text-center">S'inscrire</h3>
                    <div id="success-message-register" class="alert alert-success mb-2" style="display: none;"></div>
            
                    <!-- Success message div -->
                    <div id="success-message" class="alert alert-success mb-2" style="display: none;"></div>
                    <div id="success-message-fn" class="alert alert-success mb-2" style="display: none;"></div>
                     <div id="err-message-register" class="alert alert-danger mb-2" style="display: none;"></div>

                     <form id="registerForm" action="#">
                        @csrf
                        <!-- Champ d'email et bouton de vérification -->
                        <fieldset class="box-fieldset">
                            <input type="email" class="form-contact style-1 custom-input" placeholder="Remplir votre Email !" name="email" id="emailField" required>
                            <button type="button" class="tf-btn primary mt-3 custom-input-btn " id="verifyEmailBtn">Envoyer Code</button>
                        </fieldset>

                        <!-- Champ de saisie du code et bouton de vérification -->
                        <fieldset class="box-fieldset" id="codeFieldset" style="display: none;">
                            <input type="text" class="form-contact style-1 custom-input" placeholder="Saisir le code de vérification !" name="code" id="code" required>
                            <button type="button" class="tf-btn primary mt-3 mb-4 custom-input-btn" id="verifyCodeBtn">Vérifier le Code</button>
                            <div id="success-message-vr" class="alert alert-success mb-2" style="display: none;"></div>
                        </fieldset>

                        <!-- Champs masqués par défaut -->
                        <div id="hiddenFields" style="display: none;">
                            <fieldset class="box-fieldset">
                                <input type="text" class="form-contact style-1 custom-input" placeholder="Remplir votre Nom !" name="name" required>
                            </fieldset>

                            <fieldset class="box-fieldset">
                                <input type="text" class="form-contact style-1 custom-input" placeholder="Remplir votre Prenom !" name="prenom" required>
                            </fieldset>

                            <fieldset class="box-fieldset">
                                <input type="tel" class="form-contact style-1 custom-input" placeholder="Remplir votre Téléphone !" name="telephone" required>
                            </fieldset>

                            <fieldset class="box-fieldset">
                                <input type="password" class="form-contact style-1 custom-input" placeholder="Mot de passe" name="password" required>
                            </fieldset>

                            <fieldset class="box-fieldset">
                                <input type="password" class="form-contact style-1 custom-input" placeholder="Confirmer Mot de passe" name="password_confirmation" required>
                            </fieldset>

                            <fieldset class="d-flex align-items-center gap-6">
                                <label for="cb1" class="caption-1 text-variant-1">J'accepte les <span class="fw-5 text-black">Conditions d'Utilisation.</span></label>
                                <input type="checkbox" class="tf-checkbox style-2" id="cb1" name="termsAccepted" required>
                            </fieldset>
                        </div>

                        <!-- Bouton S'inscrire désactivé au début -->
                        <button type="submit" class="tf-btn primary w-100" id="registerBtn" disabled>S'inscrire</button>

                        <div class="mt-12 text-variant-1 text-center noti">
                            Vous avez déjà un compte ?
                            <a href="#modalLogin" data-bs-toggle="modal" class="text-black fw-5">Connectez-vous ici.</a>
                        </div>
                    </form>

                </div>
            </div> 
        </div>
    </div>


    <script>
    $(document).ready(function() {
        // Handle star rating selection
        $('#star-rating .fa-star').on('click', function() {
            let rating = $(this).data('value');
            
            // Set the selected stars
            $('#star-rating .fa-star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
            
            // Set the rating value in the hidden input
            $('#rating-value').val(rating);
        });

        // Show the modal when the "Ajouter Avis" button is clicked
        $('#send-avis').click(function() {
            $('#avisModal').modal('show');
        });

        // Handle form submission with AJAX
        $('#submit-avis').click(function(e) {
            e.preventDefault();

            // Get the review text and rating from the form
            let reviewText = $('#review-text').val();
            let rating = $('#rating-value').val();
            let departement_id = @json($payment->departement_id);
            let thematique_id = @json($payment->thematique_id);
            // Check if both fields are filled
            if (reviewText && rating) {
                $.ajax({
                    url: '/submit-review', // replace with your route for submitting a review
                    method: 'POST',
                    data: {
                        review: reviewText,
                        rating: rating,
                        departement_id : departement_id,
                        thematique_id  : thematique_id,
                        _token: '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    success: function(response) {
                        $('#success-message-avis').text('Avis Envoyer Avec Succes .').show();
                        setTimeout(function() {
                            $('#success-message-avis').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
                        }, 3000); // 2000 millisecondes = 2 secondes

                       // $('#avisModal').modal('hide');
                        $('#avisForm')[0].reset();
                        $('#star-rating .fa-star').removeClass('selected'); // Reset stars
                    },
                    error: function(xhr) {
                        $('#err-message-avis').text('Une erreur est survenue. Veuillez réessayer.').show();
                    }
                });
            } else {
                $('#err-message-avis').text('Veuillez entrer votre Avis.').show();
                setTimeout(function() {
                    $('#err-message-avis').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
                }, 3000); // 2000 millisecondes = 2 secondes
            }
        });
    });
</script>


<script src="{{ asset('assetsMarketplace/js/my-js/auth.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/my-js/news.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/my-js/market.js') }}"></script>

</body>




@endsection