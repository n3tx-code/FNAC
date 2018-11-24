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
    if(isset($_GET['error']) AND !empty($_GET['error']))
    {
        if($_GET['error'] == "false")
        {
            echo "<div class=\"good\">Votre commande a été validé !</div>";
        }
        elseif($_GET['error'] == "true")
        {
            echo "<div class=\"erreur\">Erreur dans la commande</div>";
        }
    }

    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    <?php
    if(isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $ref) {
            $req_ref_info = $bdd->prepare('SELECT * FROM reference WHERE id = ? ');
            $req_ref_info->execute(array($key));
            $ref_info = $req_ref_info->fetch();
            $ref_price = $ref_info['price'];

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
                    Quantité : <?= $_SESSION['cart'][$key]; ?><br>
                    Magasin : <?= $_SESSION['shop'][$key]; ?><br>
                    <?php
                    $req_promo_ref = $bdd->prepare('SELECT percentage FROM promo WHERE reference = ? AND end_date >= CURRENT_DATE');
                    $req_promo_ref->execute(array($key));
                    $promo_ref = $req_promo_ref->fetchColumn();
                    if($promo_ref)
                    {
                     ?>
                        <span style="color : red"><?= $promo_ref ?>  % de promotion</span><br>
                        <span class="ref_price"></span>
                            <?php
                            $ref_price = $ref_info['price'] - (($ref_info['price'] / 100) * $promo_ref );
                            ?>
                            <span style="color : red"><?= $ref_price ?></span> € / l'unité</span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <?= $ref_price ?></span> € / l'unité
                        <?php
                    }

                    ?>
                    <strong style="float: right">Total :

                        <?php

                        $total_ref = ($ref_price * $_SESSION['cart'][$key]);
                        $total_commande += $total_ref;
                        echo $total_ref
                        ?> €</strong>
                </div>
            </div>
            <?php
        }
    }
    else
    {
        echo "<h4 class=\"text-center\"> Panier vide </h4>";
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
            <?php
            if(isset($_SESSION['cart']) AND isset($_SESSION['ID']) AND !empty($_SESSION['cart']))
            {
              ?>
                <a href="commande/"><button class="btn btn-success btn-block" style="margin: 20px; font-size: 20px;">Valider le panier !</button></a>
                <?php
            }
            else
            {
                if(!isset($_SESSION['ID']))
                {
                    ?>
                    <div class="erreur">
                        Merci de vous connectez pour validez votre panier
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <button class="btn btn-success btn-block" style="margin: 20px; font-size: 20px;" disabled>Valider le panier !</button>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    include("../includes/templates/footer.php");
    ?>
</div>
</body>
</html>