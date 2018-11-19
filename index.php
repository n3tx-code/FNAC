<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
        include("includes/style.php");
        include ("includes/bdd.php");
        ?>
    </head>
<body>

    <div class="container">
        <?php
        include("includes/templates/navbar.php");
        include("includes/templates/slider.php");
        include("includes/templates/new_product.php");
        include("includes/templates/best_sells.php");
        include("includes/templates/footer.php");
        ?>
    </div>
</body>
</html>