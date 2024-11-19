<div>

    @section("title")
    Paramètres
    @endsection

    <div class="h2 fw-bold mb-1">PARAMÈTRES</div>



    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card mb-3">
                <form wire:submit="mailer" class="px-0" autocomplete="off">
                    <div class="card-body">

                        <h5 class="card-title mb-3">Mailer</h5>

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" placeholder="Host" autocomplete="off" wire:model="email">
                                <span class="error">
                                    @error("host") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label>Nom d'utilisateur</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Saisie le nom d'utilisateur" autocomplete="off" wire:model="tel">
                                <span class="error">
                                    @error("username") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group mb-1">
                                <label>Mot de passe</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" placeholder="Saisie le mot de passe" autocomplete="off" wire:model="password">
                                <span class="error">
                                    @error("password") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12 px-0">
                            <div class="form-group mb-1">
                                <label>Port</label>
                                <input type="text" class="form-control @error('port') is-invalid @enderror" placeholder="Saisie le port" autocomplete="off" wire:model="port">
                                <span class="error">
                                    @error("port") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                            <div wire:loading><span class="spinner"></span></div>
                            <span wire:loading.remove>Modifier</span>
                        </button>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card mb-3">
                <form wire:submit="mailer" class="px-0" autocomplete="off">
                    <div class="card-body">

                        <h5 class="card-title mb-3">SMS</h5>

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" placeholder="Host" autocomplete="off" wire:model="email">
                                <span class="error">
                                    @error("host") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label>Nom d'utilisateur</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Saisie le nom d'utilisateur" autocomplete="off" wire:model="tel">
                                <span class="error">
                                    @error("username") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group mb-1">
                                <label>Mot de passe</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" placeholder="Saisie le mot de passe" autocomplete="off" wire:model="password">
                                <span class="error">
                                    @error("password") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12 px-0">
                            <div class="form-group mb-1">
                                <label>Port</label>
                                <input type="text" class="form-control @error('port') is-invalid @enderror" placeholder="Saisie le port" autocomplete="off" wire:model="port">
                                <span class="error">
                                    @error("port") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                            <div wire:loading><span class="spinner"></span></div>
                            <span wire:loading.remove>Modifier</span>
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6 col-md-12">
            <div class="card mb-3">
                <form wire:submit="mailer" class="px-0" autocomplete="off">
                    <div class="card-body">

                        <h5 class="card-title mb-3">Paypal</h5>

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="host">E-mail</label>
                                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" placeholder="Saisie E-mail" autocomplete="off" wire:model="email">
                                <span class="error">
                                    @error("host") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label>API Key</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Saisie Api key" autocomplete="off" wire:model="tel">
                                <span class="error">
                                    @error("username") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                            <div wire:loading><span class="spinner"></span></div>
                            <span wire:loading.remove>Modifier</span>
                        </button>

                    </div>

                </form>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card mb-3">
                <form wire:submit="mailer" class="px-0" autocomplete="off">
                    <div class="card-body">

                        <h5 class="card-title mb-3">Stripe</h5>

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="host">E-mail</label>
                                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" placeholder="Saisie E-mail" autocomplete="off" wire:model="email">
                                <span class="error">
                                    @error("host") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label>Api Key</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Saisie Api Key" autocomplete="off" wire:model="tel">
                                <span class="error">
                                    @error("username") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                            <div wire:loading><span class="spinner"></span></div>
                            <span wire:loading.remove>Modifier</span>
                        </button>

                    </div>

                </form>
            </div>
        </div>

    </div>

</div>
