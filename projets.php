
<?php 
	require "./includes/head.php"; 
	$projets = findAll("projet");
?>
<?php $_TITLE = "Projets | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=projet" class="d-block btn btn-admin-add" style="margin:10px 0;">
		Ajouter un projet
	</a>
<?php } ?>
<?php if(count($projets) > 0){ ?>
	<?php foreach($projets as $projet){ ?>
		<section class="section">
			<h2 class="title">
				<?= $projet["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=projet&id=<?= $projet["id"] ?>" class="d-inline-block btn btn-admin-update">
						Modifier
					</a>
					<a href="admin/supprimer.php?elementType=projet&id=<?= $projet["id"] ?>" class="d-inline-block btn btn-admin-delete">
						Supprimer
					</a>
				<?php } ?>
			</h2>
			<p>
				<?= nl2br($projet["description"]) ?>
			</p>
			<div class="images">
				<img class="element-image" src="assets/images/projets/<?= $projet["image"] ?>" alt="Erreur de chargement de l'image"/>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucun projet enregistré</div>
<?php } ?>

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
