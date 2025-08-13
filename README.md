# 👵 Mamie4Family

**Mamie4Family** est un projet de site web mettant en relation des **familles** et des **mamies** pour proposer des services d'accompagnement, d'entraide et de partage intergénérationnel.

---

## 📌 Statut du projet
🚧 **En cours de développement**  
✅ Fonctions principales implémentées : inscriptions, connexions, dashboards.  
❌ **Reste à faire** : implémentation complète du système de **réservation** entre familles et mamies.

---

## ✨ Fonctionnalités actuelles

- Inscription **famille** avec formulaire dédié
- Inscription **mamie** avec formulaire dédié
- Connexion / déconnexion
- **Dashboards séparés** :
  - Dashboard famille
  - Dashboard mamie
- Affichage des informations issues de la base de données
- Connexion sécurisée via PDO (MySQL)
- Structure claire avec includes pour `navbar.php` et `footer.php`

---

## 🛠️ Technologies utilisées

- **PHP procédural** avec PDO
- **MySQL** (phpMyAdmin)
- **HTML5 / CSS3**
- **WAMP** ou **XAMPP** pour le développement local

---

## 📂 Structure du projet

```
Mamie4Family/
├─ assets/               # CSS, JS, images
├─ includes/             # navbar, footer, db_connect
├─ uploads/              # images uploadées
├─ database/             # mamie4family.sql
├─ index.php              # page d'accueil
├─ inscription_famille.php
├─ inscription_mamie.php
├─ dashboard_famille.php
├─ dashboard_mamie.php
├─ config.example.php     # modèle de configuration
└─ README.md
```

---

## ⚙️ Installation locale

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/VOTRE_COMPTE/Mamie4Family.git
   ```

2. **Placer le dossier dans votre serveur local**
   - Sous **WAMP** : `C:/wamp64/www/Mamie4Family`
   - Sous **XAMPP** : `C:/xampp/htdocs/Mamie4Family`

3. **Importer la base de données**
   - Ouvrir phpMyAdmin
   - Créer une base nommée `mamie4family`
   - Importer le fichier `database/mamie4family.sql`

4. **Configurer la connexion MySQL**
   - Copier `config.example.php` vers `config.php`
   - Modifier vos identifiants MySQL si nécessaire :
     ```php
     <?php
     return [
         'db_host' => 'localhost',
         'db_name' => 'mamie4family',
         'db_user' => 'root',
         'db_pass' => '',
         'db_charset' => 'utf8mb4'
     ];
     ```

5. **Lancer le site**
   - Démarrer Apache et MySQL
   - Ouvrir : [http://localhost/Mamie4Family/](http://localhost/Mamie4Family/)

---

## 🗄️ Schéma de base de données

La base `mamie4family` contient notamment :
- **familles** → données des familles inscrites
- **mamies** → données des mamies inscrites
- (à venir) **reservations** → gestion des réservations entre familles et mamies

Le script SQL complet se trouve dans `database/mamie4family.sql`.

---

## 🚀 Prochaines étapes

- [ ] Création du module de **réservation** :
  - Formulaire de demande
  - Validation côté mamie
  - Gestion des disponibilités
- [ ] Amélioration du design responsive
- [ ] Ajout d’un système de messagerie interne

---

## 👩‍💻 Auteur

**Sylvie Seguinaud**  
Projet réalisé dans le cadre de la formation **Développeur Web et Web Mobile (DWWM)**.
