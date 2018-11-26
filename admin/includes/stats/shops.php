<?php

if(!isset($_POST['shop']) OR empty($_POST['shop']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

include ('../../../includes/bdd.php');
include ("../../../includes/style.php");

$shop_id = $_POST['shop'];

?>
<div style="text-align: center">
    <h3>Shop : <?= $shop_id ?></h3>
</div>
<div style="display: flex; text-align: center; justify-content: center; align-items: center;">
<?php

$map = array();

$sql = 'SELECT * FROM stock WHERE shop = "'.$shop_id.'"';
$stock = $bdd->query($sql);

while($data = $stock->fetch())
{
    $reference = $data['reference'];
    $sql = 'SELECT COUNT(*) FROM product WHERE reference = '.$reference;
    $count = $bdd->query($sql)->fetchColumn();
    $map[$reference] = $count;
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

    <a href="/product/?r=<?= $key?>">
        <img style="max-height: 250px;" src="<?= $src ?>">
        <h4><?= $name ?> : <?= $value ?> sold.</h4>
    </a>

    <?php
}

?>

</div>
