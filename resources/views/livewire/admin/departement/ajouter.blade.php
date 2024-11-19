          <div wire:ignore.self class="modal fade" id="addModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                
                <div class="w-100 text-center pt-3 mb-2">
                  <div class="w-100">
                    <div class="h3">Ajouter Département</div>
                  </div>
                </div>
          
                <form wire:submit="ajouter_departement" autocomplete="off">

                  <div class="modal-body pb-0">

                      <div class="row">

                      <div class="col-12">
                            <div class="form-group mb-1">
                                <label>N°</label>
                                <input type="text" class="form-control  @error('num') is-invalid @enderror" placeholder="saisie N°" wire:model="num" autocomplete="off" />
                                <span class="error">
                                    @error("num") {{$message}}  @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label>département</label>
                                <input type="text" class="form-control  @error('departement') is-invalid @enderror" placeholder="saisie la departement" wire:model="departement" autocomplete="off" />
                                <span class="error">
                                    @error("departement") {{$message}}  @enderror
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