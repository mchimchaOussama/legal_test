<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Lead Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center" style="padding: 30px;">
                <table width="500" cellpadding="0" cellspacing="0" border="0" style="background-color: white; box-shadow: 1px 1px 10px 2px rgba(0,0,0, 0.1);">
                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img width="150" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjjTubAaMrXYGWTls9HDEuVmYS785PT-PbBv7thRoMLN8C-rgQrg8NYMEF0O09zRI-qRtoosF_yxO37AbjhsDiH_SBudN_pupSApq7HKvVw3c8UVNuisVYmVbZP7GagiqFYaGj7r5lCZWy8FRi-BoXEZtWZa4JiG5prmtanWq1YbUDi-Bi4h4ztI4ggy7NB/s1600/logo.png" alt="Lead & Boost Logo" />
                        </td>
                    </tr>
                    <!-- Title -->
                    <tr>
                        <td align="center" style="font-size: 24px; font-weight: bold; padding: 10px 20px;">
                        Votre commande a été Accéptée
                        </td>
                    </tr>
                    <!-- Message Body -->
                    <tr>
                        <td align="center" style="font-size: 16px; color: #666666; line-height: 1.5; padding: 10px 30px;">
                            Bonjour {{$cmd->client->nom}} {{$cmd->client->prenom}},<br><br>
                            Nous avons le plaisir de vous informer que votre commande numéro <strong>#{{$cmd->id}}</strong> a été acceptée avec succès.<br><br>

                            Nos équipes se chargeront de traiter votre commande dans les meilleurs délais. Vous recevrez une notification une fois que celle-ci sera prête ou expédiée.<br><br>

                            Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter.<br><br>

                            Cordialement,<br>
                            L'équipe <strong>Lead & Boost</strong> 
                        </td>
                    </tr>
                    <!-- Call to Action -->
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 14px; color: #aaaaaa;">
                            © 2024 Lead & Boost. Tous droits réservés.<br>
                            <a href="https://www.leadandboost.com/privacy" style="color: #888888; text-decoration: none;">Politique de Confidentialité</a> |
                            <a href="https://www.leadandboost.com/contact" style="color: #888888; text-decoration: none;">Contactez-nous</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
