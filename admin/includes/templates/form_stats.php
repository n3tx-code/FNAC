<?php
$req_shop = $bdd->query('SELECT identifiant FROM shop');
$req_cat = $bdd->query('SELECT id, name FROM category');
?>
<h2 class="add-admin-title">Stats boutique :</h2>
<form action="/admin/includes/stats/shops.php" class="form-horizontal" method="post" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-4" for="id_shop_input">Boutique* :</label>
        <div class="col-sm-8">
            <input list="id_shop_list" class="form-control" id="id_shop_input"
                   name="shop" placeholder="Boutique" required>
            <datalist id="id_shop_list">
                <?php
                while ($shop = $req_shop->fetch())
                {
                    echo "<option value='".$shop['identifiant']."'></option>";
                }
                ?>
            </datalist>
        </div>
    </div>
<button type="submit" class="btn btn-success btn-block">Valider</button>
</form>
<hr>
<h2 class="add-admin-title">Stats catégorie :</h2>
<form action="/admin/includes/stats/category.php" class="form-horizontal" method="post" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-4" for="ref_cat_input">Catégorie* :</label>
        <div class="col-sm-8">
            <input list="ref_cat_list" class="form-control" id="ref_cat_input"
                   placeholder="Catégorie" required>
            <datalist id="ref_cat_list">
                <?php
                while ($cat = $req_cat->fetch())
                {
                    ?>
                    <option data-value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                    <?php
                }
                ?>
            </datalist>
            <input type="hidden" name="category" id="cat">
        </div>
    </div>
<button type="submit" class="btn btn-success btn-block">Valider</button>
</form>

<script>
   document.querySelector('#ref_cat_input').addEventListener('input', function(e) {
        var input = e.target,
            list = input.getAttribute('list'),
            options = document.querySelectorAll('#' + list + ' option'),
            hiddenInput = document.getElementById('cat'),
            inputValue = input.value;

        hiddenInput.value = inputValue;

        for(var i = 0; i < options.length; i++) {
            var option = options[i];

            if(option.innerText === inputValue) {
                hiddenInput.value = option.getAttribute('data-value');
                break;
            }
        }
    });

</script>
<hr>