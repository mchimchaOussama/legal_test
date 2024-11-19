
<div wire:ignore.self class="modal fade" id="addModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                  <div class="h3">Ajouter ville</div>
                  </div>
                </div>
                
                <form wire:submit="ajouter_ville" autocomplete="off">

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
                              <label>ville</label>
                              <input type="text" class="form-control  @error('ville') is-invalid @enderror" placeholder="saisie la ville" wire:model="ville" autocomplete="off" />
                              <span class="error">
                                  @error("ville") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>code postale</label>
                              <input type="text" class="form-control  @error('code_postale') is-invalid @enderror" placeholder="saisie code postale" wire:model="code_postale" autocomplete="off" />
                              <span class="error">
                                  @error("code_postale") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>

                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>distinct</label>
                              <select class="form-control" wire:model="featured">
                                <option value="0" selected>Non</option>
                                <option value="1" >Oui</option>
                              </select>
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