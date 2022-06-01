<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Mairie de ".$_MAIRIE["nom"]; ?>

<?php ob_start(); ?>

	
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

<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>
