<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Mairie de ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>

<section class="section">
	<h2 class="title">Elevage <span class="badge">La valorisation des produits de notre commune</span></h2>
	<p>
		Les systèmes d’élevage dans la commune sont divisés en trois grandes catégories:
		<ul>
			<li>
				Les pasteurs transhumants qui possèdent de grands troupeaux de bétail. Ils pratiquent le système extensif d’élevage, déplacent les animaux d’une région à l’autre en fonction de la disponibilité des pâturages. Pendant les périodes sèches, tous les animaux, sauf les plus jeunes sont déplacés vers des zones de transhumance vers le Noun, Mbam et Inoubou, Sanaga, Nde (Ngnokong) ;
			</li>
			<li>
				Les agriculteurs sédentaires, qui ont l’élevage comme activité secondaire à l’agriculture. Ce groupe dans la plupart des cas élèvent les porcs, les chèvres, les moutons et les volailles dans leurs arrière-cours comme source alternative de revenu. Certains dans ce groupe pratiquent le système intensif pendant que les autres laissent les animaux en divagation
			</li>
			<li>
				Les agropasteurs semi-sédentaires qui se trouvent entre les catégories I et II.
			</li>
		</ul>
		Toutefois, la pratique d’élevage la plus courante est le système semi-intensif pratiqué par environ 50% des villages.
		<br><a href="activités_pastorales.html">Aller à la page</a>
	</p>
	<div class="images">
		<img src="images/section2/1.jpg"/>
		<img src="images/section2/2.jpg"/>
		<img src="images/section2/3.jpg"/>
		<img src="images/section2/4.jpg"/>
		<img src="images/section2/5.jpg"/>
	</div>
</section>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>