<div>

    @section("title")
     Corbeille
    @endsection

    @section("page-title")
     Corbeille
    @endsection

    @section("element")
       <!-- <a role="button" class="btn btn-primary" href="{{ route('admin.lead-ajouter') }}" wire:navigate>Ajouter un Lead</a>-->
    @endsection

    <div class="card">
            <div class="card-body py-1 px-0 overflow-auto">

                <form class="mb-3">

                    <div class="filters px-0">
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rechercher</label>
                                <input type="text" placeholder="Rechercher" class="form-control" wire:model="search" wire:keyup="search_function" />
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                    <!--
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publié</label>
                                <select class="form-control" wire:model="publier" wire:change="search_function">
                                    <option value="" selected>Tous</option>
                                    <option value="oui">Oui</option>
                                    <option value="non">Non</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Acheté</label>
                                <select class="form-control" wire:model="payer" wire:change="search_function">
                                    <option value="" selected>Tous</option>
                                    <option value="oui">Oui</option>
                                    <option value="non">Non</option>
                                </select>
                            </div>
                        </div>
                    -->
                    </div>

                </form>

                        <table class="custom-table w-100">
                            <thead>
                                <th>Référence</th>
                                <th>Nom Prénom</th>
                                <th>Tel</th>
                                <th>Thématique</th>
                                <th>Département</th>
                                <th>Code Postale</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="custom-striped">
                            
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->reference }}</td>
                                    <td>{{ $lead->prospect->nom }} {{ $lead->prospect->prenom }}</td>
                                    <td>{{ $lead->prospect->tel }}</td>
                                    <td>{{ optional($lead->thematique)->thematique}}</td>
                                    <td>{{ optional($lead->departement)->departement }}</td>
                                    <td>{{ $lead->code_postale }}</td>
                                    <td>
                                        <a href="#" title="reply" wire:click="reply({{ $lead->id }})">
                                            <i class="fa-solid fa-repeat fa-lg text-secondary mr-1"></i>
                                        </a>
                                        <a href="#" title="Supprimer" wire:click="delete_Lead_corbeille({{ $lead->id }})">
                                            <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-end mt-2 mx-2">
                            {{ $leads->links() }}
                    </div>

                </div>

            </div>
</div>