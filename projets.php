
<?php 
	require "./includes/head.php"; 
	$projets = findAll("projet");
?>
<?php $_TITLE = "Projets | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=projet" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter un projet</em>
	</a>
<?php } ?>
<?php if(count($projets) > 0){ ?>
	<?php foreach($projets as $projet){ ?>
		<section class="section element dispo-<?= $_THEME["dispositions"][2]; ?>">
			<h2 class="title">
				<?= $projet["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=projet&id=<?= $projet["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=projet&id=<?= $projet["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
			</h2>
			<div class="element-content">
				<div class="text">
					<p>
						<?= nl2br($projet["description"]) ?>
					</p>
				</div>
				<?php if($publicite["image"] != null) { ?>
					<div class="images">
						<img class="element-image" src="assets/images/projets/<?= $projet["image"] ?>" alt="Erreur de chargement de l'image"/>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucun projet enregistré</div>
<?php } ?>

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
