<?php
    if(isset($_SESSION['id']))
    {
        // recommandation selon achat
    }
    else
    {
        $req_random_ref = $bdd->query('SELECT * FROM reference ORDER BY RAND() LIMIT 4;');
        ?>
        <h3 class="text-center" style="margin: 40px">Recommandations</h3>
        <div class="row">
        <?php
        while($ref = $req_random_ref->fetch())
        {
            $req_img_ref = $bdd->prepare('SELECT src FROM image WHERE reference = ?');
            $req_img_ref->execute(array($ref['id']));
            $ref_img = $req_img_ref->fetch();
            ?>
            <a href="product/?r=<?= $ref['id'] ?>">
                <div class="col-md-3">
                    <img src="<?= $ref_img['src'] ?>" class="img-responsive">
                    <h5 class="text-center"><?= $ref['name'] ?></h5>
                </div>
            </a>
            <?php
        }
    }
?>
        </div>
