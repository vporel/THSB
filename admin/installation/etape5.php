<?php $_PAGE_TITLE = "Compte administrateur" ?>
<form method="post">
    <h4 style="text-align:center">Pour cette première version, on ne peut avoir qu'un seul compte administrateur</h4>
    <input type="hidden" name="compte-administrateur">
    <span>
        <label for="login">Login <font class="asterisque">*</font></label>
        <input type="text" name="login"required />
    </span>
    <span>
        <label for="mot-de-passe">Mot de passe <font class="asterisque">*</font></label>
        <input type="password" name="mot-de-passe"required />
    </span>
    <span>
        <label for="confirm-mot-de-passe">Mot de passe <font class="asterisque">*</font></label>
        <input type="password" name="confirm-mot-de-passe"required />
    </span>
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
    <center style="margin-top:15px;"><strong><i>
        Pour vous connecter en tant qu'administrateur et modifier le site, 
        entrez l'adresse /admin (après le nom du dossier du CMS)<br>
        ex: localhost/[chemin_dossier]/admin
    </i></strong></center>
</form>

<script type="text/javascript">
    
</script>