<?php
session_start();
require "server/database.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nom = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id']; 
        header('Location: profil.php');
        exit;
    } else {
        
        $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header('Location: login.php'); 
        exit;
    }
}
?>


    <?php include './common/head.php'; ?>
    <?php include './common/nav.php'; ?>

    <h1>Page de connexion</h1>

    <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="exampleInputUsername1">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="Entrez votre nom d'utilisateur" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Mot de passe" required>
        </div><br>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

    <?php include './common/footer.php'; ?>
