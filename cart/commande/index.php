<?php
session_start();
if(!isset($_SESSION['cart']) OR empty($_SESSION['cart']) OR !isset($_SESSION['shop']) OR empty($_SESSION['shop']))
{
    header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=true');
    exit();
}
include('../../includes/bdd.php');

if(isset($_POST['adresse']))
{
// calcul prix total avec promo
    $total_price = 0;
    foreach ($_SESSION['cart'] as $key => $ref) {
        $ref_price = 0;
        $req_ref_info = $bdd->prepare('SELECT * FROM reference WHERE id = ? ');
        $req_ref_info->execute(array($key));
        $ref_info = $req_ref_info->fetch();
        $ref_price = $ref_info['price'];

        $req_promo = $bdd->prepare('SELECT percentage FROM promo WHERE reference = ? AND end_date >= CURRENT_DATE');
        $req_promo->execute(array($key));
        $promo_ref = $req_promo->fetchColumn();
        if($promo_ref)
        {
            $ref_price = $ref_price - (($ref_price / 100) * $promo_ref );
        }
        $total_price += ($ref_price * $_SESSION['cart'][$key]);
    }
    $sql = 'INSERT INTO command(client, price) VALUES(:client, :price)';
    $req = $bdd->prepare($sql);
    $req->execute(array(
        'client' => $_SESSION['ID'],
        'price' => $total_price
    ));

    $req_command = $bdd->prepare('SELECT id FROM command WHERE client = ? ORDER BY add_date DESC');
    $req_command->execute(array($_SESSION['ID']));
    $command = intval($req_command->fetchColumn());

    try {
        $bdd->beginTransaction();

        foreach ($_SESSION['cart'] as $key => $ref) {
            $shop = $_SESSION['shop'][$key];
            for($i = 0; $i < $_SESSION['cart'][$key]; $i++)
            {
                $req = $bdd->prepare('INSERT INTO product(reference, command, shop) VALUES(?, ?, ?)');
                $req->execute(array($key,
                    $command,
                    $shop));

            }
        }

        $add_livraison = $bdd->prepare('INSERT INTO delivery(command, address) VALUES(?, ?)');
        $add_livraison->execute(array($command, $_POST['adresse']));
        $bdd->commit();
    }

    catch (Exception $ex)
    {
        $bdd->rollBack();

        // supression produit
        $req_del_product = $bdd->prepare('DELETE FROM product WHERE command = ?');
        $req_del_product->execute(array($command));

        // suppresion commande
        $sql = 'DELETE FROM command WHERE id = :id';
        $req_del_command = $bdd->prepare($sql);
        $req_del_command->execute(array(
            'id' => $command
        ));
        //header('location: /cart/?error=true');
        exit();
    }
    $_SESSION['cart'] = array();
    header('location: /cart/?error=false');
}
else
{
    if(!isset($_SESSION['cart']) OR empty($_SESSION['cart']))
    {
        header("Location: /");
    }

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
        include("../../includes/style.php");
        ?>
    </head>
<body>

    <div class="container">
        <form action="index.php" method="post" >
            <div class="row">
            <?php
            include("../../includes/templates/navbar.php");
            ?>
            <h3 class="text-center">Adresse de livraison :</h3>
            <?php
            $req_adress_usser = $bdd->prepare('SELECT * FROM address WHERE client = ?');
            $req_adress_usser->execute(array($_SESSION['ID']));
            $i = 0; // conteur pour background adresse
            while($adress_user = $req_adress_usser->fetch()) {
                ?>
                <div class="col-md-4 text-center" style="margin-top: 3%; margin-bottom: 4%">
                    <label class="radio-inline">
                        <input type="radio" name="adresse" class="adress-choise" value="<?= $adress_user['id'] ?>">
                        <div class="adresse-content"

                            <?php
                            if($i < 1)
                            {
                                echo 'style="background: #f2f3f4" checked';
                                $i++;
                            }
                            ?>

                        >
                        <?= $_SESSION['name'] ?> <?= $_SESSION['first_name'] ?><br>
                        <?= $adress_user['number'] ?> <?= $adress_user['street'] ?><br>
                        <?= $adress_user['city'] ?> <?= $adress_user['zip_code'] ?><br>
                        <?= $adress_user['description'] ?>
                        </div>
                    </label>
                </div>
                <?php
            }
            ?>
            <script>

                $('.adress-choise').click(function(){
                   var adress_content = $(this.nextElementSibling);
                   $('.adresse-content').css('background', 'inherit');
                   adress_content.css('background', '#f2f3f4');
                });
            </script>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-success btn-block">Envoyer la commande <i class="fas fa-rocket"></i></button>
                </div>
            </div>
        </form>
            <?php
            include("../../includes/templates/footer.php"); ?>
</body>
</html>
<?php
}

?>