<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-starter"
>
  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}" />

</head>

  <body>

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-3" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
        <h2>Créer un compte</h2>
      </div>

      <div class="row justify-content-center">
        
        <div class="col-xl-9 col-lg-10 col-12">

          <form action="{{ route('register-post') }}" method="post" autocomplete="off">
            @csrf
            <div class="row">

              <div class="col-md-6 mb-2">
                <label>Nom</label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="saisie le nom" name="nom" value="{{ old('nom') }}">
                <span class="error">
                    @error("nom") {{$message}}  @enderror
                </span>
              </div>

              <div class="col-md-6 mb-2">
                <label>Prénom</label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="saisie le prénom" name="prenom" value="{{ old('prenom') }}">
                <span class="error">
                    @error("prenom") {{$message}} @enderror
                </span>
              </div>

            </div>

            <div class="mb-2">
              <label>Nom utilisateur</label>
              <input type="text" class="form-control @error('nom_utilisateur') is-invalid @enderror" placeholder="Saisie le nom utilisateur" name="nom_utilisateur" value="{{ old('nom_utilisateur') }}">
              <span class="error">
                @error("nom_utilisateur") {{$message}}  @enderror
              </span>
            </div>

            <div class="mb-2">
                <label for="address">Rôle</label>
                <select class="form-select @error('role') is-invalid @enderror" name="role">
                    <option selected value="" disabled>Sélectionner le rôle</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @if(old('role') == $role->id) selected @endif>{{ $role->role }}</option>
                    @endforeach
                </select>
                <span class="error">
                    @error("role") {{$message}}  @enderror
                </span>
            </div>

            <div class="row">

              <div class="col-md-6 mb-2">
                <label>Mot de passe</label>
                <input type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" placeholder="******" value="" name="mot_de_passe">
                <span class="error">
                    @error("mot_de_passe") {{$message}}  @enderror
                </span>
              </div>

              <div class="col-md-6 mb-2">
                <label>Confirmez le mot de passe</label>
                <input type="password" class="form-control" placeholder="******" value="" name="mot_de_passe_confirmation">
                <span class="error">
                </span>
              </div>

            </div>

            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <button class="btn btn-primary btn-lg px-5" type="submit">Créer le compte</button>
                </div>
                <div class="col-md-6 col-12 text-end">
                    <a href="{{ route('login-view') }}" class="mt-5 mb-3 text-secondary h6">J'ai un compte <span class="text-primary border-primary border-bottom">Se connecter</span></a>
                </div>
            </div>
          
          </form>

        </div>

      </div>

    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/detector.js') }}"></script>
  </body>
</html>
