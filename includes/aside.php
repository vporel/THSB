<?php 
    $annoncesAside = findBy("annonce", [], "-date", 2);
    $publicitesAside = findBy("publicite", [], "-date", 2);
?>
<section>
    <a href="annonces.php" style="text-decoration:none"><h2>Dernières annonces</h2></a>
    <?php if(count($annoncesAside) > 0){ ?>
	    <?php foreach($annoncesAside as $annonce){ ?>
            <article>
                <h4><?= $annonce["nom"] ?></h4>
                <span><?= $annonce["date"] ?></span>
                <p><?= nl2br($annonce["description"]) ?></p>
                <img class="element-image" src="assets/images/annonces/<?= $annonce["image"] ?>" alt="Image"/>
            </article>
        <?php } ?>
        <div class="see-more-layout"><a class="see-more btn btn-primary" href="annonces.php">Voir plus</a></div>
    <?php }else{ ?>
        <p>Aucune annonce</p>
    <?php } ?>
</section>
<section>
    <a href="espace-publicite.php" style="text-decoration:none"><h2>Publicités</h2></a>
    <?php if(count($publicitesAside) > 0){ ?>
	    <?php foreach($publicitesAside as $publicite){ ?>
            <article>
                <h4><?= $publicite["nom"] ?></h4>
                <span><?= $publicite["date"] ?></span>
                <p><?= nl2br($publicite["description"]) ?></p>
                <img class="element-image" src="assets/images/publicites/<?= $publicite["image"] ?>" alt="Image"/>
            </article>
        <?php } ?>
        <div class="see-more-layout"><a class="see-more btn btn-primary" href="espace-publicite.php">Voir plus</a></div>
    <?php }else{ ?>
        <p>Aucune publicité</p>
    <?php } ?>
</section>