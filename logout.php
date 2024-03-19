<?php
session_start(); 

if (isset($_POST['submit'])) {

    session_unset();
    session_destroy();
    
    $logout_message = "Vous êtes deconnecté.";
}
?>

    <?php include './common/head.php'; ?>
    <?php include './common/nav.php'; ?>

    <h1>Page de Déconnexion</h1>

    <?php if (isset($logout_message)) echo "<p>$logout_message</p>"; ?>
    <form method="POST">
        <button type="submit" name="submit" class="btn btn-primary">Déconnexion</button>
    </form>

    <?php include './common/footer.php'; ?>
