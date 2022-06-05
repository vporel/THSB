<?php 
    $annoncesAside = findBy("annonce", [], "-date", 2);
    $publicitesAside = findBy("publicite", [], "-date", 2);
?>
<section>
    <a href="annonces.php" style="text-decoration:none"><h2>Dernières annonces</h2></a>
    <?php if(count($annoncesAside) > 0){ ?>
	    <?php foreach($annoncesAside as $annonce){ ?>
            <article>
                <h4>
                    <?= $annonce["nom"] ?>
                <?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=annonce&id=<?= $annonce["id"] ?>" class="d-block btn btn-admin-update">
                        <object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=annonce&id=<?= $annonce["id"] ?>" class="d-block btn btn-admin-delete">
                        <object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?></h4>
                <span style="display:block;text-align:right"><?= $annonce["date"] ?></span>
                <h3 class="badge"><i>Type d'annonce : </i><?= $annonce["type"] ?></h3>
                <p><?= nl2br($annonce["description"]) ?></p>
                <p><?= nl2br($annonce["type"]) ?></p>
                <img class="element-image" src="assets/images/annonces/<?= $annonce["image"] ?>" alt="Image"/>
            </article>
        <?php } ?>
        <div class="see-more-layout">
            <a class="see-more btn btn-primary" href="annonces.php">
                <object data="assets/icons/plus.svg" class="icon"></object><em>Voir plus</em>
            </a>
        </div>
    <?php }else{ ?>
        <p>Aucune annonce</p>
    <?php } ?>
</section>
<section>
    <a href="espace-publicite.php" style="text-decoration:none"><h2>Publicités</h2></a>
    <?php if(count($publicitesAside) > 0){ ?>
	    <?php foreach($publicitesAside as $publicite){ ?>
            <article>
                <h4>
                    <?= $publicite["nom"] ?>
                    <?php if(isAdminConnected()){ ?>
                        <a href="admin/modifier.php?elementType=publicite&id=<?= $publicite["id"] ?>" class="d-block btn btn-admin-update">
                            <object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
                        </a>
                        <a href="admin/supprimer.php?elementType=publicite&id=<?= $publicite["id"] ?>" class="d-block btn btn-admin-delete">
                            <object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
                        </a>
                    <?php } ?>
                </h4>
                <span style="display:block;text-align:right"><?= $publicite["date"] ?></span>
                <h3 class="badge"><?= $publicite["contacts"] ?></h3>
                <p><?= nl2br($publicite["description"]) ?></p>
                  
                <img class="element-image" src="assets/images/publicites/<?= $publicite["image"] ?>" alt="Image"/>
            </article>
        <?php } ?>
        <div class="see-more-layout">
            <a class="see-more btn btn-primary" href="espace-publicite.php">
                <object data="assets/icons/plus.svg" class="icon"></object><em>Voir plus</em>
            </a>
        </div>
    <?php }else{ ?>
        <p>Aucune publicité</p>
    <?php } ?>
</section>