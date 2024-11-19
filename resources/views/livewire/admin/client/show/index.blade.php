<div>

    @section("title")
    Détails de Client
    @endsection

    @section("page-title")
    DÉTAILS DE Client
    @endsection


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Client</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Entreprise</label>
                                    <input type="text" class="form-control "  wire:model="entreprise" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Numero Identification</label>
                                    <input type="text" class="form-control "  wire:model="numero_identification" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Nom & Prenom</label>
                                    <input type="text" class="form-control "  wire:model="nomPrenom_client" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Siren</label>
                                    <input type="text" class="form-control  "  wire:model="siren" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Siret</label>
                                    <input type="text" class="form-control "  wire:model="siret" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Rcs</label>
                                    <input type="text" class="form-control "  wire:model="rcs" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Tel</label>
                                    <input type="text" class="form-control "  wire:model="tel_client" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label>Email</label>
                                    <input type="text" class="form-control "  wire:model="email_client" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-4 col-12">
                <div class="card" style="height:300px;overflow-y:auto">
                    <div class="card-body  hidden-scroll w-100 px-0" style="height:165px;overflow-y:auto">
                        <table class="custom-table w-100">
                            <thead>
                                <th>Thématique</th>
                            </thead>
                            <tbody class="custom-striped">
                                @foreach($thematiques as $thematique)
                                <tr>
                                    <td>{{$thematique->thematique}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card" style="height:300px;overflow-y:auto">
                    <div class="card-body  hidden-scroll w-100 px-0" style="height:165px;overflow-y:auto">
                        <table class="custom-table w-100">
                            <thead>
                                <th>N°</th>
                                <th>Département</th>
                            </thead>
                            <tbody class="custom-striped">
                            @foreach($departements as $departement)
                                <tr>
                                    <td>{{$departement->num}}</td>
                                    <td>{{$departement->departement}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card" style="height:300px;overflow-y:auto">
                    <div class="card-body  hidden-scroll w-100 px-0" style="height:165px;overflow-y:auto">
                        <table class="custom-table w-100">
                            <thead>
                                <th>Code postale</th>
                                <th>Ville</th>
                            </thead>
                            <tbody class="custom-striped">
                            @foreach($villes as $ville)
                                <tr>
                                    <td>{{$ville->code_postale_id}}</td>
                                    <td>{{$ville->ville}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>







            <div class="col-md-12 col-12">

            <div class="h2 fw-bold mb-1">ACHATS</div>

                <div class="card" style="max-height:300px;overflow-y:auto;">
                    <div class="card-body">
                        <div class="row">
                        <table class="custom-table w-100">
                                <thead>
                                    <th>Prospect</th>
                                    <th>Thématique</th>
                                    <th>Mode Consommation</th>
                                    <th>Département</th>
                                    <th>Methode</th>
                                    <th>Prix</th>
                                    <th>Action</th>
                                </thead>
                                <tbody class="custom-striped">
                                @foreach($payments as $payment)

                                    <tr>
                                        <td>{{$payment->prospect->nom}} {{$payment->prospect->prenom}} </td>
                                        <td>{{$payment->thematique->thematique}}</td>
                                        <td>{{$payment->lead->modeConsommation}}</td>
                                        <td>{{$payment->departement->departement}}</td>
                                        <td>{{$payment->methode}}</td>
                                        <td>{{$payment->prix}}</td>
                                        <td>                                                    
                                                <a href="{{ route('admin.payment.show', $payment->id ) }}" title="Show" wire:navigate>
                                                <i class="fa-solid fa-file-lines fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex  mt-1 mx-4">
                                <div class="btn-group" role="group">
                                    {{ $payments->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>