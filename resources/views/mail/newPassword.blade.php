
@extends('components.app_client') 
@section('title', 'Réinitialisation du Mot de Passe') 
@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe</title>
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh; /* Full height to center the card */
            display: flex;
            align-items: center; /* Vertically center */
            justify-content: center; /* Horizontally center */
            margin: 0; /* Remove default margin */
        }
        .card {
            width: 100%;
            max-width: 400px; /* Max width for the card */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        .logo {
            max-width: 300; /* Adjust based on your logo size */
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('assetsMarketplace/images/logo.png') }}"  alt="logo" class="logo" />
                
                <h6 class="card-title mb-2">Modifier votre Mot de Passe</h6>
                <div id="success-message mb-4" class="text-success mt-1" style="display: none;"></div>
                <form id="changePasswordForm" action="#" method="POST">
                    @csrf <!-- Laravel CSRF token -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control mb-2" id="password" name="password" placeholder="Entrez votre nouveau mot de passe" required>
                        <div id="password-error" class="text-danger" style="display: none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le Mot de Passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                        <input type="hidden" id='clientId' value='{{$client->id}}'>
                        <div id="confirmation-error" class="text-danger" style="display: none;"></div>
                    </div>
                    <div id="success-message" class="alert alert-success mb-2" style="display: none;"></div>
                    <button type="submit" class="btn btn-danger w-100" id="changePassword">Modifier le Mot de Passe</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous messages
                $('#password-error').hide().text('');
                $('#success-message').hide().text('');

                // Get the email input field value
             
                let password = $('#password').val();
                let password_confirmation = $('#password_confirmation').val();
                let clientId = $('#clientId').val();

                // Check if email is empty
                if (password.trim() === '') {
                    $('#password-error').text('Veuillez entrer votre Nouveau Mot de Passe.').show();
                    return;
                }
                if (password_confirmation.trim() === '') {
                    $('#confirmation-error').text('Veuillez entrer votre Confirmer le Mot de Passe.').show();
                    return;
                }

                if (password !== password_confirmation) {
                    $('#confirmation-error').text('La confirmation du mot de passe ne correspond pas.').show();
                    return;
                }

                // AJAX request
                $.ajax({
                    url: '/update-new-password', // Adjust the URL to your route
                    type: 'POST',
                    data: {
                        password: password,
                        password_confirmation: password_confirmation,
                        clientId: clientId,
                        _token: $('input[name="_token"]').val() // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#success-message').text('Mot de passe modifié avec succès.').show();

                            // Clear password fields
                            $('#password').val('');
                            $('#password_confirmation').val('');

                            // Redirect after 3 seconds
                            setTimeout(function() {
                                window.location.href = '/'; // Redirect to the homepage or desired URL
                            }, 3000); // 3000 milliseconds = 3 seconds
                        } else {
                            $('#email-error').text('La confirmation du mot de passe ne correspond pas.').show();
                        }
                    },
                    error: function(xhr) {
                        let message = 'Une erreur est survenue. Veuillez réessayer.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        $('#email-error').text(message).show();
                    }
                });

            });
        });
    </script>
</body>
</html>

@endsection