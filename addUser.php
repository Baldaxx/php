<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['username'])) {
    require './server/database.php'; 

    $username = trim($_POST['username']);


    if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {
        try {

            $pdo->exec("CREATE TABLE IF NOT EXISTS utilisateur (id INT AUTO_INCREMENT PRIMARY KEY, nom VARCHAR(100) NOT NULL) ENGINE=InnoDB;");

            $sql = "SELECT COUNT(*) AS nbr FROM utilisateur WHERE nom = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['nbr'] > 0) {
                $_SESSION['message'] = "Ce pseudo est déjà utilisé !";
            } else {
                $sql = "INSERT INTO utilisateur (nom) VALUES (:username)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                $_SESSION['message'] = "Utilisateur enregistré avec succès : " . htmlspecialchars($username);
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Merci de respecter le format du nom d'utilisateur : chiffre, lettre majuscule et minuscule, de 4 à 16 caractères.";
    }
} else {
    $_SESSION['error'] = "Merci de remplir le champ du formulaire.";
}

header('Location: exo1.php');
exit();
