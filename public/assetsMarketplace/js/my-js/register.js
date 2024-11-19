// Function to display dropdown options and pre-check selected items
function renderDropdownOptions(data, dropdownId, nameField, selectedIds) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.innerHTML = ''; // Clear existing content
    if (data.length === 0) {
        dropdown.innerHTML = '<div>Aucune option disponible. Veuillez ajouter.</div>'; // Message if no options available
    } else {
        data.forEach(function(item) {
            var checked = selectedIds.includes(item.id) ? 'checked' : '';
            var checkbox = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${item.id}" id="${dropdownId}-${item.id}" ${checked}>
                    <label class="form-check-label" for="${dropdownId}-${item.id}">${item[nameField]}</label>
                </div>`;
            dropdown.innerHTML += checkbox; // Append checkbox to dropdown
        });
    }
}

// Fetch departments via AJAX
function fetchDepartements() {
    $.ajax({
        url: '/api/get-departements',
        method: 'GET',
        success: function(response) {
            renderDropdownOptions(response.departements, 'departementDropdown', 'name', response.selected || []);
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de la récupération des départements :", error);
        }
    });
}

// Fetch thematiques via AJAX
function fetchThematiques() {
    $.ajax({
        url: '/api/get-thematiques',
        method: 'GET',
        success: function(response) {
            renderDropdownOptions(response.thematiques, 'thematiqueDropdown', 'name', response.selected || []);
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de la récupération des thématiques :", error);
        }
    });
}

// Filter dropdown options based on search input
function filterDropdown(searchInputId, dropdownId) {
    var searchInput = document.getElementById(searchInputId).value.toLowerCase();
    var dropdown = document.getElementById(dropdownId);
    var checkboxes = dropdown.querySelectorAll('.form-check');

    checkboxes.forEach(function(checkbox) {
        var label = checkbox.querySelector('.form-check-label').innerText.toLowerCase();
        checkbox.style.display = label.includes(searchInput) ? 'block' : 'none'; // Show or hide checkboxes
    });
}

// Handle checkbox selection and prepare data for submission
function gatherSelectedItems(dropdownId) {
    var selectedIds = [];
    document.querySelectorAll(`#${dropdownId} .form-check-input:checked`).forEach(function(checkbox) {
        selectedIds.push(checkbox.value); // Collect selected IDs
    });
    return selectedIds; // Return the array of selected IDs
}

// Initialize when the page is ready
$(document).ready(function() {
    // Fetch departments and themes on page load
    fetchDepartements();
    fetchThematiques();

    // Filter departments when typing in the search field
    $('#departementSearch').on('input', function() {
        filterDropdown('departementSearch', 'departementDropdown');
    });

    // Filter thematiques when typing in the search field
    $('#thematiqueSearch').on('input', function() {
        filterDropdown('thematiqueSearch', 'thematiqueDropdown');
    });

    // Handle form submission
    $('#submitForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Gather selected departments and thematiques
        var selectedDepartments = gatherSelectedItems('departementDropdown');
        var selectedThematiques = gatherSelectedItems('thematiqueDropdown');

        // Prepare the data to send with AJAX
        var formData = $(this).serializeArray(); // Serialize the form data

        // Add selected departments and thematiques as arrays
        formData.push({ name: 'departements', value: JSON.stringify(selectedDepartments) });
        formData.push({ name: 'thematiques', value: JSON.stringify(selectedThematiques) });

        // Debugging: Log the collected data
        console.log("Departments: ", selectedDepartments);
        console.log("Thematiques: ", selectedThematiques);

        // Send the data using AJAX
        $.ajax({
            type: 'POST',
            url: '/profil/client', // Adjust route name as needed
            data: formData,
            success: function(response) {
                console.log(response);
                toastr.success('Profil mis à jour avec succès !', 'Succès', {
                    closeButton: true,
                    progressBar: true
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                if (xhr.status === 422) { // Validation error (Unprocessable Entity)
                    var errors = xhr.responseJSON.errors; // Laravel provides errors in JSON format
                    $.each(errors, function(key, errorMessages) {
                        // Display each error message using Toastr
                        errorMessages.forEach(function(message) {
                            toastr.error(message, 'Erreur de validation', {
                                closeButton: true,
                                progressBar: true
                            });
                        });
                    });
                } else {
                    // General error
                    toastr.error('Une erreur est survenue lors de la mise à jour du profil.', 'Erreur', {
                        closeButton: true,
                        progressBar: true
                    });
                }
            }
        });
        
    });
});


