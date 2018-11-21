<?php

include('bdd.php');

if(isset($_GET['search']) AND !empty($_GET['search']))
{
    $search = htmlspecialchars($_GET['search']);

    $sql = "SELECT id, name FROM reference WHERE name LIKE '%$search%' LIMIT 4";

    $req = $bdd->prepare($sql);
    $req->execute();

    while($res = $req->fetch())
    {
        $id = $res['id'];
        $name = $res['name'];
        $src = "http://ijbw.be/wordpress/wp-content/uploads/2017/02/photo-manquante-1024x484.png";

        $req_img_ref = $bdd->prepare('SELECT src FROM image WHERE reference = ?');
        $req_img_ref->execute(array($id));
        $img_ref = $req_img_ref->fetch();

        if (!empty($img_ref))
        {
            $src = $img_ref['src'];
        }

        ?>

        <a href="/product/?r=<?= $id ?>">
            <img src="<?= $src ?>">
            <h4><?= $name ?></h4>
        </a>

        <?php
    }
}

?>