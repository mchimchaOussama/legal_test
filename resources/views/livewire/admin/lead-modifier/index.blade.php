<div>

@section("title")
        Modifier Lead
    @endsection

    @section("page-title")
        Modifier Lead
    @endsection

    <form wire:submit="update_lead" autocomplete="off">
            <div class="row">

                        <div class="col-md-7 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lead</h3>
                                </div>
                                <div class="card-body">
                                    
                                        <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Agent</label>
                                            <input type="text" class="form-control  @error('agent') is-invalid @enderror" placeholder="agent" wire:model="agent" autocomplete="off" />
                                            <span class="error">
                                                @error("agent") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Heure</label>
                                            <input type="time" class="form-control @error('heure') is-invalid @enderror" placeholder="saisie le prénom" wire:model="heure" autocomplete="off" />
                                            <span class="error">
                                                @error("heure") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Date</label>
                                            <input type="date" class="form-control  @error('date') is-invalid @enderror" placeholder="saisie la date" wire:model="date" autocomplete="off" />
                                            <span class="error">
                                                @error("date") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">

                                            <label>Disponibilité</label>
                                            <select class="form-control @error('disponibilite') is-invalid @enderror" wire:model="disponibilite">
                                                <option value="">Sélectionner</option>
                                                <option value="matin">Matin</option>
                                                <option value="apres midi">Aprés midi</option>
                                                <option value="soiree">soiree</option>
                                            </select>
                                            <span class="error">
                                                @error("disponibilite") {{$message}}  @enderror
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Appel d'Agent (Lien d'Audio)</label>
                                            <input type="url" class="form-control @error('mp3Original') is-invalid @enderror" placeholder="saisie le lien d'audio" wire:model="mp3Original" autocomplete="off" />
                                            <span class="error">
                                                @error("mp3Original") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Commentaire Agent</label>
                                            <input type="text" class="form-control @error('commentaireAgent') is-invalid @enderror" placeholder="saisie le commentaire" wire:model="commentaireAgent" autocomplete="off" />
                                            <span class="error">
                                                @error("commentaireAgent") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Ville</label>

                                            <select class="form-control  @error('ville') is-invalid @enderror"
                                                    wire:model="ville"
                                                    data-live-search="true"
                                                    data-style="form-control"
                                                    title="Sélectionner une ville">
                                                <option value="" disabled selected>Sélectionner</option>  
                                                @foreach($ville_array as $Ville)
                                                    <option value='{{ $Ville->id }}'>{{ $Ville->ville }}</option>
                                                @endforeach
                                            </select>


                                            <span class="error">
                                                @error("ville") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Département</label>                                  
                                            <select class="form-control  @error('departement') is-invalid @enderror"
                                                    wire:model="departement"
                                                    data-live-search="true"
                                                    data-style="form-control"
                                                    title="Sélectionner une departement">
                                                <option value="" disabled selected>Sélectionner</option>  
                                                @foreach($departement_array as $Departement)
                                                    <option value='{{ $Departement->id }}'>{{ $Departement->departement }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error">
                                                @error("departement") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Code Postale</label>
                                            <input type="number" class="form-control  @error('code_postale') is-invalid @enderror" placeholder="saisie le code postale" wire:model="code_postale" autocomplete="off" />
                                            <span class="error">
                                                @error("code_postale") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Propriétaire</label>
                                            <select class="form-control @error('proprietaire') is-invalid @enderror" wire:model="proprietaire">
                                                <option value="">Sélectionner</option>
                                                <option value="oui">Oui</option>
                                                <option value="non">Non</option>
                                            </select>
                                            <span class="error">
                                                @error("proprietaire") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Métrage</label>
                                            <input type="number" class="form-control  @error('metrage') is-invalid @enderror" placeholder="saisie le métrage" wire:model="metrage" autocomplete="off" />
                                            <span class="error">
                                                @error("metrage") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control  @error('adresse') is-invalid @enderror" placeholder="saisie l'adresse" wire:model="adresse" autocomplete="off" />
                                            <span class="error">
                                                @error("adresse") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Thématique</label>
                                            <select class="form-control  @error('thematique') is-invalid @enderror"
                                                    wire:model="thematique"
                                                    data-live-search="true"
                                                    data-style="form-control"
                                                    title="Sélectionner une thématique">
                                                <option value="" disabled selected>Sélectionner</option>
                                                @foreach($thematique_array as $Thematique)
                                                <option value="{{ $Thematique->id }}" 
                                                        @if ($thematique == $Thematique->id) selected @endif>
                                                    {{ $Thematique->thematique }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span class="error">
                                                @error("thematique") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Mode Consomation</label>
                                            <input type="text" class="form-control @error('modeConsommation') is-invalid @enderror" placeholder="saisie le mode de consommation" wire:model="modeConsommation" autocomplete="off" />
                                            <span class="error">
                                                @error("modeConsommation") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Maison</label>
                                                <select class="form-control @error('maison') is-invalid @enderror" wire:model="maison">
                                                    <option value="" selected>Maison</option>
                                                    <option value="oui" >Oui</option>
                                                    <option Value="non" >Non</option>
                                                </select>
                                                <span class="error">
                                                    @error("maison") {{$message}}  @enderror
                                                </span>
                                            </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Interet d'amelioration de l'habitat</label>
                                                <input type="text" class="form-control @error('interetAmeliorationHabitat') is-invalid @enderror" placeholder="saisie Interet d'amelioration de l'habitat" wire:model="interetAmeliorationHabitat" autocomplete="off" />
                                                <span class="error">
                                                    @error("interetAmeliorationHabitat") {{$message}}  @enderror
                                                </span>
                                            </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Commentaire Auditeur</label>
                                            <input type="text" class="form-control  @error('commentaireAuditeur') is-invalid @enderror" placeholder="saisie le commentaire" wire:model="commentaireAuditeur" autocomplete="off" />
                                            <span class="error">
                                                @error("commentaireAuditeur") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Audio Bipé (Lien)</label>
                                            <input type="text" class="form-control @error('mp3Bipe') is-invalid @enderror" placeholder="saisie le lien" wire:model="mp3Bipe" autocomplete="off" />
                                            <span class="error">
                                                @error("mp3Bipe") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse cachée (Google Map)</label>
                                            <input type="text" class="form-control @error('adresse_cache') is-invalid @enderror" placeholder="saisie l'iFrame" wire:model="adresse_cache" autocomplete="off" />
                                            <span class="error">
                                                @error("adresse_cache") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Prix</label>
                                            <input type="number" class="form-control @error('prix') is-invalid @enderror" placeholder="saisie le prix" wire:model="prix" autocomplete="off" />
                                            <span class="error">
                                                @error("prix") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse Réelle (Google Map)</label>
                                            <input type="text" class="form-control  @error('adresse_reelle') is-invalid @enderror" placeholder="saisie l'iframe'" wire:model="adresse_reelle" autocomplete="off" />
                                            <span class="error">
                                                @error("adresse_reelle") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="d-block" for="validationBioBootstrap">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="saisie la description" wire:model="description" autocomplete="off" rows="3"></textarea>
                                            <span class="error">
                                                @error("description") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                       
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Prospect</h2>
                                </div>
                                <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Nom</label>
                                            <input type="text" class="form-control  @error('nom') is-invalid @enderror" placeholder="saisie le nom" wire:model="nom" autocomplete="off"  />
                                            <span class="error">
                                                @error("nom") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Prénom</label>
                                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="saisie le prénom" wire:model="prenom" autocomplete="off" />
                                            <span class="error">
                                                @error("prenom") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Tel</label>
                                            <input type="number" class="form-control @error('tel') is-invalid @enderror" placeholder="saisie tel" wire:model="tel" autocomplete="off" />
                                            <span class="error">
                                                @error("tel") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Email</label>
                                            <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="saisie l'email" wire:model="email" autocomplete="off" />
                                            <span class="error">
                                                @error("email") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Civilité</label>
                                            <select class="form-control" wire:model="civilite">
                                                <option value="" selected>Civilité</option>
                                                <option value="Mr" >Mr</option>
                                                <option Value="Mme" >Mme</option>
                                            </select>
                                            <span class="error">
                                                @error("email") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            </div>
                        
                            <div class="col-12 mx-0">
                                <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                                    <div wire:loading><span class="spinner"></span></div>
                                    <span wire:loading.remove>Modifier</span>
                                </button>
                            </div>
                                 
             </div>
    </form>
                </div>