<div>

    @section("title")
        Ajouter un compte
    @endsection

    @section("page-title")
        AJOUTER UN COMPTE
    @endsection



    <div class="card">
        <div class="card-body">

        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
        <!-- header media -->
        <div class="media">
            <a href="javascript:void(0);" class="mr-25">
                
                @if($profil_file)
                <img src="{{ $profil_file->temporaryUrl() }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                @else
                <img src="{{ asset('/assets/images/profil.png') }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
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
        <form class="validate-form mt-2" wire:submit="ajouter_compte" autocomplete="off">
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
                        <input type="text" class="form-control @error('nom_utilisateur') is-invalid @enderror" placeholder="saisie le nom d'utilisateur" wire:model="nom_utilisateur" autocomplete="off" />
                        <span class="error">
                            @error("nom_utilisateur") {{$message}}  @enderror
                        </span>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mb-1">
                        <label>Rôle</label>
                        <select class="form-control @error('role') is-invalid @enderror" wire:model="role">
                            <option selected value="" >Sélectionner un rôle</option>
                            <option value="1">Superviseur</option>
                            <option value="2">Administrateur</option>
                        </select>
                        <span class="error">
                            @error("role") {{$message}}  @enderror
                        </span>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mb-1">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="saisie le mot de passe" wire:model="password" autocomplete="off" />
                        <span class="error">
                            @error("password") {{$message}}  @enderror
                        </span>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mb-1">
                        <label>Confirmer mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="confirmer mot de passe" wire:model="password_confirmation" autocomplete="off" />
                        <div class="error"></div>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                        <div wire:loading><span class="spinner"></span></div>
                        <span wire:loading.remove>Ajouter</span>
                    </button>

                </div>
            </div>
        </form>
        <!--/ form -->
    </div>
    <!--/ general tab -->


        </div>
    </div>

</div>