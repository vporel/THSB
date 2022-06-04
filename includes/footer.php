<div id="contacts">
	<p> Une question ?  contactez-nous </p>
	<h4><?= $_MAIRIE["contacts"] ?? "...." ?></h4>
	<?php if(isAdminConnected()){ ?>
		<a href="admin/modifier-info-mairie.php?infoType=contacts" class="d-inline-block btn btn-admin-update">
			<object data="assets/icons/edit.svg" class="icon"></object><em>Modifier les contacts</em>
		</a>
	<?php } ?>
</div>
<p>© Copyrith 2022</p>

<?php if(!isAdminConnected()){ ?>
	<center><a href="admin/" style="color:skyblue">Modifier le site</a></center>

<?php } ?>