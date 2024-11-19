<div>

    @section("title")
        Profil
    @endsection

    @section("page-title")
        PROFIL
    @endsection



    <div class="card mb-3">

        <div class="card-body">

            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                <!-- header media -->
                <div class="media">
                    <a href="javascript:void(0);" class="mr-25">
                        
                        @if($profil_file)
                            <img src="{{ $profil_file->temporaryUrl() }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                        @else

                            @if(session("auth")["profil_image"] && !empty(session("auth")["profil_image"]))
                                <img src="{{ asset('/storage/'.session('auth')['profil_image']) }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                            @else
                                <img src="{{ asset('/assets/images/profil.png') }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                            @endif

                        @endif
                    </a>
                    <!-- upload and reset button -->
                    <div class="media-body mt-75 ml-1">
                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Télécharger</label>
                        <input type="file" id="account-upload" hidden accept="image/png, image/jpg, image/jpeg" wire:model="profil_file" />
                        <button class="btn btn-sm btn-outline-secondary mb-75" wire:click="supprimer_profil">Supprimer</button>
                        <p>JPG, JPEG ou PNG autorisé.</p>
                    </div>
                    <!--/ upload and reset button -->
                </div>
                <!--/ header media -->

                <!-- form -->
                <form class="validate-form mt-2" wire:submit="update_profile" autocomplete="off">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-1">
                                <label>Nom</label>
                                <input type="text" class="form-control  @error('nom') is-invalid @enderror" placeholder="saisie le nom" wire:model="nom" autocomplete="off" />
                                <span class="error">
                                    @error("nom") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-1">
                                <label>Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="saisie le prénom" wire:model="prenom" autocomplete="off" />
                                <span class="error">
                                    @error("prenom") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-1">
                                <label>Nom d'utilisateur</label>
                                <input type="text" class="form-control" placeholder="" wire:model="nom_utilisateur" autocomplete="off" />
                                <span class="error">
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-1">
                                <label>Rôle</label>
                                <input type="text" class="form-control" placeholder="" wire:model="role" autocomplete="off" />
                                <span class="error">
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                                <div wire:loading><span class="spinner"></span></div>
                                <span wire:loading.remove>Modifier</span>
                            </button>

                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
            <!--/ general tab -->

        </div>

    </div>


    <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="h3 fw-bold mb-0">MODIFIER MOT DE PASSE</div>
    </div>


    <div class="card">
        <div class="card-body">

            <!-- form -->
            <form class="validate-form mt-2" wire:submit="update_password" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group mb-1">
                            <label>Mot de passe actuel</label>
                            <input type="password" class="form-control  @error('current_password') is-invalid @enderror" placeholder="saisie le nom" wire:model="current_password" autocomplete="off" />
                            <span class="error">
                                @error("current_password") {{$message}}  @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group mb-1">
                            <label>Nouveau mot de passe</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="saisie le nom" wire:model="password" autocomplete="off" />
                            <span class="error">
                                @error("password") {{$message}}  @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group mb-1">
                            <label>Confirmez le mot de passe</label>
                            <input type="password" class="form-control" placeholder="saisie le nom" wire:model="password_confirmation" autocomplete="off" />
                            <span class="error">
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                            <div wire:loading><span class="spinner"></span></div>
                            <span wire:loading.remove>Modifier</span>
                        </button>

                    </div>
                </div>
            </form>
            <!--/ form -->

        </div>
    </div>


</div>