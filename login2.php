<?php 
session_start();
require_once './includes/db_connect.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Validation des champs
    if (!$email) {
        $errors['email'] = "Veuillez entrer un email valide.";
    }
    if (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if (empty($errors)) {
        try {
            $pdo = getDatabaseConnection();

            // Recherche de l'utilisateur dans les tables familles et mamies
            $tables = [
                'familles' => [
                    'id_column' => 'id_famille',
                    'redirect' => 'dashboard_famille.php',
                ],
                'mamies' => [
                    'id_column' => 'id_mamie',
                    'redirect' => 'dashboard_mamie.php',
                ],
            ];

            $userFound = false;

            foreach ($tables as $table => $config) {
                $stmt = $pdo->prepare("SELECT {$config['id_column']} AS user_id, mot_de_passe FROM $table WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['mot_de_passe'])) {
                    // Connexion réussie
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_type'] = $table; // Type d'utilisateur (famille ou mamie)
                    header("Location: {$config['redirect']}");
                    exit;
                }
            }

            if (!$userFound) {
                $errors['general'] = "Identifiants incorrects.";
            }
        } catch (PDOException $e) {
            $errors['general'] = "Erreur de connexion : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mamie4Family</title>
    <link rel="stylesheet" href="assets/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <?php if (!empty($errors['general'])): ?>
            <p class="error-message"><?= htmlspecialchars($errors['general']) ?></p>
        <?php endif; ?>
        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                <span id="emailError" class="error"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <span id="passwordError" class="error"><?= $errors['password'] ?? '' ?></span>
            </div>
            <button type="submit" class="btn-login">Se connecter</button>
        </form>
    </div>
    <script src="assets/validation.js"></script>
</body>

</html>
