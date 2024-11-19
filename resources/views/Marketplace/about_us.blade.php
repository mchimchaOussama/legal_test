
@extends('components.app_client') 
@section('title', 'A Propos') 
@section('content')

<!DOCTYPE html>

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

    </style>

<body class="body">

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

                                                <li class=""><a href="{{route('get.marketplace')}}">Marketplace</a>
                                                </li>

                                                <li class="current"><a href="{{route('get.about_us')}}">A Propos</a>
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
                        <div class="nav-logo"><a href="index.html"><img src="images/logo/logo%402x.png" alt="nav-logo" width="174" height="44"></a></div>
                        <div class="bottom-canvas">
                            <div class="login-box flex align-center">
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
            <!-- Page Title -->
            <section class="flat-title-page style-2">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{route('get.home')}}">Accueil</a></li>
                        <li>/ Pages</li>
                        <li>/ A Propos</li>
                    </ul>
                    <h2 class="text-center"> A Propos</h2>
                </div>
            </section>
            <!-- End Page Title -->

            <!-- banner video -->
            <section class="flat-section flat-banner-about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <h3> Bienvenue au <br> Lead & Boost</h3>
                        </div>
                        <div class="col-md-7 hover-btn-view">
                            <p class="body-2 text-variant-1" id="short-text">
                            Bienvenue chez Lead & Boost, votre partenaire de confiance pour la génération de leads hautement qualifiés. Nous optimisons vos opportunités d’affaires grâce à une variété de leviers d’acquisition, incluant des robots d’appels, des emailings ciblés et des campagnes sur les réseaux sociaux.
                            </p>
                            <p class="body-2 text-variant-1" id="full-text" style="display: none;">
                            Chez Lead & Boost, nous nous engageons à garantir la qualité de chaque lead généré. Tous nos leads sont soumis à un audit qualité rigoureux avant d'être transmis à nos clients. Ce processus nous permet de vous fournir des leads 100% conformes, vérifiés et immédiatement exploitables. Nous nous engageons également à vous livrer chaque lead en moins de 15 minutes, afin d’optimiser vos taux de conversion.<br>
                                <span class='mx-2'>
                                Avec Lead & Boost, bénéficiez de leads hautement qualifiés et vérifiés, transformant vos prospects en clients avec un taux de conversion exceptionnel.
                                </span>
                            </p>
                            <a href="javascript:void(0);" class="btn-view style-1" onclick="toggleText()">
                                <span class="text" id="toggle-text">En Savoir Plus</span>
                                <span class="icon icon-arrow-right2"></span>
                            </a>
                        </div>

                    </div>
                    <div class="banner-video">
                        <img src="{{ asset('assetsMarketplace/images/logo1.png') }}" alt="img-video">
                        <a href="https://youtu.be/MLpWrANjFbI" data-fancybox="gallery2" class="btn-video"> <span class="icon icon-play"></span></a>
                    </div>
                </div>
            </section>
            <!-- end banner video -->
            <!-- Service -->
            <section class="flat-section-v3 flat-service-v2 bg-surface">
                <div class="container">
                    <div class="row wrap-service-v2">
                        <div class="col-lg-6">
                            <div class="box-left">
                                <div class="box-title">
                                    <div class="text-subtitle text-primary">Services</div>
                                    <h4 class="mt-4">Votre partenaire pour la génération de prospects qualifiés!</h4>
                                </div>
                                <p>Avec Lead & Boost, vous bénéficiez de leads hautement qualifiés et vérifiés, qui transforment vos prospects en clients avec un taux de conversion imbattable.</p>
                                <ul class="list-view">
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 15.9947C12.4183 15.9947 16 12.4154 16 8C16 3.58462 12.4183 0.00524902 8 0.00524902C3.58172 0.00524902 0 3.58462 0 8C0 12.4154 3.58172 15.9947 8 15.9947Z" fill="#198754"/>
                                            <path d="M7.35849 12.2525L3.57599 9.30575L4.65149 7.9255L6.97424 9.735L10.8077 4.20325L12.2462 5.19975L7.35849 12.2525Z" fill="white"/>
                                        </svg>
                                        +200 Leads par jour 
                                    </li>
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 15.9947C12.4183 15.9947 16 12.4154 16 8C16 3.58462 12.4183 0.00524902 8 0.00524902C3.58172 0.00524902 0 3.58462 0 8C0 12.4154 3.58172 15.9947 8 15.9947Z" fill="#198754"/>
                                            <path d="M7.35849 12.2525L3.57599 9.30575L4.65149 7.9255L6.97424 9.735L10.8077 4.20325L12.2462 5.19975L7.35849 12.2525Z" fill="white"/>
                                        </svg>
                                        0% faux numéro 
                                    </li>
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 15.9947C12.4183 15.9947 16 12.4154 16 8C16 3.58462 12.4183 0.00524902 8 0.00524902C3.58172 0.00524902 0 3.58462 0 8C0 12.4154 3.58172 15.9947 8 15.9947Z" fill="#198754"/>
                                            <path d="M7.35849 12.2525L3.57599 9.30575L4.65149 7.9255L6.97424 9.735L10.8077 4.20325L12.2462 5.19975L7.35849 12.2525Z" fill="white"/>
                                        </svg>
                                        22%  transformation en rdv 
                                    </li>
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 15.9947C12.4183 15.9947 16 12.4154 16 8C16 3.58462 12.4183 0.00524902 8 0.00524902C3.58172 0.00524902 0 3.58462 0 8C0 12.4154 3.58172 15.9947 8 15.9947Z" fill="#198754"/>
                                            <path d="M7.35849 12.2525L3.57599 9.30575L4.65149 7.9255L6.97424 9.735L10.8077 4.20325L12.2462 5.19975L7.35849 12.2525Z" fill="white"/>
                                        </svg>
                                        Leads 100% vérifiés.
                                    </li>
                                </ul>
                                <a href="{{route('get.contact')}}" class="btn-view" target="_blank">
    <span class="text">Contact Us</span>
    <span class="icon icon-arrow-right2"></span>
