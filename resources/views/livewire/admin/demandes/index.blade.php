<div>

@section("title")
        Commandes
    @endsection

    @section("page-title")
        COMMANDES
    @endsection

    <div class="card">
        <div class="card-body py-1 px-0 overflow-auto">

            <table class="custom-table w-100">
                <thead>
                    <th>Entreprise</th>
                    <th>Thématique</th>
                    <th>Département</th>
                    <th>Quantité</th>
                    <th>Date Livraison</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Excel</th>
                    <th>Action</th>
                </thead>
                <tbody class="custom-striped">

                    @foreach($commandes as $key => $commande)
                        <tr>
                            <td>{{ $commande->client->entreprise }}</td>
                            <td>{{ $commande->thematique }}</td>
                            <td>{{ $commande->departement }}</td>
                            <td>{{ $commande->nombre_leads }}</td>
                            <td>{{ \Carbon\Carbon::parse($commande->date_livraison)->format("d/m/Y") }}</td>
                            <td>
                                <input  type="text" class="form-control text-center mx-auto price" value="@if($commande->prix > 0){{ $commande->prix }}@else 0 @endif" style="width:70px" data-id="{{ $commande->id }}" />
                            </td>
                            <td>
                                <select @if($commande->prix <= 0) disabled @endif value="{{ $commande->statut }}"
                                class="custom-select statut
                                    @if($commande->statut === 1)
                                        border-success text-success
                                    @elseif($commande->statut === 0)
                                        border-danger text-danger
                                    @else
                                        border-warning text-warning
                                    @endif
                                "
                                style="width:110px"
                                wire:change="changer_statut({{ $commande->id }}, $event.target.value)">
                                    <option value="" disabled @if(is_null($commande->statut)) selected @endif class="text-warning">En cours</option>
                                    <option value="1" @if($commande->statut === 1) selected @endif class="text-success">Accepté</option>
                                    <option value="0" @if($commande->statut === 0) selected @endif class="text-danger">Refusé</option>
                                </select>
                            </td>
                            <td>
                            @if($commande->statut === 1 && $commande->prix > 0 && !empty($commande->excel_path))
                                <span class="text-success">Terminé</span>
                            @else
                                <label class="import-file" data-entreprise="{{ $commande->client->entreprise }}" data-quantite="{{ $commande->nombre_leads }}" @if($commande->statut === 1 && empty($commande->excel_path)) style="cursor:pointer" @else style="pointer-events:none" @endif >
                                    
                                    <i class="fa-regular

                                    @if(!empty($commande->excel_path) && $commande->statut === 1)
                                        fa-circle-check
                                    @else
                                        fa-file-excel
                                    @endif
                                    
                                    fa-xl
                                    
                                    @if($commande->statut === 1 && $commande->prix > 0)
                                        text-success
                                    @elseif($commande->statut === 1 && $commande->prix <= 0)
                                        text-warning
                                    @endif

                                    @if($commande->statut === 0)
                                        text-danger
                                    @elseif(empty($commande->statut) || is_null($commande->statut))
                                        text-warning
                                    @endif
                                    "
                                    @if($commande->statut === 1) title="Importer fichier" @endif wire:click="importer_file_id({{ $commande->id }})"></i>
                                
                                </label>
                            @endif
                            </td>
                            <td>
                                <a href="#" title="Détails" class="details" wire:click="commande_detail({{ $commande->id }})">
                                    <i class="fa-solid fa-pen-to-square fa-lg text-secondary mr-1"></i>
                                </a>
                                <a href="#" title="Supprimer" wire:click="supprimer_commande({{ $commande->id }})">
                                    <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-end mt-2 mx-2">
                <div class="btn-group" role="group">

                </div>
            </div>

        </div>

    </div>


    @include("livewire.admin.demandes.details")
    @include("livewire.admin.demandes.upload-file")


    @section("script")
    <script>

        $(function(){


            $(".statut").change(function(e){

                e.preventDefault();
                
                $(this).attr("class", "");

                if($(this).val())
                {
                    $(this).attr("class", "custom-select statut border-success text-success");
                }else{
                    $(this).attr("class", "custom-select statut border-danger text-danger")
                }

            });


            $(".details").click(function(){

                $("#description").modal("show");

            });


            $("#statut-modal").change(function(){
                
                var value = $(this).val();
                
                $("#statut-modal").attr("class", "custom-select statut");

                if(value == 1)
                {
                    $("#statut-modal").addClass("border-success").addClass("text-success");
                }else{
                    $("#statut-modal").addClass("border-danger").addClass("text-danger");
                }

            });


            $(".import-file").click(function(){

                $("#importer-excel").modal("show");

                $("#upload_entreprise").val($(this).data("entreprise"));
                $("#upload_quantite").val($(this).data("quantite"));

            });


            $(".price").keyup(function(){

                var value = $(this).val();
                var id    = $(this).data("id");
                
                Livewire.dispatch("modifier-prix", {value:value, id:id});
                
            });


        });

    </script>
    @endsection


</div>