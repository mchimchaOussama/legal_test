@extends('components.app_client') 
@section('title', 'Votre panier') 
@section('content')




<!DOCTYPE html>


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
                                    <a class="navbar-brand ms-5" href="index.html">
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

                                                <li class=""><a href="#">A Propos</a>
                                                </li>


                                                <li class=""><a href="{{route('get.faq')}}">FAQ</a>
                                                </li>
                        
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
                                        <a href="{{route('cart_index')}}" >Panier ({{ count(session('cart'))}}) </a> 
                                        @else
                                        <a href="{{route('cart_index')}}" >Panier (0) </a>  
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
                                    <!-- Main Menu End-->
                                </div>
                               
                           
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
            


            <section class="flat-section pt-0 flat-property-detail">
                <section class="h-100">
                    <div class="container h-100 py-5">
                      <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-8">
                  
                          <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0">Votre Panier</h3>
                           
                          </div>
                  @if (session('cart') && count(session('cart')) > 0)
                      
                  @foreach($cart as $details)
                  <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                      <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img
                            src="{{ asset('storage/' . $details['img']) }}"
                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <p class="lead fw-normal mb-2">{{$details['mode']}}</p>
                          <p><span class="text-muted">Departement: </span>{{$details['departement'] }}<span class="text-muted">  Ville: </span>Grey</p>
                        </div>
                    
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                          <h6 class="mb-0">{{$details['prix']}} €</h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                          <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                          
                  
                       
                  
                         
                  
                  <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                      <div class="col-4" ></div>
                      <div class="col-4" ></div>
                   
                      <div class="col-4">
                        
                        
                        <label ><h5 class="mb-0"> TOTAL : {{$total}} €</h5></label>
                      </div>
                
                  </div>
                  </div>
                          
                  
                          <div class="row cart">
                            <div class=" col-4 card-body ">
                              <div data-mdb-input-init class="form-outline flex-fill">
                                <input type="text" id="form1" class="form-control form-control-lg" />
                                <label class="form-label" for="form1">Code Coupon</label>
                              </div>
                              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-lg ms-3">Appliquer</button>
                            </div>
                              <div class=" col-4 card-body ">
                                        
                                
                                <div class="d-flex justify-content-center">

                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg ">Passer au paiement</button>
                                </div>
                               
                         
                              </div>
                            
                          </div>
                       
                  
                       
                        </div>
                      </div>
                    </div>
                  </section>
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
                                <i class="icon icon-mapPinLine fs-20 text-variant-2"></i>
                                <p class="text-white">101 E 129th St, East Chicago, IN 46312, US</p>
                            </li>
                            <li class="mt-12 d-flex align-items-center gap-8">
                                <i class="icon icon-mail fs-20 text-variant-2"></i>
                                <p class="text-white">themesflat@gmail.com</p>
                            </li>
                          </ul>
                          
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-cl-2">
                            <div class="fw-7 text-white">Page</div>
                            <ul class="mt-10 navigation-menu-footer">
                                <li> <a href="{{route('get.home')}}" class="caption-1 text-variant-2">Accueil</a> </li>

                                <li> <a href="#" class="caption-1 text-variant-2">A Propos</a> </li>

                                <li> <a href="{{route('get.faq')}}" class="caption-1 text-variant-2">FAQ</a> </li>

                                <li> <a href="#" class="caption-1 text-variant-2">Contact</a> </li>

                            </ul>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-6">
                        <div class="footer-cl-3">
                            <div class="fw-7 text-white">Top Thematique</div>
                          
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
                                    <input type="email" name="email-form" id="subscribe-email" placeholder="Votre email address"/>
                                    <button type="button" id="subscribe-button" class="button-subscribe"><i class="icon icon-send"></i></button>
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
                        <div class="copyright">© 2024 LEAD AND BOOST (Tous droits réservés).</div>
                    
                        <ul class="menu-bottom">
                        <li><span class="text-white" data-bs-toggle="modal" data-bs-target="#termsModal2" style="cursor: pointer;font-size:13px">Conditions d'Utilisation</span></li>

<!--
                          <li><a href="pricing.html">Privacy Policy</a> </li>
                          <li><a href="contact.html">Cookie Policy</a> </li>

                        </ul>
                        -->
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
                    <div class="mt-12 text-variant-1 text-center noti">  <a href="#" class="text-black fw-5">Mot de passe oublié ?</a>/<a href="#modalRegister" data-bs-toggle="modal" class="text-black fw-5">S'inscrire.</a> </div>
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
                <span class="close-modal icon-close2" data-bs-dismiss="modal" id='reload'></span>

                <!-- Success message div -->
                <div id="success-message" class="alert alert-success" style="display: none;"></div>

                <form id="registerForm" action="#">
                    @CSRF 
                    <fieldset class="box-fieldset">
                        <label for="name">Nom<span>*</span>:</label>
                        <input type="text" class="form-contact style-1" placeholder="Remplir votre Nom !" name="name" required>
                    </fieldset>

                    <fieldset class="box-fieldset">
                        <label for="prenom">Prenom<span>*</span>:</label>
                        <input type="text" class="form-contact style-1" placeholder="Remplir votre Prenom !" name="prenom" required>
                    </fieldset>

                    <fieldset class="box-fieldset">
                        <label for="email">Email address<span>*</span>:</label>
                        <input type="email" class="form-contact style-1" placeholder="Remplir votre Email !" name="email" required>
                    </fieldset>
                    
                    <!-- Telephone input field -->
                    <fieldset class="box-fieldset">
                        <label for="telephone">Téléphone<span>*</span>:</label>
                        <input type="tel" class="form-contact style-1" placeholder="Remplir votre Téléphone !" name="telephone" required>
                    </fieldset>

                    <fieldset class="box-fieldset">
                        <label for="password">Mot de passe<span>*</span>:</label>
                        <div class="box-password">
                            <input type="password" class="form-contact style-1 password-field" placeholder="Mot de passe" name="password" required>
                            <span class="show-pass">
                                <i class="icon-pass icon-eye"></i>
                                <i class="icon-pass icon-eye-off"></i>
                            </span>
                        </div>
                    </fieldset>
                    
                    <fieldset class="box-fieldset">
                        <label for="confirm_password">Confirmer Mot de passe<span>*</span>:</label>
                        <div class="box-password">
                            <input type="password" class="form-contact style-1 password-field2" placeholder="Confirmer Mot de passe" name="password_confirmation" required>
                            <span class="show-pass2">
                                <i class="icon-pass icon-eye"></i>
                                <i class="icon-pass icon-eye-off"></i>
                            </span>
                        </div>
                    </fieldset>
                    
                    <fieldset class="d-flex align-items-center gap-6">
                    <label for="cb1" class="caption-1 text-variant-1">J'accepte les <span class="fw-5 text-black">Conditions d'Utilisation.</span></label>
                        <input type="checkbox" class="tf-checkbox style-2" id="cb1" name="termsAccepted">
                    </fieldset>

                    
                    <button type="submit" class="tf-btn primary w-100">S'inscrire</button>
                    <div class="mt-12 text-variant-1 text-center noti">Vous avez déjà un compte ?<a href="#modalLogin" data-bs-toggle="modal" class="text-black fw-5">Connectez-vous ici.</a></div>
                </form>
            </div>
        </div> 
    </div>
</div>
<script>
 
</script>
<script src="{{ asset('assetsMarketplace/js/my-js/auth.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/my-js/news.js') }}"></script>
</body>



<!-- Mirrored from themesflat.co/html/homzen/property-details-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 22:35:39 GMT -->
</html>






















































@endsection