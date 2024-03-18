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

            if ($pdo) {
                $pdo->exec("CREATE TABLE IF NOT EXISTS utilisateur (id INT AUTO_INCREMENT PRIMARY KEY, nom VARCHAR(100) NOT NULL) ENGINE=InnoDB;");

                $sql  = "SELECT COUNT(*) AS nbr FROM utilisateur WHERE nom = :username";
                $stmt  = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $result  = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['nbr'] > 0) {
                    echo "Ce pseudo est déjà utilisé !";
                } else {
                    $sql = "INSERT INTO utilisateur (nom) VALUES (:username)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();

                    echo "<p>Utilisateur enregistré avec succès : <span style='color: #0d6efd; font-size: 50px; font-family: \"Roboto\", sans-serif; text-shadow: 2px 2px 4px #000;'>$username</span></p>";
                }
            } else {
                echo "La connexion à la base de données a échoué.";
            }
        } else {
            echo "<p>Merci de respecter le format : chiffre, lettre majuscule et minuscule, de 4 à 16 caractères.</p>";
        }
    } else {
        echo "<p>Merci de remplir le champ du formulaire.</p>";
    }
    if ($pdo) {
        try {
            $sql = "SELECT nom FROM utilisateur";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($results)) {
                echo "<ul>";
                foreach ($results as $utilisateur) {
                    echo "<li><p><span style='color: #0d6efd; font-size: 20px; font-family: \"Roboto\", sans-serif; text-shadow: 1px 1px 2px #000;'>" . htmlspecialchars($utilisateur['nom']) . "</span></p></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun utilisateur enregistré pour le moment.</p>";
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de l'exécution de la requête : " . $e->getMessage();
        }
    } else {
        echo "<p>La connexion à la base de données n'a pas été établie.</p>";
    }
}
include './common/footer.php';
?>
