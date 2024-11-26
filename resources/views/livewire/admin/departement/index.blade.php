<div>

    @section("title")
    Départements
    @endsection

    @section("page-title")
    DÉPARTEMENTS
    @endsection


    @section("element")
        <a role="button" class="btn btn-primary px-1 add-modal">Ajouter Département</a>
    @endsection

    
    @section("navbar-element")
        <input type="text" class="border-0 search-navbar"  class="border-0" placeholder="Rechercher...">
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


            <div class="w-100 mt-1 mb-2 mx-2">

                @if($departements instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <span class="text-secondary me-1">Pages:</span>

                    @php

                        $pagination_start = $departements->currentPage() - 2;
                        
                        if($pagination_start <= 0) $pagination_start = 1;

                        $pagination_end   = $departements->currentPage() + 2;

                        if($pagination_end > $departements->lastPage()) $pagination_end = $departements->lastPage();

                    @endphp

                    <a type="button" class="btn btn-outline-secondary btn-sm" href="?page=1" wire:navigate title="Première page">
                        <
                    </a>
                    @for($p=$pagination_start; $p <= $pagination_end; $p++)
                        <a type="button" class="btn @if($departements->currentPage() == $p) btn-secondary @else btn-outline-secondary @endif btn-sm" href="?page={{ $p }}">
                            {{ $p }}
                        </a>
                    @endfor
                    <a type="button" class="btn btn-outline-secondary btn-sm" href="?page={{ $departements->lastPage() }}" title="Dernière page">
                        >
                    </a>

                @endif

            <div>

          </div>

          @include('livewire.admin.departement.ajouter')
          @include('livewire.admin.departement.modifier')

</div>