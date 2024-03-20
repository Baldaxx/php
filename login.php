<?php
session_start();
require "server/database.php";

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, nom, password FROM utilisateur WHERE nom = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: profil.php');
                exit;
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Nom d'utilisateur introuvable.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }

    if ($message !== "") {
        $_SESSION['error'] = $message;
        header('Location: login.php');
        exit;
    }
}

include './common/head.php';
include './common/nav.php';
?>

<h1>Page de connexion</h1>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<form method="post" action="login.php">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Entrez votre nom d'utilisateur" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
    </div>

    <br>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php include './common/footer.php'; ?>
