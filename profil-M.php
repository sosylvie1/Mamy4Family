<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mamie - Mamie4Family</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profil-M.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="mamie-header">
        <h1>Profil de Mamie Sophie</h1>
        <p>Découvrez les compétences et expériences de Mamie Sophie.</p>
    </header>

    <div class="profile-container">
        <!-- Colonne gauche : Coordonnées personnelles -->
        <section class="profile-left">
            <div class="profile-photo">
                <img src="./images/mamie-profile.jpg" alt="Photo de Mamie Sophie">
            </div>
            <h2>Mamie Sophie</h2>
            <ul class="profile-info">
                <li><i class="fas fa-map-marker-alt"></i> Paris, Île-de-France</li>
                <li><i class="fas fa-star"></i> Évaluation : 4.8/5 (50 avis)</li>
                <li><i class="fas fa-phone"></i> 06 12 34 56 78</li>
                <li><i class="fas fa-envelope"></i> sophie@example.com</li>
            </ul>
        </section>

        <!-- Colonne droite : Expériences et compétences -->
        <section class="profile-right">
            <h2>Compétences</h2>
            <ul>
                <li><i class="fas fa-child"></i> Animation d'activités pour enfants</li>
                <li><i class="fas fa-book"></i> Aide aux devoirs</li>
                <li><i class="fas fa-utensils"></i> Préparation de repas familiaux</li>
                <li><i class="fas fa-seedling"></i> Jardinage et bricolage</li>
                <li><i class="fas fa-heart"></i> Compagnie et discussions</li>
            </ul>

            <h2>Références</h2>
            <ul>
                <li><i class="fas fa-user"></i> Famille Dupont : "Mamie Sophie est adorable et très compétente !"</li>
                <li><i class="fas fa-user"></i> Famille Martin : "Une expérience incroyable avec les enfants."</li>
            </ul>

            <h2>Disponibilités</h2>
            <p><i class="fas fa-calendar-alt"></i> Disponible du lundi au vendredi</p>
            <p><i class="fas fa-calendar-alt"></i> Possibilité de week-ends sur demande</p>
            <!-- Conteneur du Bouton -->
            <!-- lien vers page reservation donc pas bouton -->
            <!-- <button class="btn-reserve">Réserver cette Mamie</button> -->
            <div class="btn-container">
                <a href="reservation.php" class="btn-reserve">Réserver cette Mamie</a>
            </div>
        </section>

    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>