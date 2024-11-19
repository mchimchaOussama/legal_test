<div>

    @section("title")
    Départements
    @endsection

    @section("page-title")
    DÉPARTEMENTS
    @endsection

    @section("element")
        <a role="button" class="btn btn-primary px-1 add-modal">Ajouter Départements</a>
    @endsection


    <div class="card">
        <div class="card-body py-1 px-0">

            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Département</th>
                        <th>Leads</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="custom-striped">

                        @if ($departements->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">Aucune département</td>
                            </tr>
                        @else

                            @foreach($departements as $index => $departement)
                                <tr>
                                    <td>{{ $departement->num }}</td>
                                    <td>{{ $departement->departement }}</td>
                                    <td>{{ $departement->leads_count }}</td>
                                    <td>
                                        <a href="#" title="Modifier" wire:click="modifier_departement({{ $departement->id }})">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        <a href="#" title="Supprimer" wire:click="delete_departement({{ $departement->id }})">
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
                      {{ $departements->links('pagination::bootstrap-4') }}
                  </div>
              </div>
          </div>

          @include('livewire.admin.departement.ajouter')
          @include('livewire.admin.departement.modifier')

</div>