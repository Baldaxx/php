<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">FIFEBook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil <span class="sr-only"></span></a>
            </li>
            <?php if (!isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">S'enregistrer</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
