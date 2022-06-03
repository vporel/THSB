
<?php 
	require "./includes/head.php"; 
	$lieux = findAll("lieuTouristique");
?>
<?php $_TITLE = "Lieux touristiques | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=lieuTouristique" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter un lieu touristique</em>
	</a>
<?php } ?>
<?php if(count($lieux) > 0){ ?>
	<style>
		.title{
			
		}	
	</style>
	<?php foreach($lieux as $lieu){ ?>
		<section class="section">
			<h2 class="title">
				<?= $lieu["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=lieuTouristique&id=<?= $lieu["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=lieuTouristique&id=<?= $lieu["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
			</h2>
			<p>
				<?= nl2br($lieu["description"]) ?>
			</p>
			<div class="images">
				<img class="element-image" src="assets/images/lieux-touristiques/<?= $lieu["image"] ?>" alt="Erreur de chargement de l'image"/>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucun lieu touristique enregistré</div>
<?php } ?>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
