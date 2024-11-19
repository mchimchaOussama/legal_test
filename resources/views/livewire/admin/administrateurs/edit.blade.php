    <!--------- Edit Modal ------------>
    <div wire:ignore.self class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="w-100 text-center">
                            <div class="w-100 mb-1">
                                <i class="fa-regular fa-pen-to-square text-secondary"></i>
                            </div>
                            <h4 class="modal-title text-secondary">Modifier Compte</h4>
                        </div>
                    </div>
                    <div class="modal-body pb-2">

                        <form wire:submit="modifier_user_yes" class="w-100">

                            <div class="mb-1">
                                <label class="form-label mb-0">Nom:</label>
                                <input type="text" class="form-control @error('new_nom') is-invalid @enderror" wire:model="new_nom" >
                                <span class="error">@error("new_nom") {{ $message }} @enderror</span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label mb-0">Prénom:</label>
                                <input type="text" class="form-control @error('new_prenom') is-invalid @enderror" wire:model="new_prenom" >
                                <span class="error">@error("new_prenom") {{ $message }} @enderror</span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label mb-0">Nom d'utilisateur:</label>
                                <input type="text" class="form-control @error('new_nom_utilisateur') is-invalid @enderror" wire:model="new_nom_utilisateur" >
                                <span class="error">@error("new_nom_utilisateur") {{ $message }} @enderror</span>
                            </div>

                            <div class="mb-1">
                                <label>Rôle</label>
                                <select class="form-control @error('new_role') is-invalid @enderror" wire:model="new_role">
                                    <option value="" >Sélectionner un rôle</option>
                                    <option value="1">Administrateur</option>
                                    <option value="2">Superviseur</option>
                                </select>
                                <span class="error">
                                    @error("new_role") {{$message}}  @enderror
                                </span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label mb-0">Mot de passe:</label>
                                <input type="text" class="form-control @error('new_password') is-invalid @enderror" wire:model="new_password" >
                                <span class="error">@error("new_password") {{ $message }} @enderror</span>
                            </div>

                            <div class="mb-1">
                                <label class="form-label mb-0">Confirmez mot de passe:</label>
                                <input type="text" class="form-control" wire:model="new_password_confirmation" >
                                <span class="error"></span>
                            </div>


                            <button type="submit" class="custom-btn w-100" wire:loading.class="disabled">
                                <div wire:loading><span class="spinner"></span></div>
                                <div wire:loading.remove>Modifier</div>
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>