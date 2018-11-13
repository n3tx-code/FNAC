<h2 class="add-admin-title">Ajout produit :</h2>
<form action="includes/scripts/add_product.php" class="form-horizontal" method="post" style="display: none" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-4" for="product_name">Nom* :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="product_name"
                   placeholder="Nom du produit" name="product_name" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="product_ref">Référence du produit* :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="product_ref" name="product_ref"
                   placeholder="Référence produit" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="product_partner">Partenaire :</label>
        <div class="col-sm-8">
            <select class="form-control" name="product_partner">
                <option value=""></option>
                <?php
                $sql = 'SELECT id, name FROM partner';
                foreach ($bdd->query($sql) as $row)
                {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="product_cat">Catégorie* :</label>
        <div class="col-sm-8">
            <select class="form-control" name="product_cat" required>
                <option value=""></option>
                <?php
                $sql = 'SELECT id, name FROM category';
                foreach ($bdd->query($sql) as $row)
                {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="profuct_price">Prix* :</label>
        <div class="col-sm-7">
            <input type="number" min="0" class="form-control" name="product_price"
                   id="product_price" required>
        </div>
        <div class="col-sm-1">
            <i class="fas fa-euro-sign" style="margin-top: 10px"></i>
        </div>
    </div>
    <div class="form-group">
        <label for="product_description">Description* :</label>
        <textarea class="form-control" rows="3" id="product_description" name="product_description" required></textarea>
    </div>
    <div class=""form-group">
        <label for="product_img">Images* :</label>
        <input type="file" accept="image/*" name="product_img[]" required multiple>
    </div>
    <button type="submit" class="btn btn-success btn-block">Ajouter produit</button>
</form>
<hr>
