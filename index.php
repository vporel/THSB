<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Mairie de ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>
<main>
	
	<section class="section">
		<h3 style="margin-top: 100px;margin-left: 70px;color: black;font-size: 50px;animation: titleShow 1s forwards;"> 
			BIENVENUE SUR LA MAIRIE DE <?php echo $_MAIRIE["nom"]; ?>
		</h3>
		<h2 class="title">
			Historique de la mairie 
			<?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-historique.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>
		</h2>
		<h2 class="title"> 
			Conseil Municipal
			<?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-conseil.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>

		</h2>
		

		<h2 class="title">
			 Missions de la mairie
			 <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier missions.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>

		</h2>
		
		
	</section>
</main>
<aside>
	<h2>Dernièrs articles</h2>
	<section>
		<h3></h3>
		<article>
            <h4>Titre</h4>
			<span>1<sup>er</sup> avril 2022</span>
			
		</article>
		<div class="see-more-layout"><a class="see-more btn btn-primary" href="activités_agricoles.html">Voir plus</a></div>
	</section>

</aside>
<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>