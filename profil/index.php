<?php
session_start();
    if (isset($_SESSION['ID']))
    {
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
        ?>
        <div class="row">
            <div class="col-md-6" style="border-right: solid 1px #1c1c1c">
                <h2 class="text-center">Mes commandes</h2>
                <?php
                    $req_command = $bdd->prepare('SELECT * FROM command WHERE client = ? ORDER BY id DESC');
                    $req_command->execute(array($_SESSION['ID']));
                    $commands = $req_command->fetchAll();
                    foreach ($commands as &$command) {
                        ?>
                        <div class="row">
                            <h4>
                                <?php
                                // data
                                $date = new DateTime($command['add_date']);
                                echo date_format($date, 'Y/m/d H:i');
                                ?>
                            </h4>
                            <?php
                            // référence
                            $req_ref = $bdd->prepare('SELECT name, id FROM reference WHERE id IN (SELECT DISTINCT reference FROM product WHERE command = ?)');
                            $req_ref->execute(array($command['id']));
                            while($ref = $req_ref->fetch())
                            {
                                ?>
                                <div class="row">
                                <?php
                                    # img

                                    $req_ref_img = $bdd->prepare('SELECT src FROM image WHERE reference = ?');
                                    $req_ref_img->execute(array($ref['id']));
                                    $ref_img = $req_ref_img->fetch()['src'];

                                    # quantité

                                    $req_ref_quantity = $bdd->prepare('SELECT COUNT(*) FROM product WHERE reference = ? AND command = ?');
                                    $req_ref_quantity->execute(array($ref['id'], $command['id']));
                                    $ref_quantity = $req_ref_quantity->fetchColumn();
                                    ?>
                                    <div class="col-md-4">
                                        <img src="<?= $ref_img ?>" alt="<?= $ref['name'] ?>" class="img-responsive" style="padding: 10px">
                                    </div>
                                    <h5><?= $ref['name'] ?></h5>
                                    Quantité : <?= $ref_quantity ?>
                                </div>
                                <?php
                            }
                        ?>
                            <strong style="float: right; margin-right: 30px">Prix total : <?= $command['price'] ?> €</strong>
                            <hr style="margin: 20px">
                        </div>
                        <?php

                        }
            ?>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Mes adresses</h2>
            </div>
        </div>
        <?php
        include("../includes/templates/footer.php");
        ?>
    </div>
</body>
</html>
<?php
    }
    else
    {
        header('Location: login/');
    }

?>