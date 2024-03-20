<?php
session_start();
require "server/database.php";

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 6 caractères.";
        header('Location: register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format d'email invalide.";
        header('Location: register.php');
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {
        try {
            $sql = "INSERT INTO utilisateur (nom, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->execute();

            $_SESSION['message'] = "Utilisateur enregistré avec succès : " . htmlspecialchars($username);
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Merci de respecter le format du nom d'utilisateur.";
    }

    header('Location: profil.php');
    exit();
}
