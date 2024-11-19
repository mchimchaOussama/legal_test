<div>

    @section("title")
        Ajouter un Coupon
    @endsection

    @section("page-title")
        Ajouter un Coupon
    @endsection

    <div class="row">

        <div class="col-4"> 
 
            <div class="card mb-3">
                <div class="card-body py-2 px-2 overflow-visitble">

                    <div class="search-container">

                        <div class="form-group mb-0">
                            <label for="search-client">Recherche de client</label>
                            <input type="text" class="form-control" id="search-client" placeholder="Rechercher" autocomplete="off" wire:keyup="client_search" wire:model="client">
                            @if(sizeof($client_search_result) > 0)
                                <div class="search-result">
                                    <ul>
                                        @foreach($client_search_result as $client)
                                            <li>
                                                <a href="#" class="lead" wire:click="add_client({{ $client->id }})">
                                                    <span class="mr-1">{{ $client->entreprise }}</span><span>{{ $client->nom }} {{ $client->prenom }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <span class="error"></span>
                        </div>

                    </div>

                </div>
            </div>

        </div>



        <div class="col-4"> 
            <div class="card mb-3">
                <div class="card-body py-2 px-2 overflow-visitble">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group mb-0">
                                <label>Coupon Code</label>
                                <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon-code" autocomplete="off" wire:model="coupon_code">
                                <span class="error">
                                    @error('coupon_code') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-0">
                                <label for="reduction">Réduction</label>
                                <input type="text" class="form-control text-center @error('coupon_discount') is-invalid @enderror" id="reduction" autocomplete="off" wire:model="coupon_discount">
                                <span class="error">
                                    @error('coupon_discount') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-4"> 
 
            <div class="card mb-3">
                <div class="card-body py-2 px-2 overflow-visitble">
                    <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label>Date Debut</label>
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" wire:model="date_debut">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label>Date Fin</label>
                            <input type="date" class="form-control @error('date_fin') is-invalid @enderror" wire:model="date_fin">
                            <span class="error"></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-12">

            <div class="w-100 mb-3">

            <div class="d-flex justify-content-between align-items-center mb-1">
                <h3 class="fw-bold">CLIENTS ({{ sizeof($client_ids) }})</h3>
                <button class="custom-btn" wire:click="ajouter">Ajouter</button>
            </div>


                <div class="card">
                    <div class="card-body py-1 px-0 overflow-auto" style="max-height:300px">

                        <table class="custom-table w-100">
                            <thead>
                                <th>Entreprise</th>
                                <th>Nom Prénom</th>
                                <th>Tel</th>
                                <th>Email</th>
                                <th>N° Identification</th>
                                <th>Siren</th>
                                <th>Siret</th>
                                <th>RCS</th>
                                <th>Supprimer</th>
                            </thead>
                            <tbody class="custom-striped">

                                @if(sizeof($selected_clients) == 0)
                                    <tr>
                                        <td colspan="9">
                                            <div class="h5 mb-0">Aucun client sélectionné</div>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($selected_clients as $index => $client)
                                    <tr>
                                        <td>{{ $client->entreprise }}</td>
                                        <td>{{ $client->nom }} {{ $client->prenom }}</td>
                                        <td>{{ $client->tel }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->numero_identification }}</td>
                                        <td>{{ $client->siren }}</td>
                                        <td>{{ $client->siret }}</td>
                                        <td>{{ $client->rcs }}</td>
                                        <td>
                                            <a href="#" title="Supprimer" wire:click="delete_client({{ $client->id }}, {{ $index }})">
                                                <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>


    <!----- Modal ------->
    <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">RÉDUCTION</h5>
            </div>
            <div class="modal-body pt-2 pb-4 text-center">
                <div class="h1" style="font-size:35px">{{ $coupon_discount }}% OFF</div>
                <div class="coupon-box d-flex justify-content-between align-items-center">
                    <i class="fa-solid fa-scissors" style="font-size:40px"></i>
                    <div class="h2">{{ $coupon_code }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
    </div>
    <!------ End Modal ----->

</div>
