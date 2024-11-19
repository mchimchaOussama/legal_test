<div>

    @section("title")
        Thématiques
    @endsection

    @section("page-title")
    THÉMATIQUES
    @endsection

    @section("element")
        <button role="button" class="btn btn-primary px-1 add-modal">Ajouter Thématique</button>
    @endsection


    <div class="card">
        <div class="card-body py-1 px-0">

            <table class="custom-table w-100">
                <thead>
                    <th>Thématique</th>
                    <th>Sous-Thématique</th>
                    <th>Type</th>
                    <th>Leads</th>
                    <th>Action</th>
                </thead>
                <tbody class="custom-striped">

                        @if ($thematiques->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">Aucune thématique</td>
                            </tr>
                        @else

                            @foreach($thematiques as $index => $thematique)
                                <tr>
                                    <td>{{ $thematique->theme }}</td>
                                    <td>{{ $thematique->thematique }}</td>
                                    <td>{{ $thematique->type }}</td>

                                    <td>{{ $thematique->leads_count }}</td>
                                    <td>

                                        <a href="#" title="Modifier" wire:click="modifier_thematique({{ $thematique->id }})">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        <a href="#" title="Supprimer" wire:click="delete_thematique({{ $thematique->id }})">
                                            <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                        </a>

                                    </td>  
                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
              </div>
              <!-- Pagination Links -->
              <div class="d-flex  mt-1 mx-2">
                  <div class="btn-group" role="group">
                      {{ $thematiques->links('pagination::bootstrap-4') }}
                  </div>
              </div>
          </div>

          @include('livewire.admin.thematique.ajouter')
          @include('livewire.admin.thematique.modifier')

</div>