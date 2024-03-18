<?php
include './common/head.php';
include './common/nav.php';
require './server/database.php'; 
?>

<h1>Page login</h1>
<form method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Entrez votre nom d'utilisateur">
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = trim($_POST['username']);
        if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {

            require('server/database.php');
            
            $pdo->exec("CREATE TABLE IF NOT EXISTS utilisateur (id INT AUTO_INCREMENT PRIMARY KEY, nom VARCHAR(100) NOT NULL) ENGINE=InnoDB;");

            $sql = "INSERT INTO utilisateur (nom) VALUES (:username)";
            $envoie = $pdo->prepare($sql);
            $envoie->bindParam(':username', $username);
            $envoie->execute();

            echo "<p>Utilisateur enregistré avec succès : <span style='color: #0d6efd; font-size: 100px; font-family: \"Roboto\", sans-serif; text-shadow: 2px 2px 4px #000;'>$username</span></p>";

        } else {
            echo "<p>Merci de respecter le format : chiffre, lettre majuscule et minuscule, de 4 à 16 caractères.</p>";
        }
    } else {
        echo "<p>Merci de remplir le champ du formulaire.</p>";
    }
}
include './common/footer.php';
?>