</a>

                            </div>
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="box-right">
                            <div class="box-service style-1 hover-btn-view">
                                <div class="icon-box">
                                <span class="icon icon-file-text"></span>
                                </div>
                                <div class="content">
                                    <h6 class="title">Fichiers ultra-qualifiés</h6>
                                    <p class="description">
                                    Nous débutons par l’identification de fichiers contenant des prospects potentiels, 
                                    </p>
                                    <div class="additional-info" style="display: none;">
                                        <p> avec les informations essentielles telles que le nom, le prénom, l’adresse postale, l’adresse email, le numéro de téléphone portable, le statut de propriétaire, etc.</p>

                                    </div>
                                    <a href="javascript:void(0);" class="btn-view style-1" onclick="toggleAdditionalInfo()">
                                        <span class="text" id="toggle-text">En Savoir Plus</span>
                                        <span class="icon icon-arrow-right2"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="box-service style-1 hover-btn-view">
                                <div class="icon-box">
                                <span class="icon icon-proven"></span>
                                </div>
                                <div class="content">
                                    <h6 class="title">Qualification et audit des leads</h6>
                                    <p class="description">
                                    Chaque contact fait l'objet d'un suivi approfondi. Nos experts évaluent les besoins en rénovation des maisons ou des appartements,
                                    </p>
                                    <div class="additional-infob" style="display: none;">
                                        <p> en tenant compte de projets tels que l'installation de panneaux solaires photovoltaïques, de pompes à chaleur, l'isolation, le remplacement de fenêtres, la création de vérandas, l'aménagement intérieur, l'installation de thermostats connectés, et bien plus encore.
