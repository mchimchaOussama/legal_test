
        <div wire:ignore.self class="modal fade edit-modal" tabindex="-1" role="dialog" id="modifierModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                  <div class="h3">Modifier Thématiques</div>
                  </div>
                </div>
                
                <form wire:submit="modifier_thematique_yes" autocomplete="off">
                  <div class="modal-body pb-0">

                    <div class="row">

                      <div class="col-12 mb-3">
                        <!-- header media -->
                        <div class="media">
                            <a href="javascript:void(0);" class="mr-25">

                                @if($upload_thematique_image)
                                    <img src="{{ $upload_thematique_image->temporaryUrl() }}" id="account-upload-img" class="rounded mr-50" alt="image" height="80" width="80" />
                                @else

                                    @if($new_image)
                                        <img src="{{ asset('/storage/'.$new_image) }}" id="account-upload-img" class="rounded mr-50" alt="image" height="80" width="80" />
                                    @else
                                        <img src="{{ asset('/assets/images/produit.png') }}" id="account-upload-img" class="rounded mr-50" alt="image" height="80" width="80" />
                                    @endif

                                @endif
                            </a>
                            <!-- upload and reset button -->
                            <div class="media-body mt-75 ml-1">
                                <label for="account-upload2" class="btn btn-sm btn-primary mb-75 mr-75">Télécharger</label>
                                <input type="file" id="account-upload2" hidden accept="image/png, image/jpg, image/jpeg" wire:model="upload_thematique_image" />
                                <button class="btn btn-sm btn-outline-secondary mb-75" wire:click="supprimer_new_image">Supprimer</button>
                                <span class="d-block">JPG, JPEG ou PNG autorisé.</span>
                            </div>
                            <!--/ upload and reset button -->
                        </div>
                        <!--/ header media -->
                      </div>
                      
                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>theme</label>
                              <select name="new_theme" id="new_theme" wire:model="new_theme" class="form-control  @error('new_theme') is-invalid @enderror" > 
                                <option value="" selected>saisie le théme</option>
                                <option value="enrRenouvelabl">energie renouvlable</option>
                                <option value="enr">energie gaz /électrique</option>
                                <option value="telecom">telecom</option>
                                <option value="formationB2B">formation B2B</option>
                                <option value="formationB2C">formation B2C</option>
                              </select>
                              <span class="error">
                                  @error("new_theme") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>

                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>Thematique</label>
                              <input type="text" class="form-control  @error('new_thematique') is-invalid @enderror" placeholder="saisie la thématique" wire:model="new_thematique" autocomplete="off" />
                              <span class="error">
                                  @error("new_thematique") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>


                      <div class="col-12">
                        <div class="form-group mb-1">
                            <label>B2B / B2C</label>
                            <select class="form-control @error('new_type_business') is-invalid @enderror" wire:model="new_type_business">
                                <option value="">sélectionner le type</option>
                                <option value="B2B">B2B</option>
                                <option Value="B2C">B2C</option>
                            </select>
                            <span class="error">
                                @error("new_type_business") {{$message}}  @enderror
                            </span>
                        </div>
                      </div>

                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                        <div wire:loading><span class="spinner"></span></div>
                        <span wire:loading.remove>Modifier</span>
                    </button>
                  </div>
                </form>
                
              </div>
            </div>
          </div>
          <!----------------- End Modal ----------------->