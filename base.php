<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $_TITLE ?></title>

	<?php
		$themeNb = $_MAIRIE["theme"] ?? null;
		if($themeNb == null || (int) $themeNb < 0 || (int) $themeNb > $_NB_THEMES){
			//Pour l(instant il n'a que 2 themes)
			$themeNb = 1;//Theme par défaut
		}
	?>	
	<link rel="stylesheet" type="text/css" href="assets/css/theme-<?= $themeNb ?>.css"/>
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
	<footer>
		<?php include "includes/footer.php"; ?>
	</footer>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<?= $_SCRIPTS ?? "" ?>
</body>
</html>