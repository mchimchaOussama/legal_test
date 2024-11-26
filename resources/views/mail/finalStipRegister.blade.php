<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte a été activé avec succès !</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4; width: 100%; height: 100%; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="500" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; box-shadow: 1px 1px 10px 2px rgba(0,0,0,0.1); border-radius: 8px; font-family: Arial, sans-serif; color: #333;">
                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img width="150" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjjTubAaMrXYGWTls9HDEuVmYS785PT-PbBv7thRoMLN8C-rgQrg8NYMEF0O09zRI-qRtoosF_yxO37AbjhsDiH_SBudN_pupSApq7HKvVw3c8UVNuisVYmVbZP7GagiqFYaGj7r5lCZWy8FRi-BoXEZtWZa4JiG5prmtanWq1YbUDi-Bi4h4ztI4ggy7NB/s1600/logo.png" alt="Lead & Boost Logo" style="display: block; border: 0; max-width: 100%; height: auto;" />
                        </td>
                    </tr>
                    <!-- Greeting -->
                    <tr>                                        
                        <td align="center" style="font-size: 24px; font-weight: bold; padding: 10px 20px; color: #333;">
                            Bonjour, {{ $user->nom }} {{ $user->prenom }}
                        </td>
                    </tr>
                    <!-- Message Body -->
                    <tr>
                        <td align="center" style="padding: 10px 20px; font-size: 16px; color: #333;">
                            Nous avons le plaisir de vous informer que votre compte sur **Lead & Boost** est désormais  @if($user->firstActivateCompte > 1 ) réactiver   @elseif ($user->firstActivateCompte <= 1) activé @endif <br>

                            Vous pouvez dès maintenant accéder à votre espace client pour consulter les leads
                            disponibles, gérer vos préférences, et commencer à explorer les opportunités adaptées à
                            votre secteur. 
                            <br>
                            Merci de votre confiance et à bientôt sur Lead & Boost !  <br><br>

                            Bien cordialement,
                            L’équipe Lead & Boost
                        </td>
                    </tr>
                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ url('/') }}" style="display: inline-block; padding: 12px 20px; font-size: 16px; font-weight: bold; color: #ffffff; background-color: #ED2027; text-decoration: none; border-radius: 5px;">
                                Revenir à la page d'accueil
                            </a>
                        </td>
                    </tr>
                    <!-- Spacer -->
                    <tr>
                        <td style="padding: 10px 20px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
