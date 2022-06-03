<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $_TITLE ?></title>

	<?php
		$numeroTheme = $_THEME["numero"] ?? $_THEME_DEFAUT["numero"];
		if($numeroTheme == null || (int) $numeroTheme < 0 || (int) $numeroTheme > $_NB_THEMES){
			//Pour l(instant il n'a que 2 themes)
			$numeroTheme = 1;//Theme par défaut
		}
	?>	
	<style type="text/css">
		:root{
			--couleur-primaire:<?= $_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"]; ?>;
			--couleur-primaire-claire:<?= ($_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"]). "dd"; ?>;
            --couleur-primaire-claire-2:<?= ($_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"]). "bb"; ?>;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="assets/css/theme-<?= $numeroTheme ?>.css"/>
	<script src="assets/js/biblio.js"></script>
	<?= $_STYLES ?? "" ?>
</head>
<body>
	<!-- Entete -->
	<?php include "includes/header.php"; ?>
	<div id="popup-image">
		<button onclick="$('#popup-image').style.display = 'none';">&times;</button>
		<div id="image-container">
			<img class="image"/>
		</div>
	</div>
	<section id="content">
		<main>
			<?= $_CONTENT ?>
		</main>
		<aside>
			<?php include "includes/aside.php"; ?>
		</aside>
	</section>
	<a href="#" id="back-to-top">^</a>
	<footer>
		<?php include "includes/footer.php"; ?>
	</footer>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<?= $_SCRIPTS ?? "" ?>
</body>
</html>