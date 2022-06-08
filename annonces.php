
<?php 
	require "./includes/head.php"; 
	$annonces = findAll("annonce");
?>
<?php $_TITLE = "Annonces | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=annonce" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter annonce</em>
	</a>
<?php } ?>
<?php if(count($annonces) > 0){ ?>
	<?php foreach($annonces as $annonce){ ?>
		<section class="section element dispo-<?= $_THEME["dispositions"][4]; ?>">
			<h2 class="title">
				<?= $annonce["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=annonce&id=<?= $annonce["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=annonce&id=<?= $annonce["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
			</h2>
			<div class="element-content">
				<div class="text">
				<h3 class="badge"><i> Type d'annonce:</i> <?=$annonce["type"] ?></h3>

					<p>
						<?= nl2br($annonce["description"]) ?>
					</p>
				</div>
				<?php if($annonce["image"] != null) { ?>
					<div class="images">
						<img class="element-image" src="assets/images/annonces/<?= $annonce["image"] ?>" alt="Erreur de chargement de l'image"/>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php } ?>
<?php }else{ ?>
	<div class="alert alert-warning">Aucune annonce</div>
<?php } ?>

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
