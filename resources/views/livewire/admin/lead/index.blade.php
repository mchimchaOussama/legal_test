<div>

    @section("title")
        Leads
    @endsection

    @section("page-title")
        LEADS
    @endsection

    @section("element")
    <div>

        <select class='form-control text-center btn btn-primary d-inline-block' onchange="window.location.href=this.value;" style="width:150px">
            <option value="" class='bg-white text-dark' disabled selected>Ajouter</option>
            <option value="{{ route('admin.lead-ajouter-telecom') }}" class='bg-white text-dark'><a href="#" wire:navigate>Telecom</a></option>
            <option value="{{ route('admin.lead-ajouter-enr') }}" class='bg-white text-dark'> <a href="#" wire:navigate> energie gaz /électrique </a></option>
            <option value="{{ route('admin.lead-ajouter') }}" class='bg-white text-dark'> <a href="#" wire:navigate> Enr Renouvelables</a></option>
            <optgroup label="Formation" class='bg-white text-dark'>
                <option value="{{ route('admin.lead-ajouter-informatique-b2b') }}" class='bg-white text-dark' wire:navigate>B2B</option>
                <option value="{{ route('admin.lead-ajouter-informatique') }}" class='bg-white text-dark' wire:navigate>B2C</option>
            </optgroup>
        </select>
    </div>
  <!-- <a role="button" class="btn btn-primary" href="{{ route('admin.lead-ajouter') }}" wire:navigate>Ajouter un Lead</a>-->

    @endsection


    <style>
    .spinner {
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3; /* Light gray */
        border-top: 3px solid #3498db; /* Blue */
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* You can adjust the size or style of the spinner as needed */
</style>


    <div class="card">


            <div class="card-body py-1 px-0 overflow-auto">

                <form class="mb-3">

                    <div class="filters px-0">
                        
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rechercher</label>
                                <input type="text" placeholder="Rechercher" class="form-control" wire:model="search" wire:keyup="search_function" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
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

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Ville</label>
                                <select class="form-control" wire:model="ville" wire:change="search_function">
                                    <option value="">Tous</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
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

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publié</label>
                                <select class="form-control" wire:model="publier" wire:change="search_function">
                                    <option value="" selected>Tous</option>
                                    <option value="oui">Oui</option>
                                    <option value="non">Non</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Acheté</label>
                                <select class="form-control" wire:model="payer" wire:change="search_function">
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
                                <th>Référence</th>
                                <th>Nom Prénom</th>
                                <th>Tel</th>
                                <th>Thématique</th>
                                <th>Sous Thématique</th>
                                <th>Département</th>
                                <th>Code Postale</th>
                                <th>Publier</th>
                                <th>Send Email</th>
                                @if(session("auth")["role"] == "superviseur")
                                    <th>Acheter</th>
                                @endif
                                <th>Action</th>
                            </thead>
                            <tbody class="custom-striped">
                            
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->reference }}</td>
                                    <td>{{ $lead->prospect->nom }} {{ $lead->prospect->prenom }}</td>
                                    <td>{{ $lead->prospect->tel }}</td>
                                    <td>{{ optional($lead->thematique)->theme}}</td>
                                    <td>{{ optional($lead->thematique)->thematique}}</td>
                                    <td>{{ optional($lead->departement)->departement }}</td>
                                    <td>{{ $lead->code_postale }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" wire:click="activation({{ $lead->publier }}, {{ $lead->id }})" id="activation{{ $lead->id }}" @if($lead->publier) checked @endif>
                                            <label class="custom-control-label" for="activation{{ $lead->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                    <a href="#" class="send-email" data-id="{{ $lead->id }}"
                                        title="Envoyer Email" 
                                        id="send-email-link"
                                        style=" @if($lead->sned_email == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                        <i class="fa-solid fa-envelope fa-lg text-primary"></i>
                                    </a>

                                    <div id="spinner-{{ $lead->id }}" class="spinner" style="display:none;">
                                        <div class="spinner-icon"></div>
                                    </div>
                            
                                    </td>
                                    @if(session("auth")["role"] == "superviseur")
                                    <td>
                                        @if($lead->payer == 1)
                                            <span class="badge badge-success px-1">Oui</span>
                                        @else
                                            <span class="badge badge-danger px-1">Non</span>
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                
                                        @if($lead->thematique && $lead->thematique->theme == "formationB2C" )
                                        <a href="{{ route('admin.lead-modifier-formation.b2c', $lead->id ) }}" title="Modifier" wire:navigate    style=" @if($lead->payer == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        @endif

                                        @if($lead->thematique && $lead->thematique->theme == "formationB2B" )
                                        <a href="{{ route('admin.lead-modifier-formation.b2b', $lead->id ) }}" title="Modifier" wire:navigate    style=" @if($lead->payer == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        @endif

                                        @if($lead->thematique && $lead->thematique->theme == "enr" )
                                        <a href="{{ route('admin.lead-modifier-enr', $lead->id ) }}" title="Modifier" wire:navigate   style=" @if($lead->payer == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        @endif

                                        @if($lead->thematique && $lead->thematique->theme == "telecom" )
                                        <a href="{{ route('admin.lead-modifier-telecom', $lead->id ) }}" title="Modifier" wire:navigate   style=" @if($lead->payer == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        @endif

                                        @if($lead->thematique && $lead->thematique->theme == "enrRenouvelabl" )
                                        <a href="{{ route('admin.lead-modifier', $lead->id ) }}" title="Modifier" wire:navigate    style=" @if($lead->payer == 1 || $lead->payer ) pointer-events: none; opacity: 0.5;  @endif">
                                            <i class="fa-solid fa-pen-clip fa-lg text-secondary mr-1"></i>
                                        </a>
                                        @endif

                                  
                                        <a href="#" title="Supprimer" wire:click="delete_lead({{ $lead->id }})">
                                            <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                                        </a>
                                    </td>

                                    
                                    <td style='display: none;'>
                                        <a href="#" class='hide-link{{ $lead->id }}'  wire:click="sendEmail({{ $lead->id }})" >click</a>
                                    </td>
                                    
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-end mt-2 mx-2">
                        <div class="btn-group" role="group">
                            {{ $leads->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal" tabindex="-1" role="dialog" id="conferm-send-email">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="w-100 text-center pt-1">
                            <div class="w-100 mb-1">
                                <i class="fa-regular fa-circle-question text-warning"></i>
                            </div>
                            <div class="w-100">
                                <h4 class="modal-title text-warning">Confirmer l'opération</h4>
                            </div>
                        </div>

                        <div class="modal-body text-center pb-2">
                            <p class="lead">Vous devez confirmer ce processus</p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <button type="button" class="btn btn-warning" id="modal-confirm-yes">Oui, Confirmer</button>
                        </div>

                    </div>
                </div>
            </div>



            <script>
    $(function() {
        var id = '';
    
        // Show modal when clicking on the send email link
        $('.send-email').click(function(event) {
            event.preventDefault();    
            id = $(this).data('id');
            $('#conferm-send-email').modal('show');
        });

        // On confirmation (Yes, Confirm), trigger the hidden link to send the email
        $('#modal-confirm-yes').click(function(event) {  
            event.preventDefault();
            
            // Show the spinner when the email sending process starts
            $('#spinner-' + id).show();  // Show the spinner for this specific lead ID
            
            // Disable the send email link and show the spinner
            $('#send-email-link').css({
                'pointer-events': 'none',
                'opacity': '0.5'
            });

            // Trigger the hidden link to execute the wire:click action
            $('.hide-link' + id)[0].click();
            
            // Close the confirmation modal
            $('#conferm-send-email').modal('hide');
        });
    });
</script>




</div>