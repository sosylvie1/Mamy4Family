<?php
require_once './includes/db_connect.php';

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT id_mamie, prenom, nom, age, tarif_horaire, competences, photo_profil, ville FROM mamies");
    $mamies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Mamies</title>
    <link rel="stylesheet" href="assets/catalogue_m.css">
</head>

<body>

    <header class="hero">
        <h1>Catalogue de nos Mamies</h1>
    </header>


    <!-- Conteneur scroll horizontal -->
    <div class="catalogue-scroll-container">
        <?php foreach ($mamies as $mamie): ?>
            <div class="mamie-card">
                <img src="<?= htmlspecialchars($mamie['photo_profil'] ?? 'assets/default-profile.png') ?>" alt="Photo de <?= htmlspecialchars($mamie['prenom']) ?>" class="mamie-photo">
                <h2><?= htmlspecialchars($mamie['prenom'] . ' ' . $mamie['nom']) ?></h2>
                <p><strong>Âge :</strong> <?= htmlspecialchars($mamie['age']) ?> ans</p>
                <p><strong>Ville :</strong> <?= htmlspecialchars($mamie['ville']) ?></p>
                <p><strong>Tarif horaire :</strong> <?= htmlspecialchars($mamie['tarif_horaire']) ?> €/h</p>
                <button class="btn-details" onclick="viewDetails(<?= $mamie['id_mamie'] ?>)">Voir plus</button>
                <button class="btn-reserve" onclick="reserve(<?= $mamie['id_mamie'] ?>)">Réserver</button>
            </div>
        <?php endforeach; ?>
    </div>





    <script>
        function viewDetails(idMamie) {
            window.location.href = 'details_mamie.php?id=' + idMamie;
        }

        function reserve(idMamie) {
            window.location.href = 'reservation.php?id_mamie=' + idMamie;
        }
    </script>
</body>

</html>