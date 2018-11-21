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
                        <div class="ref_rating">
                            <?php
                            // generate rating
                            $req_rating_ref = $bdd->prepare('SELECT AVG(grade) FROM opinion WHERE reference = ?');
                            $req_rating_ref->execute(array(htmlspecialchars($_GET['r'])));
                            $rating_ref = $req_rating_ref->fetchColumn();
                            $rating_ref_int = floor($rating_ref);
                            $rating_ref_decimals =  $rating_ref - $rating_ref_int;
                            for ($i = 0; $i < $rating_ref_int; $i++)
                            {
                                ?>
                                <i class="fas fa-star"></i>
                                <?php
                            }
                            if($rating_ref_decimals >= 0.5)
                            {
                                ?>
                                <i class="fas fa-star-half-alt"></i>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-8">
                        <form class="form-horizontal" action="add_ref_to_cart.php" method="post">
                            <div class="form-group">
                                <label class="control-label col-sm-6" for="shop">Boutique :</label>
                                <div class="col-sm-6">
                                    <input list="shop_list" class="form-control" id="shop_input"
                                           placeholder="Boutique" name="ref_shop" required>
                                    <datalist id="shop_list">
                                        <?php
                                        $req_shop = $bdd->query('SELECT identifiant FROM shop');
                                        while ($shop = $req_shop->fetch())
                                        {
                                            ?>
                                            <option value="<?= $shop['identifiant'] ?>"></option>
                                            <?php
                                        }
                                        ?>
                                    </datalist>
                                    <script src="/js/product_shop_quantity.js"></script>
                                </div>
                            </div>
                            <div class="form-group has-stock" style="display: none">
                                <label class="control-label col-sm-6" for="amount">Quantité:</label>
                                <div class="col-sm-6">
                                    <input type="number" min="1" max="1" id="ref_quantity" name="amount" class="form-control" placeholder="Quantié" value="1">
                                </div>
                            </div>
                            <div class="form-group" id="ref_no_stock" style="display: none">
                                <p style="float: right; font-weight: bold">Non disponible</p>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5" style="margin-top: 10px">
                                        <span class="ref_price"><?= $reference['price'] ?> € / l'unité</span>
                                    </div>
                                    <div class="col-md-6" >
                                        <button type="submit" class="btn btn-success btn-lg" id="ref_add_command" disabled>Ajouter au panier !</button>
                                    </div>
                                </div
                            </div>
                            <input type="hidden" value="<?= htmlspecialchars($_GET['r']) ?>" name="ref" id="ref_id">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- commentaire -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <?php
                $req_comment_ref = $bdd->prepare('SELECT * FROM opinion WHERE reference = ?');
                $req_comment_ref->execute(array(htmlspecialchars($_GET['r'])));
                while($comment_ref = $req_comment_ref->fetch())
                {
                    $req_client = $bdd->prepare('SELECT name FROM client WHERE id = ?');
                    $req_client->execute(array($comment_ref['client']));
                    $client_name = $req_client->fetchColumn();
                    ?>
                    <h6> <i class="fas fa-user"></i>  <?= $client_name ?></h6>
                    <div class="row">
                        <blockquote>
                            <?= $comment_ref['comment'] ?>
                        </blockquote>
                    </div>
                    <div class="row comment-rating">
                        Note :
                        <?php
                            for($i = 0; $i < $comment_ref['grade']; $i++)
                            {
                                ?>
                                <i class="fas fa-star"></i>
                                <?php
                            }
                        ?>
                    </div>
                    <br>
                    <hr>
                    <?php
                }
            ?>
            </div>
        </div>
        <?php
        if(isset($_SESSION['ID'])) {
            ?>
            <div class="row">
                <form action="add_comments.php" method="post" class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label for="comment">Commentaire:</label>
                        <textarea class="form-control" name="com_txt" rows="4" id="comment"></textarea>
                    </div>
                    <input type="hidden" name="com_reference" value="<?= htmlspecialchars($_GET['r']) ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="com_grade" value="5"/>
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="com_grade" value="4"/>
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="com_grade" value="3"/>
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="com_grade" value="2"/>
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="com_grade" value="1"/>
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-offset-4 btn-submit-comment">
                                <button type="submit" class="btn btn-default">Partager votre retour</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        }
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