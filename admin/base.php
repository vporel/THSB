
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_TITLE ?></title>
    <style type="text/css">
        :root{
            --couleur-primaire:<?= $_THEME["couleur-admin"] ?? $_THEME_DEFAUT["couleur-admin"]; ?>    ;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="../assets/js/biblio.js"></script>
</head>
<body>
    <div id="page">
        <header>
            <h2>Administration | THSB</h2>
            <h3><?= $_PAGE_TITLE ?></h3>
        </header>
        <?php if(isset($message)){ ?>
            <div class="alert alert-warning" style="margin:10px;">
                <?= $message ?>
            </div>
        <?php } ?>
        <?= $_CONTENT ?>
        <center><a href="../index.php">Retourner au site</a></center>
    </div>
</body>
</html>