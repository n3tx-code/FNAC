<h2 class="add-admin-title">Ajout partenaire :</h2>
<form action="includes/scripts/add_partner.php" class="form-horizontal" method="post" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-4" for="partner_name">Nom* :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="partner_name"
                   placeholder="Nom partenaire" name="partner_name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="partner_description">Description* :</label>
        <textarea class="form-control" rows="3" id="partner_description" name="partner_description" required></textarea>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="partner_site">Site web* :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="partner_ref" name="partner_site"
                   placeholder="Site web du partenaire" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">Ajouter produit</button>
</form>
<hr>
