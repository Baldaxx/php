<?php
session_start();
require "server/database.php";

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 6 caractères.";
        header('Location: register.php');
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {
        try {
            $sql = "INSERT INTO utilisateur (nom, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->execute();

            $_SESSION['message'] = "Utilisateur enregistré avec succès : " . htmlspecialchars($username);
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Merci de respecter le format du nom d'utilisateur.";
    }

    header('Location: register.php');
    exit();
}
