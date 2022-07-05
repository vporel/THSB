
<div id="contacts">
	<p> Une question ?  contactez-nous </p>
	<h4><strong><u><?= $_MAIRIE["contacts"] ?? ".........." ?></u></strong></h4>
	<?php if(isAdminConnected()){ ?>
		<a href="admin/modifier-info-mairie.php?infoType=contacts" class="d-inline-block btn btn-admin-update">
			<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier les contacts</em>
		</a>
	<?php } ?>
</div>
<h2>Mairie de <strong><?= $_MAIRIE["nom"] ?? "" ?></strong></h2>
<h3>
	<strong>By</strong> THSB - <strong>T</strong>own <strong>H</strong>all <strong>S</strong>ite <strong>B</strong>uilder
	© Copyrith 2022
</h3>

<?php if(!isAdminConnected()){ ?>
	<center><a href="admin/" style="color:skyblue">Modifier le site</a></center>

<?php } ?>