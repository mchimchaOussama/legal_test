
/**
document.addEventListener('DOMContentLoaded', function() {
    const thematiqueSelect = document.getElementById('thematiqueSelect');
    const departementSelect = document.getElementById('departementSelect');
    const time_filter = document.getElementById('time_filter');
    const type = document.getElementById('type');
    const thematiqueSelectArray = document.getElementById('thematiqueSelectArray');
    const FormSubmit = document.getElementById('FormSubmit');

    if (thematiqueSelect && FormSubmit) {
        thematiqueSelect.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

    if (departementSelect && FormSubmit) {
        departementSelect.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

    if (type && FormSubmit) {
        type.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

    if (thematiqueSelectArray && FormSubmit) {
        thematiqueSelectArray.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

    if (time_filter && FormSubmit) {
        time_filter.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

});

 * 
 * 
 * 
 * 
 * 
 * 
 */

function filterSousThematiques() {
    const thematique = document.getElementById('thematiqueSelectArray').value; 
    const sousThematiqueSelect = document.getElementById('thematiqueSelect'); 

   
    sousThematiqueSelect.innerHTML = '<option value="">Tout</option>';

   
    sousThematiques
        .filter(sousThematique => sousThematique.theme === thematique || thematique === '')
        .forEach(sousThematique => {
            const option = document.createElement('option');
            option.value = sousThematique.thematique;
            option.textContent = sousThematique.thematique;

            
            if (sousThematique.id == selectedSousThematique) {
                option.selected = true; 
            }

            sousThematiqueSelect.appendChild(option);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    if (selectedThematique) {
        const thematiqueSelectArray = document.getElementById('thematiqueSelectArray');
        thematiqueSelectArray.value = selectedThematique; 
        filterSousThematiques(); 
    }
});


