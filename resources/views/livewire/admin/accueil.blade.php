<div>

    @section("title")
        Accueil
    @endsection

    @section("style")
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/admin/accueil.css') }}">
    @endsection

    <div class="w-100 mb-3">
        <form action="" method="get" >
            <div class="w-100 row">
                <div class="col-md-3 col-sm-6 col-12">
                    <label>Thématique</label>
                    <select class="custom-select" wire:model.live="thematique" name="search_thematique">
                        <option selected value="">Tous</option>
                        @foreach($thematique_array as $thematique)
                            <option value="{{ $thematique->id }}" >{{ $thematique->thematique }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <label>Département</label>
                    <select class="custom-select" wire:model.live="departement" name="search_departement">
                        <option selected value="">Tous</option>
                        @foreach($departement_array as $departement)
                            <option value="{{ $departement->id }}" >{{ $departement->departement }}</option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <label>Date début</label>
                    <input type="date" class="form-control" title="Date de début" name="search_date_debut" wire:model.live="date_debut" />
                </div>
                <div class="col-md-3 col-sm-6 col-12">
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


    <!-------------- Section 1 ---------------->
    <div class="row mb-2">

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card card-congratulations" style="height:230px;">
                <div class="card-body text-center pb-3">
                    <img src="{{ asset('/app-assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left">
                    <img src="{{ asset('/app-assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right">
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award font-large-1"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                    </div>
                    <div class="text-center">

                            @if($sales_total == 0)
                                <h1 class="mb-1 text-white">Bienvenue {{session('auth')["prenom"]}},</h1>
                                <p class="card-text m-auto w-75">
                                    <strong style="font-size:18px">Vous n'avez aucune vente</strong>.
                                </p>
                            @elseif($sales_total == 1)
                                <h1 class="mb-1 text-white">Félicitations {{session('auth')["prenom"]}},</h1>
                                <p class="card-text m-auto w-75">
                                    <strong style="font-size:18px">Vous avez une vente</strong>.
                                </p>
                            @else
                                <h1 class="mb-1 text-white">Félicitations {{session('auth')["prenom"]}},</h1>
                                <p class="card-text m-auto w-75">
                                    <strong style="font-size:18px">Vous avez {{ $sales_total }} ventes</strong>.
                                </p>
                            @endif
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">

            <div class="card" style="height:230px;">

                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa-solid fa-database fa-lg"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ $leads->where("payer", 0)->count() }}</h2>
                    <p class="card-text">Leads</p>
                </div>

                <div id="gained-chart" style="min-height: 100px;">
                    
                    <div id="apexchartsxa5dws4jj" class="apexcharts-canvas apexchartsxa5dws4jj apexcharts-theme-light" style="width:100%;height:100px;overflow:hidden;">
                        <svg id="SvgjsSvg1259" width="364" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG1261" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1260"><clipPath id="gridRectMaskxa5dws4jj"><rect id="SvgjsRect1266" width="370.5" height="102.5" x="-3.25" y="-1.25" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskxa5dws4jj">
                        <rect id="SvgjsRect1267" width="368" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1272" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1273" stop-opacity="0.7" stop-color="rgba(2, 126, 250,0.7)" offset="0"></stop><stop id="SvgjsStop1274" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="0.8"></stop>
                        <stop id="SvgjsStop1275" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1265" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1278" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1279" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1281" class="apexcharts-grid"><g id="SvgjsG1282" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1284" x1="0" y1="0" x2="364" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1285" x1="0" y1="20" x2="364" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1286" x1="0" y1="40" x2="364" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1287" x1="0" y1="60" x2="364" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1288" x1="0" y1="80" x2="364" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1289" x1="0" y1="100" x2="364" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1283" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1291" x1="0" y1="100" x2="364" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1290" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1268" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1269" class="apexcharts-series" seriesName="Subscribers" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1276" d="M 0 100L 0 77.77777777777777C 21.23333333333333 77.77777777777777 39.43333333333334 51.111111111111114 60.666666666666664 51.111111111111114C 81.89999999999999 51.111111111111114 100.1 60 121.33333333333333 60C 142.56666666666666 60 160.76666666666665 24.444444444444443 182 24.444444444444443C 203.23333333333332 24.444444444444443 221.43333333333334 55.55555555555556 242.66666666666666 55.55555555555556C 263.9 55.55555555555556 282.09999999999997 6.666666666666657 303.3333333333333 6.666666666666657C 324.56666666666666 6.666666666666657 342.76666666666665 17.777777777777786 364 17.777777777777786C 364 17.777777777777786 364 17.777777777777786 364 100M 364 17.777777777777786z" fill="url(#SvgjsLinearGradient1272)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskxa5dws4jj)" pathTo="M 0 100L 0 77.77777777777777C 21.23333333333333 77.77777777777777 39.43333333333334 51.111111111111114 60.666666666666664 51.111111111111114C 81.89999999999999 51.111111111111114 100.1 60 121.33333333333333 60C 142.56666666666666 60 160.76666666666665 24.444444444444443 182 24.444444444444443C 203.23333333333332 24.444444444444443 221.43333333333334 55.55555555555556 242.66666666666666 55.55555555555556C 263.9 55.55555555555556 282.09999999999997 6.666666666666657 303.3333333333333 6.666666666666657C 324.56666666666666 6.666666666666657 342.76666666666665 17.777777777777786 364 17.777777777777786C 364 17.777777777777786 364 17.777777777777786 364 100M 364 17.777777777777786z" pathFrom="M -1 140L -1 140L 60.666666666666664 140L 121.33333333333333 140L 182 140L 242.66666666666666 140L 303.3333333333333 140L 364 140"></path><path id="SvgjsPath1277" d="M 0 77.77777777777777C 21.23333333333333 77.77777777777777 39.43333333333334 51.111111111111114 60.666666666666664 51.111111111111114C 81.89999999999999 51.111111111111114 100.1 60 121.33333333333333 60C 142.56666666666666 60 160.76666666666665 24.444444444444443 182 24.444444444444443C 203.23333333333332 24.444444444444443 221.43333333333334 55.55555555555556 242.66666666666666 55.55555555555556C 263.9 55.55555555555556 282.09999999999997 6.666666666666657 303.3333333333333 6.666666666666657C 324.56666666666666 6.666666666666657 342.76666666666665 17.777777777777786 364 17.777777777777786" fill="none" fill-opacity="1" stroke="#027efa" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskxa5dws4jj)" pathTo="M 0 77.77777777777777C 21.23333333333333 77.77777777777777 39.43333333333334 51.111111111111114 60.666666666666664 51.111111111111114C 81.89999999999999 51.111111111111114 100.1 60 121.33333333333333 60C 142.56666666666666 60 160.76666666666665 24.444444444444443 182 24.444444444444443C 203.23333333333332 24.444444444444443 221.43333333333334 55.55555555555556 242.66666666666666 55.55555555555556C 263.9 55.55555555555556 282.09999999999997 6.666666666666657 303.3333333333333 6.666666666666657C 324.56666666666666 6.666666666666657 342.76666666666665 17.777777777777786 364 17.777777777777786" pathFrom="M -1 140L -1 140L 60.666666666666664 140L 121.33333333333333 140L 182 140L 242.66666666666666 140L 303.3333333333333 140L 364 140"></path><g id="SvgjsG1270" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1297" r="0" cx="0" cy="0" class="apexcharts-marker wov2mzdmm no-pointer-events" stroke="#ffffff" fill="#7367f0" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1271" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1292" x1="0" y1="0" x2="364" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1293" x1="0" y1="0" x2="364" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1294" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1295" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1296" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1264" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1280" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1262" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 50px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(115, 103, 240);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 365px; height: 239px;"></div></div><div class="contract-trigger"></div></div></div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="height:230px;">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-medium-5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{ $clients->count() }}</h2>
                                <p class="card-text">Clients</p>
                            </div>
                            <div id="order-chart" style="min-height: 100px;"><div id="apexchartsp90vk17d" class="apexcharts-canvas apexchartsp90vk17d apexcharts-theme-light" style="width:100%;height:100px;overflow:hidden;"><svg id="SvgjsSvg1299" width="364" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1301" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1300"><clipPath id="gridRectMaskp90vk17d"><rect id="SvgjsRect1306" width="370.5" height="102.5" x="-3.25" y="-1.25" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskp90vk17d"><rect id="SvgjsRect1307" width="368" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1312" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1313" stop-opacity="0.7" stop-color="rgba(255,159,67,0.7)" offset="0"></stop><stop id="SvgjsStop1314" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="0.8"></stop><stop id="SvgjsStop1315" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1305" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1318" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1319" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1321" class="apexcharts-grid"><g id="SvgjsG1322" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1324" x1="0" y1="0" x2="364" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1325" x1="0" y1="20" x2="364" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1326" x1="0" y1="40" x2="364" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1327" x1="0" y1="60" x2="364" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1328" x1="0" y1="80" x2="364" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1329" x1="0" y1="100" x2="364" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1323" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1331" x1="0" y1="100" x2="364" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1330" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1308" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1309" class="apexcharts-series" seriesName="Orders" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1316" d="M 0 100L 0 60C 21.23333333333333 60 39.43333333333334 10 60.666666666666664 10C 81.89999999999999 10 100.1 80 121.33333333333333 80C 142.56666666666666 80 160.76666666666665 10 182 10C 203.23333333333332 10 221.43333333333334 90 242.66666666666666 90C 263.9 90 282.09999999999997 40 303.3333333333333 40C 324.56666666666666 40 342.76666666666665 80 364 80C 364 80 364 80 364 100M 364 80z" fill="url(#SvgjsLinearGradient1312)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp90vk17d)" pathTo="M 0 100L 0 60C 21.23333333333333 60 39.43333333333334 10 60.666666666666664 10C 81.89999999999999 10 100.1 80 121.33333333333333 80C 142.56666666666666 80 160.76666666666665 10 182 10C 203.23333333333332 10 221.43333333333334 90 242.66666666666666 90C 263.9 90 282.09999999999997 40 303.3333333333333 40C 324.56666666666666 40 342.76666666666665 80 364 80C 364 80 364 80 364 100M 364 80z" pathFrom="M -1 160L -1 160L 60.666666666666664 160L 121.33333333333333 160L 182 160L 242.66666666666666 160L 303.3333333333333 160L 364 160"></path><path id="SvgjsPath1317" d="M 0 60C 21.23333333333333 60 39.43333333333334 10 60.666666666666664 10C 81.89999999999999 10 100.1 80 121.33333333333333 80C 142.56666666666666 80 160.76666666666665 10 182 10C 203.23333333333332 10 221.43333333333334 90 242.66666666666666 90C 263.9 90 282.09999999999997 40 303.3333333333333 40C 324.56666666666666 40 342.76666666666665 80 364 80" fill="none" fill-opacity="1" stroke="#ff9f43" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp90vk17d)" pathTo="M 0 60C 21.23333333333333 60 39.43333333333334 10 60.666666666666664 10C 81.89999999999999 10 100.1 80 121.33333333333333 80C 142.56666666666666 80 160.76666666666665 10 182 10C 203.23333333333332 10 221.43333333333334 90 242.66666666666666 90C 263.9 90 282.09999999999997 40 303.3333333333333 40C 324.56666666666666 40 342.76666666666665 80 364 80" pathFrom="M -1 160L -1 160L 60.666666666666664 160L 121.33333333333333 160L 182 160L 242.66666666666666 160L 303.3333333333333 160L 364 160"></path><g id="SvgjsG1310" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1337" r="0" cx="0" cy="0" class="apexcharts-marker wxzl4y8qz no-pointer-events" stroke="#ffffff" fill="#ff9f43" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1311" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1332" x1="0" y1="0" x2="364" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1333" x1="0" y1="0" x2="364" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1334" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1335" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1336" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1304" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1320" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1302" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 50px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 159, 67);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 365px; height: 239px;"></div></div><div class="contract-trigger"></div></div></div>
                    </div>

        </div>
        <!-------------- End Section 1 ------------>





        <!---------- Section 2 ------------>
        <div class="row mb-2">

                @php

                    $leads_payer   = $leads->where("payer", 1)->count();
                    $leads_unpayer = $leads->where("payer", 0)->count();

                    if($leads_payer == 0 || $leads_unpayer == 0)
                    {
                        $rate = 0;
                    }else{
                        $rate = number_format($leads_payer / ($leads_payer + $leads_unpayer), 2) * 100;
                    }

                @endphp


                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center mb-1">
                            <h4 class="card-title">Leads Achetés</h4>
                        </div>
                        <div class="card-body p-0" style="position: relative;">

                            <div class="position-relative">

                                <div id="goal-overview-radial-bar-chart" class="pt-3 mb-5" style="height:190px;display:flex;justify-content:center;align-items:center;">
                                    <section class="svg-container">
                                        <svg class="radial-progress" data-countervalue="{{ $rate }}" viewBox="0 0 80 80">
                                            <circle class="bar-static" cx="40" cy="40" r="35"></circle>
                                            <circle class="bar--animated" cx="40" cy="40" r="35" style="stroke-dashoffset: 217.8;"></circle>
                                            <text class="countervalue start" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $rate }}</text>
                                        </svg>
                                    </section>
                                    <span id="radial-progress-value" class="d-none">{{ $rate }}</span>
                                </div>

                            </div>
                        
                            <div class="row border-top text-center mx-0">
                                <div class="col-6 border-right py-1">
                                    <p class="card-text text-muted mb-0 h4 text-success">Acheté</p>
                                    <h3 class="font-weight-bolder mb-0">{{ $leads->where("payer", 1)->count() }}</h3>
                                </div>
                                <div class="col-6 py-1">
                                    <p class="card-text text-muted mb-0 h4 text-danger">Non acheté</p>
                                    <h3 class="font-weight-bolder mb-0">{{ $leads->where("payer", 0)->count() }}</h3>
                                </div>
                            </div>

                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 496px; height: 324px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center mb-0">
                            <h4 class="card-title">Progression des ventes</h4>
                        </div>
                        <div class="card-body">
                            <div class="w-100" id="chart" style="height:300px"></div>
                        </div>
                    </div>
                </div>

        </div>
        <!------------ End Section 2 ----------->





        <!---------------- Section 3 ----------------->
        <div class="row mb-2">

            <div class="col-xl-6 col-lg-12">

                <div class="h3 fw-bold">Top 10 Clients</div>

                <div class="card">
                    <div class="card-body px-0 py-0 hidden-scroll" style="height:365px;overflow-y:auto">
                        <table class="table text-center table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-white">Entreprise</th>
                                    <th class="bg-white">Nom</th>
                                    <th class="bg-white">Prenom</th>
                                    <th class="bg-white">tel</th>
                                    <th class="bg-white">achats</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($top_clients as $index => $top_client)
                                <tr>
                                <td>{{$top_client->entreprise}}</td>
                                 <td>{{$top_client->nom}}</td>
                                 <td>{{$top_client->prenom}}</td>
                                 <td>{{$top_client->tel}}</td>
                                 <td>{{$top_client->payments_count}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-xl-6 col-lg-12">

                <div class="row">

                    <div class="col-md-6">
                        <div class="h3 fw-bold">Top Thématiques</div>
                        <div class="card card-transaction hidden-scroll" style="height:365px;overflow-y:auto">
                            <div class="card-body pt-3">
                                
                                @foreach($top_thematiques as $index => $thematique)
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar
                                            @if($index == 0)
                                                bg-light-primary 
                                            @elseif($index == 1)
                                                bg-light-success
                                            @elseif($index == 2)
                                                bg-light-info
                                            @elseif($index == 3)
                                                bg-light-warning
                                            @elseif($index == 4)
                                                bg-light-danger
                                            @endif
                                            rounded">
                                            <div class="avatar-content">
                                                <i class="fa-solid fa-tags fa-xl"></i>
                                            </div>
                                        </div>
                                        <div class="media-body pt-1">
                                            <h6 class="transaction-title">{{ $thematique->thematique }}</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder
                                        @if($index == 0)
                                            text-primary
                                        @elseif($index == 1)
                                            text-success
                                        @elseif($index == 2)
                                            text-info
                                        @elseif($index == 3)
                                            text-warning
                                        @elseif($index == 4)
                                            text-danger
                                        @endif
                                    " title="@if($thematique->payments_count > 1) Ventes @else Vente @endif" >{{ $thematique->payments_count }}</div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="h3 fw-bold">Top Départements</div>
                        <div class="card card-transaction hidden-scroll" style="height:365px;overflow-y:auto">

                            <div class="card-body pt-3">

                            @foreach($top_departements as $index => $departement)
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar
                                            @if($index == 0)
                                                bg-light-primary 
                                            @elseif($index == 1)
                                                bg-light-success
                                            @elseif($index == 2)
                                                bg-light-info
                                            @elseif($index == 3)
                                                bg-light-warning
                                            @elseif($index == 4)
                                                bg-light-danger
                                            @endif
                                            rounded">
                                            <div class="avatar-content">
                                            <i class="fa-solid fa-location-dot fa-xl"></i>
                                            </div>
                                        </div>
                                        <div class="media-body pt-1">
                                            <h6 class="transaction-title">{{ $departement->departement }}</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder
                                        @if($index == 0)
                                            text-primary
                                        @elseif($index == 1)
                                            text-success
                                        @elseif($index == 2)
                                            text-info
                                        @elseif($index == 3)
                                            text-warning
                                        @elseif($index == 4)
                                            text-danger
                                        @endif
                                    " title="@if($thematique->payments_count > 1) Ventes @else Vente @endif" >{{ $departement->payments_count }}</div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!----------- End Section 3 ------------>




    @section("script")
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        var options = {
          series:[{
          name: 'Ventes',
          data: @json($sales_data)
        }],
            chart:{
                height: 300,
                type: 'area'
            },
            dataLabels:{
                enabled: false
            },
            stroke:{
                curve: 'smooth'
            },
            xaxis:{
                type: 'date',
                categories: @json($sales_dates)
            },
            tooltip: {
                x:{
                    format: 'dd/MM/yy'
                },
            }
        };


        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        
    </script>
    @endsection

</div>
