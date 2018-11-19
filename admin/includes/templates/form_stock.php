<?php
$req_shop = $bdd->query('SELECT identifiant FROM shop');
$req_ref = $bdd->query('SELECT id, name FROM reference');
?>
<h2 class="add-admin-title">Stock :</h2>
<form action="includes/scripts/add_update_stock.php" class="form-horizontal" method="post" style="display: none"">
    <div class="form-group">
        <label class="control-label col-sm-4" for="id_shop_input">Boutique* :</label>
        <div class="col-sm-8">
            <input list="id_shop_list" class="form-control" id="id_shop_input"
                   name="id_shop" placeholder="Boutique" required>
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
    <div class="form-group">
        <label class="control-label col-sm-4" for="ref_promo_input">Référence* :</label>
        <div class="col-sm-8">
            <input list="ref_promo_list" class="form-control" id="ref_promo_input"
                   placeholder="Référence" required>
            <datalist id="ref_promo_list">
                <?php
                while ($ref = $req_ref->fetch())
                {
                    ?>
                    <option data-value="<?= $ref['id'] ?>"><?= $ref['name'] ?></option>
                    <?php
                }
                ?>
            </datalist>
            <input type="hidden" name="ref_promo" id="ref_promo">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="stock_number">Nombre* :</label>
        <div class="col-sm-8">
            <input type="number" min="0" class="form-control" name="stock_number"
               id="stock_number" required>
        </div>
    </div>
<input type="hidden" name="update" value="false">
<button type="submit" class="btn btn-success btn-block">Valider</button>
</form>
<script>
   document.querySelector('#ref_promo_input').addEventListener('input', function(e) {
        var input = e.target,
            list = input.getAttribute('list'),
            options = document.querySelectorAll('#' + list + ' option'),
            hiddenInput = document.getElementById('ref_promo'),
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
