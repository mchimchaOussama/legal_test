@extends('components.app_client') 
@section('title', 'dashbord') 
@section('content')

<!DOCTYPE html>

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
                                        <div class="logo">  <a class="navbar-brand ms-5" href="index.html"><img src="{{ asset('assetsMarketplace/images/logo.png') }}"  width="174" height="44"     alt="logo"  /></a></div>
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

                                                <li class="dropdown2"><a href="#">Thematique</a>
                                                    <ul>
                                                        @foreach($thematiques as $thematique)
                                                        <li><a href="{{route('get.marketplace')}}">{{$thematique->thematique}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class=""><a href="{{route('get.marketplace')}}">Marketplace</a>
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
                        <li class="nav-menu-item active"><a class="nav-menu-link" href="{{route('get.dashbord.client')}}"><span class="icon icon-dashboard"></span> Dashboards</a></li>
                        <li class="nav-menu-item "><a class="nav-menu-link" href="{{route('get.register.marketplace')}}"><span class="icon icon-profile"></span> My Profile</a></li>
                        <li class="nav-menu-item "><a class="nav-menu-link" href="{{route('marketplace.client-commandes')}}"><span class="icon icon-package"></span>Commandes</a></li>
                        <li class="nav-menu-item "><a class="nav-menu-link" href="{{ route('logout') }}"><span class="icon icon-sign-out"></span> Logout</a></li>
                    </ul>
                </div>
                <!-- end sidebar dashboard -->
                <div class="main-content">
                    <div class="main-content-inner wrap-dashboard-content-2">
                    <div class="button-show-hide show-mb">
                            <span class="body-1">Show Dashboard</span>
                        </div>
                        <div class="flat-counter-v2 tf-counter">
                            <div class="counter-box">
                                <div class="box-icon w-68 round">
                                    <span class="icon icon-list-dashes"></span>
                                </div>
                                <div class="content-box">
                                    <div class="title-count">Lead acheter  </div>
                                    <div class="d-flex align-items-end">
                                        <h6 class="number" data-speed="2000" data-to="17" data-inviewport="yes">{{$statLead}}</h6>                                   
                                    </div>                              

                                </div>
                            </div>
                            <div class="counter-box">
                                <div class="box-icon w-68 round">
                                    <span class="icon icon-guarantee"></span>
                                </div>
                                <div class="content-box">
                                    <div class="title-count">Total Facture </div>
                                    <div class="d-flex align-items-end">
                                        <h6 class="number" data-speed="2000" data-to="0" data-inviewport="yes">{{$invoicesStat}}</h6>                                   
                                    </div>                              

                                </div>
                            </div>
                            <div class="counter-box">
                                <div class="box-icon w-68 round">
                                    <span class="icon icon-proven"></span>
                                </div>
                                <div class="content-box">
                                    <div class="title-count">Total Paiement </div>
                                    <div class="d-flex align-items-end">
                                        <h6 class="number" data-speed="2000" data-to="1" data-inviewport="yes">{{$totalPayments}} €</h6>                                   
                                    </div>                              

                                </div>
                            </div>
                            <div class="counter-box">
                                <div class="box-icon w-68 round">
                                    <span class="icon icon-package"></span>
                                </div>
                                <div class="content-box">
                                    <div class="title-count"> Commandes </div>
                                    <div class="d-flex align-items-end">
                                        <h6 class="number" data-speed="2000" data-to="1" data-inviewport="yes">{{$Commande}}</h6>                                   
                                    </div>                              

                                </div>
                            </div>
                        </div>
                        <div class="wrapper-content row">
                            <div class="col-xl-12">
                                <div class="widget-box-2 wd-listing">
                                    <h6 class="title">Lead :</h6>
                         
                                    <div class="wd-filter">
                                        <!-- Thématique Filter -->
                                        <div class="ip-group">
                                            <label for="select-thematique">Thématique</label>
                                            <select id="thematique" class="form-select mt-2" name="thematique">
                                                <option value="">Select Theme</option>
                                                @foreach($thematiques as $thematique)
                                                    <option value="{{ $thematique->id }}">{{ $thematique->thematique }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Département Filter -->
                                        <div class="ip-group">
                                            <label for="select-departement">Département</label>
                                            <select id="departement" class="form-select mt-2" name="departement">
                                                <option value="">Select Department</option>
                                                @foreach($departements as $departement)
                                                    <option value="{{ $departement->id }}">{{ $departement->departement }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Type Filter -->
                                        <div class="ip-group mb-2">
                                            <label for="select-departement">Type</label>
                                            <select id="type" class="form-select mt-2" name="type">
                                                <option value="">Select Type</option>
                                                <option value="B2B">B2B</option>
                                                <option value="B2C">B2C</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="wrap-table">

                                    <div class="table-responsive">
                                    <!-- Table to Display Leads -->
                                    <div id="leads-container">
                                       
                                           
                                    </div>
                                        <!-- The table will be populated here via AJAX -->
                                    </div>
                                    </div>

                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                            
                                     </div>
                             
                                <div class="widget-box-2 mb-4">

                                <h6 class="title">Vos Achats :</h6>  
                                
                                <div class="d-flex gap-4"><span class="text-primary fw-7">{{$nbrFact}}</span><span class="text-variant-1">résultats trouvés</span></div>

                                @yield('list-invoice')
                              
                                </div>

                            </div>

                        </div>
                

                    <div class="footer-dashboard">
                        <p class="text-variant-2">©2024 . All Rights Reserved.</p>
                    </div>
                </div>

                <div class="overlay-dashboard"></div>

            </div>
        </div>
        <!-- /#page -->

    </div>
    <!-- go top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>



<script>
$(document).ready(function() {
    // Function to load leads based on filters
    function loadLeads() {
        // Get filter values
        const departement = $('#departement').val();
        const thematique = $('#thematique').val();
        const type = $('#type').val();

        // AJAX request to fetch leads
        $.ajax({
            url: '/fetch-leads',
            type: 'POST',
            data: {
                departement: departement,
                thematique: thematique,
                type: type,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function(response) {
                // Populate the leads container with the table HTML from the server
                $('#leads-container').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching leads:', error);
            }
        });
    }

    // Load leads on page load
    loadLeads();

    // Reload leads when any filter changes
    $('#departement, #thematique, #type').on('change', function() {
        loadLeads();
    });

    // Handle pagination
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        var url = $(this).attr('href');
        
        // Re-run the AJAX request for the new page
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                departement: $('#departement').val(),
                thematique: $('#thematique').val(),
                type: $('#type').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Update the leads table with the new data
                $('#leads-container').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching leads:', error);
            }
        });
    });
});

</script>

<!-- Mirrored from themesflat.co/html/homzen/my-invoices.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2024 22:36:10 GMT -->
</html>


@endsection