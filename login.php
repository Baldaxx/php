<?php
include './common/head.php';
include './common/nav.php';
?>
<h1>Page login</h1>

<form>
    <div class="form-group">
        <label for="exampleInputUsername1">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Entrez votre nom d'utilisateur">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
include './common/footer.php';
?>
