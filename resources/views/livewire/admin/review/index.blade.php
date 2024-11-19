<div>

    @section("title")
        Avis
    @endsection

    @section("page-title")
        AVIS
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
                                <label>Département</label>
                                <select class="form-control" wire:model="departement" wire:change="search_function">
                                    <option value="">Tous</option>
                                    @foreach($departements as $departement)
                                        <option value="{{ $departement->id }}">{{ $departement->departement }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publié</label>
                                <select class="form-control" wire:model="publier" wire:change="search_function">
                                    <option value="" selected>Tous</option>
                                    <option value="oui">Oui</option>
                                    <option value="non">Non</option>
                                </select>
                            </div>
                        </div>



                    </div>

                </form>

                        <table class="custom-table w-100">
                            <thead>
                                <th>Nom Prénom</th>
                                <th>Telephone</th>
                                <th>Notation</th>
                                <th>Avis</th>
                                <th>Publier</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="custom-striped">               
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->client->nom }} {{ $lead->client->prenom }}</td>
                                    <td>{{ $lead->client->tel }}</td>
                                    <td>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star" style="color: {{ $i <= $lead->rating ? 'gold' : 'lightgray' }}"></i>
                                        @endfor
                                    </div>


                                    </td>
                                    <td>
                                        <a href="#" class="show-review">En savoir plus
                                            <div class="review-text d-none">
                                                {{$lead->review }}
                                            </div>
                                            <div class="d-none review-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: {{ $i <= $lead->rating ? 'gold' : 'lightgray' }}"></i>
                                                @endfor
                                            </div>
                                        </a>

                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" wire:click="activation({{ $lead->publier }}, {{ $lead->id }})" id="activation{{ $lead->id }}" @if($lead->publier) checked @endif>
                                            <label class="custom-control-label" for="activation{{ $lead->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" title="Supprimer" wire:click="delete_review({{ $lead->id }})">
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




      <!------------ Confirmation Modal ------------->
      <div class="modal modal-confirm fade" tabindex="-1" role="dialog" id="review-box">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="w-100 text-center pt-1">
              <div class="w-100 mb-1" id="review-stars" class="review-stars" style="transform:scale(0.5)">
                
              </div>
              <div class="w-100">
                <h2>Avis</h2>
              </div>
            </div>
            
            <div class="modal-body text-center pb-2">
              <p style="font-size:1.15rem;line-height:1.5">

              </p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
            
          </div>
        </div>
      </div>
      <!----------------- End Modal ----------------->


    @section("script")
    <script>

        $(function(){

            $(".show-review").click(function(e){

                e.preventDefault();
                
                var review_text = $(this).find(".review-text").text();
                var stars       = $(this).find(".review-stars").html();

                $("#review-box").modal("toggle");

                $("#review-box p").text(review_text);
                $("#review-box #review-stars").html(stars);

            });

        });

    </script>
    @endsection
</div>