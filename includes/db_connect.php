
<?php
function getDatabaseConnection()
{
    $configPath = __DIR__ . '/../config.php';
    if (!file_exists($configPath)) {
        die('Configuration manquante : créez config.php à partir de config.example.php');
    }
    $config = require $configPath;

    $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s",
        $config['db_host'],
        $config['db_name'],
        $config['db_charset'] ?? 'utf8mb4'
    );

    try {
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
