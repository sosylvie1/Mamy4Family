<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Mamie4Family</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="faq.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="faq-header">
        <h1>FAQ - Mamie4Family</h1>
        <p>Trouvez des réponses aux questions les plus fréquentes. Si vous avez d'autres questions, <a href="contact.php">contactez-nous</a>.</p>
    </header>

    <div class="faq-container">
        <!-- Section FAQ -->
        <section class="faq-section">
            <h2>Questions Fréquentes</h2>
            <div class="faq-item">
                <h3><i class="fas fa-question-circle"></i> Comment fonctionne le service "Mamie4Family" ?</h3>
                <p>Mamie4family est une plateforme de mise en relation entre des familles et des Mamies disponibles pour offrir des prestations de service comme la compagnie, des activités pour enfants, ou l'aide aux personnes isolées. Les familles peuvent consulter les profils des Mamies, choisir une prestation et réserver directement en ligne.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-question-circle"></i> Quelles prestations puis-je demander à une Mamie ?</h3>
                <p>Les Mamies proposent :</p>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Compagnie et discussions</li>
                    <li><i class="fas fa-check-circle"></i> Animation d'activités pour enfants</li>
                    <li><i class="fas fa-check-circle"></i> Aide aux devoirs</li>
                    <li><i class="fas fa-check-circle"></i> Aide pour des événements familiaux</li>
                </ul>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-question-circle"></i> Comment réserver une Mamie ?</h3>
                <p>Créez un compte, remplissez vos critères, puis parcourez les profils. Consultez les évaluations et choisissez celle qui vous correspond le mieux.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-question-circle"></i> Les paiements sont-ils sécurisés ?</h3>
                <p>Oui, les paiements sont effectués via des plateformes sécurisées comme PayPal. Vos données bancaires ne sont pas stockées.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-question-circle"></i> Que faire si je rencontre un problème avec une Mamie ?</h3>
                <p>Contactez notre support client pour résoudre rapidement et équitablement toute situation. Vous pouvez également laisser un avis sur la prestation.</p>
            </div>

            <div class="faq-item highlight">
                <h3><i class="fas fa-hands-helping"></i> Puis-je proposer mes services en tant que Mamie ?</h3>
                <p>Oui ! <a href="inscription-mamie.php">Inscrivez-vous ici</a> et rejoignez notre communauté de Mamies actives.</p>
            </div>
        </section>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>