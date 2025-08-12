<?php
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment ça marche - Mamie4Family</title>
    <link rel="stylesheet" href="howitworks.css">
</head>

<body>
    <!-- Inclusion de la navbar -->
    <?php include('./includes/navbar.php'); ?>

    <!-- Section principale "Comment ça marche" -->
    
    <header class="hero">
        <h1>Bienvenue sur comment ça marche</h1>
        <p>Simple, facile et sécurisé !</p>
    </header>
    <section class="how-it-works">
        <div class="container-columns">
            <!-- Colonne Texte -->
            <div class="column-text">
                <h1>Comment ça marche ?</h1>
                <ol>
                    <li><strong>Étape 1 :</strong> Inscription sur la plateforme.</li>
                    <li><strong>Étape 2 :</strong> Recherchez une Mamie grâce à nos outils intuitifs.</li>
                    <li><strong>Étape 3 :</strong> Prenez contact avec la Mamie sélectionnée.</li>
                    <li><strong>Étape 4 :</strong> Réservez et profitez d’un moment en famille.</li>
                </ol>

                <!-- Mode de paiement -->
                <div class="payment-info">
                    
                    <p>Notre système de paiement est simple et sécurisé :</p>
                    <ul>
                        <li>La famille effectue le paiement intégral via PayPal au moment de la réservation.</li>
                        <li>PayPal transfère le montant convenu à la Mamie après la prestation.</li>
                        <li>Une commission de service de <strong>8%</strong> est reversée à Mamie4Family.</li>
                    </ul>
                    <p>Ce système garantit transparence, sécurité et une rémunération équitable pour toutes les parties.</p>
                </div>
            </div>

            <!-- Colonne Aside : Filtre de Recherche -->
            <aside class="column-aside">
                <h3>Rechercher une Mamie</h3>
                <form>
                    <div class="filter-group">
                        <label for="location">Localisation :</label>
                        <input type="text" id="location" name="location" placeholder="Entrez une ville">
                    </div>
                    <div class="filter-group">
                        <label for="availability">Disponibilité :</label>
                        <select id="availability" name="availability">
                            <option value="anytime">À tout moment</option>
                            <option value="morning">Matin</option>
                            <option value="afternoon">Après-midi</option>
                            <option value="evening">Soir</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="skills">Compétences :</label>
                        <input type="text" id="skills" name="skills" placeholder="Exemple : Cuisine, jeux">
                    </div>
                    <button type="submit" class="btn-search">Rechercher</button>
                </form>
            </aside>
        </div>
    </section>

    <!-- Inclusion du footer -->
    <?php include('./includes/footer.php'); ?>
</body>

</html>
