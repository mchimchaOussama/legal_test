    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">


        <div class="navbar-container d-flex content">
            
            @yield("navbar-element")

            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="{{ route('admin.profil') }}" wire:navigate>
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">
                            {{ session("auth")["nom"].' '.session("auth")["prenom"]  }}
                        </span><span class="user-status">{{ session("auth")["role"] }}</span></div>
                        <span class="avatar">
                            @if(session("auth")["profil_image"] && !empty(session("auth")["profil_image"]))
                                <img class="round" src="{{ asset('/storage/'.session('auth')['profil_image']) }}" alt="avatar" height="40" width="40">
                            @else
                                <img class="round" src="{{ asset('/assets/images/profil.png') }}" alt="avatar" height="40" width="40">
                            @endif
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->