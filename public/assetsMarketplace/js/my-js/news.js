///////////////// newsleater .//////////////////////////////////
$(document).ready(function () {
    $('#subscribe-News').click(function (e) {
        e.preventDefault();

        // Get the email input
        const email = $('#subscribe-email').val();
        const $subscribeMsg = $('#subscribe-msg');
        
        // Check if the email is empty
        if (email === '') {
            $subscribeMsg.html('<p style="color: red;">Votre adresse email est vide. Veuillez réessayer.</p>');    
            return;
        }

        // Clear any previous messages
        $subscribeMsg.html('');

        // Perform AJAX request
        $.ajax({
            url: '/subscribe', // Replace with your server endpoint
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token if needed
            },
            data: JSON.stringify({ email: email }),
            contentType: 'application/json',
            success: function (data) {
                
                if (data.success) {
                    $subscribeMsg.html('<p style="color: green;">Abonnement réussi !</p>');

                    setTimeout(function () {
                        $subscribeMsg.html('');
                    }, 5000);

                } else {
                    $subscribeMsg.html('<p style="color: red;">' + (data.message || 'Échec de l\'abonnement') + '</p>');
                }
            },
            error: function () {
                $subscribeMsg.html('<p style="color: red;">Une erreur s\'est produite. Veuillez réessayer.</p>');
            }
        });
    });
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////