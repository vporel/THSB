<?php $_PAGE_TITLE = "Mode d'installation" ?>
<style type="text/css">
    form span{text-align:center;}
    form span *{display:inline-block}
</style>
<form method="post">
    <span>
        <label for="rapide">Rapide</label>
        <input type="radio" name="mode-installation" id="rapide" checked value="1"/>
    </span>
    <span>
        <label for="complete">Complète</label>
        <input type="radio" name="mode-installation" id="complete" value="2"/>
    </span>
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
</form>

<script type="text/javascript">
    let $nomMairie = $("#nom-mairie");
    function changeTextNomMairie(){
        let nomMairie = $nomMairie.value.trim();
        if(nomMairie != ""){
            $("#text-nom-mairie font").textContent = nomMairie;
            $("#text-nom-mairie").style.display = "block";
        }else{
            $("#text-nom-mairie").style.display = "none";
        }
    }
    $nomMairie.onkeyup = changeTextNomMairie;
    $nomMairie.onchange = changeTextNomMairie;
</script>