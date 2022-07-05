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
			--couleur-primaire:<?= $_THEME["couleur-site"]; ?>;
			--couleur-primaire-claire:<?= ($_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"]). "dd"; ?>;
            --couleur-primaire-claire-2:<?= ($_THEME["couleur-site"] ?? $_THEME_DEFAUT["couleur-site"]). "bb"; ?>;
			--image-fond:url("../images/<?= $_MAIRIE["image"] ?? "header-background.jpg" ?>");
		}
	</style>
	<link rel="stylesheet" type="text/css" href="assets/css/theme-<?= $numeroTheme ?>.css"/>
	<script src="assets/js/biblio.js"></script>
	<?= $_STYLES ?? "" ?>
</head>
<body>
	<div id="modifier-info-mairie-box">
		<h2>Modification de la mairie<object data="assets/icons/times.svg" class="icon" onclick="alert()"></object></h2>
		<h3 id="info">Nom</h3>
		<form id="form">
			
		</form>
		<div style="text-align:right;padding:5px;">
			<button class="btn btn-primary" onclick="enregistrerInfoMairie()">Enregistrer</button>
		</div>
	</div>
	<!-- Entete -->
	<?php include "includes/header.php"; ?>
	<div id="popup-image">
		<button onclick="$('#popup-image').style.display = 'none';">&times;</button>
		<div id="image-container">
			<img class="image"/>
		</div>
	</div>
	<?= $_AFTER_HEADER ?? "" ?>
	<?php
		$annoncesPresentes = in_array(4, $_MAIRIE["fonctionnalites"]);
		$publicitesPresentes = in_array(6, $_MAIRIE["fonctionnalites"]);
	?>
	<section id="content" class="<?= (!$annoncesPresentes and !$publicitesPresentes) ? "aside-hidden" : "" ?>">
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