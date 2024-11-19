@extends('components.app_client') 
@section('title', 'Commandes') 
@section('content')

<!DOCTYPE html>
<style>

.layout-wrap .wrap-table table tbody td:last-child{
    padding-left: 20px;
}

</style>
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
                        <li class="nav-menu-item"><a class="nav-menu-link" href="{{route('get.dashbord.client')}}"><span class="icon icon-dashboard"></span> Dashboards</a></li>
                        <li class="nav-menu-item "><a class="nav-menu-link" href="{{route('get.register.marketplace')}}"><span class="icon icon-profile"></span> My Profile</a></li>
                        <li class="nav-menu-item active"><a class="nav-menu-link" href="{{route('marketplace.client-commandes')}}"><span class="icon icon-package"></span>Commandes</a></li>
                        <li class="nav-menu-item"><a class="nav-menu-link" href="{{ route('logout') }}"><span class="icon icon-sign-out"></span> Logout</a></li>
                    </ul>
                </div>
                <!-- end sidebar dashboard -->
                <div class="main-content">
                    <div class="main-content-inner wrap-dashboard-content-2">
                        <div class="button-show-hide show-mb">
                            <span class="body-1">Show Dashboard</span>
                        </div>
                        <div class="wrapper-content row">
                            <div class="col-xl-12">
                                <div class="widget-box-2 wd-listing">

                                    <h6 class="title mb-4">Commandes en Quantité:</h6>
                                <div class="wrap-table">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>Thématique</th>
                                                <th>Département</th>
                                                <th>Quantité</th>
                                                <th>Date livraison</th>
                                                <th>Statut</th>
                                                <th>Télécharger</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commandes as $commande)
                                                <tr>
                                                    <td>{{ $commande->thematique }}</td>
                                                    <td>{{ $commande->departement }}</td>
                                                    <td>{{ $commande->nombre_leads }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($commande->statut === 1)
                                                            <span class="text-success">Accepté</span>
                                                        @elseif($commande->statut === 0)
                                                            <span class="text-danger">Refusé</span>
                                                        @else
                                                            <span class="text-warning">En cours</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($commande->statut === 1 && !empty($commande->excel_path) && !is_null($commande->excel_path))
                                                            <a role="button" class="btn btn-secondary btn-sm" href="{{ route('marketplace.client-commande-download', $commande->id) }}" >Télécharger</a>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>Télécharger</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>

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



</html>


@endsection