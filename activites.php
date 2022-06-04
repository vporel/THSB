
<?php 
	require "./includes/head.php"; 
	$activites = findAll("activite");
?>
<?php $_TITLE = "Activités | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=activite" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter une activité</em>
	</a>
<?php } ?>
<?php if(count($activites) > 0){ ?>
	<?php foreach($activites as $activite){ ?>
		<section class="section element dispo-<?= $_THEME["dispositions"][3]; ?>">
			<h2 class="title">
				<?= $activite["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=activite&id=<?= $activite["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=activite&id=<?= $activite["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
			</h2>
			<div class="element-content">
				<div class="text">
				<h3 class="badge">
					<?= $activite["personnesEnCharge"] ?>
				</h3>
					<p>
						<?= nl2br(updateText($activite["description"])) ?>
					</p>
				</div>
				<div class="images">
					<img class="element-image" src="assets/images/activites/<?= $activite["image"] ?>" alt="Erreur de chargement de l'image"/>
				</div>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucune activité enregistrée</div>
<?php } ?>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
