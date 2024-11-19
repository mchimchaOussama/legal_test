<div>

    @section("title")
        Statistiques
    @endsection

    @section("style")
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/accueil.css') }}">
    @endsection

    <div class="w-100 mb-2">
        <form action="" method="get" >
            <div class="row w-100">

                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Progression</label>
                    <select class="custom-select" wire:model.live="admin" name="search_admin">
                        <option value="" selected>Tous Administrateurs</option>
                        @foreach($users_array as $user)
                            <option value="{{ $user->id }}" >{{ $user->nom }} {{ $user->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Progression</label>
                    <select class="custom-select" wire:model.live="chart_filter" name="search_chart_filter">
                        <option value="ventes">Ventes</option>
                        <option value="leads">Leads</option>
                    </select>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Thématique</label>
                    <select class="custom-select" wire:model.live="thematique" name="search_thematique">
                        <option selected value="">Tous</option>
                        @foreach($thematique_array as $thematique)
                            <option value="{{ $thematique->id }}" >{{ $thematique->thematique }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Département</label>
                    <select class="custom-select" wire:model.live="departement" name="search_departement">
                        <option selected value="">Tous</option>
                        @foreach($departement_array as $departement)
                            <option value="{{ $departement->id }}" >{{ $departement->departement }}</option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Date début</label>
                    <input type="date" class="form-control" title="Date de début" name="search_date_debut" wire:model.live="date_debut" />
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 me-sm-2 me-0">
                    <label>Date fin</label>
                    <input type="date" class="form-control " title="Date de fin" name="search_date_fin" wire:model.live="date_fin" />
                </div>

                <!---
                <div class="mt-2">
                    <button class="btn btn-primary custom-btn" style="width:60px" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                --->

            </div>
        </form>
    </div>

    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-0">
                <h4 class="card-title mb-1">Progression des {{ $chart_is }}</h4>
                <h4 class="card-title mb-1">{!! $chart_total !!}</h4>
            </div>
            <div class="card-body">
                <div class="w-100" id="chart" style="height:400px"></div>
            </div>
        </div>
    </div>



    <div class="row mb-1">

        <div class="col-xl-6 col-lg-12">

            <div class="h3 fw-bold mb-1">Revenus Clients</div>

            <div class="card">
                <div class="card-body px-0 py-0 hidden-scroll" style="height:365px;overflow-y:auto">
                    <table class="table text-center table-striped">
                        <thead>
                            <tr>
                                <th class="bg-white">Entreprise</th>
                                <th class="bg-white">Nom et Prénom</th>
                                <th class="bg-white">tel</th>
                                <th>Achats</th>
                                <th class="bg-white">chiffre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->entreprise }}</td>
                                    <td>{{ $client->nom }} {{ $client->prenom }}</td>
                                    <td>{{ $client->tel }}</td>
                                    <td>{{ $client->payment_count }}</td>
                                    <td>{{ $client->payment->sum("prix") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-xl-6 col-lg-12">

            <div class="h3 fw-bold mb-1">Revenus Thématiques</div>

            <div class="card">
                <div class="card-body px-0 py-0 hidden-scroll" style="height:365px;overflow-y:auto">
                    <table class="table text-center table-striped">
                        <thead>
                            <tr>
                                <th class="bg-white">Thématique</th>
                                <th class="bg-white">Type</th>
                                <th class="bg-white">Achats</th>
                                <th class="bg-white">chiffre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($thematiques as $thematique)
                                <tr>
                                    <td>{{ $thematique->thematique }}</td>
                                    <td>{{ $thematique->type }}</td>
                                    <td>{{ $thematique->payments_count }}</td>
                                    <td>{{ $thematique->payments->sum("prix") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <div class="row mb-1">

        <div class="col-xl-6 col-lg-12">

            <div class="h3 fw-bold mb-1">Revenus Départements</div>

            <div class="card">
                <div class="card-body px-0 py-0 hidden-scroll" style="height:365px;overflow-y:auto">
                    <table class="table text-center table-striped">
                        <thead>
                            <tr>
                            <th class="bg-white">N°</th>
                                <th class="bg-white">Département</th>
                                <th class="bg-white">Achats</th>
                                <th class="bg-white">chiffre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departements as $departement)
                                <tr>
                                    <td>{{ $departement->num }}</td>
                                    <td>{{ $departement->departement }}</td>
                                    <td>{{ $departement->payments_count }}</td>
                                    <td>{{ $departement->payments->sum("prix") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-xl-6 col-lg-12">

            <div class="h3 fw-bold mb-1">Revenus Villes</div>

            <div class="card">
                <div class="card-body px-0 py-0 hidden-scroll" style="height:365px;overflow-y:auto">
                    <table class="table text-center table-striped">
                        <thead>
                            <tr>
                                <th class="bg-white">Ville</th>
                                <th class="bg-white">Code Postale</th>
                                <th class="bg-white">Achats</th>
                                <th class="bg-white">chiffre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($villes as $ville)
                                <tr>
                                    <td>{{ $ville->ville }}</td>
                                    <td>{{ $ville->code_postale->code_postale }}</td>
                                    <td>{{ $ville->payment_count }}</td>
                                    <td>{{ $ville->payment->sum("prix") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    @section("script")
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        var options = {
            series:[{
                name: @json($chart_is),
                data: @json($chart_data)
            }],
            chart:{
                height: 400,
                type: 'area'
            },
            dataLabels:{
                enabled: false
            },
            stroke:{
                curve: 'smooth'
            },
            xaxis:{
                type: 'datetime',
                categories: @json($chart_dates)
            },
            tooltip:{
                x:{
                    format: 'dd/MM/yy HH:mm'
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        

    </script>
    @endsection

</div>