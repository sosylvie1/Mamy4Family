<?php
session_start();
require_once './includes/db_connect.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_famille'])) {
    header('Location: login.php');
    exit;
}

$idFamille = $_SESSION['id_famille'];

try {
    $pdo = getDatabaseConnection();

    // Récupération des informations de la famille
    $stmt = $pdo->prepare("SELECT * FROM familles WHERE id_famille = ?");
    $stmt->execute([$idFamille]);
    $famille = $stmt->fetch();

    if (!$famille) {
        echo "Erreur : Famille introuvable.";
        exit;
    }

    // Récupération des enfants associés
    $stmtEnfants = $pdo->prepare("SELECT * FROM enfants WHERE id_famille = ?");
    $stmtEnfants->execute([$idFamille]);
    $enfants = $stmtEnfants->fetchAll();

    // // Récupération des messages reçus et envoyés BASEDEDONNEES TBLE PAS CREEE
    // $stmtMessages = $pdo->prepare("
    //     SELECT * 
    //     FROM messages 
    //     WHERE id_famille = ?
    //     ORDER BY date_message DESC
    // ");
    // $stmtMessages->execute([$idFamille]);
    // $messages = $stmtMessages->fetchAll();

    // Récupération des réservations
    $stmtReservations = $pdo->prepare("
        SELECT * 
        FROM reservations 
        WHERE id_famille = ?
        ORDER BY date_reservation DESC
    ");
    $stmtReservations->execute([$idFamille]);
    $reservations = $stmtReservations->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Famille</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/dashboard_famille.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="header">
        <h1>Bienvenue, <?= htmlspecialchars($famille['prenom']) ?> !</h1>
        <p>Voici votre tableau de bord personnalisé.</p>
    </header>

    <main>
        <!-- Section Profil -->
        <section class="profile-section">
            <div class="profile-container">
                <!-- Colonne gauche : Photo de profil -->
                <div class="profile-photo-container">
                    <img src="<?= htmlspecialchars($famille['photo_profil']) ?>" alt="Photo de profil" class="profile-photo">
                </div>
                <!-- Colonne droite : Infos personnelles -->
                <div class="profile-info">
                    <h2>Vos informations personnelles</h2>
                    <ul>
                        <li><i class="fas fa-user"></i> <strong>Nom :</strong> <?= htmlspecialchars($famille['nom']) ?></li>
                        <li><i class="fas fa-user"></i> <strong>Prénom :</strong> <?= htmlspecialchars($famille['prenom']) ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> <strong>Adresse :</strong> <?= htmlspecialchars($famille['adresse']) ?></li>
                        <li><i class="fas fa-city"></i> <strong>Ville :</strong> <?= htmlspecialchars($famille['ville']) ?></li>
                        <li><i class="fas fa-phone"></i> <strong>Téléphone :</strong> <?= htmlspecialchars($famille['telephone']) ?></li>
                        <li><i class="fas fa-envelope"></i> <strong>Email :</strong> <?= htmlspecialchars($famille['email']) ?></li>
                    </ul>
                    <button class="btn-edit" onclick="editProfile()">Modifier mes informations</button>
                </div>
            </div>
        </section>

        <!-- Section Enfants -->
        <section class="children-section">
            <h2>Vos enfants</h2>
            <div class="children-list">
                <?php if (!empty($enfants)): ?>
                    <ul>
                        <?php foreach ($enfants as $enfant): ?>
                            <li>
                                <i class="fas fa-child"></i>
                                <strong>Prénom :</strong> <?= htmlspecialchars($enfant['prenom']) ?>,
                                <strong>Âge :</strong> <?= htmlspecialchars($enfant['age']) ?> ans,
                                <strong>Genre :</strong> <?= htmlspecialchars($enfant['genre']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun enfant enregistré.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Section des messages -->
        <section class="messages-section">
            <h2>Vos messages</h2>
            <?php if (!empty($messages)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?= htmlspecialchars($message['nom_expediteur']) ?></td>
                                <td><?= htmlspecialchars($message['contenu']) ?></td>
                                <td><?= htmlspecialchars($message['date_message']) ?></td>
                                <td><?= htmlspecialchars($message['statut']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun message pour le moment.</p>
            <?php endif; ?>
        </section>

        <!-- Section des réservations -->
        <!-- Section des réservations -->
        <section class="reservations-section">
            <h2>Vos réservations</h2>
            <form id="search-reservations-form">
                <label for="search-reservations">Rechercher :</label>
                <input type="text" id="search-reservations" name="search_reservations" placeholder="Nom ou référence">
                <input type="date" id="search-reservations-date" name="search_reservations_date">
                <button type="submit" class="btn-search">Rechercher</button>
            </form>

            <?php if (!empty($reservations)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Nom de la mamie</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th>Facture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['date_reservation']) ?></td>
                                <td><?= htmlspecialchars($reservation['nom_mamie']) ?></td>
                                <td><?= htmlspecialchars($reservation['prix']) ?> €</td>
                                <td><?= htmlspecialchars($reservation['statut']) ?></td>
                                <td><a href="factures/<?= htmlspecialchars($reservation['facture']) ?>" download>Télécharger</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune réservation pour le moment.</p>
            <?php endif; ?>
        </section>

        <!-- Actions -->
        <section class="actions-section">
            <h2></h2>
            <button onclick="logout()">Déconnexion</button>
        </section>
    </main>

    <script>
        function editProfile() {
            alert("Redirection vers la modification du profil !");
            // Redirection dynamique ici
        }

        function logout() {
            if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                window.location.href = 'deconnexion.php';
            }
        }
    </script>
    <?php include('./includes/footer.php'); ?>
</body>

</html>