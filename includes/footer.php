<h1 id="special">Recevez chaque semaine l'actualité de votre ville</h1>
<table id="special1">

<form>
	<input type="text" name="email" value="Email" id="mail"  required>
	<input type="button" name="bouton" value="S'abonner" id="b">
	
	
</form>


</table>
<p> Une question?  contactez-nous sur <a href="#">@MAIRIEJECOUTE</a> </p>
<a href="#"> CONTACT</a>
<a href="#"> MENTIONS LEGALES</a>
<a href="#"> NOS PUBLICATIONS</a>
<a href="#">RESEAUX SOCIAUX</a>
<p>© Copyrith 2022</p>
<style type="text/css">
	
	#special
	{
		font-family: aria;
		font-size: 20px;
	}
	#special1
	{
		text-align: center;
		width: 200px;
	}


</style>


<?php if(!isAdminConnected()){ ?>
	<center><a href="admin/" style="color:skyblue">Accéder à l'administration</a></center>

<?php } ?>