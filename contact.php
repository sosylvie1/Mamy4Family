<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Mamie4Family</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="contact.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="contact-header">
        <h1>Contactez-nous</h1>
        <p>Une question ? Un problème ? Remplissez ce formulaire et nous vous répondrons rapidement.</p>
    </header>

    <div class="contact-container">
        <form action="contact_handler.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Nom complet :</label>
                <input type="text" id="name" name="name" required placeholder="Entrez votre nom">
            </div>

            <div class="form-group">
                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" required placeholder="Entrez votre email">
            </div>

            <div class="form-group">
                <label for="subject">Sujet :</label>
                <input type="text" id="subject" name="subject" required placeholder="Sujet du message">
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required placeholder="Écrivez votre message ici"></textarea>
            </div>

            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>
