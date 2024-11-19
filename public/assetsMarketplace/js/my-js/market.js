document.addEventListener('DOMContentLoaded', function() {
    const thematiqueSelect = document.getElementById('thematiqueSelect');
    const departementSelect = document.getElementById('departementSelect');
    const time_filter = document.getElementById('time_filter');
    const type = document.getElementById('type');
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

    if (time_filter && FormSubmit) {
        time_filter.addEventListener('change', function() {
            FormSubmit.submit();
        });
    }

});

