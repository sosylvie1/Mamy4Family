<?php
session_start();
require_once './includes/db_connect.php';

if (!isset($_GET['id_reservation'])) {
    header('Location: reservation.php');
    exit;
}

$idReservation = $_GET['id_reservation'];

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT montant FROM reservations WHERE id_reservation = ?");
    $stmt->execute([$idReservation]);
    $reservation = $stmt->fetch();

    if (!$reservation) {
        echo "Réservation introuvable.";
        exit;
    }
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
    <title>Paiement</title>
    <script src="https://www.paypal.com/sdk/js?client-id=VOTRE_CLIENT_ID_PAYPAL&currency=EUR"></script>
</head>
<body>
    <h1>Paiement</h1>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?= $reservation['montant'] ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Redirection après paiement réussi
                    window.location.href = 'paiement_reussi.php?id_reservation=<?= $idReservation ?>';
                });
            },
            onCancel: function(data) {
                // Redirection après annulation
                window.location.href = 'paiement_annule.php?id_reservation=<?= $idReservation ?>';
            },
            onError: function(err) {
                console.error(err);
                alert("Une erreur est survenue lors du paiement.");
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
