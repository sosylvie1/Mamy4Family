<?php
session_start();

// Inclusion de la connexion à la base de données
require_once './includes/db_connect.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id_mamie'])) { // Utilisation cohérente de id_mamie
    header('Location: login.php'); // Redirige vers la page de connexion si pas connecté
    exit;
}

// Récupération de l'identifiant de la mamie depuis la session
$idMamie = $_SESSION['id_mamie'];

try {
    // Connexion à la base de données
    $pdo = getDatabaseConnection();

    // Récupération des données de la mamie
    $stmt = $pdo->prepare("SELECT * FROM mamies WHERE id_mamie = ?");
    $stmt->execute([$idMamie]);
    $mamie = $stmt->fetch();

    if (!$mamie) {
        // Aucune mamie trouvée avec cet identifiant
        echo "Aucune mamie trouvée avec cet identifiant.";
        exit;
    }
} catch (PDOException $e) {
    // Gestion des erreurs de connexion ou de requête
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mamie</title>
    <link rel="stylesheet" href="./assets/dashboard_mamie.css">
</head>
<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>
    <header class="dashboard-header">
        <h1>Bienvenue, <?= htmlspecialchars($mamie['prenom']) ?> !</h1>
        <p>Voici votre tableau de bord personnalisé.</p>
    </header>

    <main class="dashboard-main">
        <!-- Informations principales -->
        <section class="profile-section">
            <h2>Vos informations</h2>
            <ul>
                <li><strong>Nom complet :</strong> <?= htmlspecialchars($mamie['prenom'] . ' ' . $mamie['nom']) ?></li>
                <li><strong>Âge :</strong> <?= htmlspecialchars($mamie['age']) ?> ans</li>
                <li><strong>Adresse :</strong> <?= htmlspecialchars($mamie['adresse'] . ', ' . $mamie['ville']) ?></li>
                <li><strong>Email :</strong> <?= htmlspecialchars($mamie['email']) ?></li>
                <li><strong>Tarif horaire :</strong> <?= htmlspecialchars($mamie['tarif_horaire']) ?> €</li>
                <li><strong>Compétences :</strong> <?= nl2br(htmlspecialchars($mamie['competences'])) ?></li>
            </ul>
        </section>

        <!-- Photo de profil -->
        <section class="photo-section">
            <h2>Photo de profil</h2>
            <img src="<?= htmlspecialchars($mamie['photo_profil']) ?>" alt="Photo de profil de <?= htmlspecialchars($mamie['prenom']) ?>" class="profile-photo">
        </section>

        <!-- Actions -->
        <section class="actions-section">
            <h2>Actions</h2>
            <button onclick="updateProfile()">Modifier mon profil</button>
            <button onclick="logout()">Déconnexion</button>
        </section>
    </main>

    <script>
        // Fonction pour déconnexion
        function logout() {
            if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                window.location.href = 'logout.php';
            }
        }

        // Fonction pour modifier le profil (redirection)
        function updateProfile() {
            window.location.href = 'update_profile_mamie.php';
        }
    </script>
</body>
</html>
