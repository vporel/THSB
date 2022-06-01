
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
<style type="text/css">
	#personnels{
		display: flex;
		justify-content: flex-start;
		flex-wrap: wrap;
	}
	#personnels section{
		display: flex;
		margin: 10px 5px;
		flex-direction: column;
		width: 49%;
		box-shadow: 0 0 2px gray;
		transition: all .2s ease;
	}
	#personnels section:hover{
		transform: scale(1.01);
	}
	#personnels .dispo-1 .images{
		order: 1;
		justify-content: center;
	}
	.images img:hover{
		box-shadow: none!important;
		transform: none!important;
	}
	#personnels .title{
		text-align: center;
		margin: 5px 0;
	}
	#personnels .dispo-1 .title{
		order: 2;
	}
	#personnels .dispo-1 .poste{
		order: 3;
		margin: 3px 0;
		text-align: center;
	}
	#personnels p{
		text-align: center;
		margin: 5px 0;
	}

	#personnels .dispo-1 p{
		order: 4;
	}
	#personnels .btn{
		display: block;
	}
</style>
<?php if(count($personnels) > 0){ ?>
	<section id="personnels">
	<?php foreach($personnels as $personnel){ ?>
		<section class="section dispo-<?= $_THEME["dispositions"][1] ?? $_THEME_DEFAUT["dispositions"][1]; ?>">
			<h2 class="title">
				<?= $personnel["nom"] ?>
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=personnel&id=<?= $personnel["id"] ?>" class="d-inline-block btn btn-admin-update">
						Modifier
					</a>
					<a href="admin/supprimer.php?elementType=personnel&id=<?= $personnel["id"] ?>" class="d-inline-block btn btn-admin-delete">
						Supprimer
					</a>
				<?php } ?>
			</h2>
			<h3 class="poste">
				<?= $personnel["poste"] ?>
			</h3>
			<p>
				<?= nl2br($personnel["parcours"]) ?>
				<br>

				<a href="assets/cv-personnels/<?= $personnel["cv"] ?>" download>Télécharger le CV</a>
			</p>
			<div class="images">
				<img class="element-image" src="assets/images/personnels/<?= $personnel["photo"] ?>" alt="Erreur de chargement de l'image"/>
			</div>
		</section>
	<?php } ?>
	</section>
<?php }else{ ?>
	<div class="alert alert-warning">Aucun personnel enregistré</div>
<?php } ?>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>

