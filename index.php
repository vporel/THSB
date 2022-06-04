<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Mairie de ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
	<link rel="stylesheet"href="assets/css/accueil.css"?>
<?php $_STYLES = ob_get_clean(); ?>
<?php ob_start(); ?>
	<style type="text/css">
		#image-mairie{
			width:100%;
		}
	</style>
	<section class="section">
		<?php if($_MAIRIE["imagePresente"]){ ?>
			<img src="assets/images/<?= $_MAIRIE["image"]; ?>" alt="" id="image-mairie">
		<?php }else{ ?>
			<?php if(isAdminConnected()){ ?>
				Aucune image de la mairie enregistrée
			<?php } ?>
		<?php } ?>
		<?php if(isAdminConnected()){ ?>
			<a href="admin/modifier-info-mairie.php?infoType=image" class="d-block btn btn-admin-update">
				<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier l'image</em>
			</a>
		<?php } ?>
		<h3 style="padding:10px 0;text-align:center;color: black;font-size: 30px;"> 
			BIENVENUE SUR LA MAIRIE DE <?php echo $_MAIRIE["nom"] ?? "" ?>
		</h3>
	</section>
	<section id="historique">
		<h3 class="title">
			Historique
			<?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-info-mairie.php?infoType=historique" class="d-inline-block btn btn-admin-update">
					<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
				</a>
				
			<?php } ?>
		</h3>
		<p>
			<?= nl2br(updateText($_MAIRIE["historique"] ?? "")) ?>
		</p>
	</section>
	<section id="conseil-municipal">
		<h3 class="title"> 
			Conseil Municipal
			<?php if(isAdminConnected()){ ?>
				<a href="admin/ajouter.php?elementType=conseiller" class="d-inline-block btn btn-admin-update">
					<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter un conseiller</em>
				</a>
				
			<?php } ?>
			
		</h3>
		<?php $conseillers = findAll("conseiller"); ?>
		<?php if(count($conseillers) > 0){ ?>
			<section id="conseillers">
			<?php foreach($conseillers as $conseiller){ ?>
				<section class="conseiller">
					<h4 class="title">
						<?= $conseiller["nom"] ?>
						<?php if(isAdminConnected()){ ?>
							<a href="admin/modifier.php?elementType=conseiller&id=<?= $conseiller["id"] ?>" class="d-inline-block btn btn-admin-update">
								<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
							</a>
							<a href="admin/supprimer.php?elementType=conseiller&id=<?= $conseiller["id"] ?>" class="d-inline-block btn btn-admin-delete">
								<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
							</a>
						<?php } ?>
					</h4>
					<div class="images">
						<img class="element-image" src="assets/images/conseillers/<?= $conseiller["photo"] ?>" alt="Erreur de chargement de l'image"/>
					</div>
				</section>
			<?php } ?>
			</section>
		<?php }else{ ?>
			<div class="alert alert-warning">Aucun conseiller enregistré</div>
		<?php } ?>
	</section>
	<section class="section"id="missions">
		<h3 class="title">
			 Missions de la mairie
			 <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-info-mairie.php?infoType=missions" class="d-inline-block btn btn-admin-update">
					<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
				</a>
				
			<?php } ?>

		</h3>
		<p>
			<?= nl2br(updateText($_MAIRIE["missions"] ?? "")) ?>
		</p>
	</section>

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
