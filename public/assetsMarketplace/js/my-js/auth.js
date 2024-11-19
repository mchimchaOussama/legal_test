
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous success message
        $('#success-message').hide().text('');
        $('#terms-error').hide().text(''); // Clear terms error message
        $('#cb1').removeClass('is-invalid'); // Remove invalid class from checkbox

        $.ajax({
            url: '/api/register',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Display success message
                    $('#success-message-register').text(response.message).show();

                    // Optionally reset the form fields
                    $('#registerForm')[0].reset();
                    $('#terms-error').hide(); // Hide terms error if previously displayed
                }
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // You can display errors below the respective input fields
                        let input = $('[name=' + key + ']');
                        input.addClass('is-invalid mb-2'); // Add a red border to the input
                        input.next('.invalid-feedback').remove(); // Remove any existing feedback
                        input.after('<div class="invalid-feedback">' + value[0] + '</div>'); // Show error message
                    });

                    // Check if terms were accepted
                    if (errors.termsAccepted) {
                        $('#terms-error').text(errors.termsAccepted[0]).show(); // Show terms error message
                        $('#cb1').addClass('is-invalid'); // Add red border to checkbox
                    } else {
                        $('#terms-error').hide(); // Hide terms error if there are no errors
                    }
                }
            }
        });
    });


});

/////////login/////////////////////////
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Clear previous error messages
        $('#email-error').hide().text('');
        $('#password-error').hide().text('');

        $.ajax({
            url: '/api/login', // Adjust the URL to your route
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Reload the page on successful login
                    location.reload();
                } else {
                    // Display error messages for email and password
                    if (response.errors.email) {
                        $('#email-error').text(response.errors.email).show();
                    }
                    if (response.errors.password) {
                        $('#password-error').text(response.errors.password).show();
                    }
                    if (response.errors.verification) {
                        $('#err-message').text(response.errors.verification).show();
                    }
                }
            },
            error: function(xhr) {
                // Handle validation errors if any
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $('#email-error').text(errors.email[0]).show(); // Show error for email
                    }
                    if (errors.password) {
                        $('#password-error').text(errors.password[0]).show(); // Show error for password
                    }
                }
            }
        });
    });
});
///////////reset//////////////////////////////////////////////////////////////
$(document).ready(function() {
    $('#resetPassword').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous messages
        $('#email-error').hide().text('');
        $('#success-message').hide().text('');

        // Get the email input field value
        let email = $('input[name="email"]').val();

        // Check if email is empty
        if (email.trim() === '') {
            $('#email-error').text('Veuillez entrer votre email.').show();
            return;
        }

        // AJAX request
        $.ajax({
            url: '/client/reset-password', // Adjust the URL to your route
            type: 'POST',
            data: {
                email: email,
                _token: $('input[name="_token"]').val() // CSRF token
            },
            success: function(response) {
                // Check if the response indicates success
                if (response.success) {
                    $('#success-message').text('Demande de réinitialisation de mot de passe envoyée avec succès. Vérifiez votre boîte e-mail.').show();
                } else {
                    $('#email-error').text('Aucun client trouvé avec cet email.').show();
                }
            },
            error: function(xhr) {
                let message = 'Une erreur est survenue. Veuillez réessayer.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message; // Show server error message if available
                }
                $('#email-error').text(message).show();
            }
        });
    });
});

//////////////////////////////////////////////////////////////////////

$(document).ready(function() {
    // Ajout de l'en-tête CSRF à toutes les requêtes AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Vérification de l'email
    $("#verifyEmailBtn").on("click", function() {
        const email = $("#emailField").val();
        if (!email) {
            $('#err-message-register').text('Veuillez entrer votre email.').show();
            return;
        }

        $.ajax({
            url: "/send-verification-code",
            type: "POST",
            data: {
                email: email,
            },
            success: function(response) {
                $('#success-message-vr').text('Code de vérification envoyé.').show();

                setTimeout(function() {
                    $('#success-message-vr').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
                }, 3000); // 2000 millisecondes = 2 secondes

                sessionStorage.setItem("verificationCode", response.code);

                // Afficher le champ de code de vérification
                $("#emailField").prop("readonly", true);
                $("#codeFieldset").show();
                $("#verifyEmailBtn").hide(); // Masquer le bouton d'envoi du code
            },
            error: function(xhr) {
                $('#err-message-register').text("Email déja trouvé").show();
                setTimeout(function() {
                    $('#err-message-register').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
                }, 3000); // 2000 millisecondes = 2 secondes
            }
        });
    });

    // Vérification du code de confirmation
    $("#verifyCodeBtn").on("click", function() {
        const enteredCode = $("#code").val();
        const originalCode = sessionStorage.getItem("verificationCode");

        if (enteredCode === originalCode) {
            $('#success-message-fn').text("Code vérifié avec succès !").show();

            setTimeout(function() {
                $('#success-message-fn').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
            }, 3000); // 2000 millisecondes = 2 secondes

            $("#hiddenFields").show(); // Afficher les champs cachés
            $("#registerBtn").prop("disabled", false); // Activer le bouton S'inscrire
            $("#codeFieldset").hide(); // Masquer le champ de code de vérification
            $("#verifyCodeBtn").hide(); // Masquer le bouton de vérification
            $("#emailField").prop("readonly", true);
        } else {
            $('#err-message-register').text('Code incorrect. Veuillez réessayer.').show();
            setTimeout(function() {
                $('#err-message-register').fadeOut(); // Vous pouvez utiliser fadeOut() pour un effet de disparition
            }, 3000); // 2000 millisecondes = 2 secondes
            $("#registerBtn").prop("disabled", true); // Désactiver le bouton S'inscrire
        }
    });
});





