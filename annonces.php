
<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Annonces | ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<main>
	
	<section class="section">
		<h2 class="title"></h2>
		<!-- Annonces ici -->
	</section>
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
