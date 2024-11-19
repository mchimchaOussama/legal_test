
<div wire:ignore.self class="modal fade edit-modal" tabindex="-1" role="dialog" id="modifierModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                  <div class="h3">Modifier Département</div>
                  </div>
                </div>
                
                <form wire:submit="modifier_departement_yes" autocomplete="off">

                <div class="modal-body pb-0">

                    <div class="row">

                    <div class="col-12">
                          <div class="form-group mb-1">
                              <label>N°</label>
                              <input type="text" class="form-control  @error('new_num') is-invalid @enderror" placeholder="saisie N°" wire:model="new_num" autocomplete="off" />
                              <span class="error">
                                  @error("new_num") {{$message}}  @enderror
                              </span>
                          </div>
                      </div>

                      <div class="col-12">
                          <div class="form-group mb-1">
                              <label>Département</label>
                              <input type="text" class="form-control  @error('new_departement') is-invalid @enderror" placeholder="saisie la departement" wire:model="new_departement" autocomplete="off" />
                              <span class="error">
                                  @error("new_departement") {{$message}}  @enderror
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