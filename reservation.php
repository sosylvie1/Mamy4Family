<?php
session_start();
require_once './includes/db_connect.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idFamille = $_SESSION['id_famille'] ?? null;
    $idMamie = intval($_POST['id_mamie']);
    $dateReservation = htmlspecialchars(trim($_POST['date_reservation']));
    $heureDebut = htmlspecialchars(trim($_POST['heure_debut']));
    $heureFin = htmlspecialchars(trim($_POST['heure_fin']));
    $tarifHoraire = floatval($_POST['tarif_horaire']);
    $montant = 0;

    // Calcul du montant
    if ($heureDebut && $heureFin) {
        $debut = strtotime($heureDebut);
        $fin = strtotime($heureFin);
        $duree = ($fin - $debut) / 3600;

        if ($duree > 0) {
            $montant = $tarifHoraire * $duree;
        } else {
            $errors['horaire'] = "L'heure de fin doit être après l'heure de début.";
        }
    }

    // Vérification des conflits
    if (empty($errors)) {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare("
                SELECT * FROM reservations
                WHERE id_mamie = ? AND date_reservation = ?
                AND (heure_debut < ? AND heure_fin > ?)
            ");
            $stmt->execute([$idMamie, $dateReservation, $heureFin, $heureDebut]);

            if ($stmt->fetch()) {
                $errors['general'] = "La mamie est déjà réservée pour cette plage horaire.";
            }
        } catch (PDOException $e) {
            $errors['general'] = "Erreur lors de la vérification : " . $e->getMessage();
        }
    }

    // Enregistrement de la réservation
    if (empty($errors)) {
        try {
            $facturePath = "factures/facture_" . uniqid() . ".pdf"; // Génération de facture
            $stmt = $pdo->prepare("
                INSERT INTO reservations (id_famille, id_mamie, date_reservation, heure_debut, heure_fin, montant, statut, facture)
                VALUES (?, ?, ?, ?, ?, ?, 'en attente', ?)
            ");
            $stmt->execute([$idFamille, $idMamie, $dateReservation, $heureDebut, $heureFin, $montant, $facturePath]);

            // Générer la facture (code de génération à intégrer ici)

            $success = "Votre réservation a été enregistrée avec succès !";
        } catch (PDOException $e) {
            $errors['general'] = "Erreur lors de la réservation : " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="stylesheet" href="assets/reservation.css">
</head>
<body>
    <header>
        <h1>Réserver une Mamie</h1>
    </header>
    <div class="form-container">
        <form id="reservation-form" method="POST">
            <div class="form-group">
                <label for="id_mamie">Choisissez une Mamie :</label>
                <select id="id_mamie" name="id_mamie" required>
                    <option value="">-- Sélectionnez une mamie --</option>
                    <?php
                    try {
                        $pdo = getDatabaseConnection();
                        $stmt = $pdo->query("SELECT id_mamie, prenom, nom, tarif_horaire FROM mamies");
                        $mamies = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($mamies as $mamie) {
                            echo "<option value='{$mamie['id_mamie']}' data-tarif='{$mamie['tarif_horaire']}'>" .
                                htmlspecialchars("{$mamie['prenom']} {$mamie['nom']} (Tarif: {$mamie['tarif_horaire']} €/h)") .
                                "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erreur lors du chargement des mamies.</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_reservation">Date de réservation :</label>
                <input type="date" id="date_reservation" name="date_reservation" required>
            </div>
            <div class="form-group">
                <label for="heure_debut">Heure de début :</label>
                <input type="time" id="heure_debut" name="heure_debut" required>
            </div>
            <div class="form-group">
                <label for="heure_fin">Heure de fin :</label>
                <input type="time" id="heure_fin" name="heure_fin" required>
            </div>
            <div class="form-group">
                <label for="montant">Montant à payer :</label>
                <p id="montant">0 €</p>
            </div>
            <button type="submit" class="btn-submit">Réserver</button>
        </form>
    </div>
    <script>
        // Calcul du montant
        document.getElementById('reservation-form').addEventListener('input', function () {
            const heureDebut = document.getElementById('heure_debut').value;
            const heureFin = document.getElementById('heure_fin').value;
            const tarifHoraire = document.getElementById('id_mamie').selectedOptions[0].getAttribute('data-tarif');

            if (heureDebut && heureFin && tarifHoraire) {
                const debut = new Date(`1970-01-01T${heureDebut}Z`);
                const fin = new Date(`1970-01-01T${heureFin}Z`);
                const duree = (fin - debut) / (1000 * 60 * 60); // Convertir en heures

                if (duree > 0) {
                    const montant = (tarifHoraire * duree).toFixed(2);
                    document.getElementById('montant').textContent = `${montant} €`;
                } else {
                    document.getElementById('montant').textContent = "Durée invalide.";
                }
            }
        });
    </script>
</body>
</html>
