
<?php 
	require "./includes/head.php"; 
	$personnels = findAll("personnel");
?>
<?php $_TITLE = "Personnel | ".$_MAIRIE["nom"]; ?>
<?php ob_start(); ?>
	<div  id="brand-title">
		<h3>Personnel de la mairie</h3>
		<?php include "components/_custom-line.php"; ?>
	</div>
<?php $_AFTER_HEADER = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php if(isAdminConnected()){ ?>
	<a href="admin/ajouter.php?elementType=personnel" class="d-block btn btn-admin-add" style="margin:10px 0;">
		<object data="assets/icons/plus.svg" class="icon"></object><em>Ajouter un personnel</em>
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
		width: 31%;
		box-shadow: 0 0 2px gray;
		transition: all .2s ease;
		padding:5px;
	}
	#personnels section:hover{
		transform: scale(1.01);
	}
	#personnels .images{
		order: 1;
		justify-content: center;
    	overflow: hidden;
    	width:100%;
	}
	.images img{
		justify-content: center;
    	overflow: hidden;
		width:auto!important;
   		max-width:none!important;
		   height:200px;
	}
	.images img:hover{
		box-shadow: none!important;
		transform: none!important;
	}
	#personnels .title{
		order: 2;
		text-align: center;
		margin: 5px 0;
		color:black;
		font-size:20px;
	}
	#personnels .poste{
		order: 3;
		margin: 3px 0;
		font-size: 18px;;
		text-align: left;
	}
	#personnels p{
		order: 4;
		text-align: left;
		margin: 5px 0;
	}
	#personnels .btn{
		display: block;
	}
	#personnels .dispo-2 .title{
		order: 1;
	}
	#personnels .dispo-2 .poste{
		order: 2;
	}
	#personnels .dispo-2 p{
		order: 3;
	}
	#personnels .dispo-2 .images{
		order: 4;
	}
</style>
<?php if(count($personnels) > 0){ ?>
	<section id="personnels">
	<?php foreach($personnels as $personnel){ ?>
		<section class="section element dispo-<?= $_THEME["dispositions"][1] ?>">
			<h2 class="title">
				<?= $personnel["nom"] ?>
				<div class="btns">
				<?php if(isAdminConnected()){ ?>
					<a href="admin/modifier.php?elementType=personnel&id=<?= $personnel["id"] ?>" class="d-inline-block btn btn-admin-update">
						<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier</em>
					</a>
					<a href="admin/supprimer.php?elementType=personnel&id=<?= $personnel["id"] ?>" class="d-inline-block btn btn-admin-delete">
						<object data="assets/icons/trash.svg" class="icon"></object><em>Supprimer</em>
					</a>
				<?php } ?>
				</div>
			</h2>
			<h3 class="poste">
				<?= $personnel["poste"] ?>
			</h3>
			<p>
				<?= nl2br($personnel["parcours"]) ?>
				<br>

				<span class="cv"style="text-align:right;display:block"><object data="assets/icons/link.svg" class="icon"></object><a href="assets/cv-personnels/<?= $personnel["cv"] ?>" download>Télécharger le CV</a></span>
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

