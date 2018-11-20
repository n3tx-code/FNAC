<?php
session_start();
include ("../includes/bdd.php");
$req_reference = $bdd->prepare('SELECT * FROM reference WHERE id = ?');
$req_reference->execute(array(htmlspecialchars(htmlspecialchars($_GET['r']))));
$reference = $req_reference->fetch();
if(!$reference)
{
    header("Location: /");
}
else {

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <?php
        include("../includes/style.php");
        ?>
    </head>
    <body>

    <div class="container">
        <?php
        include("../includes/templates/navbar.php");
        if(isset($_GET['add']) AND $_GET['add'] > 0)
        {
            ?>
            <div class="good">
                <?= $reference['name'] ?> a été ajouté <?= htmlspecialchars($_GET['add']) ?> fois dans votre panier.
            </div>
            <?php
        }
        ?>
        <h2 class="text-center"><?= $reference['name'] ?></h2>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-5">
                        <?php
                        $req_ref_img = $bdd->prepare('SELECT * FROM image WHERE reference = ?');
                        $req_ref_img->execute(array($reference['id']));
                        $i = 0;
                        while ($ref_img = $req_ref_img->fetch())
                        {
                            ?>
                            <img class="mySlides" src="<?= $ref_img['src'] ?>" style="width:100%">
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-7">
                        <p>
                            <?= $reference['description'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-8">
                        <form class="form-horizontal" action="add_ref_to_cart.php" method="post">
                            <div class="form-group">
                                <label class="control-label col-sm-6" for="amount">Quantité:</label>
                                <div class="col-sm-6">
                                    <input type="number" name="amount" class="form-control" id="email" placeholder="Quantié" value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Ajouter au panier !</button>
                            </div>
                            <input type="hidden" value="<?= htmlspecialchars($_GET['r']) ?>" name="ref">
                        </form>
                    </div>
                    <span class="ref_price"><?= $reference['price'] ?> € / l'unité</span>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
        <?php
        include("../includes/templates/footer.php");
        ?>
    </div>
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>
    </body>
    </html>
    <?php
}?>