<?php
$req_last_5_ref = $bdd->query('SELECT id, name FROM reference ORDER BY id ASC LIMIT 5');
$last_5_ref = $req_last_5_ref->fetchAll();
$last_5_ref_img = array();
foreach ($last_5_ref as $ref)
{
    $req_img = $bdd->prepare('SELECT src from image WHERE reference = ?');
    $req_img->execute(array($ref['id']));
    array_push($last_5_ref_img, $req_img->fetch()['src']);
}

?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <a href="product/?r=<?= $last_5_ref[0]['id'] ?>">
                <img src="<?= $last_5_ref_img[0] ?>" style="max-height: 400px; min-height: 400px; margin: auto">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h2 style="color: white; background-color: rgba(94, 94, 94, 0.7); padding : 10px; border-radius : 5px"><?= $last_5_ref[0]['name'] ?></h2 style="color: white; background-color: rgba(94, 94, 94, 0.7)"; padding : 10px; border-radius : 5px ></div>
                </a>
            </div>

            <div class="item">
                <a href="product/?r=<?= $last_5_ref[1]['id'] ?>">
                <img src="<?= $last_5_ref_img[1] ?>" style="max-height: 400px; min-height: 400px; margin: auto">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h2 style="color: white; background-color: rgba(94, 94, 94, 0.7); padding : 10px; border-radius : 5px"><?= $last_5_ref[1]['name'] ?></h2 style="color: white; background-color: rgba(94, 94, 94, 0.7)"; padding : 10px; border-radius : 5px ></div>
                </a>
            </div>

            <div class="item">
                <a href="product/?r=<?= $last_5_ref[2]['id'] ?>">
                <img src="<?= $last_5_ref_img[2] ?>" style="max-height: 400px; min-height: 400px; margin: auto">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h2 style="color: white; background-color: rgba(94, 94, 94, 0.7); padding : 10px; border-radius : 5px "><?= $last_5_ref[2]['name'] ?></h2 style="color: white; background-color: rgba(94, 94, 94, 0.7)"; padding : 10px; border-radius : 5px ></div>
                </a>
            </div>

            <div class="item">
                <a href="product/?r=<?= $last_5_ref[3]['id'] ?>">
                <img src="<?= $last_5_ref_img[3] ?>" style="max-height: 400px; min-height: 400px; margin: auto">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h2 style="color: white; background-color: rgba(94, 94, 94, 0.7); padding : 10px; border-radius : 5px"><?= $last_5_ref[3]['name'] ?></h2 style="color: white; background-color: rgba(94, 94, 94, 0.7)"; padding : 10px; border-radius : 5px ></div>
                </a>
            </div>

            <div class="item">
                <a href="product/?r=<?= $last_5_ref[4]['id'] ?>">
                <img src="<?= $last_5_ref_img[4] ?>" style="max-height: 400px; min-height: 400px; margin: auto">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <h2 style="color: white; background-color: rgba(94, 94, 94, 0.7); padding : 10px; border-radius : 5px"><?= $last_5_ref[4]['name'] ?></h2 style="color: white; background-color: rgba(94, 94, 94, 0.7)"; padding : 10px; border-radius : 5px ></div>
                </a>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php
?>