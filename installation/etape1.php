
<style type="text/css">
    #text-nom-mairie{
        display:none;
        text-align:center;
        padding:5px 0;
    }
    #text-nom-mairie font{
        color:var(--couleur-primaire);
        font-weight: bold;
    }
</style>
<form method="post">
    <span>
        <label for="nom-mairie" style="text-align:center">Nom de la mairie</label>
        <input type="text" name="nom-mairie" id="nom-mairie" required autocomplete="false"/>
    </span>
    <div id="text-nom-mairie">Site pour la mairie de <font></font></div>
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