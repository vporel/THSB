
<?php 
	require "./includes/head.php"; 
	$personnels = findAll("personnel");
?>
<?php $_TITLE = "Personnel | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=personnel" class="d-block btn btn-admin-add" style="margin:10px 0;">
		Ajouter un personnel
	</a>
<?php } ?>
<?php if(count($personnels) > 0){ ?>
	<?php foreach($personnels as $personnel){ ?>
		<section class="section">
			<h2 class="title">
				<?= $personnel["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=personnel&id=<?= $propersonneljet["id"] ?>" class="d-inline-block btn btn-admin-update">
						Modifier
					</a>
					<a href="admin/supprimer.php?elementType=personnel&id=<?= $personnel["id"] ?>" class="d-inline-block btn btn-admin-delete">
						Supprimer
					</a>
				<?php } ?>
			</h2>
			<p>
				<?= nl2br($personnel["parcours"]) ?>
			</p>
			<div class="images">
				<img class="element-image" src="assets/images/personnels/<?= $personnel["photo"] ?>" alt="Erreur de chargement de l'image"/>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucun personnel enregistré</div>
<?php } ?>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>

