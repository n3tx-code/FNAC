<?php
$req_ref = $bdd->query('SELECT id, name FROM reference');
?>
<h2 class="add-admin-title">Ajout boutique :</h2>
<form action="includes/scripts/add_shop.php" class="form-horizontal" method="post" style="display: none"">
    <h4>Adresse*</h4>
    <div class="form-group">
        <label for="nom-prenom">Nom :</label>
        <input type="text" class="form-control" id="shop_nom" name="shop_nom">
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="shop-n-rue">N° :</label>
                <input type="text" class="form-control" id="shop-n-rue" name="shop-n-rue" required>
            </div>
        </div>

        <div class="col-md-9 col-md-offset-1">
            <div class="form-group">
                <label for="shop-rue">Rue :</label>
                <input type="text" class="form-control" id="shop-rue" name="shop-rue" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="shop-CP">Code postal :</label>
                <input type="text" class="form-control" id="shop-CP" name="shop-CP" required>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <div class="form-group">
                <label for="shop-ville">Ville :</label>
                <input type="text" class="form-control" id="shop-ville" name="shop-ville" required>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">Ajouter boutique</button>
</form>
<hr>
