<?php $_PAGE_TITLE = "Base de données" ?>
<form method="post">
    <h4 style="text-align:center">Le CMS Utilise un base de données SQLite (un fichier 'bd.sqlite' sera créé dans le dossier du projet)</h4>
    <input type="hidden" name="base-de-donnees">
    <!-- 
        Informations à fornir si la base est mysql
    <span>
        <label for="nom-bd">Nom de la base <font class="asterisque">*</font></label>
        <input type="text" name="nom-bd" id="nom-bd" required value="<?= $_POST["nom-bd"] ?? "" ?>"/>
    </span>
    <span>
        <label for="hote-bd">Hôte <font class="asterisque">*</font></label>
        <input type="text" name="hote-bd" id="hote-bd" required value="<?= $_POST["hote-bd"] ?? "localhost" ?>"/>
    </span>
    <span>
        <label for="nom-utilisateur-bd">Nom d'utilisateur <font class="asterisque">*</font></label>
        <input type="text" name="nom-utilisateur-bd" id="nom-utilisateur-bd" required value="<?= $_POST["nom-utilisateur-bd"] ?? "root" ?>"/>
    </span>
    <span>
        <label for="mot-de-passe-bd">Mot de passe</label>
        <input type="text" name="mot-de-passe-bd" id="mot-de-passe-bd" value="<?= $_POST["mot-de-passe-bd"] ?? "" ?>"/>
    </span>
    -->
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
</form>

<script type="text/javascript">
    
</script>