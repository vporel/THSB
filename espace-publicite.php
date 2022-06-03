
<?php 
	require "./includes/head.php"; 
	$publicites = findAll("publicite");
?>
<?php $_TITLE = "Publicités | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=publicite" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter un publicité</em>
	</a>
<?php } ?>
<?php if(count($publicites) > 0){ ?>
	<?php foreach($publicites as $publicite){ ?>
		<section class="section">
			<h2 class="title">
				<?= $publicite["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=publicite&id=<?= $publicite["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=publicite&id=<?= $publicite["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
			</h2>
			<p>
				<?= nl2br($publicite["description"]) ?>
			</p>
			<div class="images">
				<img class="element-image" src="assets/images/publicites/<?= $publicite["image"] ?>" alt="Erreur de chargement de l'image"/>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucune publicité faite</div>
<?php } ?>

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
