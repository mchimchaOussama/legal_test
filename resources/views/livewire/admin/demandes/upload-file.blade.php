    <!---------- Modal Ajouyer ---------->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="importer-excel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body py-0 pt-2">
                    <form autocomplete="off"> 

                        <div class="row">
                            <div class="col-6 form-group mb-0">
                                <label class="fw-bold">Entreprise</label>
                                <input type="text" class="form-control" readonly id="upload_entreprise">
                            </div>
                            <div class="col-6 form-group mb-0">
                                <label class="fw-bold">Quantité</label>
                                <input type="text" class="form-control" readonly id="upload_quantite">
                            </div>
                        </div>

                        <div class="w-100 pt-2">
                            <label role="button" class="upload-file" for="import-file-excel">

                                <div class="upload-file-box mt-3">
                                    <div class="w-100 text-center mb-3">
                                        <i class="fa-solid fa-cloud-arrow-up fa-lg"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="h4">Cliquez Pour Télécharger</div>
                                    </div>
                                </div>

                            </label>
                        </div>

                        <input class="d-none" type="file" accept=".xls,.xlsx" id="import-file-excel" wire:model="excel" />

                        <div class="w-100 py-1">
                            <div class="custom-progress">
                                <div class="progress-bar" style="width:{{ $progress }}%"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>