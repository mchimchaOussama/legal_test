<div>

    @section("title")
        Thématiques
    @endsection

    @section("page-title")
        THÉMATIQUES
    @endsection

    @section("navbar-element")
        <input type="text" class="border-0 search-navbar"  class="border-0" placeholder="Rechercher..." id="custom-search">
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
                                    <td>
                                        @if ($thematique->theme == 'enr')
                                        energie gaz /électrique
                                        @else
                                        {{ $thematique->theme }}
                                        @endif
                                    </td>
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

                    <div class="w-100 mt-1 mb-2">

                        @if($thematiques instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <span class="text-secondary me-1">Pages:</span>

                            @php

                                $pagination_start = $thematiques->currentPage() - 2;
                                if($pagination_start <= 0) $pagination_start = 1;

                                $pagination_end   = $thematiques->currentPage() + 2;
                                if($pagination_end > $thematiques->lastPage()) $pagination_end = $thematiques->lastPage();

                            @endphp

                            <a type="button" class="btn btn-outline-secondary btn-sm" href="?page=1" wire:navigate title="Première page">
                                <
                            </a>
                            @for($p=$pagination_start; $p <= $pagination_end; $p++)
                                <a type="button" class="btn @if($thematiques->currentPage() == $p) btn-secondary @else btn-outline-secondary @endif btn-sm" href="?page={{ $p }}" wire:navigate>
                                    {{ $p }}
                                </a>
                            @endfor
                            <a type="button" class="btn btn-outline-secondary btn-sm" href="?page={{ $thematiques->lastPage() }}" wire:navigate title="Dernière page">
                                >
                            </a>

                        @endif

                    <div>
                    
                  </div>
              </div>
          </div>

          @include('livewire.admin.thematique.ajouter')
          @include('livewire.admin.thematique.modifier')

</div>