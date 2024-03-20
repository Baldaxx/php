<?php
session_start();
require "server/database.php";
if (!isset($_SESSION['user_id'])) {

    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT nom FROM utilisateur WHERE id = :userId");
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: login.php');
    exit;
}

$nomUtilisateur = $user['nom'];
?>

<?php include './common/head.php'; ?>
<?php include './common/nav.php'; ?>
<h1>Bonjour, <?= htmlspecialchars($nomUtilisateur); ?></h1>

<hr class="mt-0 mb-4">
<div class="row">
    <div class="col-xl-4">
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Page de profil</div>
            <div class="card-body text-center">
                <img src="img/1.png" alt="Avatar de la page de profil">
                <div class="small font-italic text-muted mb-4">JPG ou PNG, maximun 5 MB</div>
                <button class="btn btn-primary" type="button">Télécharger sa photo</button>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card mb-4">
            <div class="card-header">Détails du compte</div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Nom d'utilisateur</label>
                        <input class="form-control" id="inputUsername" type="text" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">Prénom</label>
                            <input class="form-control" id="inputFirstName" type="text" placeholder="Entrer votre prenom">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Nom</label>
                            <input class="form-control" id="inputLastName" type="text" placeholder="Entrer votre nom">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Adresse mail</label>
                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Entrer votre email">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Numèro de téléphone</label>
                            <input class="form-control" id="inputPhone" type="tel" placeholder="Entrer votre numero">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Dâte d'anniversaire</label>
                            <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="00/00/0000">    <br>        <button class="btn btn-primary" type="button">Enregistrer</button>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>
</div>

<?php include './common/footer.php'; ?>
