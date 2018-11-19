<?php

$req_parent_cat =  $bdd->query('SELECT id, name from category WHERE parent IS NULL ')
?>
<div class="header-navbar">
    <div class="row">
        <h1 class="site-title text-center">FNEC</h1><br>
        <h6 class="site-second-title text-center">Fédération Nationale Electroménager Cool</h6>
    </div>
    <div class="row">
        <div class="nav-logo col-md-1">
            <a href="/"><img src="/img/logo.png" class="img-responsive"></a>
        </div>
        <div class="col-md-7">
            <?php
            while($parent_cat = $req_parent_cat->fetch())
            {
                $req_number_child = $bdd->prepare('SELECT COUNT(id) from category WHERE parent = ?');
                $req_number_child->execute(array(intval($parent_cat['id'])));
                $number_child = $req_number_child->fetch()[0];
                if($number_child > 0) {
                    ?>
                    <div class="dropdown">
                        <a href="/c/?c=<?= $parent_cat['id'] ?>"><button class="dropbtn"><?= $parent_cat['name'] ?></button></a>
                        <div class="dropdown-content">
                    <?php
                    // find children categories
                    $req_child_cat = $bdd->prepare('SELECT id, name FROM category WHERE parent = ?');
                    $req_child_cat->execute(array(intval($parent_cat['id'])));
                    while ($child_cat = $req_child_cat->fetch())
                    {
                        ?>
                        <a href="/c/?c=<?= $child_cat['id'] ?>"><?= $child_cat['name'] ?></a>
                        <?php
                    }
                    ?>
                        </div>
                    </div>
                    <?php
                }

                else {
                ?>
                    <a href="/c/?c=<?= $parent_cat['id'] ?>"><button class="dropbtn"><?= $parent_cat['name'] ?></button></a>
                <?php

                }
            }
            ?>
        </div>
        <div class="nav-search col-md-3">
            <div class="input-group stylish-input-group">
                <input type="text" class="form-control"  placeholder="Recherche" >
                <span class="input-group-addon">
                    <button>
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
                <div class="nav-user col-md-4">
                    <a href="/profil/"><i class="fas fa-user-alt"></i></a>
                </div>
                <div class="nav-basket col-md-4">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>

        </div>
    </div>
</div>