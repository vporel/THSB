<?php require "./includes/head.php"; ?>
<?php $_TITLE = "Personnel | Mairie de ".$_MAIRIE["nom"]; ?>


<?php ob_start(); ?>
    
    <style>
        .personnel1{
           margin-bottom:30px;
        }
        .personnel2{
            margin-left:20px;
        }
    </style>
<?php $_STYLES= ob_get_clean(); ?>
<?php ob_start(); ?>
<main>
<div class="personnel1">
     <div class="div-image1">
         <img src="images/maire.jpeg">
 	
     <div>
        <p>LENGUE MALAPA JEAN-JACQUES |  Maire de la communaute de Douala Ier</p>
    
        <a href="cv1.htnl"> CV telechargeable</a>
    </div>
         
</div>
</div>
<br>
<br>
<br>
<br>
<div class="personnel2">
<div class="div-image2">
         <img src="images/maire.jpeg">
         
    <div>
        <p> EKE-de-MATEKE-GERARD | Chef cabinet du maire</p>
        
        <a href="cv2.htnl"> CV telechargeable</a>
</div>
    </div>
     
         
</div>
</div>
<br>
<br>
<br>
<br>
<div class="personnel3">
<div class="div-image3">
         <img src="images/maire.jpeg">
 		
    <div>
        <p> EONE OSCAR JEAN | secretaire general</p>
        <a href="cv3.htnl">CV telechargeable</a>
</div>
    </div>
     
         
</div>
</div>
<br>
<br>
<br>
<br>
<div class="personnel4">
<div class="div-image4">
         <img src="images/maire.jpeg">
 		
    <div>
        <p>Tonye Charles Lavoisier | Chef service technique</p>
        
        <a href="cv4.htnl"> CV telechargeable</a>
</div>
    </div>     
         
</div>
</div>
<br>


<?php $_CONTENT = ob_get_clean(); ?>
<?php require "base.php"; ?>