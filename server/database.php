<?php
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('C:\wamp64\www\PHP\server');
$dotenv->load();

$host = $_ENV['HOST'];
$dbname = $_ENV['DBNAME'];
$user = $_ENV['USER'];
$password = $_ENV['PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données MySQL: " . $e->getMessage();
}
