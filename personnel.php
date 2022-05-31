<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Personnel | Mairie de ".$_MAIRIE["nom"]; ?>


<?php ob_start(); ?>
    
    <style>
        .pl1{
            display=flex;
        }
    </style>
<?php $_STYLES= ob_get_clean(); ?>
<?php ob_start(); ?>
<main>
<div class="personnel1">
    <div class="pl1" style=display:flex; >
     <div class="div-image1">
         <img src="images/maire.jpeg" style=margin-top:20px;>
 	
    </div>
    <div class="div-image11" style="margin-top:20px; margin-left:20px;">
        <p>
            <br> 2008-2009: secretaire general adjoint</br>
            <br> 2009-2013: chef service finance</br>
        </p>
        <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-personnel.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>
 	
    </div>
    </div>

        <p>LENGUE MALAPA JEAN-JACQUES |  Maire de la communaute de Douala Ier</p>
    
        <a href="cv1.htnl"> CV telechargeable</a>

         

</div>
<br>
<br>
<br>
<br>

<div class="personnel2">
    <div class="pl1" style="display:flex; margin-left:300px; ">
    <div class="div-image22">
    <p>
            <br> 2008-2009: secretaire general adjoint</br>
            <br> 2009-2013: chef service finance</br>
        </p>
        <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-personnel.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>
          </div>

        <div class="div-image2" style="margin-left:10px;">
         <img src="images/maire.jpeg">
    </div>
         
    </div>
    <div class="pf" style="margin-left:350px;">
        <p> EKE-de-MATEKE-GERARD | Chef cabinet du maire</p>
        
        <a href="cv2.htnl"> CV telechargeable</a>

    </div>
     

</div>
<br>
<br>
<br>
<br>
<div class="personnel3">
    <div class="pl3" style="display:flex;">
<div class="div-image3">
         <img src="images/maire.jpeg">
    </div>
     
    <div class="div-image33" style="margin-left:20px;">
    <p>
            <br> 2008-2009: secretaire general adjoint</br>
            <br> 2009-2013: chef service finance</br>
        </p>
        <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-personnel.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>
    </div>
    
 		
    </div>
        <p> EONE OSCAR JEAN | secretaire general</p>
        <a href="cv3.htnl">CV telechargeable</a>  

</div>
<br>
<br>
<br>
<br>
<div class="personnel4">
    <div class="pl4" style="display:flex; margin-left:300px; ">
    <div class="div-image44">
    <p>
            <br> 2008-2009: secretaire general adjoint</br>
            <br> 2009-2013: chef service finance</br>
        </p>
        <?php if(isAdminConnected()){ ?>
				<a href="admin/modifier-personnel.php" class="d-inline-block btn btn-admin-update">
					Modifier
				</a>
				
			<?php } ?>
              
          </div>

        <div class="div-image4" style="margin-left:10px;">
         <img src="images/maire.jpeg">
    </div>
         
    </div>
    <div class="pf1" style="margin-left:350px;">
        <p> Tonye Charles Lavoisier | Chef service technique</p>
        
        <a href="cv4.htnl"> CV telechargeable</a>

    </div>
     

</div>



<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>