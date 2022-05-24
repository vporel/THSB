<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $_TITLE ?></title>

	<link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
	<script src="assets/js/biblio.js"></script>
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
		<?= $_CONTENT ?>
	</section>
	<footer>
		<?php include "includes/footer.php"; ?>
	</footer>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>