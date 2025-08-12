<!-- navbar mobile tablette et pc -->
<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar mamie4Family</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>


  <nav class="navbar">
    <div class="logo-container">
      <img src="./assets/images/logo4M.png" alt="Mamie4Family Logo" class="nav-logo">
      <span class="site-title">Mamie4Family</span>
    </div>
    <div class="menu-burger" id="menu-burger">
      <i class="fas fa-bars"></i>
    </div>
    <ul class="nav-links" id="nav-links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="about.php">À propos</a></li>
      <!-- <li><a href="dashboard.php">Mon compte</a></li> -->
    </ul>
    <div class="nav-icons">
      <a href="#" class="icon-link">
        <i class="fas fa-user"></i>
      </a>
    </div>

    <!-- js pour click burger -->
    <script>
      const menuBurger = document.getElementById("menu-burger");
      const navLinks = document.getElementById("nav-links");

      menuBurger.addEventListener("click", () => {
        navLinks.classList.toggle("active");
      });
    </script>
  </nav>
</body>

</html>