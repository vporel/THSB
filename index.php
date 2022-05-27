<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Mairie de ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<main>
	
	<section class="section">
		<h3 style="margin-top: 100px;margin-left: 70px;color: black;font-size: 50px;animation: titleShow 1s forwards;text-shadow: 1px 1px 2px black;z-index: 5;"> 
			BIENVENUE SUR LA MAIRIE DE DOUALA I 
		</h3>
		<h2 class="title">Historique de la mairie <span class="badge">La valorisation des produits de notre commune</span></h2>
		<p>
			La commune de Douala a ete creee en 1987 , d'apres la loi numero 87-15 du 15 juillet 1987 , portant creation des communautes urbaines au cameeroun.elle s'etend sur 1309 ha,limitee a l'ouest par le fleuve Wouri et le Mbanya qui le separe de l'arrondissement de Douala 5eme.
		</p>
		<h2 class="title"> Conseil Municipal</h2>
		<p>
			le conseil municipal de la mairie de Douala definit la politique de l'organisation  et l'orientation de son action. Les membres du CE , qui sont de hauts responsables de la mairie,apportent leur longue experience et leur savoir afin de nous conseiller et de nous guider. il est compose de L'Executif Municipal qui comprend (05) memebres a savoir:
				<ul>
					<li> Le Maire </li>
					<li> Les (04) adjoints </li>
					
				</ul>
			

		</p>


		<h2 class="title"> Missions de la mairie</h2>
		<p>
			la mairie de Douala gere, sous tutelle de L'Etat, les affaires locales en vue du developpement economique,social et culturel de ses populations.En matiere de transport terrestre la mairie de Douala est chargee de l'etude , et de la gestion des programmes d'entretiendes infrastructures et des reseaux de moindre envergure(car pour ceux plus important, ce sont les ministeres de la ville ou des travaux publics qui s'en occupent); la commune de Douala s'occupe egalement de la gestion du domaine public routier, en relation avec les services concernes. A cet effet,elle dispose d'un service "Circulation et des deplacements urbains " charge:
			<ul>
				<li> de l'etude et realisation des amenagements et des equipements necessaires a l'application du plan de circulation;</li>
				<li> d'assurer la liaison avec les operateurs du transport.</li>
			</ul>
			Au quotidien, la mairie de Douala veille au respect des infrastructures et des amenagements installes sur la voie publique afin de maintenir un developpement des deplacements adaptes pour une mobilite, mieux pour une urbanisation plus simplifiee et plus organisee de nos villes.
		</p>
		
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