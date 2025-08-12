<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histoire - Mamie4Family</title>
    <!-- meme css que about -->
    <link rel="stylesheet" href="about.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php'); ?>

    <header class="hero">
        <h1>Bienvenue sur Mamie4Family</h1>
        <p>Un concept est né </p>
    </header>

    <div class="container">
        <main class="main-content">
            <section class="content-about">
                <h2>Une histoire d’amour familial et de partage</h2>
                <p>Jacqueline, fondatrice de Mamie4Family, n’est pas une mamie comme les autres.À 67 ans, elle déborde d’énergie et de passion pour transmettre son amour et ses talents.
                    <p> Mais comme beaucoup de grands-parents modernes, Jacqueline s’est retrouvée confrontée à une réalité qu’elle n’avait pas anticipée : l’éloignement de ses petits-enfants.
                    Ses deux filles avaient déménagé dans des villes lointaines pour leur travail, emmenant avec elles leurs enfants qu’elle adorait.</p>
                    Le téléphone et les appels vidéo étaient un moyen de rester en contact, mais cela ne comblait pas ce manque qu’elle ressentait de ne plus pouvoir serrer ses petits-enfants dans ses bras, raconter des histoires le soir ou préparer leurs goûters préférés.
                    <p>
                    Un jour, lors d’une conversation avec une amie, Jacqueline a eu une idée. Cette amie lui racontait à quel point elle aurait aimé que ses propres enfants aient une "mamie de cœur" pour leur offrir cette chaleur intergénérationnelle. Jacqueline s’est alors dit :
                    "Pourquoi ne pas partager mon amour, mes histoires et mes talents avec d’autres familles ? Pourquoi ne pas devenir une mamie pour celles et ceux qui en rêvent, mais qui n’ont pas cette chance ?"</p>
</section>
<section class="how-it-works">
                <h2>Le concept de Mamie4Family est né</h2>
                <p>C’est ainsi qu’a germé l’idée de Mamie4Family – une plateforme pour mettre en relation des familles qui cherchent une figure maternelle ou grand-maternelle pour leurs enfants avec des mamies prêtes à partager leur temps et leur bienveillance.
                    Jacqueline a pensé à tout :</p>
                <ul>

                    <li>Pour les familles en quête de lien : Une mamie pour garder les enfants, leur lire des histoires, leur apprendre à tricoter ou à cuisiner des recettes traditionnelles.</li>
                    <li>Pour les événements spéciaux : Une mamie pour animer un anniversaire, transmettre son savoir-faire artisanal ou simplement apporter une touche chaleureuse lors de moments importants.</li>
                    <li>Pour les mamies : Une chance de se sentir utile, de transmettre leur héritage et de créer de nouveaux liens, même lorsque leurs propres petits-enfants sont loin.
                    </li>

                </ul>
            </section>


            <section class="how-it-works">
                <h2>Un succès intergénérationnel</h2>
                <p>Le projet a rapidement pris de l’ampleur. Jacqueline a commencé à recruter d’autres mamies prêtes à rejoindre l’aventure. Elle les a appelées les "Mamies de Cœur", des femmes dynamiques, pleines d’amour et de ressources. Ensemble, elles ont bâti une communauté solidaire où chacune trouvait un sens nouveau à sa vie.
                Mamie4Family est devenue bien plus qu’un simple service : c’était un moyen de recréer du lien, de briser l’isolement des personnes âgées et d’offrir aux enfants des souvenirs précieux.
            </p>
                
            </section>
            <section class="how-it-works">
                <h2>Un projet pour toutes les générations </h2>
                <p>Aujourd’hui, Jacqueline est fière de voir des milliers de familles bénéficier de cette initiative. Lorsqu’on lui demande ce qu’elle ressent, elle répond avec un sourire :
"C’est un rêve devenu réalité. Je ne suis pas seulement une mamie pour ma famille, je le suis pour des centaines d’enfants. Et vous savez quoi ? Ce sont eux qui me donnent le plus d’énergie et de joie !"
Avec Mamie4Family, Jacqueline a prouvé qu’il n’y a pas d’âge pour innover, partager et se réinventer. Une simple idée née d’un manque personnel est devenue une révolution intergénérationnelle, apportant chaleur, amour et connexion dans le cœur de nombreuses familles.
</p>
                
            </section>
            <section class="how-it-works">
                <h2>La vision de Mamie4Family </h2>
                <p>Jacqueline rêve que chaque enfant, peu importe sa situation, puisse grandir avec la présence bienveillante d’une mamie. Et que chaque mamie puisse, si elle le souhaite, vivre une retraite active en partageant tout ce qu’elle a de plus précieux : son temps, ses valeurs et son sourire.
</p>
                
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