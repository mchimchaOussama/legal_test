
          <div wire:ignore.self class="modal fade" id="addModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                  <div class="h3">Ajouter Thématiques</div>
                  </div>
                </div>
                
                <form wire:submit="ajouter_thematique" autocomplete="off">

                <div class="modal-body pb-0">

                    <div class="row">

                      <div class="col-12 mb-3">
                        <!-- header media -->
                        <div class="media">
                            <a href="javascript:void(0);" class="mr-25">
                                
                                @if($image)
                                <img src="{{ $image->temporaryUrl() }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                @else
                                <img src="{{ asset('/assets/images/produit.png') }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                @endif
                            </a>
                            <!-- upload and reset button -->
                            <div class="media-body mt-75 ml-1">
                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Télécharger</label>
                                <input type="file" id="account-upload" hidden accept="image/png, image/jpg, image/jpeg" wire:model="image" />
                                <button class="btn btn-sm btn-outline-secondary mb-75" wire:click="supprimer_image">Supprimer</button>
                                <span class="d-block">JPG, JPEG ou PNG autorisé.</span>
                            </div>
                            <!--/ upload and reset button -->
                        </div>
                        <!--/ header media -->
                      </div>

                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>theme</label>
                              <!-- <input type="text" class="form-control  @error('theme') is-invalid @enderror" placeholder="saisie la thématique" wire:model="theme" autocomplete="off" /> -->
                              <select name="theme" id="theme" wire:model="theme" class="form-control  @error('theme') is-invalid @enderror" > 
                                <option value="" selected>saisie le théme</option>
                                <option value="enrRenouvelabl">energie renouvlable</option>
                                <option value="enr">energie gaz /électrique</option>
                                <option value="telecom">telecom</option>
                                <option value="formationB2B">formation B2B</option>
                                <option value="formationB2C">formation B2C</option>
                              </select>
                              <span class="error">
                                  @error("theme") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>


                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>Thematique</label>
                              <input type="text" class="form-control  @error('thematique') is-invalid @enderror" placeholder="saisie la thématique" wire:model="thematique" autocomplete="off" />
                              <span class="error">
                                  @error("thematique") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>


                      <div class="col-12">
                        <div class="form-group mb-1">
                            <label>B2B / B2C</label>
                            <select class="form-control @error('business_type') is-invalid @enderror" wire:model="business_type">
                                <option value="" selected>sélectionner le type</option>
                                <option value="B2B" >B2B</option>
                                <option Value="B2C" >B2C</option>
                            </select>
                            <span class="error">
                                @error("business_type") {{$message}}  @enderror
                            </span>
                        </div>
                      </div>

                    </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="custom-btn" wire:loading.class="disabled">  
                        <div wire:loading><span class="spinner"></span></div>
                        <span wire:loading.remove>Ajouter</span>
                    </button>
                  </div>

                </form>
                
              </div>
            </div>
          </div>
          <!----------------- End Modal ----------------->