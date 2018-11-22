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
    // detecter si parent
    $req_parent = $bdd->prepare("SELECT parent FROM category WHERE id = ?");
    $req_parent->execute(array(htmlspecialchars($_GET['c'])));
    $parent = $req_parent->fetch()['parent'];
    $ref = [];
    if($parent == null)
    {


        // récupère référence de la catégorie parente
        $req_ref_main_cat = $bdd->prepare("SELECT * FROM reference WHERE category = ?");
        $req_ref_main_cat->execute(array(htmlspecialchars($_GET['c'])));
        while ($ref_main = $req_ref_main_cat->fetch())
        {
            array_push($ref, $ref_main);
        }

        // récupération références des sous catégories
        $req_all_sub_cat = $bdd->prepare('SELECT id FROM category WHERE parent = ?');
        $req_all_sub_cat->execute(array(htmlspecialchars($_GET['c'])));

        while ($sub_cat = $req_all_sub_cat->fetch()['id'])
        {
            $req_ref_cat = $bdd->prepare("SELECT * FROM reference WHERE category = ?");
            $req_ref_cat->execute(array($sub_cat));
            while ($ref_cat = $req_ref_cat->fetch())
            {
                array_push($ref, $ref_cat);
            }
        }

    }
    else
    {
        $req_ref_cat = $bdd->prepare("SELECT * FROM reference WHERE category = ?");
        $req_ref_cat->execute(array(htmlspecialchars($_GET['c'])));
        while($ref_cat = $req_ref_cat->fetch())
        {
            array_push($ref, $ref_cat);
        }
    }

    ?>
    <div class="row">
    <?php
        foreach ($ref as &$r)
        {
            ?>
            <a href="/product/?r=<?= $r['id'] ?>">
                <div class="col-md-4 reference">
                    <?php
                        $src = "http://ijbw.be/wordpress/wp-content/uploads/2017/02/photo-manquante-1024x484.png";
                        $req_img_ref = $bdd->prepare('SELECT src FROM image WHERE reference = ?');
                        $req_img_ref->execute(array($r['id']));
                        $img_ref = $req_img_ref->fetch();
                        if (!empty($img_ref))
                        {

                            $src = $img_ref['src'];
                        }
                        ?>
                        <img src="<?= $src ?>"
                             class="img-responsive">
                        <a href="/product/?r=<?= $r['id'] ?>"><h3 class="text-center"><?= $r['name'] ?></h3></a>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p><?= $r['description'] ?></p>
                            </div>
                        </div>
                        <div class="ref_price">
                            <?= $r['price'] ?> <i class="fas fa-euro-sign"></i>
                        </div>
                        <div class="ref_note">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                </div>
            </a>
            <?php
        }
    ?>
    </div>
    <?php
    include("../includes/templates/footer.php");
    ?>
    </div>
</div>
</body>
</html>