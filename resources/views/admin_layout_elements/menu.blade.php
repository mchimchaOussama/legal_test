<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.accueil') }}">
                <img src="{{ asset('assetsMarketplace/images/logo.png') }}"  width="174" height="44" alt="logo"  />
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content pt-4">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(Route::currentRouteName() == 'admin.accueil') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.accueil') }}" wire:navigate>
                <i class="fa-solid fa-house"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Accueil</span>
                </a>
            </li>
            
            <li class=" nav-item @if(Route::currentRouteName() == 'admin.lead-ajouter-informatique-b2b' ||Route::currentRouteName() == 'admin.lead' || Route::currentRouteName() == 'admin.lead-ajouter' || Route::currentRouteName() == 'admin.lead-ajouter-enr' || Route::currentRouteName() == 'admin.lead-modifier'|| Route::currentRouteName() == 'admin.lead-ajouter-telecom' || Route::currentRouteName() == 'admin.lead-ajouter-informatique'|| Route::currentRouteName() == 'admin.lead-ajouter-informatique') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.lead') }}" wire:navigate>
                <i class="fa-solid fa-database"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Leads</span>
                </a>
            </li>

            <li class=" nav-item @if(Route::currentRouteName() == 'admin.thematiques') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.thematiques') }}" wire:navigate>
                <i class="fa-solid fa-tags"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Thématiques</span>
                </a>
            </li>

            <li class="nav-item @if(Route::currentRouteName() == 'admin.ville') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.ville') }}" wire:navigate>
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Villes</span>
                </a>
            </li>

            <li class="nav-item @if(Route::currentRouteName() == 'admin.departement') active @endif">
                <a class="d-flex align-items-center" href="{{ route('admin.departement') }}" wire:navigate>
                <i class="fa-solid fa-map-location-dot"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Départements</span>
                </a>
            </li>

            <!-------- Superviseur ------------>
            @if(session("auth")["role"] == "superviseur")
                <li class="nav-item @if(Route::currentRouteName() == 'admin.client' || Route::currentRouteName() == 'admin.client.show') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.client') }}" wire:navigate>
                    <i class="fa-solid fa-handshake"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Clients</span>
                    </a>
                </li>

                <li class="nav-item @if(Route::currentRouteName() == 'admin.coupon' || Route::currentRouteName() == 'admin.coupon-ajouter') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.coupon') }}" wire:navigate>
                        <i class="fa-solid fa-scissors"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Coupons</span>
                    </a>
                </li>

                <li class="nav-item @if(Route::currentRouteName() == 'admin.comptes' || Route::currentRouteName() == 'admin.ajouter-compte') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.comptes') }}" wire:navigate>
                        <i class="fa-solid fa-user-group"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Comptes</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'admin.payment' || Route::currentRouteName() == 'admin.payment.show') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.payment') }}" wire:navigate>
                        <i class="fa-solid fa-sack-dollar"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Paiements</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'admin.statistics') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.statistics') }}" wire:navigate>
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Statistiques</span>
                    </a>
                </li>
                <li class="nav-item @if(Route::currentRouteName() == 'admin.config') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.config') }}" wire:navigate>
                    <i class="fa-solid fa-gear"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Paramètres</span>
                    </a>
                </li>

                <li class="nav-item @if(Route::currentRouteName() == 'admin.corbeille') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.corbeille') }}" wire:navigate>
                    <i class="fa-solid fa-trash-arrow-up"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Corbeille</span>
                    </a>
                </li>

                <li class="nav-item @if(Route::currentRouteName() == 'admin.review') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.review') }}" wire:navigate>
                    <i class="fa-solid fa-star"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Review</span>
                    </a>
                </li>

                <li class="nav-item @if(Route::currentRouteName() == 'admin.demandes') active @endif">
                    <a class="d-flex align-items-center" href="{{ route('admin.demandes') }}" wire:navigate>
                        <i class="fa-regular fa-bell"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Commandes</span>
                    </a>
                </li>

                

            @endif

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.logout') }}">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Déconneter</span>
                </a>
            </li>

        </ul>
    </div>
    
</div>