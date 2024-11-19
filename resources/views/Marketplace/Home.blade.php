@extends('components.app_client') 
@section('title', 'Accueil') 
@section('content')


<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .border-danger {
            border: 1px solid red;
        }

        .custom-input {
        height: 40px; /* Hauteur des inputs à 100 pixels */
    }
    .custom-input-btn{
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

        .tf-btn.primary {
            background-color: #ED2027; /* Couleur normale */
            color: white; /* Couleur du texte */
            border: none; /* Retirer la bordure */
            padding: 10px; /* Padding pour rendre le bouton plus grand */
            border-radius: 5px; /* Arrondir les coins */
            cursor: pointer; /* Change le curseur sur survol */
        }

        /* Couleur lorsque le bouton est désactivé */
        .tf-btn.primary:disabled {
            background-color: #cccccc; /* Couleur désactivée */
            color: #666666; /* Couleur du texte désactivé */
            cursor: not-allowed; /* Change le curseur pour indiquer que le bouton est désactivé */
        }


        body.modal-open {
            overflow: visible !important; /* Prevent scrolling */
        }
        #page-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Behind Bootstrap modal */
            display: none;
        }


        .custom-modal-position {
            position: fixed;
            bottom: 0; /* Positioned at the bottom */
            left: 25%; /* Center horizontally relative to the viewport */
            transform: translateX(-50%); /* Adjust to center properly */
            margin: 0;
            max-width: 1000px; /* Adjust width as needed */
            width: 100%; /* Ensure it fits the screen width */
       
            z-index: 1055; /* Ensure it appears above other content */
        }
        .custom-modal-position .modal-content {
            border-radius: 0.5rem;
        }

    </style>
</head>

