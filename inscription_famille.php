<?php
session_start();
require_once './includes/db_connect.php';



$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $photoProfil = $_FILES['photo_profil'];

    $childNames = $_POST['child_name'] ?? [];
    $childAges = $_POST['child_age'] ?? [];
    $childGenders = $_POST['child_gender'] ?? [];
    

    // Validation des champs
    if (!preg_match('/^[A-ZÀ-Ÿ]/', $prenom)) {
        $errors['prenom'] = "Le prénom doit commencer par une majuscule.";
    }
    if (!preg_match('/^[A-ZÀ-Ÿ]/', $nom)) {
        $errors['nom'] = "Le nom doit commencer par une majuscule.";
    }
    // if (!preg_match('/^\d+\s+\S+\s+\d{5}$/', $adresse)) {
    //     $errors['adresse'] = "L'adresse doit inclure un numéro, une rue, et un code postal valide.";
    // }
    if (empty($ville) || !preg_match('/^[A-Za-zÀ-Ÿ\- ]+$/', $ville)) {
        $errors['ville'] = "La ville est invalide. Elle doit contenir uniquement des lettres.";
    }
    if (!preg_match('/^\d{10}$/', $telephone)) {
        $errors['telephone'] = "Le numéro de téléphone doit comporter exactement 10 chiffres.";
    }
    if (!$email || strlen($email) < 8 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide ou trop court (minimum 8 caractères).";
    }
    if (strlen($password) < 5) {
        $errors['password'] = "Le mot de passe doit comporter au moins 5 caractères.";
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }
    if (empty($photoProfil['name']) || !in_array($photoProfil['type'], ['image/jpeg', 'image/png']) || $photoProfil['size'] > 2 * 1024 * 1024) {
        $errors['photo_profil'] = "L'image doit être un fichier JPEG ou PNG de 2MB maximum.";
    }
    if (empty($childNames[0]) || empty($childAges[0]) || empty($childGenders[0])) {
        $errors['children'] = "Vous devez ajouter au moins un enfant avec un prénom, un âge, et un genre.";
    }

    // Vérification de l'email unique
    if (empty($errors)) {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare("SELECT id_famille FROM familles WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors['email'] = "Cet email est déjà utilisé.";
            }
        } catch (PDOException $e) {
            $errors['general'] = "Erreur lors de la connexion à la base : " . $e->getMessage();
        }
    }

    // Insertion dans la base de données
    if (empty($errors)) {
        try {
            // Gestion de l'upload de la photo
            $photoPath = 'uploads/' . uniqid('profil_') . '.' . pathinfo($photoProfil['name'], PATHINFO_EXTENSION);
            if (!move_uploaded_file($photoProfil['tmp_name'], $photoPath)) {
                throw new Exception("Erreur lors de l'upload de la photo de profil.");
            }

            // Insertion dans la table familles
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $pdo->prepare("INSERT INTO familles (prenom, nom, adresse, ville, telephone, email, mot_de_passe, photo_profil, date_inscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$prenom, $nom, $adresse, $ville, $telephone, $email, $hashedPassword, $photoPath]);
            $familleId = $pdo->lastInsertId();

            // Insertion des enfants
            $stmt = $pdo->prepare("INSERT INTO enfants (id_famille, prenom, age, genre) VALUES (?, ?, ?, ?)");
            foreach ($childNames as $index => $childName) {
                $stmt->execute([$familleId, htmlspecialchars($childName), intval($childAges[$index]), htmlspecialchars($childGenders[$index])]);
            }

            // Redirection après succès
            header('Location: login2.php');
            exit;
        } catch (Exception $e) {
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
    <title>Inscription Mamie - Mamie4Family</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/inscriptionM.css">

</head>


<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>


    <header class="header">
        <h1>Inscription Famille</h1>
        <p>Rapide, simple et sécurisée </p>
    </header>

    <div class="form-container">
        <form id="inscription_famille" method="POST" enctype="multipart/form-data">
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                <span id="prenomError" class="error"><?= $errors['prenom'] ?? '' ?></span>
            </div>
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                <span id="nomError" class="error"><?= $errors['nom'] ?? '' ?></span>
            </div>
            <div>
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" required>
                <span id="adresseError" class="error"><?= $errors['adresse'] ?? '' ?></span>
            </div>
            <div>
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" required>
                <span id="villeError" class="error"><?= $errors['ville'] ?? '' ?></span>
            </div>
            <div>
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" required>
                <span id="telephoneError" class="error"><?= $errors['telephone'] ?? '' ?></span>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                <span id="emailError" class="error"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <span id="passwordError" class="error"><?= $errors['password'] ?? '' ?></span>
            </div>
            <div>
                <label for="confirm_password">Confirmez le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <span id="confirmPasswordError" class="error"><?= $errors['confirm_password'] ?? '' ?></span>
            </div>
            <div>
                <label for="photo_profil">Photo de profil :</label>
                <input type="file" id="photo_profil" name="photo_profil" accept="image/jpeg,image/png" required>
                <span id="photoError" class="error"><?= $errors['photo_profil'] ?? '' ?></span>
            </div>
            <div id="children-info">
                <h3>Informations sur les enfants</h3>
                <div class="child">
                    <label>Nom de l'enfant :</label>
                    <input type="text" name="child_name[]" required>
                    <span class="error"><?= $errors['children'] ?? '' ?></span>
                </div>
                <div>
                    <label>Âge :</label>
                    <input type="number" name="child_age[]" min="0" required>
                    <span class="error"><?= $errors['children'] ?? '' ?></span>
                </div>
                <div>
                    <label>Genre :</label>
                    <select name="child_gender[]" required>
                        <option value="">Sélectionner</option>
                        <option value="fille">Fille</option>
                        <option value="garçon">Garçon</option>
                    </select>
                    <span class="error"><?= $errors['children'] ?? '' ?></span>
                </div>
            </div>
            <button type="button" id="add-child-btn">Ajouter un enfant</button>
            <!-- Bouton d'inscription -->
            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>
        </form>
    </div>
    <!-- Inclusion du script de validation -->
    <script src="./assets/validation.js"></script>
</body>

</html>