</p>

                                    </div>
                                    <a href="javascript:void(0);" class="btn-view style-1" onclick="toggleAdditionalInfob()">
                                        <span class="text" id="toggle-text">En Savoir Plus</span>
                                        <span class="icon icon-arrow-right2"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="box-service style-1 hover-btn-view">
                                <div class="icon-box">
                                    <span class="icon icon-faders"></span>
                                </div>
                                <div class="content">
                                    <h6 class="title">Vérification et contrôle</h6>
                                    <p class="description">
                                    Tous les leads sont ensuite soumis à un examen approfondi par une équipe d’experts.
                                    </p>
                                    <div class="additional-infoc" style="display: none;">
                                        <p> Ce processus de contrôle qualité garantit la conformité de chaque lead avec la réglementation en vigueur et valide leur intérêt réel pour les projets de rénovation.</p>

                                    </div>
                                    <a href="javascript:void(0);" class="btn-view style-1" onclick="toggleAdditionalInfoc()">
                                        <span class="text" id="toggle-text">En Savoir Plus</span>
                                        <span class="icon icon-arrow-right2"></span>
                                    </a>
                                </div>
                            </div>


                            <div class="box-service style-1 hover-btn-view">
                                <div class="icon-box">
                                    <span class="icon icon-package"></span>
                                </div>
                                <div class="content">
                                    <h6 class="title">Livraison rapide</h6>
                                    <p class="description">
                                    Chaque L.E.A.D. vérifié est transmis au client final en moins de 15 minutes, optimisant ainsi vos chances de conversion.
                                    </p>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Service -->
            <!-- Testimonial -->
            <section class="flat-section flat-testimonial-v4">
                <div class="container">
                    <div class="box-title text-center">
                        <div class="text-subtitle text-primary">Lead & Boost</div>
                        <h4 class="mt-4">Pourquoi choisir Lead And Boost comme partenaire?</h4>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="">
                                <div class="box-tes-item style-2">
                                    <p class="note body-1">
                                       <span class='mx-4 mb-2'> Transformez vos prospects en clients grâce à nos services de génération de leads efficaces ! Chez Lead And Boost, nous reconnaissons l'importance de capturer des leads de qualité pour favoriser la croissance de votre activité. Grâce à nos techniques avancées et à notre expertise en ciblage précis, nous générons des leads hautement qualifiés qui répondent parfaitement à vos besoins commerciaux. Nos stratégies sur mesure sont conçues pour vous connecter avec des prospects réellement intéressés.
                                        </span>  <br>
                                        <span class='mx-4'>
                                        Nous vous accompagnons tout au long du processus, en optimisant votre entonnoir de conversion et en améliorant votre taux de transformation. En collaborant avec nous, vous garantissez à votre entreprise un flux régulier de leads pertinents, favorisant une croissance durable et un retour sur investissement maximal. Faites confiance à nos solutions innovantes et démarquez-vous dans un marché compétitif grâce à des prospects qualifiés et prêts à agir !
                                        </span>
                                    </p>
                                </div>
                            </div>    
                        </div>           
                    </div>
                </div>
            </section>
            <!-- End Testimonial -->
            <!-- Contact -->
             <!--
      <section class="flat-section-v3 flat-slider-contact">
                <div class="container">
                    <div class="row content-wrap">
                        <div class="col-lg-7">
                            <div class="content-left">
                                <div class="box-title">
                                    <div class="text-subtitle text-white">Contact Us</div>
                                    <h4 class="mt-4 fw-6 text-white">We're always eager to hear from you!</h4>
                                </div>
                                <p class="body-2 text-white">Sed ullamcorper nulla egestas at. Aenean eget tortor nec elit sagittis molestie. Pellentesque tempus massa in.r nulla egestas at. Aenean eget tortor nec elit sagittis mole</p>
                            </div>
                            
                        </div>
                        <div class="col-lg-5">
                            <form action="#" class="box-contact-v2">
                                <div class="box">
                                    <label for="name" class="label">Name:</label>
                                    <input type="text" class="form-control" value="Tony Nguyen |">
                                </div>
                                <div class="box">
                                    <label for="email" class="label">Email:</label>
                                    <input type="text" class="form-control" value="hi.themesflat@mail.com">
                                </div>
                                <div class="box">
                                    <label for="message" class="label">Message:</label>
                                    <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Write comment"></textarea>
                                </div>
                                <div class="box">
                                    <button class="tf-btn primary">Contact US</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="overlay"></div>

            </section>