<body class="body counter-scroll">

    <div class="preload preload-container">
        <div class="boxes ">
            <div class="box">
                <div></div> <div></div> <div></div> <div></div>
            </div>
            <div class="box">
                <div></div> <div></div><div></div> <div></div>
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
                                                <li class=" home current"><a href="{{route('get.home')}}">Accueil</a>
                                                </li>

                                                <li class="dropdown2"><a href="{{route('get.marketplace')}}">Thematique</a>
                                                    <ul>
                                                        @foreach($thematiques as $thematique)
                                                        <li><a href="{{route('get.marketplace')}}">{{$thematique->thematique}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                <li class=""><a href="{{route('get.marketplace')}}">Marketplace</a></li>

                                                <li class=""><a href="{{route('get.about_us')}}">A Propos</a></li>

                                                <li class=""><a href="{{route('get.faq')}}">FAQ</a>
                                                </li>

                                                <li class=""><a href="{{route('marketplace.demandes')}}">
                                                Commandez en Quantité
                                                </a></li>

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
            <!-- End Main Header -->
            <!-- Slider -->
            <section class="flat-slider home-1">
                <div class="container relative">
                    <div class="row">    
                        <div class="col-lg-12">
                            <div class="slider-content">
                                <div class="heading text-center">
                                    <h1 class="text-white animationtext slide">
                                    Nos Leads sont 
                                            <span class="tf-text s1 cd-words-wrapper"> 
                                                <span class="item-text is-visible">Tous Exclusifs</span>
                                                <span class="item-text is-hidden">Tous Vérifiés</span>
                                                <span class="item-text is-hidden">Tous Fiable</span>
                                            </span>  
                                    </h1>
                                    <p class="subtitle text-white body-1 wow fadeIn" data-wow-delay=".8s" data-wow-duration="2000ms">Acheter en live nos lead scrupuleusement vérifié par nos experts , achetez à l'unité à partir de <span class='h3'>  32 euros H.T </span>  </span></p>
                                </div>
                                <div class="flat-tab flat-tab-form">
                                    <ul class="nav-tab-form style-1 justify-content-center" role="tablist">
                                        <li class="nav-tab-item" role="presentation">   
                                            <a href="#forRent" class="nav-link-item active"  data-bs-toggle="tab">Filtrer par département, par thématique, et choisissez !</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" role="tabpanel">
                                            <div class="form-sl">
                                            <form method="post" action="{{ route('post.marketplace') }}">
                                            @csrf
                                                <div class="wd-find-select mb-5">
                                                    <div class="inner-group">
                                                        <div class="form-group-1 search-form form-style">
                                                            <label>Recherche</label>
                                                            <input type="text" class="form-control" placeholder="Mot-clé de recherche." value="{{ request('s') }}" name="s" title="Rechercher">
                                                        </div>
                                                        <div class="form-group-3 form-style">
                                                            <label>Thematique</label>
                                                            <div class="group-select">
                                                                <div class="" tabindex="0">
                                                                    <select class='form-select no-border' name="thematique_id">
                                                                        <option selected='' disabled >Tout</option>
                                                                        @foreach($thematiquesFurstSlideSherchs as $thematiquesFurstSlideSherch)
                                                                            <option value="{{ $thematiquesFurstSlideSherch->id }}">{{ $thematiquesFurstSlideSherch->thematique }}</option>
                                                                        @endforeach     
                                                                    </select>                                               
                                                                </div>
                                                            </div>                                                
                                                        </div>
                                                        <div class="form-group-3 form-style">
                                                            <label>Departement</label>
                                                            <div class="group-select">
                                                                <div class="" tabindex="0">
                                                                    <select class='form-select no-border' name="departement_id">
                                                                        <option selected='' disabled >Tout</option>
                                                                        @foreach($DepartementFurstSlideSherchs as $DepartementFurstSlideSherch)
                                                                            <option value="{{ $DepartementFurstSlideSherch->id }}">{{ $DepartementFurstSlideSherch->departement }}</option>
                                                                        @endforeach     
                                                                    </select>                                               
                                                                </div>
                                                            </div>                                                
                                                        </div>
                                                        <div class="form-group-4 box-filter">
                                                            <a class="filter-advanced pull-right">
                                                                <span class="icon icon-faders"></span> 
                                                                <span class="text-1">Advanced</span>                                                                      
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="tf-btn primary">Recherche</button>
                                                </div>

                                                <div class="wd-search-form">
                                                    <div class="grid-2 group-box group-price"></div>
                                                    <div class="grid-2 group-box">
                                                        <div class="group-select grid-2">
                                                            <div class="box-select">
                                                                <label class="title-select text-variant-1">Type</label>
                                                                <div class="group-select">
                                                                    <div class="" tabindex="0">
                                                                        <select class='form-select' name="type">
                                                                            <option selected='' disabled >Tout</option>
                                                                            <option value="B2B">B2B</option>
                                                                            <option value="B2C">B2C</option>
                                                                        </select>                                               
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                            <div class="box-select">
                                                                <label class="title-select text-variant-1">Date Debut</label>
                                                                <div class="group-input">
                                                                <select name="time_filter" class='form-select no-border'>
                                                                    <option value="">Tout</option>
                                                                    <option value="today">Aujourd'hui</option>
                                                                    <option value="this_week">semaine</option>
                                                                    <option value="this_month">Mois</option>
                                                                </select>   
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                
                                                <div class="d-flex justify-content-center">
                                                        <a href="{{route('get.marketplace')}}" class="btn " style='background-color:#ED2027;color:white;' >J'accède à La Marketplace !</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                            
                            
                    </div>
                </div>
                <div class="overlay"></div>
            </section> 
            <!-- End Slider -->
            <!-- Recommended -->
            <section class="flat-section flat-recommended">
                <div class="container">
                    <div class="text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="text-subtitle text-primary">La place de marché 100% Lead !</div>
                        <h4 class="mt-4">Thématique</h4>
                    </div>
                    <div class="flat-tab-recommended wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <ul class="nav-tab-recommended justify-content-center" role="tablist">
                            @foreach($thematiques as $thematique)
                            <li class="nav-tab-item" role="presentation">
                            <a href="#" class="nav-link-item @if ($loop->first) active @endif" data-thematique-id="{{ $thematique->id }}" data-bs-toggle="tab">{{ $thematique->thematique }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="viewAll" role="tabpanel">
                                <div class="row" id="leads-container">
                                    <!-- Leads will be injected here by AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Recommended -->
            <!-- Location -->
            <section class="flat-section-v3 flat-location bg-surface">
                <div class="container-full">
                    <div class="box-title text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="text-subtitle text-primary">Explorez les Thematique</div>
                        <h4 class="mt-4">Lead</h4>
                    </div>
                    <div class="wow fadeInUpSmall" data-wow-delay=".4s" data-wow-duration="2000ms">
                        <div class="swiper tf-sw-location overlay" data-preview-lg="4.1" data-preview-md="3" data-preview-sm="2" data-space="30" data-centered="true" data-loop="true">
                            <div class="swiper-wrapper">


                                        @foreach($villesSlide as $v)
                                <div class="swiper-slide">
                                    <a href="#" class="box-location">
                                        <div class="image">
                                        <img src="{{ asset('storage/' . $v->image) }}" alt="image-location">
                                        </div>
                                        <div class="content">
                                            <span class="sub-title">Leads {{$v->leads_count}}</span>
                                            <h6 class="title">{{$v->ville}}</h6>
                                        </div>
                                    </a>
                                </div>
                                        @endforeach
                            </div>
                            <div class="box-navigation">
                                <div class="navigation swiper-nav-next nav-next-location"><span class="icon icon-arr-l"></span></div>
                                <div class="navigation swiper-nav-prev nav-prev-location"><span class="icon icon-arr-r"></span></div> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- End Location -->
            <!-- Service & Counter  -->
             <!--
            <section class="flat-section">
                <div class="container">
                    <div class="box-title style-1 wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="box-left">
                            <div class="text-subtitle text-primary">Our Services</div>
                            <h4 class="mt-4">What We Do?</h4>
                        </div>
                        <a href="#" class="btn-view"><span class="text">View All Services</span> <span class="icon icon-arrow-right2"></span> </a>
                    </div>
                    <div class="flat-service wrap-service wow fadeInUpSmall" data-wow-delay=".4s" data-wow-duration="2000ms">
                        <div class="box-service hover-btn-view">
                            <div class="icon-box">
                                <span class="icon icon-buy-home"></span>
                            </div>
                            <div class="content">
                                <h6 class="title">Buy A New Home</h6>
                                <p class="description">Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.</p>
                                <a href="#" class="btn-view style-1"><span class="text">Learn More</span> <span class="icon icon-arrow-right2"></span> </a>
                            </div>
                        </div>
                        <div class="box-service hover-btn-view">
                            <div class="icon-box">
                                <span class="icon icon-rent-home"></span>
                            </div>
                            <div class="content">
                                <h6 class="title">Rent a home</h6>
                                <p class="description">Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.</p>
                                <a href="#" class="btn-view style-1"><span class="text">Learn More</span> <span class="icon icon-arrow-right2"></span> </a>
                            </div>
                        </div>
                        <div class="box-service hover-btn-view">
                            <div class="icon-box">
                                <span class="icon icon-sale-home"></span>
                            </div>
                            <div class="content">
                                <h6 class="title">Sell a home</h6>
                                <p class="description">Sell confidently with expert guidance and effective strategies, showcasing your property's best features for a successful sale.</p>
                                <a href="#" class="btn-view style-1"><span class="text">Learn More</span> <span class="icon icon-arrow-right2"></span> </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flat-counter tf-counter wrap-counter wow fadeInUpSmall" data-wow-delay=".4s" data-wow-duration="2000ms">
                        @foreach($thematiquesStatistiques as $thematiquesStatistique)
                        <div class="counter-box">
                            <div class="count-number">                                  
                            <div class="number" data-speed="2000" data-to="{{$thematiquesStatistique->leads_count}}" data-inviewport="yes">{{$thematiquesStatistique->leads_count}}</div>                                   
                            </div>
                            <div class="title-count">{{$thematiquesStatistique->thematique}}</div>                              
                        </div>
                        @endforeach
                    </div> 
                </div>
            </section>
             -->
            <!-- End Service & Counter -->
            <!-- Benefit -->
            <section class="flat-section flat-benefit bg-surface">
                <div class="container">
                    <div class="box-title text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="text-subtitle text-primary">La place de marché 100% Lead !</div>
                        <h4 class="mt-4">Pourquoi Choisir Lead & Boost</h4>
                    </div>
                    <div class="wrap-benefit wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="box-benefit">
                            <div class="icon-box">
                                <span class="icon icon-proven"></span>
                            </div>
                            <div class="content text-center">
                                <h6 class="title">Nos Leads sont tous exclusifs</h6>
                                <p class="description">Nous garantissons un lead 100% exclusif pour une meilleure transformation .</p>
                            </div>
                        </div>
                        <div class="box-benefit">
                            <div class="icon-box">
                                <span class="icon icon-double-ruler"></span>
                            </div>
                            <div class="content text-center">
                                <h6 class="title">100% des LEAD Vérifiés !</h6>
                                <p class="description">Chaque LEAD présent sur la plate-forme ont été appelé par un expert pour verifier l'exactitude des informations</p>
                            </div>
                        </div>
                        <div class="box-benefit">
                            <div class="icon-box">
                                <span class="icon icon-hand"></span>
                            </div>
                            <div class="content text-center">
                                <h6 class="title">100% fiable</h6>
                                <p class="description">En cas de manquement, faux numéros, mauvais email , sous 48h votre lead est remplacé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Benefit -->
            <!-- Property  -->
            <section class="flat-section flat-property">
                <div class="container">
                    <div class="box-title style-1 wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="box-left">
                            <div class="text-subtitle text-primary">Top Thematique</div>
                            <h4 class="mt-4">Top Thematique</h4>
                        </div>
                        <a href="{{route('get.marketplace')}}" class="tf-btn primary size-1">Aficher  Tout</a>
                    </div>
                    <div class="wrap-property">
                        <div class="box-left  wow fadeInLeftSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                            <div class="homeya-box lg">
                                <div class="archive-top">
                                    <a href="property-details-v1.html" class="images-group">
                                        <div class="images-style">
                                            <img src="/storage/{{$topThematiques->image}}" alt="img">      
                                        </div>
                                        <div class="bottom">
                                            <span class="flag-tag style-2">Nombre des Leads ({{$topThematiques->leads_count}} )</span>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <h5 class="text-capitalize"><a href="property-details-v1.html" class="link">{{$topThematiques->thematique}}</a></h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                             
                        <div class="box-right wow fadeInRightSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                            @foreach ($top3leadThematique as $p)
                            <div class="homeya-box list-style-1">
                                <a href="{{ route('get.detai', $p->id) }}" class="images-group">
                                    <div class="images-style">
                                        <img src="/storage/{{$p->thematique->image}}" alt="img" style="width: 260px; height: 110px;">
                                    </div>
                                    <div class="top">
  
                                        <ul class="d-flex gap-4">
                                        <li class=""><span class='flag-tag style-2'>{{$p->departement->departement}} </span> <span class='flag-tag style-2'>{{$p->code_postale}}</span></li>
                                        
                                        </ul>
                                    </div>
                                    <div class="bottom">
                                        <span class="flag-tag success style-2">{{$p->thematique->theme}}</span>
                                    </div>
                                </a>
                                <div class="content">
                                    <div class="archive-top">
                                        <div class="row">
                                            <div class="col-lg-9">  <div class=" text-capitalize fw-7 pt-2"><a href="property-details-v1.html" class="link">{{$p->thematique->thematique}}</a></div> </div>
                                            <div class="col-lg-3 mt-2 d-flex justify-content-end">
                                                <li class="item">
                                                @if(session("auth"))
                                                    <i class="fas fa-eye"></i> 
                                                        <span>{{$p->viewed_by_clients_count}}</span>
                                                @endif
                                                </li>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex gap-8 align-items-center">
                                        <li>
                                        <p class="h7">€ {{$p->prix}}</p>
                                        </li>
                                        </div>
                                        <div class="d-flex align-items-center">

                                        <form method="POST" action="{{route('cart_add',['lead'=>$p,'src'=>'market'])}}" class="contact-form">
                                                   
                                                   @csrf     <div class="d-flex align-items-center">
                                                    <li><input type="image" src="{{ asset('assetsMarketplace/images/ajouter-au-panier.png') }}"  width="30" height="30" alt="addPanier"  /> </li>               
                                                    </div>
                                        </form>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Property  -->
            <!-- Testimonial -->
             @if ($reviews->count() > 0)
            <section class="flat-section-v3 bg-surface flat-testimonial">
                <div class="cus-layout-1">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="box-title">
                                <div class="text-subtitle text-primary">Top Avis</div>
                                <h4 class="mt-4">Avis</h4>
                            </div>
                            <p class="text-variant-1 p-16">Avec notre solution, accédez à des leads qualifiés et vérifiés pour optimiser votre croissance. Profitez d'un ciblage précis et d'une génération de contacts en conformité avec la réglementation, pour dynamiser votre portefeuille clients en toute sérénité.</p>
                            <div class="box-navigation">
                                <div class="navigation swiper-nav-next nav-next-testimonial"><span class="icon icon-arr-l"></span></div>
                                <div class="navigation swiper-nav-prev nav-prev-testimonial"><span class="icon icon-arr-r"></span></div> 
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="swiper tf-sw-testimonial" data-preview-lg="2.6" data-preview-md="2" data-preview-sm="2" data-space="30">
                                <div class="swiper-wrapper">
                                    
                                    @foreach ($reviews as $review)
                                        <div class="swiper-slide">
                                            <div class="box-tes-item wow fadeIn" data-wow-delay=".2s" data-wow-duration="2000ms">
                                                <ul class="list-star">
                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                        <li class="icon icon-star"></li>
                                                    @endfor
                                                </ul>
                                                <p class="note body-1">
                                                    "{{ $review->review }}"
                                                </p>
                                                <div class="box-avt d-flex align-items-center gap-12">
                                                    <div class="info">
                                                        <div class="h7 fw-7">{{ $review->client->nom }} {{ $review->client->prenom }}</div>
                                                        <p class="text-variant-1 mt-4">{{ $review->client->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </section>
            @endif
            <!-- End Testimonial -->
            <!-- Agents -->
<!--   
            <section class="flat-section flat-agents">
                <div class="container">
                    <div class="box-title text-center wow fadeIn" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="text-subtitle text-primary">Our Teams</div>
                        <h4 class="mt-4">Meet Our Agents</h4>
                    </div>
                    <div class="row">
                        <div class="box col-lg-3 col-sm-6">
                            <div class="box-agent hover-img wow fadeIn" data-wow-delay=".2s" data-wow-duration="2000ms">
                                <a href="#" class="box-img img-style">
                                    <img src="images/agents/agent-1.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><span class="icon icon-facebook"></span></li>
                                        <li><span class="icon icon-linkedin"></span></li>
                                        <li><span class="icon icon-twitter"></span></li>
                                        <li><span class="icon icon-instagram"></span></li>
                                    </ul>
                                </a>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">Jack Halow</h6>
                                        <p class="mt-4 text-variant-1">CEO & Founder</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box col-lg-3 col-sm-6">
                            <div class="box-agent hover-img wow fadeIn" data-wow-delay=".4s" data-wow-duration="2000ms">
                                <a href="#" class="box-img img-style">
                                    <img src="images/agents/agent-2.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><span class="icon icon-facebook"></span></li>
                                        <li><span class="icon icon-linkedin"></span></li>
                                        <li><span class="icon icon-twitter"></span></li>
                                        <li><span class="icon icon-instagram"></span></li>
                                    </ul>
                                </a>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">John Smith</h6>
                                        <p class="mt-4 text-variant-1">Property Manager</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box col-lg-3 col-sm-6">
                            <div class="box-agent hover-img wow fadeIn" data-wow-delay=".6s" data-wow-duration="2000ms">
                                <a href="#" class="box-img img-style">
                                    <img src="images/agents/agent-3.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><span class="icon icon-facebook"></span></li>
                                        <li><span class="icon icon-linkedin"></span></li>
                                        <li><span class="icon icon-twitter"></span></li>
                                        <li><span class="icon icon-instagram"></span></li>
                                    </ul>
                                </a>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">Chris Patt</h6>
                                        <p class="mt-4 text-variant-1">Administrative Staff</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box col-lg-3 col-sm-6">
                            <div class="box-agent hover-img wow fadeIn" data-wow-delay=".8s" data-wow-duration="2000ms">
                                <a href="#" class="box-img img-style">
                                    <img src="images/agents/agent-4.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><span class="icon icon-facebook"></span></li>
                                        <li><span class="icon icon-linkedin"></span></li>
                                        <li><span class="icon icon-twitter"></span></li>
                                        <li><span class="icon icon-instagram"></span></li>
                                    </ul>
                                </a>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">Jack Halow</h6>
                                        <p class="mt-4 text-variant-1">Real Estate Marketer</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
 -->
            <!-- End Agents -->
            <!-- Latest New -->
             <!--   
            <section class="flat-section-v3 flat-latest-new bg-surface">
                <div class="container">
                    <div class="box-title text-center wow fadeIn" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <div class="text-subtitle text-primary">Latest New</div>
                        <h4 class="mt-4">Helpful Homeya Guides</h4>
                    </div>
                    <div class="row">
                        <div class="box col-lg-4 col-md-6">
                            <a href="blog-detail.html" class="flat-blog-item hover-img wow fadeIn" data-wow-delay=".2s" data-wow-duration="2000ms">
                                <div class="img-style">
                                    <img src="images/blog/blog-1.jpg" alt="img-blog">
                                    <span class="date-post">January 28, 2024</span>
                                </div>
                                <div class="content-box">
                                    <div class="post-author">
                                        <span class="fw-6">Esther</span>
                                        <span>Furniture</span>
                                    </div>
                                    <h6 class="title">Building gains into housing stocks and how to trade the sector</h6>
                                    <p class="description">The average contract interest rate for 30-year fixed-rate mortgages with conforming loan balances...</p>
                                </div>

                            </a>
                        </div>
                        <div class="box col-lg-4 col-md-6">
                            <a href="blog-detail.html" class="flat-blog-item hover-img wow fadeIn" data-wow-delay=".4s" data-wow-duration="2000ms">
                                <div class="img-style">
                                    <img src="images/blog/blog-2.jpg" alt="img-blog">
                                    <span class="date-post">January 31, 2024</span>
                                </div>
                                <div class="content-box">
                                    <div class="post-author">
                                        <span class="fw-6">Angel</span>
                                        <span>Interior</span>
                                    </div>
                                    <h6 class="title">92% of millennial homebuyers say inflation has impacted their plans</h6>
                                    <p class="description">Mortgage applications to purchase a home, however, dropped 4% last week compared...</p>
                                </div>

                            </a>
                        </div>
                        <div class="box col-lg-4 col-md-6">
                            <a href="blog-detail.html" class="flat-blog-item hover-img wow fadeIn" data-wow-delay=".6s" data-wow-duration="2000ms">
                                <div class="img-style">
                                    <img src="images/blog/blog-3.jpg" alt="img-blog">
                                    <span class="date-post">January 28, 2024</span>
                                </div>
                                <div class="content-box">
                                    <div class="post-author">
                                        <span class="fw-6">Colleen</span>
                                        <span>Architecture</span>
                                    </div>
                                    <h6 class="title">We are hiring ‘moderately,’ says Compass CEO</h6>
                                    <p class="description">New listings were down 20% year over year in March, according to Realtor.com, and total inventory...</p>
                                </div>

                            </a>
                        </div>
                    </div>
                </div>
            </section>
             -->
            <!-- End Latest New -->
            <!-- partner -->
             <!--
            <section class="flat-section-v4 flat-partner">
                <div class="container">
                    <div class="wrap-partner swiper tf-sw-partner" data-preview-lg="5" data-preview-md="4" data-preview-sm="3" data-space="80">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div  class="partner-item">
                                    <svg width="182" height="35" viewBox="0 0 182 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5" clip-path="url(#clip0_1_17747)">
                                        <path d="M0 30.7538C5.56974 30.7538 10.0849 26.2386 10.0849 20.6689C10.0849 15.0991 5.56974 10.584 0 10.584V17.6434C1.67091 17.6434 3.02544 18.9979 3.02544 20.6689C3.02544 22.3398 1.67091 23.6943 0 23.6943V30.7538Z" fill="#161E2D"/>
                                        <path d="M33.6173 13.9459C31.8939 13.4 30.0587 13.1055 28.1546 13.1055C18.1755 13.1055 10.0859 21.1952 10.0859 31.1742C10.0859 32.1758 10.1674 33.1584 10.3241 34.1157H21.5508C21.1501 33.2171 20.9272 32.2217 20.9272 31.1742C20.9272 27.1826 24.163 23.9467 28.1546 23.9467C30.3363 23.9467 32.2921 24.9133 33.6173 26.4416V13.9459Z" fill="#161E2D"/>
                                        <path d="M1.77344 0.5C2.60954 8.06357 9.022 13.9465 16.8085 13.9465C24.5948 13.9465 31.0073 8.06357 31.8434 0.5H21.0251C20.3573 2.17427 18.721 3.35737 16.8085 3.35737C14.8958 3.35737 13.2596 2.17427 12.5917 0.5H1.77344Z" fill="#161E2D"/>
                                        <path d="M45.3164 7.33047H50.9477C52.4706 7.33047 53.6393 7.45 54.4539 7.68906C55.2773 7.92813 55.8927 8.27344 56.3 8.725C56.7161 9.17656 56.9951 9.72552 57.1367 10.3719C57.2872 11.0094 57.3625 12.001 57.3625 13.3469V15.2195C57.3625 16.5919 57.2208 17.5924 56.9375 18.2211C56.6542 18.8497 56.1318 19.3323 55.3703 19.6688C54.6177 20.0052 53.6305 20.1734 52.4086 20.1734H50.9078V28.8328H45.3164V7.33047ZM50.9078 11.0094V16.4813C51.0672 16.4901 51.2044 16.4945 51.3195 16.4945C51.8331 16.4945 52.1872 16.3706 52.382 16.1227C52.5857 15.8659 52.6875 15.3391 52.6875 14.5422V12.7758C52.6875 12.0409 52.5724 11.5628 52.3422 11.3414C52.112 11.1201 51.6339 11.0094 50.9078 11.0094Z" fill="#161E2D"/>
                                        <path d="M67.9344 7.33047L71.1352 28.8328H65.4109L65.132 24.968H63.1266L62.7945 28.8328H57.0039L59.8461 7.33047H67.9344ZM64.9727 21.1563C64.6893 18.7214 64.406 15.7154 64.1227 12.1383C63.556 16.2466 63.2018 19.2526 63.0602 21.1563H64.9727Z" fill="#161E2D"/>
                                        <path d="M84.5758 7.33047V28.8328H79.675L76.7664 19.0578V28.8328H72.0914V7.33047H76.7664L79.9008 17.0125V7.33047H84.5758Z" fill="#161E2D"/>
                                        <path d="M96.4891 7.33047L99.6898 28.8328H93.9656L93.6867 24.968H91.6812L91.3492 28.8328H85.5586L88.4008 7.33047H96.4891ZM93.5273 21.1563C93.244 18.7214 92.9607 15.7154 92.6773 12.1383C92.1107 16.2466 91.7565 19.2526 91.6148 21.1563H93.5273Z" fill="#161E2D"/>
                                        <path d="M100.646 7.33047H104.83C107.53 7.33047 109.354 7.45443 110.302 7.70234C111.258 7.95026 111.984 8.35755 112.48 8.92422C112.976 9.49089 113.285 10.124 113.409 10.8234C113.533 11.5141 113.595 12.8776 113.595 14.9141V22.4445C113.595 24.3747 113.502 25.6674 113.316 26.3227C113.139 26.969 112.825 27.4781 112.373 27.85C111.922 28.213 111.364 28.4698 110.7 28.6203C110.036 28.762 109.035 28.8328 107.698 28.8328H100.646V7.33047ZM106.237 11.0094V25.1539C107.043 25.1539 107.539 24.9945 107.725 24.6758C107.911 24.3482 108.004 23.4672 108.004 22.0328V13.6789C108.004 12.7049 107.973 12.0807 107.911 11.8063C107.849 11.5318 107.707 11.3326 107.486 11.2086C107.265 11.0758 106.848 11.0094 106.237 11.0094Z" fill="#161E2D"/>
                                        <path d="M128.457 19.9211C128.457 22.0815 128.404 23.6133 128.298 24.5164C128.2 25.4107 127.882 26.2297 127.341 26.9734C126.81 27.7172 126.089 28.2883 125.177 28.6867C124.265 29.0852 123.202 29.2844 121.989 29.2844C120.838 29.2844 119.802 29.0984 118.881 28.7266C117.969 28.3458 117.234 27.7792 116.677 27.0266C116.119 26.274 115.787 25.4549 115.68 24.5695C115.574 23.6841 115.521 22.1346 115.521 19.9211V16.2422C115.521 14.0818 115.57 12.5544 115.667 11.6602C115.773 10.757 116.092 9.93359 116.623 9.18984C117.164 8.44609 117.89 7.875 118.802 7.47656C119.714 7.07813 120.776 6.87891 121.989 6.87891C123.14 6.87891 124.172 7.06927 125.084 7.45C126.004 7.82188 126.744 8.38411 127.302 9.13672C127.859 9.88932 128.191 10.7083 128.298 11.5938C128.404 12.4792 128.457 14.0286 128.457 16.2422V19.9211ZM122.866 12.8555C122.866 11.8549 122.808 11.2174 122.693 10.943C122.587 10.6596 122.361 10.518 122.016 10.518C121.723 10.518 121.498 10.6331 121.338 10.8633C121.188 11.0846 121.112 11.7487 121.112 12.8555V22.8961C121.112 24.1445 121.161 24.9148 121.259 25.207C121.365 25.4992 121.604 25.6453 121.976 25.6453C122.357 25.6453 122.6 25.4771 122.706 25.1406C122.812 24.8042 122.866 24.0029 122.866 22.7367V12.8555Z" fill="#161E2D"/>
                                        <path d="M141.884 7.33047L139.932 16.8398L142.88 28.8328H137.701C137.081 26.6901 136.514 24.0826 136.001 21.0102C135.859 22.3648 135.664 23.8036 135.416 25.3266L134.885 28.8328H129.44L131.459 16.8398L129.44 7.33047H134.845C134.943 7.9237 135.137 8.91094 135.43 10.2922C135.66 11.3458 135.85 12.3109 136.001 13.1875L137.196 7.33047H141.884Z" fill="#161E2D"/>
                                        <path d="M156.162 7.33047V28.8328H151.261L148.352 19.0578V28.8328H143.677V7.33047H148.352L151.487 17.0125V7.33047H156.162Z" fill="#161E2D"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1_17747">
                                        <rect width="181.333" height="34" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>  
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="partner-item">
                                    <svg width="184" height="45" viewBox="0 0 184 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5" clip-path="url(#clip0_1_17753)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0004 4.27114C8.43019 5.3691 7.01027 6.66724 5.77766 8.12855C10.8147 7.66092 17.2141 8.42451 24.6437 12.1393C32.5775 16.1062 38.9662 16.2403 43.4124 15.3826C43.0089 14.1612 42.501 12.9872 41.8994 11.8712C36.8097 12.408 30.2847 11.6975 22.6804 7.89541C17.8515 5.48099 13.595 4.48642 10.0004 4.27114ZM38.9262 7.63932C34.9069 3.14848 29.0658 0.322266 22.5645 0.322266C20.6552 0.322266 18.8028 0.566042 17.0368 1.02413C19.4286 1.67675 21.9695 2.63152 24.6437 3.96865C30.2112 6.75235 35.0178 7.64866 38.9262 7.63932ZM44.363 19.6702C38.9915 20.7308 31.5741 20.513 22.6804 16.0661C14.3657 11.9088 7.7479 11.9611 3.28464 12.953C3.05426 13.0041 2.8293 13.0579 2.60978 13.1139C2.02543 14.3847 1.55898 15.7211 1.2243 17.1089C1.58175 17.0134 1.95113 16.9226 2.33224 16.8379C7.74696 15.6346 15.3975 15.6869 24.6437 20.31C32.9585 24.4674 39.5762 24.415 44.0396 23.4232C44.1924 23.3892 44.3431 23.3541 44.4913 23.3179C44.5076 22.9718 44.5157 22.6236 44.5157 22.2735C44.5157 21.3927 44.4639 20.5239 44.363 19.6702ZM43.7746 27.9504C38.4553 28.8803 31.2538 28.5234 22.6804 24.2368C14.3657 20.0794 7.7479 20.1318 3.28464 21.1237C2.29392 21.3437 1.40269 21.6118 0.616497 21.8949C0.614354 22.0208 0.613281 22.147 0.613281 22.2735C0.613281 34.3968 10.4412 44.2247 22.5645 44.2247C32.7247 44.2247 41.2727 37.322 43.7746 27.9504Z" fill="#161E2D"/>
                                        <path d="M67.8761 29.2566C66.6293 29.2566 65.4702 29.0283 64.399 28.5717C63.3454 28.1151 62.4322 27.4829 61.6595 26.6751C60.9044 25.8498 60.3512 24.8927 60 23.8039L62.9766 22.5132C63.4507 23.6371 64.1356 24.5239 65.0312 25.1737C65.9268 25.8059 66.9366 26.122 68.0605 26.122C68.6927 26.122 69.2371 26.0254 69.6937 25.8322C70.1678 25.6215 70.5278 25.3405 70.7737 24.9893C71.0371 24.6381 71.1688 24.2166 71.1688 23.7249C71.1688 23.1454 70.9932 22.6712 70.6419 22.3024C70.3083 21.9161 69.799 21.6176 69.1141 21.4068L65.3473 20.1951C63.8195 19.721 62.6693 19.0098 61.8966 18.0615C61.1239 17.1132 60.7376 15.998 60.7376 14.7161C60.7376 13.5922 61.0098 12.6 61.5541 11.7395C62.1161 10.879 62.8888 10.2117 63.8722 9.73756C64.8732 9.24585 66.0146 9 67.2966 9C68.4732 9 69.5532 9.21073 70.5366 9.63219C71.52 10.0361 72.3629 10.6068 73.0654 11.3444C73.7854 12.0644 74.321 12.9161 74.6722 13.8995L71.722 15.2166C71.3356 14.2332 70.7561 13.478 69.9834 12.9512C69.2107 12.4068 68.3151 12.1346 67.2966 12.1346C66.6995 12.1346 66.1727 12.24 65.7161 12.4507C65.2595 12.6439 64.8995 12.9249 64.6361 13.2937C64.3902 13.6449 64.2673 14.0663 64.2673 14.5581C64.2673 15.1024 64.4429 15.5854 64.7941 16.0068C65.1454 16.4107 65.681 16.7268 66.401 16.9551L70.0098 18.0878C71.5727 18.5971 72.7405 19.2995 73.5132 20.1951C74.3034 21.0907 74.6985 22.1971 74.6985 23.5141C74.6985 24.6381 74.4088 25.6302 73.8293 26.4907C73.2498 27.3512 72.4507 28.0273 71.4322 28.519C70.4137 29.0107 69.2283 29.2566 67.8761 29.2566Z" fill="#161E2D"/>
                                        <path d="M77.6346 28.9405V9H81.0853V17.4293L80.6112 16.9288C80.9448 16.0683 81.4892 15.4185 82.2443 14.9795C83.017 14.5229 83.9126 14.2946 84.9312 14.2946C85.9848 14.2946 86.9156 14.5229 87.7234 14.9795C88.5487 15.4361 89.1897 16.0771 89.6463 16.9024C90.1029 17.7102 90.3312 18.6498 90.3312 19.721V28.9405H86.8804V20.5376C86.8804 19.9054 86.7575 19.361 86.5116 18.9044C86.2658 18.4478 85.9234 18.0966 85.4843 17.8507C85.0629 17.5873 84.5624 17.4556 83.9829 17.4556C83.4209 17.4556 82.9204 17.5873 82.4814 17.8507C82.0424 18.0966 81.6999 18.4478 81.4541 18.9044C81.2082 19.361 81.0853 19.9054 81.0853 20.5376V28.9405H77.6346Z" fill="#161E2D"/>
                                        <path d="M97.5954 29.2566C96.5945 29.2566 95.7252 29.0898 94.9876 28.7561C94.2501 28.4224 93.6793 27.9483 93.2754 27.3337C92.8715 26.7015 92.6696 25.9727 92.6696 25.1473C92.6696 24.3571 92.8452 23.6546 93.1964 23.04C93.5476 22.4078 94.092 21.881 94.8296 21.4595C95.5671 21.0381 96.4979 20.7395 97.6218 20.5639L102.311 19.8V22.4341L98.2803 23.119C97.5954 23.242 97.0862 23.4615 96.7525 23.7776C96.4188 24.0937 96.252 24.5063 96.252 25.0156C96.252 25.5073 96.4364 25.9024 96.8052 26.201C97.1915 26.482 97.6657 26.6224 98.2276 26.6224C98.9476 26.6224 99.5798 26.4732 100.124 26.1746C100.686 25.8585 101.116 25.4283 101.415 24.8839C101.731 24.3395 101.889 23.7424 101.889 23.0927V19.4049C101.889 18.7902 101.643 18.281 101.152 17.8771C100.677 17.4556 100.045 17.2449 99.2549 17.2449C98.5174 17.2449 97.8589 17.4468 97.2793 17.8507C96.7174 18.2371 96.3047 18.7551 96.0413 19.4049L93.2228 18.0351C93.5037 17.28 93.9428 16.6302 94.5398 16.0859C95.1545 15.5239 95.8745 15.0849 96.6998 14.7688C97.5252 14.4527 98.4208 14.2946 99.3867 14.2946C100.563 14.2946 101.599 14.5141 102.495 14.9532C103.391 15.3746 104.084 15.9717 104.576 16.7444C105.085 17.4995 105.34 18.3863 105.34 19.4049V28.9405H102.073V26.4907L102.811 26.4381C102.442 27.0527 102.003 27.5707 101.494 27.9922C100.985 28.3961 100.405 28.7122 99.7554 28.9405C99.1057 29.1512 98.3857 29.2566 97.5954 29.2566Z" fill="#161E2D"/>
                                        <path d="M108.529 28.9405V14.6107H111.769V17.4293L111.506 16.9288C111.839 16.0683 112.384 15.4185 113.139 14.9795C113.912 14.5229 114.807 14.2946 115.826 14.2946C116.879 14.2946 117.81 14.5229 118.618 14.9795C119.443 15.4361 120.084 16.0771 120.541 16.9024C120.997 17.7102 121.226 18.6498 121.226 19.721V28.9405H117.775V20.5376C117.775 19.9054 117.652 19.361 117.406 18.9044C117.16 18.4478 116.818 18.0966 116.379 17.8507C115.957 17.5873 115.457 17.4556 114.877 17.4556C114.316 17.4556 113.815 17.5873 113.376 17.8507C112.937 18.0966 112.595 18.4478 112.349 18.9044C112.103 19.361 111.98 19.9054 111.98 20.5376V28.9405H108.529Z" fill="#161E2D"/>
                                        <path d="M131.098 34.7356C130.027 34.7356 129.034 34.56 128.121 34.2088C127.208 33.8576 126.418 33.3659 125.751 32.7337C125.101 32.119 124.627 31.3902 124.328 30.5473L127.542 29.3356C127.752 30.0029 128.165 30.5385 128.78 30.9424C129.412 31.3639 130.185 31.5746 131.098 31.5746C131.8 31.5746 132.415 31.4429 132.942 31.1795C133.486 30.9161 133.908 30.5298 134.206 30.0205C134.505 29.5288 134.654 28.9317 134.654 28.2293V24.9629L135.312 25.7532C134.821 26.6137 134.162 27.2634 133.337 27.7024C132.512 28.1415 131.572 28.361 130.518 28.361C129.184 28.361 127.99 28.0537 126.936 27.439C125.882 26.8244 125.057 25.9815 124.46 24.9102C123.863 23.839 123.564 22.6361 123.564 21.3015C123.564 19.9493 123.863 18.7463 124.46 17.6927C125.057 16.639 125.873 15.8137 126.91 15.2166C127.946 14.602 129.122 14.2946 130.439 14.2946C131.511 14.2946 132.45 14.5229 133.258 14.9795C134.083 15.4185 134.768 16.0595 135.312 16.9024L134.838 17.7717V14.6107H138.105V28.2293C138.105 29.4761 137.797 30.5912 137.183 31.5746C136.586 32.5581 135.76 33.3307 134.707 33.8927C133.671 34.4546 132.468 34.7356 131.098 34.7356ZM130.94 25.1737C131.677 25.1737 132.318 25.0156 132.863 24.6995C133.425 24.3659 133.864 23.9093 134.18 23.3298C134.496 22.7502 134.654 22.0829 134.654 21.3278C134.654 20.5902 134.487 19.9317 134.153 19.3522C133.837 18.7551 133.398 18.2898 132.836 17.9561C132.292 17.6224 131.66 17.4556 130.94 17.4556C130.22 17.4556 129.57 17.6224 128.991 17.9561C128.411 18.2898 127.954 18.7551 127.621 19.3522C127.305 19.9317 127.147 20.5902 127.147 21.3278C127.147 22.0654 127.305 22.7239 127.621 23.3034C127.954 23.8829 128.402 24.3395 128.964 24.6732C129.544 25.0068 130.202 25.1737 130.94 25.1737Z" fill="#161E2D"/>
                                        <path d="M140.037 28.9405L145.042 21.7493L140.01 14.6107H144.067L147.992 20.4059H146.174L150.099 14.6107H154.129L149.124 21.7493L154.103 28.9405H150.073L146.201 23.1717H147.965L144.093 28.9405H140.037Z" fill="#161E2D"/>
                                        <path d="M156.016 28.9405V14.6107H159.467V28.9405H156.016ZM156.016 13.0039V9.3161H159.467V13.0039H156.016Z" fill="#161E2D"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1_17753">
                                        <rect width="183.293" height="45" fill="white" transform="translate(0.5)"/>
                                        </clipPath>
                                        </defs>
                                    </svg> 
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="partner-item">
                                    <svg width="151" height="39" viewBox="0 0 151 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                        <path d="M18.2284 7.93359V3.18359H3.25195V35.8189H18.2284V31.0689C15.1605 31.0689 12.2182 29.8501 10.0489 27.6808C7.8795 25.5114 6.66078 22.5692 6.66078 19.5013C6.66078 16.4333 7.8795 13.491 10.0489 11.3217C12.2182 9.15233 15.1605 7.93359 18.2284 7.93359Z" fill="#161E2D"/>
                                        <path d="M18.2285 7.93359V31.0689C21.2965 31.0689 24.2388 29.8501 26.4081 27.6808C28.5775 25.5114 29.7962 22.5692 29.7962 19.5013C29.7962 16.4333 28.5775 13.491 26.4081 11.3217C24.2388 9.15233 21.2965 7.93359 18.2285 7.93359Z" fill="#161E2D"/>
                                        <path d="M142.008 14.7399C143.366 14.7399 144.466 13.639 144.466 12.2811C144.466 10.9231 143.366 9.82227 142.008 9.82227C140.65 9.82227 139.549 10.9231 139.549 12.2811C139.549 13.639 140.65 14.7399 142.008 14.7399Z" fill="#161E2D"/>
                                        <path d="M45.3016 24.4599L49.794 9.37167H54.1685L47.5281 28.4415H44.6467L45.3016 24.4599ZM41.1628 9.37167L45.6421 24.4599L46.3232 28.4415H43.4156L36.8145 9.37167H41.1628Z" fill="#161E2D"/>
                                        <path d="M62.7605 25.2457V18.9328C62.7605 18.4787 62.6862 18.0902 62.5378 17.7671C62.3894 17.4353 62.158 17.1777 61.8436 16.9944C61.538 16.811 61.1407 16.7193 60.6518 16.7193C60.2327 16.7193 59.8703 16.7935 59.5647 16.942C59.2591 17.0817 59.0233 17.2869 58.8574 17.5576C58.6915 17.8195 58.6086 18.1295 58.6086 18.4875H54.8365C54.8365 17.885 54.9762 17.3131 55.2556 16.7717C55.535 16.2304 55.9411 15.7545 56.4737 15.3441C57.0063 14.925 57.6394 14.5975 58.3728 14.3618C59.115 14.126 59.9445 14.0082 60.8613 14.0082C61.9615 14.0082 62.9395 14.1915 63.7952 14.5582C64.6509 14.925 65.3232 15.4751 65.8122 16.2085C66.3099 16.942 66.5587 17.8588 66.5587 18.959V25.0231C66.5587 25.8002 66.6067 26.4376 66.7028 26.9353C66.7988 27.4243 66.9385 27.8521 67.1219 28.2189V28.4415H63.3105C63.1272 28.0573 62.9875 27.5771 62.8914 27.0008C62.8041 26.4158 62.7605 25.8308 62.7605 25.2457ZM63.2582 19.8103L63.2844 21.9452H61.1757C60.678 21.9452 60.2458 22.002 59.879 22.1155C59.5123 22.229 59.2111 22.3905 58.9753 22.6001C58.7395 22.8009 58.5649 23.0366 58.4514 23.3073C58.3466 23.578 58.2942 23.8749 58.2942 24.198C58.2942 24.521 58.3685 24.8135 58.5169 25.0755C58.6653 25.3287 58.8793 25.5295 59.1587 25.678C59.4381 25.8177 59.7655 25.8875 60.141 25.8875C60.7085 25.8875 61.2019 25.774 61.621 25.547C62.0401 25.32 62.3632 25.0406 62.5902 24.7088C62.8259 24.377 62.9482 24.0626 62.9569 23.7657L63.9523 25.3636C63.8126 25.7216 63.6205 26.0927 63.376 26.4769C63.1403 26.8611 62.839 27.2235 62.4723 27.564C62.1056 27.8958 61.6646 28.1708 61.1495 28.3891C60.6343 28.5987 60.0231 28.7035 59.3158 28.7035C58.4165 28.7035 57.6001 28.5245 56.8666 28.1665C56.1419 27.7997 55.5656 27.2977 55.1378 26.6603C54.7186 26.0141 54.5091 25.2807 54.5091 24.4599C54.5091 23.7177 54.6488 23.0585 54.9282 22.4822C55.2076 21.9059 55.618 21.4213 56.1594 21.0284C56.7094 20.6267 57.3949 20.3255 58.2157 20.1247C59.0364 19.9151 59.9882 19.8103 61.0709 19.8103H63.2582Z" fill="#161E2D"/>
                                        <path d="M73.1598 17.2956V28.4415H69.3878V14.2701H72.9241L73.1598 17.2956ZM72.6097 20.8581H71.5881C71.5881 19.8103 71.7235 18.8673 71.9941 18.0291C72.2648 17.1821 72.6446 16.4617 73.1336 15.868C73.6226 15.2655 74.2032 14.8071 74.8756 14.4928C75.5566 14.1697 76.3163 14.0082 77.1545 14.0082C77.8181 14.0082 78.425 14.1042 78.9751 14.2963C79.5252 14.4884 79.9967 14.794 80.3896 15.2131C80.7912 15.6322 81.0969 16.1867 81.3064 16.8765C81.5247 17.5663 81.6339 18.4089 81.6339 19.4043V28.4415H77.8356V19.3912C77.8356 18.7625 77.7483 18.2736 77.5736 17.9243C77.399 17.575 77.1414 17.3305 76.8009 17.1908C76.4691 17.0424 76.0587 16.9682 75.5697 16.9682C75.0633 16.9682 74.6224 17.0686 74.2469 17.2694C73.8802 17.4702 73.5746 17.7497 73.3301 18.1077C73.0943 18.4569 72.9153 18.8673 72.7931 19.3388C72.6708 19.8103 72.6097 20.3167 72.6097 20.8581Z" fill="#161E2D"/>
                                        <path d="M89.3089 28.4415H85.5107V13.0128C85.5107 11.9388 85.7202 11.035 86.1394 10.3016C86.5672 9.5594 87.1653 9.00057 87.9337 8.62511C88.7108 8.24092 89.632 8.04883 90.6973 8.04883C91.0465 8.04883 91.3827 8.07502 91.7058 8.12741C92.0288 8.17107 92.3432 8.22783 92.6488 8.29768L92.6095 11.1398C92.4436 11.0962 92.269 11.0656 92.0856 11.0481C91.9022 11.0307 91.6883 11.0219 91.4438 11.0219C90.9898 11.0219 90.6012 11.1005 90.2782 11.2577C89.9638 11.4061 89.7237 11.6288 89.5578 11.9257C89.3919 12.2225 89.3089 12.5849 89.3089 13.0128V28.4415ZM92.138 14.2701V16.942H83.402V14.2701H92.138Z" fill="#161E2D"/>
                                        <path d="M101.765 25.2457V18.9328C101.765 18.4787 101.69 18.0902 101.542 17.7671C101.394 17.4353 101.162 17.1777 100.848 16.9944C100.542 16.811 100.145 16.7193 99.6559 16.7193C99.2368 16.7193 98.8744 16.7935 98.5688 16.942C98.2632 17.0817 98.0275 17.2869 97.8616 17.5576C97.6957 17.8195 97.6127 18.1295 97.6127 18.4875H93.8407C93.8407 17.885 93.9804 17.3131 94.2598 16.7717C94.5392 16.2304 94.9452 15.7545 95.4778 15.3441C96.0105 14.925 96.6435 14.5975 97.377 14.3618C98.1191 14.126 98.9487 14.0082 99.8655 14.0082C100.966 14.0082 101.944 14.1915 102.799 14.5582C103.655 14.925 104.327 15.4751 104.816 16.2085C105.314 16.942 105.563 17.8588 105.563 18.959V25.0231C105.563 25.8002 105.611 26.4376 105.707 26.9353C105.803 27.4243 105.943 27.8521 106.126 28.2189V28.4415H102.315C102.131 28.0573 101.992 27.5771 101.896 27.0008C101.808 26.4158 101.765 25.8308 101.765 25.2457ZM102.262 19.8103L102.288 21.9452H100.18C99.6821 21.9452 99.2499 22.002 98.8832 22.1155C98.5164 22.229 98.2152 22.3905 97.9794 22.6001C97.7437 22.8009 97.5691 23.0366 97.4555 23.3073C97.3508 23.578 97.2984 23.8749 97.2984 24.198C97.2984 24.521 97.3726 24.8135 97.521 25.0755C97.6695 25.3287 97.8834 25.5295 98.1628 25.678C98.4422 25.8177 98.7697 25.8875 99.1451 25.8875C99.7127 25.8875 100.206 25.774 100.625 25.547C101.044 25.32 101.367 25.0406 101.594 24.7088C101.83 24.377 101.952 24.0626 101.961 23.7657L102.956 25.3636C102.817 25.7216 102.625 26.0927 102.38 26.4769C102.144 26.8611 101.843 27.2235 101.476 27.564C101.11 27.8958 100.669 28.1708 100.154 28.3891C99.6384 28.5987 99.0272 28.7035 98.32 28.7035C97.4206 28.7035 96.6042 28.5245 95.8708 28.1665C95.146 27.7997 94.5697 27.2977 94.1419 26.6603C93.7228 26.0141 93.5132 25.2807 93.5132 24.4599C93.5132 23.7177 93.6529 23.0585 93.9323 22.4822C94.2117 21.9059 94.6221 21.4213 95.1635 21.0284C95.7136 20.6267 96.399 20.3255 97.2198 20.1247C98.0406 19.9151 98.9923 19.8103 100.075 19.8103H102.262Z" fill="#161E2D"/>
                                        <path d="M108.47 8.32387H112.243V25.1934L111.863 28.4415H108.47V8.32387ZM121.214 21.2117V21.4868C121.214 22.5433 121.101 23.5125 120.874 24.3944C120.655 25.2763 120.315 26.0403 119.852 26.6865C119.389 27.3239 118.813 27.8216 118.123 28.1796C117.442 28.5288 116.639 28.7035 115.713 28.7035C114.849 28.7035 114.098 28.5288 113.461 28.1796C112.832 27.8303 112.304 27.337 111.876 26.6996C111.448 26.0622 111.103 25.3156 110.841 24.4599C110.579 23.6042 110.383 22.6699 110.252 21.6571V21.0546C110.383 20.0417 110.579 19.1074 110.841 18.2517C111.103 17.396 111.448 16.6495 111.876 16.0121C112.304 15.3747 112.832 14.8813 113.461 14.5321C114.089 14.1828 114.831 14.0082 115.687 14.0082C116.621 14.0082 117.433 14.1872 118.123 14.5452C118.822 14.8944 119.398 15.3921 119.852 16.0383C120.315 16.6757 120.655 17.4353 120.874 18.3172C121.101 19.1904 121.214 20.1552 121.214 21.2117ZM117.442 21.4868V21.2117C117.442 20.6355 117.399 20.0941 117.311 19.5877C117.233 19.0725 117.093 18.6228 116.892 18.2386C116.691 17.8457 116.416 17.5357 116.067 17.3087C115.726 17.0817 115.286 16.9682 114.744 16.9682C114.229 16.9682 113.792 17.0555 113.434 17.2301C113.076 17.4048 112.78 17.6492 112.544 17.9636C112.317 18.2779 112.146 18.6534 112.033 19.09C111.919 19.5178 111.85 19.9893 111.823 20.5045V22.2202C111.85 22.91 111.963 23.5213 112.164 24.0539C112.374 24.5778 112.688 24.9925 113.107 25.2981C113.535 25.595 114.089 25.7435 114.77 25.7435C115.303 25.7435 115.744 25.6387 116.093 25.4291C116.442 25.2196 116.713 24.9227 116.905 24.5385C117.106 24.1543 117.246 23.7046 117.324 23.1895C117.403 22.6656 117.442 22.098 117.442 21.4868Z" fill="#161E2D"/>
                                        <path d="M131.208 25.2457V18.9328C131.208 18.4787 131.133 18.0902 130.985 17.7671C130.837 17.4353 130.605 17.1777 130.291 16.9944C129.985 16.811 129.588 16.7193 129.099 16.7193C128.68 16.7193 128.317 16.7935 128.012 16.942C127.706 17.0817 127.47 17.2869 127.305 17.5576C127.139 17.8195 127.056 18.1295 127.056 18.4875H123.284C123.284 17.885 123.423 17.3131 123.703 16.7717C123.982 16.2304 124.388 15.7545 124.921 15.3441C125.453 14.925 126.087 14.5975 126.82 14.3618C127.562 14.126 128.392 14.0082 129.308 14.0082C130.409 14.0082 131.387 14.1915 132.242 14.5582C133.098 14.925 133.77 15.4751 134.259 16.2085C134.757 16.942 135.006 17.8588 135.006 18.959V25.0231C135.006 25.8002 135.054 26.4376 135.15 26.9353C135.246 27.4243 135.386 27.8521 135.569 28.2189V28.4415H131.758C131.574 28.0573 131.435 27.5771 131.339 27.0008C131.251 26.4158 131.208 25.8308 131.208 25.2457ZM131.705 19.8103L131.732 21.9452H129.623C129.125 21.9452 128.693 22.002 128.326 22.1155C127.959 22.229 127.658 22.3905 127.422 22.6001C127.187 22.8009 127.012 23.0366 126.899 23.3073C126.794 23.578 126.741 23.8749 126.741 24.198C126.741 24.521 126.816 24.8135 126.964 25.0755C127.112 25.3287 127.326 25.5295 127.606 25.678C127.885 25.8177 128.213 25.8875 128.588 25.8875C129.156 25.8875 129.649 25.774 130.068 25.547C130.487 25.32 130.81 25.0406 131.037 24.7088C131.273 24.377 131.395 24.0626 131.404 23.7657L132.399 25.3636C132.26 25.7216 132.068 26.0927 131.823 26.4769C131.587 26.8611 131.286 27.2235 130.919 27.564C130.553 27.8958 130.112 28.1708 129.597 28.3891C129.081 28.5987 128.47 28.7035 127.763 28.7035C126.864 28.7035 126.047 28.5245 125.314 28.1665C124.589 27.7997 124.013 27.2977 123.585 26.6603C123.166 26.0141 122.956 25.2807 122.956 24.4599C122.956 23.7177 123.096 23.0585 123.375 22.4822C123.655 21.9059 124.065 21.4213 124.607 21.0284C125.157 20.6267 125.842 20.3255 126.663 20.1247C127.484 19.9151 128.435 19.8103 129.518 19.8103H131.705Z" fill="#161E2D"/>
                                        </g>
                                    </svg>  
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="partner-item">
                                    <svg width="168" height="43" viewBox="0 0 168 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                        <path d="M19.0801 2.20508H42.3239L25.235 27.5342H1.99121L19.0801 2.20508Z" fill="#161E2D"/>
                                        <path d="M20.0984 29.8818L13.4795 39.6924H37.8259L54.9147 14.3633H36.9456L26.4756 29.8818H20.0984Z" fill="#161E2D"/>
                                        <path d="M75.2788 26.9907L74.749 30.0141H65.5366L66.0663 26.9907H75.2788ZM70.0459 11.2016L66.777 30.0141H62.9912L66.2472 11.2016H70.0459Z" fill="#161E2D"/>
                                        <path d="M91.0291 18.8636L90.4993 21.887H80.9509L81.4807 18.8636H91.0291ZM83.9485 11.2016L80.6796 30.0141H76.8939L80.1499 11.2016H83.9485ZM95.0345 11.2016L91.7655 30.0141H88.0056L91.2616 11.2016H95.0345Z" fill="#161E2D"/>
                                        <path d="M95.3058 28.2828C95.2972 27.697 95.491 27.2146 95.8872 26.8356C96.2921 26.4566 96.7831 26.2671 97.3602 26.2671C97.9115 26.2585 98.3852 26.4308 98.7815 26.784C99.1863 27.1285 99.3931 27.585 99.4017 28.1535C99.4103 28.7393 99.2122 29.2217 98.8073 29.6007C98.4111 29.9797 97.9244 30.1692 97.3473 30.1692C96.796 30.1778 96.3179 30.0098 95.9131 29.6653C95.5168 29.3121 95.3144 28.8513 95.3058 28.2828Z" fill="#161E2D"/>
                                        <path d="M113.924 11.2016L110.668 30.0141H106.883L110.152 11.2016H113.924ZM119.532 11.2016L119.002 14.238H104.105L104.635 11.2016H119.532Z" fill="#161E2D"/>
                                        <path d="M123.525 30.2725C122.568 30.2553 121.707 30.0744 120.94 29.7299C120.174 29.3767 119.532 28.8943 119.015 28.2828C118.507 27.6712 118.132 26.9605 117.891 26.1508C117.65 25.3411 117.564 24.4712 117.633 23.5409L117.684 23.0111C117.788 22.0378 118.025 21.1118 118.395 20.2332C118.765 19.3546 119.261 18.5793 119.881 17.9075C120.501 17.227 121.233 16.6972 122.077 16.3182C122.93 15.9306 123.878 15.7497 124.92 15.7755C125.893 15.7928 126.725 15.9909 127.414 16.3699C128.103 16.7489 128.658 17.2571 129.08 17.8945C129.503 18.532 129.791 19.2598 129.946 20.0781C130.101 20.8878 130.131 21.7363 130.037 22.6235L129.83 24.174H119.028L119.429 21.6932L126.561 21.7061L126.626 21.3831C126.694 20.9094 126.673 20.4701 126.561 20.0652C126.449 19.6517 126.238 19.3201 125.928 19.0703C125.618 18.8205 125.204 18.687 124.687 18.6698C124.093 18.6525 123.593 18.7774 123.189 19.0445C122.784 19.3115 122.452 19.6647 122.194 20.104C121.935 20.5433 121.737 21.0213 121.599 21.5382C121.462 22.0464 121.362 22.5374 121.302 23.0111L121.251 23.5279C121.207 23.9845 121.22 24.441 121.289 24.8975C121.358 25.3455 121.492 25.7503 121.69 26.1121C121.897 26.4739 122.177 26.7667 122.53 26.9907C122.891 27.2146 123.344 27.3352 123.886 27.3525C124.575 27.3697 125.209 27.2362 125.786 26.9519C126.371 26.6591 126.897 26.2714 127.362 25.7891L128.99 27.753C128.602 28.3387 128.107 28.8211 127.504 29.2001C126.91 29.5705 126.268 29.8418 125.579 30.0141C124.89 30.195 124.205 30.2812 123.525 30.2725Z" fill="#161E2D"/>
                                        <path d="M136.962 27.3783C137.419 27.3869 137.823 27.3008 138.177 27.1199C138.538 26.939 138.836 26.6849 139.068 26.3576C139.301 26.0302 139.456 25.6512 139.533 25.2206L142.957 25.2076C142.88 26.2499 142.544 27.1543 141.949 27.921C141.364 28.6876 140.619 29.2776 139.714 29.6911C138.818 30.1046 137.867 30.2984 136.859 30.2725C135.851 30.2553 134.985 30.0529 134.262 29.6653C133.547 29.2776 132.97 28.7608 132.53 28.1148C132.091 27.4601 131.781 26.715 131.6 25.8795C131.428 25.044 131.385 24.1654 131.471 23.2437L131.51 22.8561C131.613 21.8913 131.845 20.9783 132.207 20.1169C132.569 19.2469 133.051 18.4846 133.654 17.8299C134.266 17.1667 134.985 16.6541 135.812 16.2924C136.639 15.922 137.574 15.7497 138.616 15.7755C139.693 15.7928 140.614 16.0383 141.381 16.512C142.148 16.9772 142.729 17.6146 143.125 18.4243C143.53 19.234 143.724 20.1643 143.707 21.2151L140.296 21.2022C140.304 20.7801 140.248 20.3796 140.128 20.0006C140.007 19.613 139.8 19.3029 139.507 19.0703C139.223 18.8291 138.836 18.6956 138.345 18.6698C137.767 18.6525 137.285 18.7731 136.897 19.0316C136.51 19.2814 136.195 19.6216 135.954 20.0523C135.713 20.4744 135.528 20.9352 135.399 21.4348C135.269 21.9258 135.179 22.4038 135.127 22.869L135.101 23.2437C135.058 23.6313 135.033 24.062 135.024 24.5358C135.015 25.0009 135.063 25.4488 135.166 25.8795C135.269 26.3016 135.459 26.6547 135.735 26.939C136.019 27.2146 136.428 27.3611 136.962 27.3783Z" fill="#161E2D"/>
                                        <path d="M151.214 10.168L147.764 30.0141H144.133L147.583 10.168H151.214ZM148.578 22.5331L147.635 22.546C147.729 21.7535 147.914 20.9524 148.19 20.1427C148.474 19.333 148.858 18.5966 149.34 17.9333C149.822 17.2614 150.412 16.7274 151.11 16.3311C151.817 15.9263 152.635 15.7368 153.565 15.7626C154.349 15.7798 154.999 15.9392 155.516 16.2407C156.042 16.5336 156.451 16.9341 156.744 17.4423C157.036 17.9419 157.23 18.5147 157.325 19.1608C157.42 19.7982 157.428 20.4701 157.351 21.1764L155.878 30.0141H152.221L153.72 21.1376C153.772 20.6811 153.759 20.2719 153.681 19.9102C153.612 19.5398 153.445 19.2469 153.177 19.0316C152.919 18.8076 152.536 18.6913 152.028 18.6827C151.468 18.6655 150.985 18.7645 150.58 18.9799C150.184 19.1952 149.848 19.4924 149.573 19.8714C149.297 20.2418 149.082 20.6596 148.927 21.1247C148.772 21.5812 148.655 22.0507 148.578 22.5331Z" fill="#161E2D"/>
                                        </g>
                                    </svg>  
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="partner-item">
                                    <svg width="161" height="39" viewBox="0 0 161 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                        <path d="M36.379 13.4941C36.3791 11.2763 35.7094 9.11018 34.4576 7.27948C33.2058 5.44877 31.4302 4.03881 29.3635 3.2343C27.2969 2.42977 25.0353 2.2682 22.8753 2.77073C20.7151 3.27326 18.7572 4.41648 17.2578 6.05062H3.35156V35.4009H32.713V21.684C33.8654 20.6533 34.7876 19.3912 35.4192 17.9799C36.0509 16.5687 36.378 15.0402 36.379 13.4941ZM30.7295 13.4941C30.7318 14.5567 30.4187 15.5963 29.8299 16.481C29.241 17.3656 28.403 18.0558 27.4218 18.464C26.4405 18.8723 25.3604 18.9802 24.3177 18.7742C23.2752 18.5683 22.3171 18.0576 21.5649 17.3069C20.8126 16.5562 20.3001 15.5993 20.0919 14.5571C19.8838 13.515 19.9895 12.4345 20.3957 11.4525C20.8018 10.4704 21.4902 9.63092 22.3736 9.04027C23.2571 8.44962 24.296 8.13435 25.3587 8.13434C26.7812 8.13434 28.1456 8.69867 29.1525 9.70348C30.1595 10.7083 30.7267 12.0716 30.7295 13.4941ZM27.0635 29.7515H9.00099V11.7001H14.5055C14.3992 12.2923 14.3433 12.8924 14.3384 13.4941C14.3414 16.4159 15.5034 19.2172 17.5695 21.2834C19.6355 23.3493 22.4368 24.5114 25.3587 24.5143C25.93 24.5113 26.5 24.4629 27.0635 24.3695V29.7515Z" fill="#161E2D"/>
                                        <path d="M47.2278 30.0861V13.3719H42.0664V10.1627H55.9727V13.3719H50.8916V30.0861H47.2278Z" fill="#161E2D"/>
                                        <path d="M58.5922 35.9963C58.2 35.9963 57.8167 35.9607 57.4423 35.8893C57.0679 35.8359 56.7292 35.7378 56.4261 35.5952V32.6535C56.6578 32.7069 56.9342 32.7604 57.2551 32.8139C57.5938 32.8674 57.9058 32.8941 58.1911 32.8941C58.9934 32.8941 59.5728 32.7069 59.9294 32.3325C60.3038 31.9581 60.6336 31.4679 60.9189 30.8617L61.8816 28.6153L61.8281 31.557L55.4901 15.538H59.2608L63.7001 27.3584H62.363L66.7756 15.538H70.573L64.235 31.557C63.8606 32.5019 63.406 33.3042 62.8711 33.9639C62.3362 34.6235 61.7122 35.1227 60.9991 35.4615C60.3038 35.818 59.5015 35.9963 58.5922 35.9963Z" fill="#161E2D"/>
                                        <path d="M76.3871 30.4071C75.3709 30.4071 74.4884 30.2377 73.7396 29.8989C72.9908 29.5602 72.4113 29.0788 72.0013 28.4548C71.5912 27.813 71.3862 27.0731 71.3862 26.2352C71.3862 25.4329 71.5645 24.7197 71.9211 24.0957C72.2776 23.4539 72.8303 22.9191 73.5791 22.4912C74.3279 22.0633 75.2728 21.7602 76.4139 21.5819L81.1741 20.8064V23.4807L77.0824 24.176C76.3871 24.3008 75.8701 24.5236 75.5313 24.8445C75.1926 25.1655 75.0232 25.5844 75.0232 26.1015C75.0232 26.6007 75.2104 27.0018 75.5848 27.3049C75.9771 27.5901 76.4584 27.7328 77.0289 27.7328C77.7599 27.7328 78.4017 27.5812 78.9544 27.2781C79.5249 26.9572 79.9617 26.5204 80.2648 25.9677C80.5857 25.4151 80.7462 24.8089 80.7462 24.1492V20.4052C80.7462 19.7812 80.4966 19.2642 79.9974 18.8541C79.516 18.4263 78.8742 18.2123 78.0719 18.2123C77.3231 18.2123 76.6545 18.4173 76.0662 18.8274C75.4957 19.2196 75.0767 19.7456 74.8093 20.4052L71.9478 19.0146C72.2331 18.248 72.6788 17.5883 73.2849 17.0356C73.9089 16.4651 74.6399 16.0194 75.4779 15.6985C76.3158 15.3776 77.2251 15.2171 78.2056 15.2171C79.4001 15.2171 80.452 15.44 81.3613 15.8857C82.2705 16.3136 82.9748 16.9197 83.474 17.7042C83.991 18.4708 84.2495 19.3712 84.2495 20.4052V30.0861H80.9334V27.5991L81.6822 27.5456C81.3078 28.1696 80.8621 28.6955 80.3451 29.1234C79.828 29.5335 79.2397 29.8544 78.58 30.0861C77.9204 30.3001 77.1894 30.4071 76.3871 30.4071Z" fill="#161E2D"/>
                                        <path d="M91.9001 30.4071C90.8838 30.4071 90.0013 30.2377 89.2525 29.8989C88.5037 29.5602 87.9243 29.0788 87.5142 28.4548C87.1042 27.813 86.8991 27.0731 86.8991 26.2352C86.8991 25.4329 87.0774 24.7197 87.434 24.0957C87.7906 23.4539 88.3433 22.9191 89.0921 22.4912C89.8409 22.0633 90.7858 21.7602 91.9268 21.5819L96.687 20.8064V23.4807L92.5954 24.176C91.9001 24.3008 91.383 24.5236 91.0443 24.8445C90.7055 25.1655 90.5362 25.5844 90.5362 26.1015C90.5362 26.6007 90.7234 27.0018 91.0978 27.3049C91.49 27.5901 91.9714 27.7328 92.5419 27.7328C93.2729 27.7328 93.9147 27.5812 94.4674 27.2781C95.0379 26.9572 95.4747 26.5204 95.7778 25.9677C96.0987 25.4151 96.2591 24.8089 96.2591 24.1492V20.4052C96.2591 19.7812 96.0095 19.2642 95.5103 18.8541C95.029 18.4263 94.3871 18.2123 93.5849 18.2123C92.8361 18.2123 92.1675 18.4173 91.5791 18.8274C91.0086 19.2196 90.5897 19.7456 90.3222 20.4052L87.4607 19.0146C87.746 18.248 88.1917 17.5883 88.7979 17.0356C89.4219 16.4651 90.1529 16.0194 90.9908 15.6985C91.8287 15.3776 92.738 15.2171 93.7186 15.2171C94.9131 15.2171 95.965 15.44 96.8742 15.8857C97.7835 16.3136 98.4877 16.9197 98.9869 17.7042C99.5039 18.4708 99.7625 19.3712 99.7625 20.4052V30.0861H96.4463V27.5991L97.1951 27.5456C96.8207 28.1696 96.375 28.6955 95.858 29.1234C95.341 29.5335 94.7526 29.8544 94.093 30.0861C93.4333 30.3001 92.7023 30.4071 91.9001 30.4071Z" fill="#161E2D"/>
                                        <path d="M103 30.0861V9.8418H106.504V30.0861H103Z" fill="#161E2D"/>
                                        <path d="M109.738 35.4347V15.538H113.028V18.4263L112.707 17.7042C113.206 16.9197 113.884 16.3136 114.739 15.8857C115.595 15.44 116.585 15.2171 117.708 15.2171C119.081 15.2171 120.32 15.5559 121.425 16.2333C122.53 16.9108 123.404 17.8201 124.046 18.9611C124.705 20.1021 125.035 21.3858 125.035 22.8121C125.035 24.2205 124.714 25.5042 124.073 26.6631C123.431 27.8219 122.557 28.7401 121.452 29.4176C120.346 30.0772 119.089 30.4071 117.681 30.4071C116.629 30.4071 115.657 30.202 114.766 29.792C113.892 29.3641 113.197 28.7579 112.68 27.9735L113.242 27.2781V35.4347H109.738ZM117.28 27.1979C118.082 27.1979 118.795 27.0107 119.419 26.6363C120.043 26.2619 120.525 25.7449 120.863 25.0852C121.22 24.4256 121.398 23.6679 121.398 22.8121C121.398 21.9563 121.22 21.2075 120.863 20.5657C120.525 19.906 120.043 19.389 119.419 19.0146C118.795 18.6224 118.082 18.4263 117.28 18.4263C116.513 18.4263 115.818 18.6135 115.194 18.9879C114.588 19.3623 114.106 19.8882 113.75 20.5657C113.411 21.2253 113.242 21.9741 113.242 22.8121C113.242 23.6679 113.411 24.4256 113.75 25.0852C114.106 25.7449 114.588 26.2619 115.194 26.6363C115.818 27.0107 116.513 27.1979 117.28 27.1979Z" fill="#161E2D"/>
                                        <path d="M127.706 30.0861V9.8418H131.21V18.3995L130.728 17.8914C131.067 17.0178 131.62 16.3581 132.386 15.9124C133.171 15.4489 134.08 15.2171 135.114 15.2171C136.184 15.2171 137.129 15.4489 137.949 15.9124C138.787 16.376 139.437 17.0267 139.901 17.8647C140.365 18.6848 140.596 19.6386 140.596 20.7261V30.0861H137.093V21.5552C137.093 20.9133 136.968 20.3607 136.719 19.8971C136.469 19.4336 136.121 19.077 135.676 18.8274C135.248 18.56 134.74 18.4263 134.151 18.4263C133.581 18.4263 133.073 18.56 132.627 18.8274C132.181 19.077 131.834 19.4336 131.584 19.8971C131.334 20.3607 131.21 20.9133 131.21 21.5552V30.0861H127.706Z" fill="#161E2D"/>
                                        <path d="M147.971 30.4071C146.955 30.4071 146.073 30.2377 145.324 29.8989C144.575 29.5602 143.996 29.0788 143.585 28.4548C143.175 27.813 142.97 27.0731 142.97 26.2352C142.97 25.4329 143.149 24.7197 143.505 24.0957C143.862 23.4539 144.414 22.9191 145.163 22.4912C145.912 22.0633 146.857 21.7602 147.998 21.5819L152.758 20.8064V23.4807L148.667 24.176C147.971 24.3008 147.454 24.5236 147.116 24.8445C146.777 25.1655 146.607 25.5844 146.607 26.1015C146.607 26.6007 146.795 27.0018 147.169 27.3049C147.561 27.5901 148.043 27.7328 148.613 27.7328C149.344 27.7328 149.986 27.5812 150.539 27.2781C151.109 26.9572 151.546 26.5204 151.849 25.9677C152.17 25.4151 152.33 24.8089 152.33 24.1492V20.4052C152.33 19.7812 152.081 19.2642 151.582 18.8541C151.1 18.4263 150.458 18.2123 149.656 18.2123C148.907 18.2123 148.239 18.4173 147.65 18.8274C147.08 19.2196 146.661 19.7456 146.393 20.4052L143.532 19.0146C143.817 18.248 144.263 17.5883 144.869 17.0356C145.493 16.4651 146.224 16.0194 147.062 15.6985C147.9 15.3776 148.809 15.2171 149.79 15.2171C150.984 15.2171 152.036 15.44 152.945 15.8857C153.855 16.3136 154.559 16.9197 155.058 17.7042C155.575 18.4708 155.834 19.3712 155.834 20.4052V30.0861H152.518V27.5991L153.266 27.5456C152.892 28.1696 152.446 28.6955 151.929 29.1234C151.412 29.5335 150.824 29.8544 150.164 30.0861C149.505 30.3001 148.774 30.4071 147.971 30.4071Z" fill="#161E2D"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            -->
            <!-- End partner -->
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
                                <p class="text-white">email@gmail.com</p>
                            </li>

                          </ul>
                          
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-cl-2">
                            <div class="fw-7 text-white">Page</div>
                            <ul class="mt-10 navigation-menu-footer">
                                <li> <a href="{{route('get.marketplace')}}" class="caption-1 text-variant-2">Marketplace</a> </li>

                                <li> <a href="{{route('get.about_us')}}" class="caption-1 text-variant-2">A Propos</a> </li>

                                <li> <a href="{{route('get.faq')}}" class="caption-1 text-variant-2">FAQ</a> </li>


                            </ul>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-6">
                        <div class="footer-cl-3">
                            <div class="fw-7 text-white">Top Thematique</div>
                            <ul class="mt-10 navigation-menu-footer">
                                @foreach($thematiquesStatistiques as $thematiquesStatistique)
                                <li> <a href="{{route('get.marketplace')}}" class="caption-1 text-variant-2">{{$thematiquesStatistique->theme}}</a> </li>
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
                          <li><span class="text-white" data-bs-toggle="modal" data-bs-target="#termsModal2" style="cursor: pointer;font-size:13px">Conditions d'Utilisation</span></li>
                          
                              <!--
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
<!-- popup login -->
<div class="modal fade" id="modalLogin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="flat-account bg-surface">
                <h3 class="title text-center">Se connecter</h3>
                <div id="success-message" class="text-success mt-1" style="display: none;"></div>
                <div id="err-message" class="alert alert-danger mt-1" style="display: none;"></div>
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
<!--
                    <fieldset class="d-flex align-items-center gap-6">
                    <label for="cb1" class="caption-1 text-variant-1">J'ai lu et j'accepte <span class="fw-5 text-black">Contact du service.</span> and <span class="fw-5 text-black">Contact du service. </span>Politique de Confidentialité  <input type="checkbox" class="style-2" id="cb1" name="termsAccepted"> </label>
                    </fieldset>
    -->
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
                            <label for="cb1" class="caption-1 text-variant-1"> J'accepte les  <span class="fw-5 text-black" data-bs-toggle="modal" data-bs-target="#termsModal" style="cursor: pointer;"> Conditions d'Utilisation  </span>.
                            </label>
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

    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Conditions d'Utilisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id='btnClose'></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
               <!-- Conditions Générales de Vente -->
               <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>
                <p class='h6' ><strong>1. Objet du Contrat :</strong></p>
                <div class='mx-3 mb-2'>
                <span >Les présentes conditions générales ont pour objet de définir les modalités selon lesquelles Lead & Boost fournit des leads qualifiés et vérifiés à ses clients dans le domaine du marketing digital.</span>
                </div>
                <p class='h6'><strong>2. Engagements de Lead & Boost :</strong></p>
                <div class='mx-3 mb-2'>
                <ul>
                    <li>-> Conformité des leads aux critères définis sur la marketplace.</li>
                    <li>-> Livraison des leads dans les délais indiqués.</li>
                    <li>-> Qualité garantie : remplacement des leads erronés au-delà d’un taux d’erreur de 10%.</li>
                </ul>
                </div>
               <p class='h6'><strong>3. MODALITÉS FINANCIÈRES :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Les prix des leads sont fixés par Lead & Boost et indiqués sur la marketplace. Le paiement
                        se fait en ligne via la plateforme sécurisée PayPal ou Stripe avant le démarrage de la
                        mission. Aucun remboursement ne sera accordé, sauf dans le cas où les leads ne sont pas
                        livrés dans les délais, auquel cas un remboursement au prorata des leads non livrés pourra
                        être effectué.
                        Les prix sont indiqués hors taxes (HT).</span>
                </div>

                <p class='h6'><strong>4. LEVIERS D’ACQUISITION DES LEADS :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Lead & Boost génère des leads qualifiés via plusieurs leviers d'acquisition, incluant, mais
                sans s'y limiter</span>
                <ul class='mx-3'>
                    <li>-> Campagnes d'e-mailing.</li>
                    <li>-> Réseaux sociaux (Facebook, LinkedIn, etc.)</li>
                    <li>-> Moteurs de recherche (Google)</li>
                    <li>-> Data Opt-in</li>
                    <li>-> Appels téléphoniques</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>5. CRITÈRES DE SÉLECTION DES LEADS :</strong></p>
                <span>Les leads sont qualifiés selon les critères suivants, qui peuvent être spécifiques à chaque
                commande:</span>

                <ul class='mx-3'>
                    <li>-> Secteur d'activité du prospect.</li>
                    <li>-> Taille de l'entreprise</li>
                    <li>-> Localisation géographique</li>
                    <li>-> Autres critères spécifiques définis lors de l'achat sur la marketplace</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>6. MODALITÉS DE PAIEMENT :</strong></p>
                <span>Les paiements doivent être effectués via la plateforme sécurisée avant que la mission ne soit
                lancée.</span><br>
                <span>Le paiement peut être effectué par :</span>

                <ul>
                    <li>-> Carte bancaire via PayPal ou Stripe</li>
                    <li>-> Virement bancaire sur demande (un bon de commande signé sera requis pour valider la
                    transaction)</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>7. CONFIDENTIALITÉ:</strong></p>
                    <span>Lead & Boost et le Client s'engagent à respecter la confidentialité des informations
                            échangées dans le cadre de la mission. Ces informations ne seront utilisées que pour
                            l'accomplissement des services spécifiés et ne seront pas partagées sans l'accord préalable
                            des parties concernées. </span>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>8. RÉGLEMENT DES DIFFÉRENDS ET LOI APPLICABLE:</strong></p>
                    <span>En cas de litige relatif à l’exécution ou à l’interprétation des présentes conditions, celui-ci
                            sera soumis à la compétence exclusive des tribunaux de Sharjah, Émirats Arabes Unis. Le
                            contrat est régi par les lois des Émirats Arabes Unis.</span>
                </div>
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. DÉFINITIONS :</strong></p>
                     <span>Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation de
                            l'application Lead & Boost. En accédant et en utilisant cette application, vous acceptez ces
                            conditions sans réserve.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. DACCÈS À L'APPLICATION :</strong></p>
                     <span>L'accès à l'application est réservé aux utilisateurs disposant d'un compte valide et ayant
                            payé pour les services. Lead & Boost se réserve le droit de suspendre l'accès à l'application
                            pour toute violation des présentes CGU.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. COMPORTEMENT DE L'UTILISATEUR :</strong></p>
                     <span>L'utilisateur s'engage à utiliser l'application de manière conforme aux lois et règlements en
                            vigueur. Toute activité illégale ou non conforme, y compris le fait de fournir des
                            informations fausses ou trompeuses, peut entraîner la suspension ou la suppression du
                            compte de l'utilisateur. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. PROPRIÉTÉ INTELLECTUELLE:</strong></p>
                     <span>Les éléments contenus dans l'application, y compris mais non limités aux textes,
                            graphiques, logos, images, etc., sont la propriété exclusive de Lead & Boost ou de ses
                            partenaires. Toute reproduction ou exploitation sans autorisation expresse est interdite. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. RESPONSABILITÉ:</strong></p>
                     <span>Lead & Boost ne saurait être tenu responsable des dommages directs ou indirects causés
                            par l'utilisation de l'application. Le client est responsable de l'utilisation des leads achetés
                            sur la plateforme.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>6. MODIFICATIONS:</strong></p>
                     <span>Lead & Boost se réserve le droit de modifier ou de mettre à jour ces CGU à tout moment.
                            L'utilisateur sera informé de toute modification et devra accepter les nouvelles CGU pour
                            continuer à utiliser l'application.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>7. LOI APPLICABLE ET JURIDICTION:</strong></p>
                     <span>Les présentes CGU sont régies par les lois des Émirats Arabes Unis. En cas de litige, les
                     tribunaux compétents seront ceux de Sharjah, Émirats Arabes Unis.</span>
                </div>

                <h6 style="color:#608BC1" class='text-center mb-2'>MENTIONS LÉGALES</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. Informations sur l'éditeur de l'application :</strong></p>
                     <span>L'application Lead & Boost est éditée par : </span>
                     <ul>
                    <li>-> Nom de l'entreprise : AK Business Group FZE</li>
                    <li>-> Statut juridique : Free Zone Establishment (FZE)</li>
                    <li>-> Formation Number : 4311426</li>
                    <li>-> Siège social : Business Centre, Sharjah Publishing City Free Zone, Sharjah, Émirats Arabes
                    Unis
                </li>
                    <li>-> Numéro de licence : 4311426.01</li>
                    <li>-> Date de création de la licence : 08/03/2024</li>
                    <li>-> Date d'expiration : 07/03/2025</li>
                    <li>-> Directeur de publication : Kader Ajouaou</li>
                </ul>

                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. Propriété intellectuelle :</strong></p>
                     <span>L'ensemble des éléments présents sur l'application Lead & Boost, incluant, de façon non
                            limitative, les textes, images, graphismes, logo, icônes, sons, vidéos, logiciels, et bases de

                            données, sont la propriété exclusive de AK Business Group FZE ou font l'objet d'une
                            autorisation d'utilisation. Toute reproduction, distribution, modification, adaptation,
                            retransmission ou publication, même partielle, de ces éléments est strictement interdite
                            sans l'accord écrit préalable de AK Business Group FZE. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. Protection des données personnelles :</strong></p>
                     <span>Conformément au Règlement Général sur la Protection des Données (RGPD), Lead & Boost
                            s'engage à respecter la confidentialité des données personnelles des utilisateurs. Les
                            informations collectées lors de l'utilisation de l'application sont traitées conformément à
                            notre Politique de Confidentialité, disponible sur l'application. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. Utilisation des cookies :</strong></p>
                     <span>L'application Lead & Boost utilise des cookies pour améliorer l'expérience utilisateur et
                            fournir des services personnalisés. En utilisant l'application, vous acceptez l'utilisation de
                            cookies conformément à notre Politique relative aux cookies. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. Loi applicable et juridique compétente :</strong></p>
                     <span>Les Présentes mentions légales sont régies par les  lois des Émirats arabes unis. en cas de litige relatif a l'application Lead & Boost, et défault de résolution amiable,les tribunaux compétents seront ceux de Sharjah. </span>
                </div>
                <!-- Include additional sections as per the original content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='fermertermsmodal'>Fermer</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="termsModal2" tabindex="-1" aria-labelledby="termsModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title test-center" id="termsModalLabel2">Conditions Générales et Mentions Légales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnClose"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <!-- Conditions Générales de Vente -->
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>
                <p class='h6' ><strong>1. Objet du Contrat :</strong></p>
                <div class='mx-3 mb-2'>
                <span >Les présentes conditions générales ont pour objet de définir les modalités selon lesquelles Lead & Boost fournit des leads qualifiés et vérifiés à ses clients dans le domaine du marketing digital.</span>
                </div>
                <p class='h6'><strong>2. Engagements de Lead & Boost :</strong></p>
                <div class='mx-3 mb-2'>
                <ul>
                    <li>-> Conformité des leads aux critères définis sur la marketplace.</li>
                    <li>-> Livraison des leads dans les délais indiqués.</li>
                    <li>-> Qualité garantie : remplacement des leads erronés au-delà d’un taux d’erreur de 10%.</li>
                </ul>
                </div>
               <p class='h6'><strong>3. MODALITÉS FINANCIÈRES :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Les prix des leads sont fixés par Lead & Boost et indiqués sur la marketplace. Le paiement
                        se fait en ligne via la plateforme sécurisée PayPal ou Stripe avant le démarrage de la
                        mission. Aucun remboursement ne sera accordé, sauf dans le cas où les leads ne sont pas
                        livrés dans les délais, auquel cas un remboursement au prorata des leads non livrés pourra
                        être effectué.
                        Les prix sont indiqués hors taxes (HT).</span>
                </div>

                <p class='h6'><strong>4. LEVIERS D’ACQUISITION DES LEADS :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Lead & Boost génère des leads qualifiés via plusieurs leviers d'acquisition, incluant, mais
                sans s'y limiter</span>
                <ul class='mx-3'>
                    <li>-> Campagnes d'e-mailing.</li>
                    <li>-> Réseaux sociaux (Facebook, LinkedIn, etc.)</li>
                    <li>-> Moteurs de recherche (Google)</li>
                    <li>-> Data Opt-in</li>
                    <li>-> Appels téléphoniques</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>5. CRITÈRES DE SÉLECTION DES LEADS :</strong></p>
                <span>Les leads sont qualifiés selon les critères suivants, qui peuvent être spécifiques à chaque
                commande:</span>

                <ul class='mx-3'>
                    <li>-> Secteur d'activité du prospect.</li>
                    <li>-> Taille de l'entreprise</li>
                    <li>-> Localisation géographique</li>
                    <li>-> Autres critères spécifiques définis lors de l'achat sur la marketplace</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>6. MODALITÉS DE PAIEMENT :</strong></p>
                <span>Les paiements doivent être effectués via la plateforme sécurisée avant que la mission ne soit
                lancée.</span><br>
                <span>Le paiement peut être effectué par :</span>

                <ul>
                    <li>-> Carte bancaire via PayPal ou Stripe</li>
                    <li>-> Virement bancaire sur demande (un bon de commande signé sera requis pour valider la
                    transaction)</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>7. CONFIDENTIALITÉ:</strong></p>
                    <span>Lead & Boost et le Client s'engagent à respecter la confidentialité des informations
                            échangées dans le cadre de la mission. Ces informations ne seront utilisées que pour
                            l'accomplissement des services spécifiés et ne seront pas partagées sans l'accord préalable
                            des parties concernées. </span>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>8. RÉGLEMENT DES DIFFÉRENDS ET LOI APPLICABLE:</strong></p>
                    <span>En cas de litige relatif à l’exécution ou à l’interprétation des présentes conditions, celui-ci
                            sera soumis à la compétence exclusive des tribunaux de Sharjah, Émirats Arabes Unis. Le
                            contrat est régi par les lois des Émirats Arabes Unis.</span>
                </div>
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. DÉFINITIONS :</strong></p>
                     <span>Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation de
                            l'application Lead & Boost. En accédant et en utilisant cette application, vous acceptez ces
                            conditions sans réserve.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. DACCÈS À L'APPLICATION :</strong></p>
                     <span>L'accès à l'application est réservé aux utilisateurs disposant d'un compte valide et ayant
                            payé pour les services. Lead & Boost se réserve le droit de suspendre l'accès à l'application
                            pour toute violation des présentes CGU.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. COMPORTEMENT DE L'UTILISATEUR :</strong></p>
                     <span>L'utilisateur s'engage à utiliser l'application de manière conforme aux lois et règlements en
                            vigueur. Toute activité illégale ou non conforme, y compris le fait de fournir des
                            informations fausses ou trompeuses, peut entraîner la suspension ou la suppression du
                            compte de l'utilisateur. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. PROPRIÉTÉ INTELLECTUELLE:</strong></p>
                     <span>Les éléments contenus dans l'application, y compris mais non limités aux textes,
                            graphiques, logos, images, etc., sont la propriété exclusive de Lead & Boost ou de ses
                            partenaires. Toute reproduction ou exploitation sans autorisation expresse est interdite. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. RESPONSABILITÉ:</strong></p>
                     <span>Lead & Boost ne saurait être tenu responsable des dommages directs ou indirects causés
                            par l'utilisation de l'application. Le client est responsable de l'utilisation des leads achetés
                            sur la plateforme.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>6. MODIFICATIONS:</strong></p>
                     <span>Lead & Boost se réserve le droit de modifier ou de mettre à jour ces CGU à tout moment.
                            L'utilisateur sera informé de toute modification et devra accepter les nouvelles CGU pour
                            continuer à utiliser l'application.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>7. LOI APPLICABLE ET JURIDICTION:</strong></p>
                     <span>Les présentes CGU sont régies par les lois des Émirats Arabes Unis. En cas de litige, les
                     tribunaux compétents seront ceux de Sharjah, Émirats Arabes Unis.</span>
                </div>

                <h6 style="color:#608BC1" class='text-center mb-2'>MENTIONS LÉGALES</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. Informations sur l'éditeur de l'application :</strong></p>
                     <span>L'application Lead & Boost est éditée par : </span>
                     <ul>
                    <li>-> Nom de l'entreprise : AK Business Group FZE</li>
                    <li>-> Statut juridique : Free Zone Establishment (FZE)</li>
                    <li>-> Formation Number : 4311426</li>
                    <li>-> Siège social : Business Centre, Sharjah Publishing City Free Zone, Sharjah, Émirats Arabes
                    Unis
                </li>
                    <li>-> Numéro de licence : 4311426.01</li>
                    <li>-> Date de création de la licence : 08/03/2024</li>
                    <li>-> Date d'expiration : 07/03/2025</li>
                    <li>-> Directeur de publication : Kader Ajouaou</li>
                </ul>

                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. Propriété intellectuelle :</strong></p>
                     <span>L'ensemble des éléments présents sur l'application Lead & Boost, incluant, de façon non
                            limitative, les textes, images, graphismes, logo, icônes, sons, vidéos, logiciels, et bases de

                            données, sont la propriété exclusive de AK Business Group FZE ou font l'objet d'une
                            autorisation d'utilisation. Toute reproduction, distribution, modification, adaptation,
                            retransmission ou publication, même partielle, de ces éléments est strictement interdite
                            sans l'accord écrit préalable de AK Business Group FZE. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. Protection des données personnelles :</strong></p>
                     <span>Conformément au Règlement Général sur la Protection des Données (RGPD), Lead & Boost
                            s'engage à respecter la confidentialité des données personnelles des utilisateurs. Les
                            informations collectées lors de l'utilisation de l'application sont traitées conformément à
                            notre Politique de Confidentialité, disponible sur l'application. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. Utilisation des cookies :</strong></p>
                     <span>L'application Lead & Boost utilise des cookies pour améliorer l'expérience utilisateur et
                            fournir des services personnalisés. En utilisant l'application, vous acceptez l'utilisation de
                            cookies conformément à notre Politique relative aux cookies. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. Loi applicable et juridique compétente :</strong></p>
                     <span>Les Présentes mentions légales sont régies par les  lois des Émirats arabes unis. en cas de litige relatif a l'application Lead & Boost, et défault de résolution amiable,les tribunaux compétents seront ceux de Sharjah. </span>
                </div>
                <!-- Include additional sections as per the original content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="fermertermsmodal">Fermer</button>
            </div>
        </div>
    </div>
</div>



@if(!session('client_hom'))

<div class="modal fade" id="termsModal3" tabindex="-1" aria-labelledby="termsModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg custom-modal-position" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title test-center" id="termsModalLabel3">Conditions Générales et Mentions Légales</h5>
           
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;height:200px;">
                <!-- Conditions Générales de Vente -->
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>
                <p class='h6' ><strong>1. Objet du Contrat :</strong></p>
                <div class='mx-3 mb-2'>
                <span >Les présentes conditions générales ont pour objet de définir les modalités selon lesquelles Lead & Boost fournit des leads qualifiés et vérifiés à ses clients dans le domaine du marketing digital.</span>
                </div>
                <p class='h6'><strong>2. Engagements de Lead & Boost :</strong></p>
                <div class='mx-3 mb-2'>
                <ul>
                    <li>-> Conformité des leads aux critères définis sur la marketplace.</li>
                    <li>-> Livraison des leads dans les délais indiqués.</li>
                    <li>-> Qualité garantie : remplacement des leads erronés au-delà d’un taux d’erreur de 10%.</li>
                </ul>
                </div>
               <p class='h6'><strong>3. MODALITÉS FINANCIÈRES :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Les prix des leads sont fixés par Lead & Boost et indiqués sur la marketplace. Le paiement
                        se fait en ligne via la plateforme sécurisée PayPal ou Stripe avant le démarrage de la
                        mission. Aucun remboursement ne sera accordé, sauf dans le cas où les leads ne sont pas
                        livrés dans les délais, auquel cas un remboursement au prorata des leads non livrés pourra
                        être effectué.
                        Les prix sont indiqués hors taxes (HT).</span>
                </div>

                <p class='h6'><strong>4. LEVIERS D’ACQUISITION DES LEADS :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Lead & Boost génère des leads qualifiés via plusieurs leviers d'acquisition, incluant, mais
                sans s'y limiter</span>
                <ul class='mx-3'>
                    <li>-> Campagnes d'e-mailing.</li>
                    <li>-> Réseaux sociaux (Facebook, LinkedIn, etc.)</li>
                    <li>-> Moteurs de recherche (Google)</li>
                    <li>-> Data Opt-in</li>
                    <li>-> Appels téléphoniques</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>5. CRITÈRES DE SÉLECTION DES LEADS :</strong></p>
                <span>Les leads sont qualifiés selon les critères suivants, qui peuvent être spécifiques à chaque
                commande:</span>

                <ul class='mx-3'>
                    <li>-> Secteur d'activité du prospect.</li>
                    <li>-> Taille de l'entreprise</li>
                    <li>-> Localisation géographique</li>
                    <li>-> Autres critères spécifiques définis lors de l'achat sur la marketplace</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                <p class='h6'><strong>6. MODALITÉS DE PAIEMENT :</strong></p>
                <span>Les paiements doivent être effectués via la plateforme sécurisée avant que la mission ne soit
                lancée.</span><br>
                <span>Le paiement peut être effectué par :</span>

                <ul>
                    <li>-> Carte bancaire via PayPal ou Stripe</li>
                    <li>-> Virement bancaire sur demande (un bon de commande signé sera requis pour valider la
                    transaction)</li>
                </ul>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>7. CONFIDENTIALITÉ:</strong></p>
                    <span>Lead & Boost et le Client s'engagent à respecter la confidentialité des informations
                            échangées dans le cadre de la mission. Ces informations ne seront utilisées que pour
                            l'accomplissement des services spécifiés et ne seront pas partagées sans l'accord préalable
                            des parties concernées. </span>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h6'><strong>8. RÉGLEMENT DES DIFFÉRENDS ET LOI APPLICABLE:</strong></p>
                    <span>En cas de litige relatif à l’exécution ou à l’interprétation des présentes conditions, celui-ci
                            sera soumis à la compétence exclusive des tribunaux de Sharjah, Émirats Arabes Unis. Le
                            contrat est régi par les lois des Émirats Arabes Unis.</span>
                </div>
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. DÉFINITIONS :</strong></p>
                     <span>Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation de
                            l'application Lead & Boost. En accédant et en utilisant cette application, vous acceptez ces
                            conditions sans réserve.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. DACCÈS À L'APPLICATION :</strong></p>
                     <span>L'accès à l'application est réservé aux utilisateurs disposant d'un compte valide et ayant
                            payé pour les services. Lead & Boost se réserve le droit de suspendre l'accès à l'application
                            pour toute violation des présentes CGU.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. COMPORTEMENT DE L'UTILISATEUR :</strong></p>
                     <span>L'utilisateur s'engage à utiliser l'application de manière conforme aux lois et règlements en
                            vigueur. Toute activité illégale ou non conforme, y compris le fait de fournir des
                            informations fausses ou trompeuses, peut entraîner la suspension ou la suppression du
                            compte de l'utilisateur. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. PROPRIÉTÉ INTELLECTUELLE:</strong></p>
                     <span>Les éléments contenus dans l'application, y compris mais non limités aux textes,
                            graphiques, logos, images, etc., sont la propriété exclusive de Lead & Boost ou de ses
                            partenaires. Toute reproduction ou exploitation sans autorisation expresse est interdite. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. RESPONSABILITÉ:</strong></p>
                     <span>Lead & Boost ne saurait être tenu responsable des dommages directs ou indirects causés
                            par l'utilisation de l'application. Le client est responsable de l'utilisation des leads achetés
                            sur la plateforme.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>6. MODIFICATIONS:</strong></p>
                     <span>Lead & Boost se réserve le droit de modifier ou de mettre à jour ces CGU à tout moment.
                            L'utilisateur sera informé de toute modification et devra accepter les nouvelles CGU pour
                            continuer à utiliser l'application.</span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>7. LOI APPLICABLE ET JURIDICTION:</strong></p>
                     <span>Les présentes CGU sont régies par les lois des Émirats Arabes Unis. En cas de litige, les
                     tribunaux compétents seront ceux de Sharjah, Émirats Arabes Unis.</span>
                </div>

                <h6 style="color:#608BC1" class='text-center mb-2'>MENTIONS LÉGALES</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>1. Informations sur l'éditeur de l'application :</strong></p>
                     <span>L'application Lead & Boost est éditée par : </span>
                     <ul>
                    <li>-> Nom de l'entreprise : AK Business Group FZE</li>
                    <li>-> Statut juridique : Free Zone Establishment (FZE)</li>
                    <li>-> Formation Number : 4311426</li>
                    <li>-> Siège social : Business Centre, Sharjah Publishing City Free Zone, Sharjah, Émirats Arabes
                    Unis
                </li>
                    <li>-> Numéro de licence : 4311426.01</li>
                    <li>-> Date de création de la licence : 08/03/2024</li>
                    <li>-> Date d'expiration : 07/03/2025</li>
                    <li>-> Directeur de publication : Kader Ajouaou</li>
                </ul>

                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>2. Propriété intellectuelle :</strong></p>
                     <span>L'ensemble des éléments présents sur l'application Lead & Boost, incluant, de façon non
                            limitative, les textes, images, graphismes, logo, icônes, sons, vidéos, logiciels, et bases de

                            données, sont la propriété exclusive de AK Business Group FZE ou font l'objet d'une
                            autorisation d'utilisation. Toute reproduction, distribution, modification, adaptation,
                            retransmission ou publication, même partielle, de ces éléments est strictement interdite
                            sans l'accord écrit préalable de AK Business Group FZE. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>3. Protection des données personnelles :</strong></p>
                     <span>Conformément au Règlement Général sur la Protection des Données (RGPD), Lead & Boost
                            s'engage à respecter la confidentialité des données personnelles des utilisateurs. Les
                            informations collectées lors de l'utilisation de l'application sont traitées conformément à
                            notre Politique de Confidentialité, disponible sur l'application. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>4. Utilisation des cookies :</strong></p>
                     <span>L'application Lead & Boost utilise des cookies pour améliorer l'expérience utilisateur et
                            fournir des services personnalisés. En utilisant l'application, vous acceptez l'utilisation de
                            cookies conformément à notre Politique relative aux cookies. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h6'><strong>5. Loi applicable et juridique compétente :</strong></p>
                     <span>Les Présentes mentions légales sont régies par les  lois des Émirats arabes unis. en cas de litige relatif a l'application Lead & Boost, et défault de résolution amiable,les tribunaux compétents seront ceux de Sharjah. </span>
                </div>
                <!-- Include additional sections as per the original content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="fermertermsmodal">Accept Condition</button>
            </div>
        </div>
    </div>
</div>

@endif


<script>
    const propertyDetailsUrl = '{{ route('get.detai', '') }}';
    let isAuthenticated = {{ json_encode(session('auth') ? true : false) }};

    $('#fermertermsmodal').click(function() {
            $('#modalRegister').modal('toggle');
    });

    $('#btnClose').click(function() {
            $('#modalRegister').modal('toggle');
    });

    $(document).ready(function () {
            // Show the modal on page load
            $('#termsModal3').modal({
                backdrop: 'static', // Disable closing by clicking outside
                keyboard: false     // Disable closing with the Escape key
            }).modal('show');

            // Show overlay to disable the page
            $('#page-overlay').show();

            // Enable the page only after clicking "Fermer"
            $('#modalCloseButton').click(function () {
                $('#termsModal3').modal('hide'); // Close modal
                $('#page-overlay').hide();      // Remove overlay
            });
        });

</script>

    <script src="{{ asset('assetsMarketplace/js/my-js/home.js') }}"></script>
    <script src="{{ asset('assetsMarketplace/js/my-js/auth.js') }}"></script>
    <script src="{{ asset('assetsMarketplace/js/my-js/news.js') }}"></script>
    
</body>

@endsection