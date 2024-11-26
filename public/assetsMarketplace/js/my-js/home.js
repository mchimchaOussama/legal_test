
$(document).ready(function() {
    // Load leads for the first thematique by default
    loadLeads($('.nav-link-item').first().data('thematique-id'));

    // Function to load leads based on thematique ID
    function loadLeads(thematiqueId) {
        $.ajax({
            url: '/get-leads', // Route for AJAX request
            type: 'GET',
            data: { thematique_id: thematiqueId },
            success: function(response) {
                $('#leads-container').empty(); // Clear existing leads

                if (response.leads && response.leads.length > 0) {
                    response.leads.forEach(function(lead) {
                        // Use the thematique image
                        const thematiqueImage = `/storage/${lead.thematique.image}`;

                        // Format the updated_at date
                        const updatedAt = new Date(lead.updated_at);
                        const formattedDate = updatedAt.toLocaleDateString('fr-FR'); // Formats date to 'dd/mm/yyyy'
                        // Construct property details URL using the global variable
                        const propertyUrl = `${propertyDetailsUrl}/${lead.id}`;
                        const routeWithParams = cartAddRoute.replace(':lead', lead.id);
                        $('#leads-container').append(`
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="homeya-box">
                                    <div class="archive-top">
                                        <a href="${propertyUrl}" class="images-group">
                                            <div class="images-style">
                                                <img src="${thematiqueImage}" alt="img" style="width: 300px; height: 150px;">      
                                            </div>
                                            <div class="top">
                                                <ul class=""> <span class='flag-tag style-2'>${lead.departement.departement} </span> <span class='flag-tag style-2'>${lead.code_postale}</span></ul>
                                                <ul class="d-flex gap-4"></ul>
                                            </div>
                                            <div class="bottom">
                                                <span class="flag-tag success style-2">   ${lead.thematique.theme === 'enr' ? 'énergie gaz / électrique' : lead.thematique.theme}</span>
                                            </div>
                                        </a>
                                        <div class="content">
                                            <div class='row'>
                                                <div class="col-lg-9">
                                                    <div class="text-capitalize fw-7"><a href="${propertyUrl}" class="link"> ${lead.thematique.thematique}</a></div>
                                                </div>
                                                <div class="col-lg-3">
                                                    ${isAuthenticated ? `
                                                        <li>
                                                            <i class="fas fa-eye"></i>
                                                            <span>${lead.viewed_by_clients_count}</span>
                                                        </li>` : ''
                                                    }
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="archive-bottom d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-8 align-items-center">
                                                <li class="item">
                                                     <p class='h7'>€ ${lead.prix}</p>
                                                </li>
                                            </div>
                                            <div class="d-flex gap-8 align-items-center">
                                            
                                                     <form method="POST" action="${routeWithParams}" class="contact-form">
                                                        <input type="hidden" name="_token" value="${csrfToken}">
                                                        <input type="image" src="${addCartImage}" width="30" height="30" alt="addPanier">
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#leads-container').append('<p class="alert alert-warning" >Aucune Lead disponible pour cette thématique.</p>');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
    // Event handler for tab clicks
    $('.nav-link-item').on('click', function(e) {
        e.preventDefault();
        const thematiqueId = $(this).data('thematique-id');
        loadLeads(thematiqueId); // Load leads for the selected thematique
    });
});


