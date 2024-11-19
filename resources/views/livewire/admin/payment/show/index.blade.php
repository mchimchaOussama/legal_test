<div>

    @section("title")
    Détails de vente
    @endsection

    @section("page-title")
    DÉTAILS DE VENTE
    @endsection

    <form>
            <div class="row">

                        <div class="col-md-7 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lead ({{$reference}})</h3>
                                </div>
                                <div class="card-body">
                                    
                                        <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Agent</label>
                                            <input type="text" class="form-control  @error('agent') is-invalid @enderror"  wire:model="agent" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("agent") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Heure</label>
                                            <input type="time" class="form-control @error('heure') is-invalid @enderror"  wire:model="heure" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("heure") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Date</label>
                                            <input type="date" class="form-control  @error('date') is-invalid @enderror"  wire:model="date" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("date") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                         <label>Disponibilité</label>   
                                        <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="disponibilite" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Appel d'Agent (Lien d'Audio)</label>
                                            <input type="url" class="form-control @error('mp3Original') is-invalid @enderror"  wire:model="mp3Original" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("mp3Original") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Commentaire Agent</label>
                                            <input type="text" class="form-control @error('commentaireAgent') is-invalid @enderror"  wire:model="commentaireAgent" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("commentaireAgent") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Ville</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="ville" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Département</label>                                  
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="departement" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Code Postale</label>
                                            <input type="number" class="form-control  @error('code_postale') is-invalid @enderror"  wire:model="code_postale" autocomplete="off" readonly/>
                                            <span class="error">
                                                @error("code_postale") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Propriétaire</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="proprietaire" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Métrage</label>
                                            <input type="number" class="form-control  @error('metrage') is-invalid @enderror"  wire:model="metrage" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("metrage") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control  @error('adresse') is-invalid @enderror"  wire:model="adresse" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("adresse") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Thématique</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror" wire:model="thematique" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Mode Consomation</label>
                                            <input type="text" class="form-control @error('modeConsommation') is-invalid @enderror"  wire:model="modeConsommation" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("modeConsommation") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Commentaire Auditeur</label>
                                            <input type="text" class="form-control  @error('commentaireAuditeur') is-invalid @enderror"  wire:model="commentaireAuditeur" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("commentaireAuditeur") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Audio Bipé (Lien)</label>
                                            <input type="text" class="form-control @error('mp3Bipe') is-invalid @enderror"  wire:model="mp3Bipe" autocomplete="off" readonly/>
                                            <span class="error">
                                                @error("mp3Bipe") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse cachée (Google Map)</label>
                                            <input type="text" class="form-control @error('adresse_cache') is-invalid @enderror" wire:model="adresse_cache" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("adresse_cache") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Prix</label>
                                            <input type="number" class="form-control @error('prix') is-invalid @enderror"  wire:model="prix" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("prix") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Adresse Réelle (Google Map)</label>
                                            <input type="text" class="form-control  @error('adresse_reelle') is-invalid @enderror"  wire:model="adresse_reelle" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("adresse_reelle") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Methode</label>
                                            <input type="text" class="form-control  @error('adresse_reelle') is-invalid @enderror"  wire:model="methode" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("adresse_reelle") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="d-block" for="validationBioBootstrap">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"  wire:model="description" autocomplete="off" rows="3" readonly></textarea>
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
                                            <input type="text" class="form-control  @error('nom') is-invalid @enderror"  wire:model="nom" autocomplete="off" readonly  />
                                            <span class="error">
                                                @error("nom") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Prénom</label>
                                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" wire:model="prenom" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("prenom") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Tel</label>
                                            <input type="number" class="form-control @error('tel') is-invalid @enderror"  wire:model="tel" autocomplete="off" readonly />
                                            <span class="error">
                                                @error("tel") {{$message}}  @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label>Email</label>
                                            <input type="text" class="form-control  @error('email') is-invalid @enderror"  wire:model="email" autocomplete="off" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-1">
                                            <label>Civilité</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="civilite" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Client</h2>
                                </div>

                                <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Nom & Prenom</label>
                                            <input type="text" class="form-control  @error('nom') is-invalid @enderror"  wire:model="nomPrenom_client" autocomplete="off" readonly  />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Tel</label>
                                            <input type="number" class="form-control @error('tel') is-invalid @enderror"  wire:model="tel" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control  @error('email') is-invalid @enderror"  wire:model="email_client" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Numero Identification</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="numero_identification" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Siren</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="siren" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Siret</label>
                                            <input type="text" class="form-control  @error('date') is-invalid @enderror"  wire:model="siret" autocomplete="off" readonly />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Rcs</label>
                                            <input type="text" class="form-control @error('prenom') is-invalid @enderror"  wire:model="rcs" autocomplete="off" readonly/>
                                        </div>
                                    </div>

                                    
                                </div>

                            


                            </div>
                            </div>
                            </div>

                            
                            </div>                             
             </div>
    </form>
                </div>