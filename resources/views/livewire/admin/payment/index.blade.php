<div>

    @section("title")
        Ventes
    @endsection

    @section("page-title")
        VENTES
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
                                <th>Nom Prénom</th>
                                <th>Tel</th>
                                <th>Email</th>
                                <th>Reference</th>
                                <th>Thématique</th>
                                <th>Département</th>
                                <th>Prix</th>
                                <th>Détails</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="custom-striped">
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->client->nom }} {{ $lead->client->prenom }}</td>
                                    <td>{{ $lead->client->tel }}</td>
                                    <td>{{ $lead->client->email }}</td>
                                    <td>{{ $lead->lead->reference }}</td>
                                    <td>{{ optional($lead->thematique)->thematique}}</td>
                                    <td>{{ optional($lead->departement)->departement }}</td>
                                    <td>{{ $lead->lead->code_postale}}</td>
                                    <td>{{ $lead->prix }}</td>
                      
                                    <td>
                                        <a href="{{ route('admin.payment.show', $lead->id ) }}" title="Show" wire:navigate>
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2 mx-2">
                            <div class="btn-group" role="group">
                            {{ $leads->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
</div>