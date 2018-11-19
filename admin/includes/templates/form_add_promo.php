<?php
    $req_ref = $bdd->query('SELECT id, name FROM reference');
?>
<h2 class="add-admin-title">Ajout promo :</h2>
<form action="includes/scripts/add_promo.php" class="form-horizontal" method="post" style="display: none" enctype="multipart/form-data">
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
        <label class="control-label col-sm-4" for="promo_start_date">Début* :</label>
        <div class="col-sm-8">
            <input type="date" name="promo_start_date" class="form-control" required style="line-height: inherit">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="promo_fin_date">Fin* :</label>
        <div class="col-sm-8">
            <input type="date" name="promo_fin_date" class="form-control" required style="line-height: inherit">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="promo_pourcent">Pourcentage* :</label>
        <div class="col-sm-8">
            <input type="number" name="promo_pourcent" class="form-control" required style="line-height: inherit" min="0">
        </div>
    </div>
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
    <button type="submit" class="btn btn-success btn-block">Ajouter promotions</button>
</form>
<hr>
