<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield("title")</title>
    <link rel="icon" type="image/png" href="{{ asset('/app-assets/images/ico/favcion.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors.min.css') }}">
    <!--- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css') }}">
    
    <!-------->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/semi-dark-layout.css') }}">
    <!---------->    

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/dashboard-ecommerce.css') }}">

    <!------>
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-------->    
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/radial-progress.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/forms/form-wizard.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/plugins/forms/form-validation.css') }}">


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    @yield("style")

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="" >

    @include('admin_layout_elements.navbar')


    @include('admin_layout_elements.menu')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-header row"></div>

            <div class="content-body">

                <div class="d-flex justify-content-between align-items-center mb-1">

                    <div class="h2 fw-bold mb-0">@yield("page-title")</div>

                    <div class="elment">
                        @yield("element")
                    </div>

                </div>

                {{ $slot }}

            </div>

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><a class="ml-25" href="#" target="_blank">---</a></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button">
        <i data-feather="arrow-up"></i>
    </button>
    <!-- END: Footer-->


      <!----------- Success Modal ------------>
      <div class="modal modal-success fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="w-100 text-center pt-1">

              <div class="w-100 mb-1">
                <i class="fa-regular fa-circle-check mb-2 text-success"></i>
              </div>

              <div class="w-100">
                <h4 class="modal-title text-success">Opération Réussie</h4>
              </div>

            </div>

            <div class="modal-body text-center pb-2">
              <p class="lead">Ce processus s'est terminé avec succès</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
      <!------------ End Modal ---------------->


      <!----------- Failed Modal ------------>
      <div class="modal modal-failed fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="w-100 text-center pt-1">

              <div class="w-100 mb-1">
                <i class="fa-regular fa-circle-xmark text-danger"></i>
              </div>

              <div class="w-100">
                <h4 class="modal-title text-danger">Opération Échouée</h4>
              </div>

            </div>

            <div class="modal-body text-center pb-2">
              <p class="lead">Il y a une erreur dans ce processus</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
      <!----------- End Modal --------------->


      <!------------ Confirmation Modal ------------->
      <div class="modal modal-confirm fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="w-100 text-center pt-1">
              <div class="w-100 mb-1">
                <i class="fa-regular fa-circle-question text-warning"></i>
              </div>
              <div class="w-100">
                <h4 class="modal-title text-warning">Confirmer l'opération</h4>
              </div>
            </div>
            
            <div class="modal-body text-center pb-2">
              <p class="lead">Vous devez confirmer ce processus</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="button" class="btn btn-warning" id="modal-confirm-yes">Oui, Confirmer</button>
            </div>
            
          </div>
        </div>
      </div>
      <!----------------- End Modal ----------------->


      <!------------ Toast Success ------------>
      <div class="toast-message success">
          <div class="toast-icon">
            <i class="fa-solid fa-circle-check text-success"></i>
          </div>
          <div class="toast-text">
            <p></p>
          </div>
      </div>
      <!------------ End Toast Success --------->


      <!------------ Toast Success ------------>
      <div class="toast-message failed">
          <div class="toast-icon">
            <i class="fa-solid fa-circle-check text-danger"></i>
          </div>
          <div class="toast-text">
              <p></p>
          </div>
      </div>
      <!------------ End Toast Success --------->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/assets/js/detector.js') }}"></script>
    <script src="{{ asset('/assets/js/radial-progress.js') }}"></script>

    <!-- END: Theme JS-->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    -->
    @yield("script")


    <script>

      //////////// Confirm /////////////
      window.addEventListener("confirm", function(e){

          $(".modal-confirm").modal("toggle");

          $("#modal-confirm-yes").click(function(){
              $(".modal-confirm").modal("toggle");
              Livewire.dispatch(e.detail.targeted_function);
          });

      });

      /////////// Edit Modal ///////////
      window.addEventListener("show-edit-modal", function(e){
          $(".edit-modal").modal("toggle");
      });

    </script>

</body>
<!-- END: Body-->

</html>