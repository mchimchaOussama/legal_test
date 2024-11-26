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
            height: 40px;
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

                                                <li class="dropdown2 current"><a href="{{route('get.marketplace')}}">Thematique</a>
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
                                    <div class="register">
                                        <ul class="d-flex">
                                            @if(session()->has('client_hom'))
                                            
                                            @else
                                                <li><a href="#modalLogin" data-bs-toggle="modal">Se connecter</a></li>
                                                <li>/</li>
                                                <li><a href="#modalRegister" data-bs-toggle="modal">S'inscrire</a></li>
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
                                <a href="#modalLogin" data-bs-toggle="modal">Se connecter</a>
                                <span>/</span>
                                <a href="#modalRegister" data-bs-toggle="modal">S'inscrire</a>
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
                                    <p class="subtitle text-white body-1 wow fadeIn" data-wow-delay=".8s" data-wow-duration="2000ms">Achetez en direct nos leads scrupuleusement vérifiés par nos experts. Disponibles à l'unité à partir de <span class='h3'> 32 € HT. </span>  </span></p>
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
                                                                    <select class='form-select no-border' name="thematiqueArray">
                                                                        <option selected='' disabled >Tout</option>
                                                                        @foreach($thematiqueArrays as $thematiqueArray)
                                                                            <option value="{{ $thematiqueArray }}"> @if($thematiqueArray =='enr') energie gaz /électrique @else {{$thematiqueArray}} @endif  </option>
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
                                                                <span class="text-1">Avancée</span>                                                                      
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="tf-btn primary">Rechercher</button>
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
                        <div class="text-subtitle text-primary">La marketplace 100% dédiée aux leads !</div>
                        <h4 class="mt-4">Sous Thématique</h4>
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
                        <div class="text-subtitle text-primary">•	Explorez les thématiques liées aux leads !</div>
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
                                    <a href="" class="images-group">
                                        <div class="images-style">
                                            <img src="/storage/{{$topThematiques->image}}" alt="img">      
                                        </div>
                                        <div class="bottom">
                                            <span class="flag-tag style-2">Nombre des Leads ({{$topThematiques->leads_count}} )</span>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <h5 class="text-capitalize"><a href="#" class="link">@if ($topThematiques->theme == 'enr' )  energie gaz /électrique  @else {{$topThematiques->theme}} @endif  </a></h5>
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
                                        <span class="flag-tag success style-2"> @if ($p->thematique->theme == 'enr' ) energie gaz /électrique @else {{ $p->thematique->theme }} @endif  </span>
                                    </div>
                                </a>
                                <div class="content">
                                    <div class="archive-top">
                                        <div class="row">
                                            <div class="col-lg-9">  <div class=" text-capitalize fw-7 pt-2"><a href="#" class="link">{{$p->thematique->thematique}}</a></div> </div>
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
                                                        <div class="h7 fw-7">{{ strtoupper(substr($review->client->nom, 0, 1)) }} {{ strtoupper(substr($review->client->prenom, 0, 1)) . '.....' }}</div>
                                                       <!-- <p class="text-variant-1 mt-4">{{ $review->client->email }}</p>-->
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
                                <li> <a href="{{route('get.marketplace')}}" class="caption-1 text-variant-2">@if ($thematiquesStatistique->theme =='enr' )  energie gaz /électrique @else {{$thematiquesStatistique->theme}} @endif </a> </li>
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
    <div class="modal-dialog modal-lg"  >
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
    <div class="modal-dialog modal-lg" style="
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    ">
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
    <div class="modal-dialog modal-lg" style="width:100%;position:fixed;bottom:0;left:50%;transform:translateX(-50%);
    ">
        <div class="modal-content">
            <div class="modal-header w-100 text-center">
                <h5 class="modal-title" id="termsModalLabel3">Conditions Générales et Mentions Légales</h5>
           
            </div>
            <div class="modal-body" style="overflow-y:auto;height:300px;">
                <!-- Conditions Générales de Vente -->
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>
                <p class='h5' ><strong>1. Objet du Contrat :</strong></p>
                <div class='mx-3 mb-2'>
                <span >Les présentes conditions générales ont pour objet de définir les modalités selon lesquelles Lead & Boost fournit des leads qualifiés et vérifiés à ses clients dans le domaine du marketing digital.</span>
                </div>
                <p class='h5'><strong>2. Engagements de Lead & Boost :</strong></p>
                <div class='mx-3 mb-2'>
                <ul>
                    <li>-> Conformité des leads aux critères définis sur la marketplace.</li>
                    <li>-> Livraison des leads dans les délais indiqués.</li>
                    <li>-> Qualité garantie : remplacement des leads erronés au-delà d’un taux d’erreur de 10%.</li>
                </ul>
                </div>
               <p class='h5'><strong>3. MODALITÉS FINANCIÈRES :</strong></p>
                <!-- Add more sections from the document as required -->
                <div class='mx-3 mb-2'>
                <span>Les prix des leads sont fixés par Lead & Boost et indiqués sur la marketplace. Le paiement
                        se fait en ligne via la plateforme sécurisée PayPal ou Stripe avant le démarrage de la
                        mission. Aucun remboursement ne sera accordé, sauf dans le cas où les leads ne sont pas
                        livrés dans les délais, auquel cas un remboursement au prorata des leads non livrés pourra
                        être effectué.
                        Les prix sont indiqués hors taxes (HT).</span>
                </div>

                <p class='h5'><strong>4. LEVIERS D’ACQUISITION DES LEADS :</strong></p>
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
                <p class='h5'><strong>5. CRITÈRES DE SÉLECTION DES LEADS :</strong></p>
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
                <p class='h5'><strong>6. MODALITÉS DE PAIEMENT :</strong></p>
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
                    <p class='h5'><strong>7. CONFIDENTIALITÉ:</strong></p>
                    <span>Lead & Boost et le Client s'engagent à respecter la confidentialité des informations
                            échangées dans le cadre de la mission. Ces informations ne seront utilisées que pour
                            l'accomplissement des services spécifiés et ne seront pas partagées sans l'accord préalable
                            des parties concernées. </span>
                </div>

                <div class='mx-3 mb-2'>
                    <p class='h5'><strong>8. RÉGLEMENT DES DIFFÉRENDS ET LOI APPLICABLE:</strong></p>
                    <span>En cas de litige relatif à l’exécution ou à l’interprétation des présentes conditions, celui-ci
                            sera soumis à la compétence exclusive des tribunaux de Sharjah, Émirats Arabes Unis. Le
                            contrat est régi par les lois des Émirats Arabes Unis.</span>
                </div>
                <h6 style="color:#608BC1" class='text-center mb-2'>Conditions Générales de Vente de Lead & Boost</h6>

                <div class='mx-3 mb-2'>         
                     <p class='h5'><strong>1. DÉFINITIONS :</strong></p>
                     <span>Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation de
                            l'application Lead & Boost. En accédant et en utilisant cette application, vous acceptez ces
                            conditions sans réserve.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h5'><strong>2. DACCÈS À L'APPLICATION :</strong></p>
                     <span>L'accès à l'application est réservé aux utilisateurs disposant d'un compte valide et ayant
                            payé pour les services. Lead & Boost se réserve le droit de suspendre l'accès à l'application
                            pour toute violation des présentes CGU.  </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h5'><strong>3. COMPORTEMENT DE L'UTILISATEUR :</strong></p>
                     <span>L'utilisateur s'engage à utiliser l'application de manière conforme aux lois et règlements en
                            vigueur. Toute activité illégale ou non conforme, y compris le fait de fournir des
                            informations fausses ou trompeuses, peut entraîner la suspension ou la suppression du
                            compte de l'utilisateur. </span>
                </div>

                <div class='mx-3 mb-2'>         
                     <p class='h5'><strong>4. PROPRIÉTÉ INTELLECTUELLE:</strong></p>
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
                     <p class='h5'><strong>5. Loi applicable et juridique compétente :</strong></p>
                     <span>Les Présentes mentions légales sont régies par les  lois des Émirats arabes unis. en cas de litige relatif a l'application Lead & Boost, et défault de résolution amiable,les tribunaux compétents seront ceux de Sharjah. </span>
                </div>
                <!-- Include additional sections as per the original content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm disabled" data-bs-dismiss="modal" id="accepter-condition" >Accept Condition</button>
                <button type="button" class="btn btn-success btn-sm d-none" data-bs-dismiss="modal" id="accepter-condition-none" >Accept Condition</button>
            </div>
        </div>
    </div>
</div>

@endif




<script>
    const cartAddRoute = "{{ route('cart_add', ['lead' => ':lead', 'src' => 'market']) }}";
    const addCartImage = "{{ asset('assetsMarketplace/images/ajouter-au-panier.png') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>





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

        //   $('#fermertermsmodal').prop('disabled', true);
        
        if(!localStorage.getItem('termsAccepted')) {

            $('#termsModal3').modal({
                backdrop: 'static', // Disable closing by clicking outside
                keyboard: false     // Disable closing with the Escape key
            }).modal('show');
        }

        $("#accepter-condition-none").click(function(){

            localStorage.setItem('termsAccepted', "ok");

        });
            // Show overlay to disable the page
            $('#page-overlay').show();


            $('#termsModal3 .modal-body').on('scroll', function () {
        var contentHeight = $(this).prop('scrollHeight'); // Total height of content
        var scrollPosition = $(this).scrollTop() + $(this).height(); // Current scroll position + visible area height

        if (scrollPosition >= contentHeight - 32) {
            $("#accepter-condition-none").removeClass("d-none");
            $("#accepter-condition").addClass("d-none");    
           
        }
    });
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