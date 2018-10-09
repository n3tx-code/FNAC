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
                    $sql = 'SELECT name FROM partner';
                    foreach ($bdd->query($sql) as $row)
                    {
                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                ?>
            </select>
		</label><br>
		<label>Catégorie :
			<select name="category" required>
                <option value=""></option>
				<?php
					$sql = 'SELECT name FROM category';
					foreach ($bdd->query($sql) as $row)
					{
                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
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
			<input type="number" name="promo" required>
		</label><br>
		<label>
			<input type="submit" name="submit" value="Add product">
		</label><br>
	</form>

	<br><br>

	<form action="includes/add_category.php" method="post">
		<label>Nom :
			<input type="text" name="name" required>
		</label><br>
		<label>Description :
			<input type="text" name="description">
		</label><br>
		<label>Parent category
			<select name="category">
                <option value=""></option>
				<?php
                    $sql = 'SELECT name FROM category';
                    foreach ($bdd->query($sql) as $row)
                    {
                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
				?>
			</select>
		</label><br>
		<label>
			<input type="submit" name="submit" value="Add category">
		</label><br>
	</form>

	<br><br>

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

</body>

</html>