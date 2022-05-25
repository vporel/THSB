<?php 
    require "../includes/head.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | THBS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="../assets/js/biblio.js"></script>
</head>
<body>
    <div id="page">
        <header>
            <h2>Connexion | Administration</h2>
        </header>
        <?php if(isset($message)){ ?>
            <div class="alert alert-warning" style="margin:10px;">
                <?= $message ?>
            </div>
        <?php } ?>
        <form method="post">
            <span>
                <label for="nom-utilisateur">Nom d'utilisateur</label>
                <input type="text" name="nom-utilisateur" id="nom-utilisateur" required/>
            </span>
            <span>
                <label for="mot-de-passe" >Mot de passe</label>
                <input type="text" name="mot-de-passe" id="mot-de-passe" required/>
            </span>
            <div class="btns">
                <button type="submit" class="btn btn-primary">Continuer</button>
            </div>
        </form>
    </div>
</body>
</html>