<?php


require_once './includes/db_connect.php';

$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $age = intval($_POST['age']);
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $tarif_horaire = floatval($_POST['tarif_horaire']);
    $competences = htmlspecialchars(trim($_POST['competences']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Gestion des fichiers
    $photoProfil = $_FILES['photo_profil'];
    $photoIdentite = $_FILES['photo_piece_identite'];

    // Validation des champs obligatoires
    if (!$email) {
        $errors['email'] = "Adresse email invalide.";
    }
    if (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }
    if (empty($prenom) || empty($nom) || empty($adresse) || empty($ville)) {
        $errors['general'] = "Tous les champs obligatoires doivent être remplis.";
    }
    if (empty($photoProfil['name']) || empty($photoIdentite['name'])) {
        $errors['photos'] = "Les deux photos sont obligatoires.";
    }

    if (empty($errors)) {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare("SELECT id_mamie FROM mamies WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors['email'] = "Cet email est déjà utilisé.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Gestion des uploads de fichiers
                $photoProfilPath = 'uploads/profile_' . uniqid() . '.' . pathinfo($photoProfil['name'], PATHINFO_EXTENSION);
                $photoIdentitePath = 'uploads/idcard_' . uniqid() . '.' . pathinfo($photoIdentite['name'], PATHINFO_EXTENSION);

                if (!move_uploaded_file($photoProfil['tmp_name'], $photoProfilPath)) {
                    $errors['photo_profil'] = "Erreur lors du téléchargement de la photo de profil.";
                }
                if (!move_uploaded_file($photoIdentite['tmp_name'], $photoIdentitePath)) {
                    $errors['photo_piece_identite'] = "Erreur lors du téléchargement de la pièce d'identité.";
                }

                if (empty($errors)) {
                    // Insertion dans la base de données
                    $stmt = $pdo->prepare("
                        INSERT INTO mamies (prenom, nom, age, adresse, ville, telephone, email, mot_de_passe, tarif_horaire, competences, photo_profil, photo_piece_identite)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([
                        $prenom, $nom, $age, $adresse, $ville, $telephone, $email, $hashedPassword, $tarif_horaire, $competences, $photoProfilPath, $photoIdentitePath
                    ]);

                    $success = "Inscription réussie !";
                    header('Location: login2.php');
                    exit;
                }
            }
        } catch (PDOException $e) {
            $errors['general'] = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Mamie</title>
    <link rel="stylesheet" href="assets/inscriptionM.css">
    <script src="assets/validation.js" defer></script>
</head>
<body>
    <header class="header">
        <h1>Inscription Mamie</h1>
        <p>Rejoignez notre communauté des mamies de cœur !</p>
    </header>

    <div class="form-container">
        <?php if (!empty($errors['general'])): ?>
            <p class="error-message"><?= htmlspecialchars($errors['general']) ?></p>
        <?php elseif ($success): ?>
            <p class="success-message"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($_POST['age'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="tarif_horaire">Tarif horaire (€) :</label>
                <input type="number" step="0.01" id="tarif_horaire" name="tarif_horaire" value="<?= htmlspecialchars($_POST['tarif_horaire'] ?? '') ?>" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="competences">Compétences :</label>
                <textarea id="competences" name="competences" rows="3"><?= htmlspecialchars($_POST['competences'] ?? '') ?></textarea>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="photo_profil">Photo de profil :</label>
                <input type="file" id="photo_profil" name="photo_profil" accept="image/*" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="photo_piece_identite">Photo de pièce d'identité :</label>
                <input type="file" id="photo_piece_identite" name="photo_piece_identite" accept="image/*" required>
                <span class="error"></span>
            </div>

            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
