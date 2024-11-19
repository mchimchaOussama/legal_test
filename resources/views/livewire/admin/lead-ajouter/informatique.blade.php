<div>

@section("title")
    Formation-B2C
    @endsection

    @section("page-title")
     Formation-B2C
    @endsection

        <div class="card">
            <div class="card-body py-0">

                    <div class="form-wizard">

                        <div class="form-wizard-header py-3">

                            <div class="form-wizard-header-box mb-2 @if($step == 1) active @endif">
                                <div class="step">1</div>
                                <div class="title">Prospect</div>
                            </div>

                            <div class="form-wizard-header-box mb-2 @if($step == 2) active @endif">
                                <div class="step">2</div>
                                <div class="title">L'appel</div>
                            </div>

                            <div class="form-wizard-header-box mb-2 @if($step == 3) active @endif">
                                <div class="step">3</div>
                                <div class="title">Localisation</div>
                            </div>

                            <div class="form-wizard-header-box mb-2 @if($step == 4) active @endif">
                                <div class="step">4</div>
                                <div class="title">Lead</div>
                            </div>

                            <div class="form-wizard-header-box mb-0 @if($step == 5) active @endif">
                                <div class="step">5</div>
                                <div class="title">Publicité</div>
                            </div>
                            

                        </div>

                        <div class="form-wizard-body-container">
                            
                            <!---------- Step 1 ----------->
                            @if($step == 1)
                            <form  wire:submit="ajouter_lead_step1" autocomplete="off">
                                <div class="form-wizard-body py-3 active">

                                    <div class="h2 mb-2">Prospect</div>

                                    <!------ Row --------->
                                    <div class="row mb-2">


                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Nom</label>
                                                <input type="text" class="form-control  @error('nom') is-invalid @enderror" placeholder="saisie le nom" wire:model="nom" autocomplete="off" />
                                                <span class="error">
                                                    @error("nom") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Prénom</label>
                                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="saisie le prénom" wire:model="prenom" autocomplete="off" />
                                                <span class="error">
                                                    @error("prenom") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Tel</label>
                                                <input type="number" class="form-control @error('tel') is-invalid @enderror" placeholder="saisie tel" wire:model="tel" autocomplete="off" />
                                                <span class="error">
                                                    @error("tel") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Email</label>
                                                <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="saisie l'email" wire:model="email" autocomplete="off" />
                                                <span class="error">
                                                    @error("email") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Civilité</label>
                                                <select class="form-control @error('civilite') is-invalid @enderror" wire:model="civilite">
                                                    <option value="" selected>Civilité</option>
                                                    <option value="Mr" >Mr</option>
                                                    <option Value="Mme" >Mme</option>
                                                </select>
                                                <span class="error">
                                                    @error("civilite") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Salarié</label>
                                                <select class="form-control @error('salarie') is-invalid @enderror" wire:model="salarie">
                                                    <option value="" selected>Salarié</option>
                                                    <option value="oui" >Oui</option>
                                                    <option Value="non" >Non</option>
                                                </select>
                                                <span class="error">
                                                    @error("salarie") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Salarie</label>
                                                <select class="form-control @error('datSalarie') is-invalid @enderror" wire:model="datSalarie">
                                                    <option value="" selected>Salarié</option>
                                                    <option value="2" >Plus De 2 Ans</option>
                                                    <option Value="3" >Plus De 3 Ans</option>
                                                </select>
                                                <span class="error">
                                                    @error("datSalarie") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>



                                    </div>
                                    <!------ End Row ------>

                                </div>

                                <!---- Pagination ---->
                                <div class="w-100 d-flex justify-content-between align-items-center form-wizard-pagination">
                                    <button class="prev btn btn-secondary btn-pagination" type="button" wire:click="previousSection">Précédent</button>

                                    <button class="next btn btn-secondary btn-pagination" type="submit">Suivant</button>
                                </div>
                                <!--- End Pagination --->

                            </form>
                            @endif
                            <!---------- End Step 1 ----------->


                            <!---------- Step 2 ----------->
                            @if($step == 2)
                            <form  wire:submit="ajouter_lead_step2" autocomplete="off">
                                <div class="form-wizard-body py-3">

                                    <div class="h2 mb-2">L'appel</div>

                                    <!------- Row ---------->
                                    <div class="row mb-2">

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
                                                    <option value="soiree">soirée</option>
                                                </select>
                                                <span class="error">
                                                    @error("disponibilite") {{$message}}  @enderror
                                                </span>

                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Appel d'Agent (Lien d'Audio)</label>
                                                <input type="text" class="form-control @error('lienMp3') is-invalid @enderror" placeholder="saisie le lien d'audio" wire:model="lienMp3" autocomplete="off" />
                                                <span class="error">
                                                    @error("lienMp3") {{$message}}  @enderror
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


                                    </div>
                                    <!------- End Row --------->

                                </div>
                                <!---- Pagination ---->
                                <div class="w-100 d-flex justify-content-between align-items-center form-wizard-pagination">
                                    <button class="prev btn btn-secondary btn-pagination" type="button" wire:click="previousSection">Précédent</button>

                                    <button class="next btn btn-secondary btn-pagination" type="submit">Suivant</button>
                                </div>
                                <!--- End Pagination --->
                            </form>
                            @endif
                            <!------- End Step 2 --------->


                            <!--------- Step 3---------->
                            @if($step == 3)
                            <form  wire:submit="ajouter_lead_step3" autocomplete="off">

                                <div class="form-wizard-body py-3">

                                    <div class="h2 mb-2">Localisation</div>

                                    <!------- Row -------->
                                    <div class="row mb-2">

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Ville</label>
                                                
                                                <select class="form-control @error('ville') is-invalid @enderror"
                                                        wire:model="ville"
                                                        data-live-search="true"
                                                        data-style="form-control"
                                                        title="Sélectionner une ville">
                                                    <option   selected="">Sélectionner</option>  
                                                    @foreach($ville_array as $Ville)
                                                        <option value='{{ $Ville->id }}'>{{ $Ville->ville }}</option>
                                                    @endforeach
                                                </select>
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
                                                    <option  selected=''>Sélectionner</option>  
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
                                                <label>Adresse</label>
                                                <input type="text" class="form-control  @error('adresse') is-invalid @enderror" placeholder="saisie l'adresse" wire:model="adresse" autocomplete="off" />
                                                <span class="error">
                                                    @error("adresse") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <!---- Pagination ---->
                                <div class="w-100 d-flex justify-content-between align-items-center form-wizard-pagination">
                                    <button class="prev btn btn-secondary btn-pagination" type="button" wire:click="previousSection">Précédent</button>

                                    <button class="next btn btn-secondary btn-pagination" type="submit">Suivant</button>
                                </div>
                                <!--- End Pagination --->

                            </form>
                            @endif
                            <!--------- End Step 3 ----------->


                            <!--------- Step 4---------->
                            @if($step == 4)
                            <form  wire:submit="ajouter_lead_step4" autocomplete="off">
                                <div class="form-wizard-body py-3">

                                    <div class="h2 mb-2">Lead</div>

                                    <!------- Row -------->
                                    <div class="row mb-2">

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Thématique</label>
                                                <select class="form-control  @error('thematique') is-invalid @enderror"
                                                        wire:model="thematique"
                                                        data-live-search="true"
                                                        data-style="form-control"
                                                        title="Sélectionner une thématique">
                                                    <option   selected=''>Sélectionner</option>
                                                    
                                                    @foreach($thematique_array as $Thematique)
                                                        <option value='{{ $Thematique->id }}'>{{ $Thematique->thematique }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error">
                                                    @error("thematique") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-1">
                                                <label>Langues</label>
                                                <select class="form-control @error('lange2') is-invalid @enderror" wire:model="lange2">
                                                    <option value="" selected>Langues</option>
                                                    <option value="informatique" >Informatique</option>
                                                    <option Value="marketing" >Marketing</option>
                                                    <option Value="comptabilité" >Comptabilité</option>
                                                    <option Value="gestion" >Gestion</option>
                                                </select>
                                                <span class="error">
                                                    @error("lange2") {{$message}}  @enderror
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
                                                <input type="text" class="form-control @error('lienMp3bip') is-invalid @enderror" placeholder="saisie le lien" wire:model="lienMp3bip" autocomplete="off" />
                                                <span class="error">
                                                    @error("lienMp3bip") {{$message}}  @enderror
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

                                    </div>

                                </div>

                                <!---- Pagination ---->
                                <div class="w-100 d-flex justify-content-between align-items-center form-wizard-pagination">
                                    <button class="prev btn btn-secondary btn-pagination" type="button" wire:click="previousSection">Précédent</button>
                                    <button class="next btn btn-secondary btn-pagination" type="submit">Suivant</button>
                                </div>
                                <!--- End Pagination --->
                            </form>
                            @endif
                            <!--------- End Step 4 ----------->


                            <!--------- Step 5---------->
                            @if($step == 5)
                            <form  wire:submit="ajouter_lead_step5" autocomplete="off">
                                <div class="form-wizard-body py-3">

                                    <div class="h2 mb-2">Publicité</div>

                                    <!------- Row -------->
                                    <div class="row mb-2">


                                        <div class="w-100"></div>

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
                                            <div class="form-group" style="margin-bottom:10px">
                                                <label>Description</label>
                                                <textarea class="form-control" class="form-control @error('description') is-invalid @enderror" placeholder="saisie la description" wire:model="description" autocomplete="off" rows="5"></textarea>
                                                <span class="error">
                                                    @error("description") {{$message}}  @enderror
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <!---- Pagination ---->
                                <div class="w-100 d-flex justify-content-between align-items-center form-wizard-pagination">
                                    <button class="prev btn btn-secondary btn-pagination" type="button" wire:click="previousSection">Précédent</button>
                                    @if($step == $maxSteps)
                                        <button class="form-wizard-submit custom-btn" type="submit">Ajouter</button>
                                    @else
                                        <button class="next btn btn-secondary btn-pagination" type="submit">Suivant</button>
                                    @endif
                                </div>
                                <!--- End Pagination --->
                            </form>
                            @endif
                            <!--------- End Step 5 ----------->






                        </div>

                    </div>

                </form>


            </div>
        </div>
    </form>

</div>