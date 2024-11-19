<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lead&Boost')</title> <!-- Titre dynamique avec un titre par défaut -->
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/favicon.png') }}">

    <!-- font -->
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/fonts/fonts.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsMarketplace/css/apexcharts.html')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsMarketplace/css/styles.css') }}">
    <link rel="stylesheet"type="text/css" href="{{ asset('assetsMarketplace/css/jqueryui.min.css')}}"/>
    <link rel="stylesheet"type="text/css" href="{{ asset('assetsMarketplace/css/styles.css')}}"/>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <!-- Icons -->
<link rel="stylesheet" href="{{ asset('assetsMarketplace/assets/fonts/font-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assetsMarketplace/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsMarketplace/assets/css/jqueryui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assetsMarketplace/assets/css/styles.css') }}">

<!-- Favicon and Touch Icons -->
<link rel="shortcut icon" href="{{ asset('assetsMarketplace/assets/images/logo/favicon.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('assetsMarketplace/assets/images/logo/favicon.png') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    
</head>

<body>
    @yield('content')
    <!-- Javascript -->
<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSiPhoDaOJ7aqtJVtQhYhLzwwJ7rQlmA"></script>

<!-- Local Scripts -->
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/swiper-bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/plugin.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/jquery.nice-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/rangle-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/countto.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/shortcodes.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/animation_heading.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/main.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/map-single.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/marker.js') }}"></script>
<script src="{{ asset('assetsMarketplace/js/infobox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/chart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/chart-init.js') }}"></script>
<script type="text/javascript" src="{{ asset('assetsMarketplace/js/jqueryui.min.js') }}"></script>

<!-- Dashboard Menu -->
<script type="text/javascript" src="{{ asset('js/dashboard-menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard-menu.min.js') }}"></script>





    
</body>
</html>
