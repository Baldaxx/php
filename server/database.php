<?php
$host = 'localhost'; 
$dbname = 'exobase';
$user = 'root';
$password = 'Mamandu13007.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données MySQL: " . $e->getMessage();
}
