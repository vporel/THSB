
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_TITLE ?></title>
    <style type="text/css">
        :root{
            --couleur-primaire:<?= $_THEME["couleur-admin"] ?? $_THEME_DEFAUT["couleur-admin"]; ?>;
            --couleur-primaire-claire:<?= ($_THEME["couleur-admin"] ?? $_THEME_DEFAUT["couleur-admin"]). "dd"; ?>;
            --couleur-primaire-claire-2:<?= ($_THEME["couleur-admin"] ?? $_THEME_DEFAUT["couleur-admin"]). "bb"; ?>;
        }
    </style>
    <?php if($installation){ ?>
        <link rel="stylesheet" type="text/css" href="style.css">
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="style-non-installation.css">
    <?php } ?>
    <script src="../assets/js/biblio.js"></script>
</head>
<body>
    <div id="page">
        <header>
            <h2><?= $installation ? "Installation" : "Administration" ?> | THSB</h2>
            <p style="color:lightgray">Town Hall Site Builder</p>
            <h3><?= $_PAGE_TITLE ?></h3>
        </header>
        <div id="content">

            <?php if(isset($message)){ ?>
                <div class="alert alert-warning" style="margin:0 10px;">
                    <?= $message ?>
                </div>
            <?php } ?>
            <?= $_CONTENT ?>
        </div>
        <?php if($installation){ ?> 
            <h5>Membres de l'équipe</h5>
            <ol>
                <li>NKOUANANG KEPSEU VIVIAN POREL - 20U2668 <i>(Chef du groupe)</i></li>
                <li>BELEK A EKITE FLEURETTE       - 18T2392</li>
                <li>NGOTAGUA YONKEU SYNTHIA       - 20U2636</li>
                <li>ABDELAZIZ MAHAMAT LOUKY      - 18T2916</li>

            </ol>
        <?php } ?> 
    </div>
    <div id="liens-pied">
    <?php if(!$installation){ ?> 
        <?php if(isset($elementType) &&  $elementSchema->getPage() != ""){ ?> 
            <a href="../<?= $elementSchema->getPage() ?>" class="btn btn-primary">
                <object data="../assets/icons/arrow-left.svg" class="icon"></object><em>Aller à la page - <?= ucfirst($elementType) ?></em>
            </a>
        <?php } ?> 
        <a href="../index.php" class="btn btn-primary">
            <object data="../assets/icons/arrow-left.svg" class="icon"></object><em>Aller à la page d'accueil</em>
        </a>
    <?php }else{ ?>
        <?php if($_INSTALLATION["etape"] > 1){ ?> 
            <a href="installation.php?prev" class="btn btn-primary">
                <object data="../assets/icons/arrow-left.svg" class="icon"></object><em>Précédent</em>
            </a>
        <?php } ?> 
        <?php if($_INSTALLATION["etape"] < $_INSTALLATION["etape-complete"]){ ?> 
            <a href="installation.php?next" class="btn btn-primary">
                <em>Suivant</em><object data="../assets/icons/arrow-right.svg" class="icon"></object>
            </a>
        <?php } ?> 
    <?php } ?>
    </div>
</body>
</html>