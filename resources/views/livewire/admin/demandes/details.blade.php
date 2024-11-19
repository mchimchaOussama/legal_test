     <!------------ Confirmation Modal ------------->
     <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="description">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content pt-2">

            <div class="w-100 text-center pt-1">
              <div class="w-100 mb-3">
                <h2>Détails de Commande</h2>
              </div>
            </div>
            
            <div class="modal-body pb-2">
                <form action="" class="w-100">
                    <div class="row">
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Entreprise</label>
                            <input type="text" class="form-control" readonly wire:model="entreprise">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Nom et Prénom</label>
                            <input type="text" class="form-control" readonly wire:model="nom_prenom">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">E-mail</label>
                            <input type="email" class="form-control" value="0612345678" readonly wire:model="email">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Téléphone</label>
                            <input type="number" class="form-control" readonly wire:model="tel">
                        </div>

                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Nombre de leads:</label>
                            <input type="integer" class="form-control" readonly wire:model="quantite">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Date de Livraison:</label>
                            <input type="text" class="form-control" readonly wire:model="date">
                        </div>

                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Thématique(s):</label>
                            <input type="text" class="form-control" readonly wire:model="thematique">
                        </div>
                        <div class="col-6 form-group mb-2">
                            <label style="font-size:20px;font-weight:bold">Département(s):</label>
                            <input type="text" class="form-control" readonly wire:model="departement">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label style="font-size:20px;font-weight:bold">Descriptif de Commande</label>
                        <textarea class="form-control" rows="6" readonly wire:model="description"></textarea>
                    </div>
                    
                </form>
            </div>


            <div class="modal-footer pt-0 w-100 d-flex justify-content-between align-items-center">
                <div class="statut-container">
                    <select @if($prix <= 0) disabled @endif value="{{ $statut }}" class="custom-select statut
                        @if($statut === 1)
                            border-success text-success
                        @elseif($statut === 0)
                            border-danger text-danger
                        @elseif(is_null($statut))
                            border-warning text-warning
                        @endif
                        " style="width:110px" wire:change="changer_statut_modal({{ $target_id }}, $event.target.value)" id="statut-modal">
                            <option value="" disabled @if(is_null($statut)) selected @endif class="text-warning">En cours</option>
                            <option value="1" @if($statut === 1) selected @endif class="text-success">Accepté</option>
                            <option value="0" @if($statut === 0) selected @endif class="text-danger">Refusé</option>
                        </select>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
            
            
          </div>
        </div>
      </div>
      <!----------------- End Modal ----------------->