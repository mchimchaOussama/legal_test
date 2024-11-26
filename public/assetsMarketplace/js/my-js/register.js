
function renderDropdownOptions(data, dropdownId, num , nameField, selectedIds) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.innerHTML = ''; 
    if (data.length === 0) {
        dropdown.innerHTML = '<div>Aucune option disponible. Veuillez ajouter.</div>'; 
    } else {
        data.forEach(function(item) {
            var checked = selectedIds.includes(item.id) ? 'checked' : '';
            var checkbox = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${item.id}" id="${dropdownId}-${item.id}" ${checked}>
                 <label class="form-check-label" for="${dropdownId}-${item.id}"> ${item[num] ? item[num] + ' , ' : ''}${item[nameField]}</label>
                </div>`;
            dropdown.innerHTML += checkbox; 
        });
    }
}


function fetchDepartements() {
    $.ajax({
        url: '/api/get-departements',
        method: 'GET',
        success: function(response) {
            renderDropdownOptions(response.departements, 'departementDropdown', 'num' , 'name', response.selected || []);
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de la récupération des départements :", error);
        }
    });
}


function fetchThematiques() {
    $.ajax({
        url: '/api/get-thematiques',
        method: 'GET',
        success: function(response) {
            renderDropdownOptions(response.thematiques, 'thematiqueDropdown','num' ,'name', response.selected || []);
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de la récupération des thématiques :", error);
        }
    });
}


function filterDropdown(searchInputId, dropdownId) {
    var searchInput = document.getElementById(searchInputId).value.toLowerCase();
    var dropdown = document.getElementById(dropdownId);
    var checkboxes = dropdown.querySelectorAll('.form-check');

    checkboxes.forEach(function(checkbox) {
        var label = checkbox.querySelector('.form-check-label').innerText.toLowerCase();
        checkbox.style.display = label.includes(searchInput) ? 'block' : 'none'; 
    });
}


function gatherSelectedItems(dropdownId) {
    var selectedIds = [];
    document.querySelectorAll(`#${dropdownId} .form-check-input:checked`).forEach(function(checkbox) {
        selectedIds.push(checkbox.value); 
    });
    return selectedIds; 
}


$(document).ready(function() {
    fetchDepartements();
    fetchThematiques();

    
    $('#departementSearch').on('input', function() {
        filterDropdown('departementSearch', 'departementDropdown');
    });


    $('#thematiqueSearch').on('input', function() {
        filterDropdown('thematiqueSearch', 'thematiqueDropdown');
    });

 
    $('#submitForm').on('submit', function(event) {
        event.preventDefault(); 

        
        var selectedDepartments = gatherSelectedItems('departementDropdown');
        var selectedThematiques = gatherSelectedItems('thematiqueDropdown');

      
        var formData = $(this).serializeArray(); 

      
        formData.push({ name: 'departements', value: JSON.stringify(selectedDepartments) });
        formData.push({ name: 'thematiques', value: JSON.stringify(selectedThematiques) });

  
        console.log("Departments: ", selectedDepartments);
        console.log("Thematiques: ", selectedThematiques);

  
        $.ajax({
            type: 'POST',
            url: '/profil/client', 
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
                if (xhr.status === 422) { 
                    var errors = xhr.responseJSON.errors; 
                    $.each(errors, function(key, errorMessages) {
                       
                        errorMessages.forEach(function(message) {
                            toastr.error(message, 'Erreur de validation', {
                                closeButton: true,
                                progressBar: true
                            });
                        });
                    });
                } else {
                  
                    toastr.error('Une erreur est survenue lors de la mise à jour du profil.', 'Erreur', {
                        closeButton: true,
                        progressBar: true
                    });
                }
            }
        });
        
    });
});


