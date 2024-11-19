<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Tab/Enter Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Formulaire avec Navigation Tab/Enter</h2>
    <form id="myForm">
        <div class="mb-3">
            <label for="firstName" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstName" placeholder="Entrez votre prénom">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Nom de famille</label>
            <input type="text" class="form-control" id="lastName" placeholder="Entrez votre nom de famille">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Entrez votre email">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <select class="form-select" id="city">
                <option value="paris">Paris</option>
                <option value="lyon">Lyon</option>
                <option value="marseille">Marseille</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="3" placeholder="Entrez votre message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Detect keypress or tabulation and move focus to next input
        $('form').on('keydown', 'input, select, textarea', function(e) {
            // Check if the pressed key is "Enter" or "Tab"
            if (e.key === "Enter" || e.key === "Tab") {
                // Prevent the default action only if it's "Enter"
                if (e.key === "Enter") {
                    e.preventDefault(); // Prevent form submission or any other default action
                }

                // Find the next input field in the form
                var nextInput = $(this).closest('form').find('input, select, textarea').eq($(this).closest('form').find('input, select, textarea').index(this) + 1);
                
                // If no next input, submit the form (last input reached)
                if (!nextInput.length) {
                    $(this).closest('form').submit(); // Submit the form
                } else {
                    // Set focus to the next input if it exists
                    nextInput.focus();
                }
            }
        });
    });
</script>



</body>
</html>



<!--     chatboooot  


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-box {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            height: 500px; /* Hauteur de la boîte de chat */
        }
        .chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }
        .chat-messages {
            height: 400px; /* Hauteur de la zone des messages */
            overflow-y: auto;
            padding: 10px;
            background-color: #f8f9fa;
        }
        .message {
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .message.sent {
            background-color: #007bff;
            color: white;
            text-align: right; /* Aligner le texte à droite pour les messages envoyés */
        }
        .message.received {
            background-color: #d4edda;
            color: black;
            text-align: left; /* Aligner le texte à gauche pour les réponses */
        }
        .question {
            cursor: pointer;
            color: #007bff;
            font-weight: bold;
        }
    </style>
    <title>Boîte de Chat</title>
</head>
<body>
    <div class="container mt-5">
        <div class="chat-box">
            <div class="chat-header">
                <h2 class="mb-0">FAQ</h2>
            </div>
            <div class="chat-messages" id="chat-messages">
                <!-- Questions et réponses -->
                <div class="question" data-answer="Je vais bien, merci ! Et vous ?">
                    Comment ça va ?
                </div>
                <div class="question" data-answer="Nous sommes ouverts de 9h à 18h, du lundi au vendredi.">
                    Quelles sont vos heures d'ouverture ?
                </div>
                <div class="question" data-answer="Au revoir ! À bientôt.">
                    Au revoir
                </div>
                <!-- Espace pour afficher les messages -->
            </div>
        </div>
    </div>

    <script>
        // Fonction pour ajouter un message à la zone de messages
        function addMessage(text, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            messageDiv.innerText = text;

            const chatMessages = document.getElementById('chat-messages');
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight; // Faire défiler vers le bas
        }

        // Gestion des clics sur les questions
        document.querySelectorAll('.question').forEach(question => {
            question.addEventListener('click', () => {
                const userQuestion = question.innerText;
                const answer = question.getAttribute('data-answer');

                // Ajouter le message envoyé par l'utilisateur
                addMessage(userQuestion, 'sent');
                // Ajouter la réponse après un délai pour simuler la réponse
                setTimeout(() => {
                    addMessage(answer, 'received');
                }, 1000); // Délai d'une seconde pour simuler la réponse
            });
        });
    </script>
</body>
</html>




--------------------------->
