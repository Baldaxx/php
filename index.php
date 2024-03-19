<?php
session_start();
include './common/head.php';
include './common/nav.php';
?>
<h1>Bienvenue sur la page d'accueil des exercices PHP !</h1>

<?php
if (isset($_SESSION['logout_message'])) {
    echo "<p>" . $_SESSION['logout_message'] . "</p>";
    unset($_SESSION['logout_message']);
}
?>

<?php
include './common/footer.php';
?>
