<?php

/*if(!isset($_POST['category']) OR empty($_POST['category']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}*/

include ('../../../includes/bdd.php');

$category = 1; //$_POST['category'];

$map = array();

$sql = 'SELECT id FROM reference WHERE category = "'.$category.'"';
$req = $bdd->query($sql);

while($res = $req->fetch())
{
    $id = $res['id'];
    $sql = 'SELECT COUNT(*) FROM product WHERE reference = '.$id;
    $count = $bdd->query($sql)->fetchColumn();
    $map[$id] = $count;
}

foreach($map as $key => $value)
{
    //get info
    $sql = 'SELECT * FROM reference WHERE id = '.$key;
    $reference = $bdd->query($sql)->fetch();

    $ref = $reference['ref_product'];
    $name = $reference['name'];
    $price = $reference['price'];

    //get first image
    $sql = 'SELECT src FROM image WHERE reference = '.$key;
    $src = $bdd->query($sql)->fetch()['src'];

    ?>

    <div>
        <img src="<?php echo $src ?>">
    </div>

    <?php
}

?>