-->
            <!-- End Contact -->
            <!-- Agents -->
             <!--
            <section class="flat-section flat-agents">
                <div class="container">
                    <div class="box-title text-center">
                        <div class="text-subtitle text-primary">Our Teams</div>
                        <h4 class="mt-4">Meet Our Agents</h4>
                    </div>
                    <div class="row">
                        <div class="box col-lg-4 col-sm-6">
                            <div class="box-agent style-1 hover-img">
                                <div class="box-img img-style">
                                    <img src="images/agents/agent-lg-1.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><a href="#" class="icon icon-facebook"></a></li>
                                        <li><a href="#" class="icon icon-linkedin"></a></li>
                                        <li><a href="#" class="icon icon-twitter"></a></li>
                                        <li><a href="#" class="icon icon-instagram"></a></li>
                                    </ul>
                                </div>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">Jack Halow</h6>
                                        <p class="mt-4 text-variant-1">CEO & Founder</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box col-lg-4 col-sm-6">
                            <div class="box-agent style-1 hover-img">
                                <div class="box-img img-style">
                                    <img src="images/agents/agent-lg-2.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><a href="#" class="icon icon-facebook"></a></li>
                                        <li><a href="#" class="icon icon-linkedin"></a></li>
                                        <li><a href="#" class="icon icon-twitter"></a></li>
                                        <li><a href="#" class="icon icon-instagram"></a></li>
                                    </ul>
                                </div>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">John Smith</h6>
                                        <p class="mt-4 text-variant-1">Property Manager</p>
                                    </div>
                                    <span class="icon-phone"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box col-lg-4 col-sm-6">
                            <div class="box-agent style-1 hover-img">
                                <div class="box-img img-style">
                                    <img src="images/agents/agent-lg-3.jpg" alt="image-agent">
                                    <ul class="agent-social">
                                        <li><a href="#" class="icon icon-facebook"></a></li>
                                        <li><a href="#" class="icon icon-linkedin"></a></li>
                                        <li><a href="#" class="icon icon-twitter"></a></li>
                                        <li><a href="#" class="icon icon-instagram"></a></li>
                                    </ul>
                                </div>
                                <a href="#" class="content">
                                    <div class="info">
                                        <h6 class="link">Chris Patt</h6>
                                        <p class="mt-4 text-variant-1">Administrative Staff</p>
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
            <!-- banner -->
            <section class="flat-section pt-0 flat-banner">
                <div class="container">
                    <div class="wrap-banner bg-surface">
                        <div class="box-left">
                            <div class="box-title">
                                <div class="text-subtitle text-primary">C'est parti !</div>
                                <h4 class="mt-4">Bienvenue sur LeadBoost, rejoignez-nous !</h4>
                            </div>
                            <a href="{{route('get.marketplace')}}" class="tf-btn primary size-1">J'accéde a la Marketplace !</a>
                        </div>
                        <div class="box-right">
                            <img src=" {{ asset('assetsMarketplace/images/banner/banner.png') }}" alt="image">
                           
                        </div>
                    </div>
                </div>
            </section>
            <!-- end banner -->
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
                                <p class="text-white">tet@gmail.com</p>
                            </li>
                          </ul>
                          
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-cl-2">
                            <div class="fw-7 text-white">Page</div>
                            <ul class="mt-10 navigation-menu-footer">

                                <li> <a href="{{route('get.home')}}" class="caption-1 text-variant-2">Accueil</a> </li>
                                
                                <li> <a href="{{route('get.marketplace')}}" class="caption-1 text-variant-2">Marketplace</a> </li>

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
                            <label for="cb1" class="caption-1 text-variant-1"> J'accepte les  <span class="fw-5 text-black" data-bs-toggle="modal" data-bs-target="#termsModal" style="cursor: pointer;"> Conditions d'Utilisation  </span>.
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

<script>

    $('#fermertermsmodal').click(function() {
            $('#modalRegister').modal('toggle');
    });

    $('#btnClose').click(function() {
            $('#modalRegister').modal('toggle');
    });

</script>

    <script src="{{ asset('assetsMarketplace/js/my-js/auth.js') }}"></script>
    <script src="{{ asset('assetsMarketplace/js/my-js/about.js') }}"></script>
    <script src="{{ asset('assetsMarketplace/js/my-js/news.js') }}"></script>


</body>


<!-- Mirrored from themesflat.co/html/homzen/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 22:35:39 GMT -->
</html>

@endsection