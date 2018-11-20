<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    include("../includes/style.php");
    include ("../includes/bdd.php");
    ?>
</head>
<body>

<div class="container">
    <?php
    include("../includes/templates/navbar.php");
    $total_commande = 0;
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    <?php
    foreach ($_SESSION['cart'] as $key => $ref)
    {
        $req_ref_info = $bdd->prepare('SELECT * FROM reference WHERE id = ? ');
        $req_ref_info->execute(array($key));
        $ref_info = $req_ref_info->fetch();

        $req_ref_img = $bdd->prepare('SELECT * FROM image WHERE reference = ?');
        $req_ref_img->execute(array($key));
        $ref_img = $req_ref_img->fetch();
        ?>
            <div class="row" style="margin-bottom: 20px; border-bottom: 1px solid #FFBE14; padding-bottom: 10px">
                <div class="col-md-5">
                    <img src="<?= $ref_img['src'] ?>" class="img-responsive">
                </div>
                <div class="col-md-7">
                    <h4><?= $ref_info['name'] ?></h4>
                    Quantité : <?= $_SESSION['cart'][$key]; ?><br><br>
                    <strong style="float: right">Total : <?php
                        $total_ref = $ref_info['price'] * $_SESSION['cart'][$key];
                        $total_commande += $total_ref;
                        echo $total_ref
                        ?> €</strong>
                </div>
            </div>
        <?php
    }
    ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center">Total commande : <?= $total_commande ?> €</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="#"><button class="btn btn-success btn-block" style="margin: 20px; font-size: 20px;">Valider le panier !</button></a>
        </div>
    </div>
    <?php
    include("../includes/templates/footer.php");
    ?>
</div>
</body>
</html>