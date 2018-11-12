<h2 class="add-admin-title">Ajout Catérogies :</h2>
<form action="includes/scripts/add_category.php" class="form-horizontal" method="post" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-4" for="categorie_name">Nom* :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="categorie_name"
                   placeholder="Nom catégorie" name="categorie_name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="categorie_description">Description* :</label>
        <textarea class="form-control" rows="3" id="categorie_description" name="categorie_description"></textarea>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="categorie_parent">Catégorie parent :</label>
        <div class="col-sm-8">
            <select class="form-control" name="categorie_parent">
                <option></option>
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
    <button type="submit" class="btn btn-success btn-block">Ajouter produit</button>
</form>
<hr>
