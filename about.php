<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Mamie4Family</title>
    <link rel="stylesheet" href="about.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="hero">
        <h1>Bienvenue sur Mamie4Family</h1>
        <p>Un lien intergénérationnel unique pour une vie familiale plus riche.</p>
    </header>

    <div class="container">
        <main class="main-content">
            <section class="content-about">
                <h2>À propos de Mamie4Family</h2>
                <p>Notre plateforme propose une approche unique combinant expertise intergénérationnelle et relations humaines authentiques.</p>
                <ul>
                    <li><i class="fas fa-heart"></i> <strong>Expérience intergénérationnelle :</strong> Une richesse culturelle et émotionnelle unique.</li>
                    <li><i class="fas fa-hand-holding-heart"></i> <strong>Relations personnalisées :</strong> Des liens adaptés aux besoins de chaque famille.</li>
                    <li><i class="fas fa-coins"></i> <strong>Tarifs abordables :</strong> Accessibles sans compromis sur la qualité.</li>
                    <li><i class="fas fa-calendar-alt"></i> <strong>Flexibilité :</strong> Adapté à vos besoins, ponctuels ou réguliers.</li>
                    <li><i class="fas fa-users"></i> <strong>Solidarité :</strong> En luttant contre l’isolement des seniors, nous créons des liens durables.</li>
                </ul>
            </section>

           
            <section class="how-it-works">
                <h2>Comment ça marche ?</h2>
                <p>Découvrez le fonctionnement de Mamie4Family en quelques clics.</p>
                <a href="how-it-works.php" class="btn-link">En savoir plus</a>
            </section>
            <section class="how-it-works">
                <h2>Notre histoire </h2>
                <p>Découvrez l'histoire de Mamie4Family en quelques mots.</p>
                <a href="histoire.php" class="btn-link">En savoir plus</a>
            </section>
        </main>

        <aside class="aside-filter">
            <h3>Rechercher une Mamie</h3>
            <form>
                <div class="filter-group">
                    <label for="location">Localisation :</label>
                    <input type="text" id="location" name="location" placeholder="Entrez une ville">
                </div>
                <div class="filter-group">
                    <label for="availability">Disponibilité :</label>
                    <select id="availability" name="availability">
                        <option value="anytime">À tout moment</option>
                        <option value="morning">Matin</option>
                        <option value="afternoon">Après-midi</option>
                        <option value="evening">Soir</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="skills">Compétences :</label>
                    <input type="text" id="skills" name="skills" placeholder="Exemple : Cuisine, jeux">
                </div>
                <button type="submit" class="btn-search">Rechercher</button>
            </form>
        </aside>
    </div>

    <?php include('./includes/footer.php'); ?>
</body>

</html>