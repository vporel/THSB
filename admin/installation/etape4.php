<?php $_PAGE_TITLE = "Eléments à gérer" ?>
<style>
    label{display:inline!important}
</style>
<form method="post">
    <p>Vous pourrez les modifier plus tard</p>
    <?php foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonc){ ?>
    <span>
        <input type="checkbox" name="fonctionnalites[]" id="<?= $fonc["nom"] ?>" value="<?= $index ?>" <?= ($_INSTALLATION["etape-complete"] < 4 || in_array($index, $_MAIRIE["fonctionnalites"])) ? "checked" : "" ?>/>
        <label for="<?= $fonc["nom"] ?>"><?= $fonc["label"] ?></label>
    </span>
    <?php } ?>
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
</form>