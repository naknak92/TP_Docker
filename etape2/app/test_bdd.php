<?php
$host = 'database';  // Le nom du container MySQL
$db = 'wordpress';   // Nom de la base de données
$user = 'root';      // Utilisateur MySQL
$pass = 'rootpassword'; // Mot de passe MySQL

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connexion réussie à la base de données !<br>";

    // Test d'une requête simple
    $stmt = $pdo->query('SELECT * FROM test_table');
    while ($row = $stmt->fetch()) {
        echo "ID: " . $row['id'] . " - Contenu: " . $row['content'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>









