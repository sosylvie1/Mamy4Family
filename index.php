<?php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Mamie4Family</title>
  <link rel="stylesheet" href="style.css">
  <!-- insertion pour icone -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <?php include('./includes/navbar.php'); ?>

  <section class="hero-modern">
    <div class="hero-content">
      <div class="hero-text">
        <h1>Mamie4Family</h1>
        <h3>Mamie à louer</h3>
        <p class="subtitle">Vos enfants réclament une mamie, mais la leur habite loin ?</p>
        <p class="description">Chez Mamie4Family, nous vous aidons à trouver une mamie de substitution pour des moments de partage et de bonheur en famille.</p>
        <div class="hero-buttons">
          <button class="btn-dark">
            <i class="fas fa-search"></i> <a href="catalogue_mamies.php">Trouvez votre mamie</a> </button>
          <!-- <a href="catalogue_mamies.php" class="fas fa-search">Rechercher une Mamie</a> -->
        </div>
      </div>
      <div class="hero-image">
        <img src="./assets/images/mamiegateau.jpg" alt="Mamie avec enfants">
      </div>
    </div>
    <div class="features">
      <div class="feature-card">
        <i class="fas fa-shield-alt"></i>
        <h3>Engagements de confiance</h3>
        <p>Sélection rigoureuse des mamies.
          Sécurité des paiements et confidentialité des données.</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-user-friends"></i>
        <h3>Avantages uniques</h3>
        <p>Des moments authentiques en famille.
          Des mamies chaleureuses et compétentes.
        </p>
      </div>
      <div class="feature-card">
        <i class="fas fa-check-circle"></i>
        <h3>Facilité d’utilisation</h3>
        <p>Inscription simple et rapide.
          Nous vous offrons une fléxibilité sur nos services.
        </p>
      </div>
    </div>
  </section>

  <section class="statistics-and-inscription">
    <!-- Section Statistiques -->
    <div class="statistics-section">
      <div class="stat-card">
        <img src="./assets/images/mamiesgroup.png" alt="Mamies Disponibles">
        <h3>Mamies Disponibles</h3>
        <p class="stat-number">347</p>
        <p class="stat-change">+12 depuis la semaine dernière</p>
      </div>
      <div class="stat-card">
        <img src="./assets/images/familleheureuse.png" alt="Familles Heureuses">
        <h3>Familles Heureuses</h3>
        <p class="stat-number">502</p>
        <p class="stat-change">+25 cette semaine</p>
      </div>
    </div>

    <!-- Section Inscription rapide -->

    <div class="section-box">
      <h3>Inscription rapide</h3>
      <p>Rejoignez la communauté Mamie4Family :</p>
      <div class="inscription-buttons">
        <!-- Lien vers la page d'inscription Mamie -->
        <a href="inscription_mamie.php" class="btn-inscription">Devenez Mamie</a>
        <!-- Lien pour les familles -->
        <a href="inscription_famille.php" class="btn-inscription-F">Famille</a>
      </div>
    </div>

  </section>

  <section class="mamie-scroll">

    <section class="mamie-catalogue">
      <!-- Texte explicatif -->
      <div class="texte-explicatif">
        <h2>Trouvez votre mamie idéale</h2>
        <p>
          Découvrez notre sélection de mamies disponibles près de chez vous.
        </p>
      </div>
      <!-- Section Catalogue -->
    <section class="catalogue-section">
        <!-- <h2>Catalogue des Mamies</h2> -->
        <?php include('catalogue_mamies.php'); ?>
    </section>
      <!-- <div class="image-scroll-container">
        <div class="mamie-card" onclick="showProfile('mamie1')">
          <img src="./assets/images/mamiejeux.jpg" alt="Mamie Jeux">
          <p>Mamie Claire</p>
        </div>
        <div class="mamie-card" onclick="showProfile('mamie2')">
          <img src="./assets/images/mamiedevoir.jpg" alt="Mamie Devoir">
          <p>Mamie Sophie</p>
        </div>
        <div class="mamie-card" onclick="showProfile('mamie3')">
          <img src="./assets/images/mamieballon.webp" alt="Mamie ballon">
          <p>Mamie Élodie</p>
        </div>
        <div class="mamie-card" onclick="showProfile('mamie4')">
          <img src="./assets/images/mamiepetitenfant.jpg" alt="Mamie petits enfant">
          <p>Mamie Charlotte</p>
        </div>
      </div> -->
    </section>

    <!-- Modale pour afficher le profil complet
    <div id="profile-modal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="profile-content">
           Le contenu du profil sera injecté ici via JavaScript 
        </div>
      </div>
    </div>

     Modale pour afficher le profil complet 
    <div id="profile-modal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="profile-content">
          Le contenu du profil sera injecté ici via JavaScript 
        </div>
      </div>
    </div>-->
 





    <!-- Section Avis -->
    <section class="section-box bloc-avis">
      <h2>Avis des familles</h2>

      <div class="avis-container">
        <div class="avis">
          <div class="family-info">
            <img src="./assets/images/temoinfemme2.jpg" alt="Famille Landrés" class="family-photo">
            <p class="family-name">Famille Landrés</p>
          </div>
          <p>⭐⭐⭐⭐⭐</p>
          <p>“Mamie Claire a illuminé notre journée spéciale.”</p>
        </div>
        <div class="avis">
          <div class="family-info">
            <img src="./assets/images/papa temoin.jpg" alt="Famille Karls" class="family-photo">
            <p class="family-name">Famille Karls</p>
          </div>
          <p>⭐⭐⭐⭐</p>
          <p>“Merci Mamie Élodie pour votre patience et gentillesse !”</p>
        </div>
        <div class="avis">
          <div class="family-info">
            <img src="./assets/images/familleLouis.jpg" alt="Famille Carloti" class="family-photo">
            <p class="family-name">Famille Carloti</p>
          </div>
          <p>⭐⭐⭐⭐⭐</p>
          <p>“Un vrai bonheur pour toute la famille, merci Mamie Charlotte.”</p>
        </div>
      </div>
      <!-- Bouton Voir Plus -->
      <div class="voir-plus-container">
        <a href="#" class="voir-plus-button">Voir plus</a>
      </div>
    </section>

    <?php include('./includes/footer.php'); ?>
</body>


</html>