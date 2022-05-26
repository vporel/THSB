<style>
    label{display:inline!important}
</style>
<form method="post">
    <h3>Eléments à gérer</h3>
    <p>Vous pourrez les modifier plus tard</p>
    <?php foreach($_FONCTIONNALITES_DISPONIBLES as $index => $fonc){ ?>
    <span>
        <input type="checkbox" name="fonctionnalites[]" id="<?= $fonc["nom"] ?>" value="<?= $index ?>"/>
        <label for="<?= $fonc["nom"] ?>"><?= $fonc["label"] ?></label>
    </span>
    <?php } ?>
    <div class="btns">
        <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
</form>