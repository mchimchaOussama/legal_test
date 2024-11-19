<div>

    @section("title")
        Comptes
    @endsection

    @section("page-title")
        COMPTES
    @endsection

    @section("element")
        <a role="button" class="btn btn-primary" href="{{ route('admin.ajouter-compte') }}" wire:navigate>Ajouter un compte</a>
    @endsection

    <div class="card">
        <div class="card-body py-1 px-0">

            <table class="custom-table w-100">
                <thead>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nom d'utilisateur</th>
                    <th>Role</th>
                    <th>Désactiver / Activer</th>
                    <th>Action</th>
                </thead>
                <tbody class="custom-striped">


                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->prenom }}</td>
                                <td>{{ ucfirst($user->nom_utilisateur) }}</td>
                                <td>{{ ucfirst($user->role->role) }}</td>

                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" wire:click="activation({{ $user->activer }} , {{ $user->id }})" id="activation{{ $user->id }}" @if($user->activer) checked @endif>
                                        <label class="custom-control-label" for="activation{{ $user->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" title="Modifier" class="edit-modal" wire:click="modifier_user({{ $user->id }})" >
                                        <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                    </a>
                                    <a href="#" title="Supprimer" wire:click="delete_user({{ $user->id }})">
                                        <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>


            <div class="d-flex justify-content-end align-items-center mt-2 px-2">
                <a class="btn btn-secondary mr-1 btn-pagination" href="{{ $users->previousPageUrl() }}" wire:navigate>Précédent</a>
                <a class="btn btn-secondary btn-pagination" href="{{ $users->nextPageUrl() }}" wire:navigate>Suivant</a>
            </div>

        </div>
    </div>


    @include('livewire.admin.administrateurs.edit')

</div>