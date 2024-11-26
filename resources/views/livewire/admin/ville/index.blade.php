<div>

    @section("title")
    Villes
    @endsection

    @section("page-title")
    VILLES
    @endsection

    @section("element")
        <button role="button" class="btn btn-primary px-2 add-modal">Ajouter une Ville</button>
    @endsection

    @section("navbar-element")
        <input type="text" class="border-0 search-navbar" id="custom-search"  class="border-0" placeholder="Rechercher...">
    @endsection


    <div class="card">
        <div class="card-body py-1 px-0">

            <table class="custom-table w-100">
                <thead>
                    <th>Ville</th>
                    <th>Code postale</th>
                    <th>Leads</th>
                    <th>Action</th>
                </thead>
                <tbody class="custom-striped">

                    @if ($villes->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">Aucune ville</td>
                        </tr>
                    @else

                        @foreach($villes as $index => $ville)
                            <tr>
                                <td>{{ $ville->ville }}</td>
                                <td>{{ $ville->code_postale->code_postale }}</td>
                                <td>{{ $ville->leads_count }}</td>
                                <td>

                                    <a href="#" title="Modifier" class="edit-modal" wire:click="modifier_ville({{ $ville->id }})">
                                        <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                    </a>
                                    <a href="#" title="Supprimer" wire:click="delete_ville({{ $ville->id }})">
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
                      {{ $villes->links('pagination::bootstrap-4') }}
                  </div>
              </div>
          </div>

          @include('livewire.admin.ville.ajouter')
          @include('livewire.admin.ville.modifier')

</div>