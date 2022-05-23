
<form method="post">
    <h3>Base de données</h3>
    <input type="hidden" name="base-de-donnees">
    <span>
        <label for="nom-bd">Nom de la base <font class="asterisque">*</font></label>
        <input type="text" name="nom-bd" id="nom-bd" required />
    </span>
    <span>
        <label for="hote-bd">Hôte <font class="asterisque">*</font></label>
        <input type="text" name="hote-bd" id="hote-bd" value="localhost" required />
    </span>
    <span>
        <label for="nom-utilisateur-bd">Nom d'utilisateur <font class="asterisque">*</font></label>
        <input type="text" name="nom-utilisateur-bd" id="nom-utilisateur-bd" value="root" required />
    </span>
    <span>
        <label for="mot-de-passe-bd">Mot de passe</label>
        <input type="text" name="mot-de-passe-bd" id="mot-de-passe-bd" />
    </span>
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
</form>

<script type="text/javascript">
    
</script>