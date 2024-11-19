<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message du formulaire de contact</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4; width: 100%; height: 100%; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="500" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; box-shadow: 1px 1px 10px 2px rgba(0,0,0,0.1); border-radius: 8px; font-family: Arial, sans-serif; color: #333;">
                    
                    <!-- Logo Section -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                        <img width="150" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjjTubAaMrXYGWTls9HDEuVmYS785PT-PbBv7thRoMLN8C-rgQrg8NYMEF0O09zRI-qRtoosF_yxO37AbjhsDiH_SBudN_pupSApq7HKvVw3c8UVNuisVYmVbZP7GagiqFYaGj7r5lCZWy8FRi-BoXEZtWZa4JiG5prmtanWq1YbUDi-Bi4h4ztI4ggy7NB/s1600/logo.png" alt="Lead & Boost Logo" />
                        </td>
                    </tr>
                    
                    <!-- Header Section -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <h2 style="font-size: 24px; color: #333;">Nouveau message du formulaire de contact</h2>
                        </td>
                    </tr>
                    
                    <!-- Contact Information -->
                    <tr>
                        <td style="padding: 20px; font-size: 16px; color: #333;">
                            <p><strong>Nom :</strong> {{ $name }}</p>
                            <p><strong>Email :</strong> {{ $email }}</p>
                            <p><strong>Téléphone :</strong> {{ $phone }}</p>
                            <p><strong>Sujet :</strong> {{ $subject }}</p>
                        </td>
                    </tr>
                    <!-- Message Body -->
                    <tr>
                        <td style="padding: 10px; font-size: 16px; color: #333;">
                            <p><strong>Message :</strong></p>
                            <p>{{ $userMessage }}</p>
                        </td>
                    </tr>

                    <!-- Footer Spacer -->
                    <tr>
                        <td style="padding: 10px 20px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
