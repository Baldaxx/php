<?php
session_start();
require "server/database.php"; 
if (!isset($_SESSION['user_id'])) {
    
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT nom FROM utilisateur WHERE id = :userId");
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit;
}

$nomUtilisateur = $user['nom']; 
?>

    <?php include './common/head.php'; ?>
    <?php include './common/nav.php'; ?>
    <img src="img/user.png" alt="Photo de profil">
    <h1>Bonjour, <?= htmlspecialchars($nomUtilisateur); ?></h1>

    <?php include './common/footer.php'; ?>

