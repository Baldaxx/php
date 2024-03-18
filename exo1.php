<?php
session_start();
include './common/head.php';
include './common/nav.php';
require './server/database.php';
?>

<h1>Page exo1</h1>
<form method="post" action="addUser.php">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Entrez votre nom d'utilisateur">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe">
    </div>

    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<?php

if (isset($_SESSION['message'])) {
    echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

if (isset($pdo)) {
    try {
        $sql = "SELECT nom FROM utilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            echo "<ul>";
            foreach ($results as $utilisateur) {
                echo "<li>" . htmlspecialchars($utilisateur['nom']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun utilisateur enregistré pour le moment.</p>";
        }
    } catch (Exception $e) {
        echo "<p>Une erreur est survenue lors de l'affichage des utilisateurs : " . $e->getMessage() . "</p>";
    }
}
?>

<?php include './common/footer.php'; ?>
