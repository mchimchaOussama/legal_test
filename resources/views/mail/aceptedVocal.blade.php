<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Merci d'avoir accepté l'appel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .email-container {
            width: 500px;
            background-color: white;
            box-shadow: 1px 1px 10px 2px rgba(0,0,0, 0.1);
            border-radius: 8px;
        }
        .email-content {
            padding: 20px 30px;
        }
    </style>
    <!-- Add jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="height: 100vh;">
        <tr>
            <td align="center" valign="middle">
                <table class="email-container" cellpadding="0" cellspacing="0" border="0">
                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img width="150" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjjTubAaMrXYGWTls9HDEuVmYS785PT-PbBv7thRoMLN8C-rgQrg8NYMEF0O09zRI-qRtoosF_yxO37AbjhsDiH_SBudN_pupSApq7HKvVw3c8UVNuisVYmVbZP7GagiqFYaGj7r5lCZWy8FRi-BoXEZtWZa4JiG5prmtanWq1YbUDi-Bi4h4ztI4ggy7NB/s1600/logo.png" alt="Lead & Boost Logo" />
                        </td>
                    </tr>
                    <!-- Greeting -->
                    <tr>
                        <td align="center" style="font-size: 24px; font-weight: bold; padding: 10px 20px;">
                            Merci d'avoir accepté l'appel
                        </td>
                    </tr>
                    <!-- Message Body -->
                    <tr>
                        <td class="email-content" align="center" style="font-size: 18px; color: #666666; line-height: 1.5;">
                            Cliquez pour revenir à la page d'accueil.
                        </td>
                    </tr>
                    <!-- Reset Button -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <input type="hidden" value='{{$user->id}}' id='clientId'>
                            <input type="hidden" value='{{$user->verification}}' id='clientVerification'>
                            <a href="{{ url('/') }}" style="display: inline-block; padding: 12px 20px; font-size: 16px; font-weight: bold; color: white; background-color: #ED2027; text-decoration: none; border-radius: 5px;">
                                revenir à la page d'accueil
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Script should be added after jQuery -->
    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Check verification status on page load
            let clientId = $('#clientId').val();
            let clientVerification = $('#clientVerification').val();

            if (clientVerification === '0') { // Ensure it's checked as a string
                // Update verification status to 1
                $.ajax({
                    url: '/update-verification',
                    type: 'POST',
                    data: {
                        clientId: clientId,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function() {
                        console.log('Verification status updated.');
                    },
                    error: function() {
                        console.log('Failed to update verification status.');
                    }
                });
            }
        });
    </script>
</body>
</html>
