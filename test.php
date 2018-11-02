<?php

	include('includes/bdd.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
</head>
<body>

    <h2>Ajout produit :</h2>
	<form action="includes/add_product.php" method="post">
		<label>Nom :
			<input type="text" name="name" required>
		</label><br>
		<label>Référence du produit :
			<input type="text" name="ref_product" required>
		</label><br>
		<label>Partenaire
            <select name="partner">
                <option value=""></option>
                <?php
                    $sql = 'SELECT id, name FROM partner';
                    foreach ($bdd->query($sql) as $row)
                    {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                ?>
            </select>
		</label><br>
		<label>Catégorie :
			<select name="category" required>
				<?php
					$sql = 'SELECT id, name FROM category';
					foreach ($bdd->query($sql) as $row)
					{
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}
				?>
			</select>
		</label><br>
		<label>Description :
			<input type="text" name="description" required>
		</label><br>
		<label>Prix :
			<input type="number" name="price" required>
		</label><br>
		<label>Promo :
			<input type="number" name="promo">
		</label><br>
		<label>
			<input type="submit" name="submit" value="Add product">
		</label><br>
	</form>

	<br><br>

    <h2>Ajout categorie :</h2>
	<form action="includes/add_category.php" method="post">
		<label>Nom :
			<input type="text" name="name" required>
		</label><br>
		<label>Description :
			<input type="text" name="description">
		</label><br>
		<label>Parent category
			<select name="parent">
                <option value=""></option>
				<?php
                    $sql = 'SELECT id, name FROM category';
                    foreach ($bdd->query($sql) as $row)
                    {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
				?>
			</select>
		</label><br>
		<label>
			<input type="submit" name="submit" value="Add category">
		</label><br>
	</form>

	<br><br>

    <h2>Ajout partenaire :</h2>
	<form action="includes/add_partner.php" method="post">
		<label>Nom :
			<input type="text" name="name" required>
		</label><br>
		<label>Description :
			<input type="text" name="description" required>
		</label><br>
		<label>Site :
			<input type="text" name="site" required>
		</label><br>
		<label>
			<input type="submit" name="submit" value="Add partner">
		</label><br>
	</form>

    <h2>Ajout promo :</h2>
    <form action="includes/add_promo.php" method="post">
        <label>Rechercher :
            <input type="text" name="reference" id="search_ref_promo" required>
        </label><br>
        <ul id="search_result"></ul>
        <label>Date de début:
            <input type="date" name="start_date" required>
        </label><br>
        <label>Date de fin :
            <input type="date" name="end_date" required>
        </label><br>
        <label>Réduction (%) :
            <input type="number" name="percentage" required>
        </label><br>
        <label>
            <input type="submit" name="submit" value="Add promo">
        </label><br>
    </form>

</body>

<script src="js/search_ref.js"></script>

<script>
    search.init('search_ref_promo', 'search_result');
</script>

</html>