
<?php 
	require "./includes/head.php"; 
	$projets = findAll("projet");
?>
<?php $_TITLE = "Projets | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<main>
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
</main>
<aside>
	<h2>Dernières annonces</h2>
	<section>
		<h3></h3>
		<article>
            <h4>Titre</h4>
			<span>1<sup>er</sup> avril 2022</span>
			
		</article>
		<div class="see-more-layout"><a class="see-more btn btn-primary" href="activités_agricoles.html">Voir plus</a></div>
	</section>
    <h2>Publicités</h2>
	<section>
		<h3></h3>
		<article>
			<h4></h4>
			<p>
				Le pigeon est un oiseau dont le régime alimentaire est essentiellement granivore mais il peut aussi manger de petits insectes, vers de terre et de la verdure.
				<a class="see-more" href="elevage_pigeons.html">En savoir plus</a>
			</p>
		</article>
		<div class="see-more-layout"><a class="see-more btn btn-primary" href="activités_pastorales.html">Voir plus</a></div>
	</section>
</aside>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
