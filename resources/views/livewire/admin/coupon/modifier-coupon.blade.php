
<div wire:ignore.self class="modal fade edit-modal" tabindex="-1" role="dialog" id="modifierModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                  <div class="h3">Modifier Coupon</div>
                  </div>
                </div>
                
                <form wire:submit="modifier_thematique_yes" autocomplete="off">
                  <div class="modal-body pb-0">

                    <div class="row">

                      <div class="col-12 mb-3">
                            
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