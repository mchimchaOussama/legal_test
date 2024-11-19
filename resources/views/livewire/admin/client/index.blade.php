<div>

    @section("title")
        Clients
    @endsection

    @section("page-title")
        Clients
    @endsection

    <div class="card">
            <div class="card-body py-1 px-0 overflow-auto">

                <form class="mb-3">

                    <div class="filters px-0">
                        
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rechercher</label>
                                <input type="text" placeholder="Rechercher" class="form-control" wire:model="search" wire:keyup="search_function" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Thématique</label>
                                <select class="form-control" wire:model="thematique" wire:change="search_function">
                                    <option value="">Tous</option>
                                    @foreach($thematiques as $thematique)
                                        <option value="{{ $thematique->id }}">{{ $thematique->thematique }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Ville</label>
                                <select class="form-control" wire:model="ville" wire:change="search_function">
                                    <option value="">Tous</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Département</label>
                                <select class="form-control" wire:model="departement" wire:change="search_function">
                                    <option value="">Tous</option>
                                    @foreach($departements as $departement)
                                        <option value="{{ $departement->id }}">{{ $departement->departement }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date début</label>
                                <input type="date" class="form-control" title="Date début" wire:model="f_date_debut" wire:change="search_function" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date fin</label>
                                <input type="date" class="form-control" title="Date fin" wire:model="f_date_fin" wire:change="search_function" />
                            </div>
                        </div>
                        
                    </div>
                </form>
                

                <table class="custom-table w-100">
                    <thead>
                    <!--    <th>Entreprise</th>-->
                        <th>Nom Prénom</th>
                        <th>Tel</th>
                        <th>Email</th>
                  <!--      <th>N° Identification</th>
                        <th>SIREN</th>
                        <th>SIRET</th>
                        <th>RCS</th>
-->
                        <th>Désactiver / Activer</th>
                        <th>status</th>
                        <th>Détails</th>
                    </thead>
                    <tbody class="custom-striped">
                        @foreach($leads as $lead)
                        <tr>
                        <!--    <td>{{ $lead->entreprise}}</td>-->
                            <td>{{ $lead->nom }} {{ $lead->prenom }}</td>
                            <td>{{ $lead->tel }}</td>
                            <td>{{ $lead->email }}</td>
                  <!--          <td>{{ $lead->numero_identification}}</td>
                            <td>{{ $lead->siren}}</td>
                            <td>{{ $lead->siret}}</td>
                            <td>{{ $lead->rcs}}</td>
-->
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" wire:click="activation({{ $lead->activer }} , {{ $lead->id }})" id="activation{{ $lead->id }}" @if($lead->activer) checked @endif>
                                    <label class="custom-control-label" for="activation{{ $lead->id }}"></label>
                                </div>
                            </td>
                            <td>
                                @if($lead->verification === 1 &&  $lead->activer === 0)             
                                    <i class="fa-solid fa-phone fa-bounce fa-lg" style="color: #63E6BE;"></i>
                                @endif

                                @if($lead->verification === 0)             
                                <i class="fa-solid fa-phone fa-lg text-danger"></i>
                                @endif              

                                @if($lead->verification === 1 && $lead->activer === 1)             
                                    <span class="text-success">Activer</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.client.show', $lead->id ) }}" wire:navigate class="mr-1">
                                    <i class="fa-solid fa-pen-clip fa-lg text-secondary"></i>
                                </a>
                                <a href="#" title="Supprimer" wire:click="delete_client({{ $lead->id }})">
                                    <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class=" mt-2 mx-2">
                            <div class="btn-group" role="group">
                            {{ $leads->links('pagination::bootstrap-4') }}
                            </div>
                </div>

            <div class="d-flex mt-1 mx-2">
                <div class="btn-group" role="group"></div>
            </div>
            
        </div>
    </div>
</div>
