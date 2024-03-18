<?php
include './common/head.php';
include './common/nav.php';
?>
<h1>Page register</h1>

<form method="POST">
    <div class="form-group">
        <label for="name">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur" name="username">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Entrer votre email" name="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
    </div>
    <input type="submit" class="btn btn-primary" value="submit" name="submit"></input>
</form>

<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        if (preg_match('/^[a-zA-Z0-9]{4,16}$/', $username)) {
            echo "Mon nom : $username";
        } else {
            echo "Merci de respecter le format chiffre lettre majuscule minuscule";
        }

        $email = $_POST['email'];
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($emailSanitize, FILTER_VALIDATE_EMAIL)) {
            echo " Mon email : $emailSanitize";
        } else {
            echo " Merci d'ajouter un email valide";
        }

        $password = $_POST['password'];
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,20}$/', $password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            echo " Mon mot de passe (haché pour la sécurité) : $passwordHash";
        } else {
            echo " Merci de respecter le format du mot de passe";
        }
    } else {
        echo "Merci de remplir tout le formulaire";
    }
}
?>


<?php
include './common/footer.php';
?>
