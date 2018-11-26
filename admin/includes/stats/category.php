<?php

if(!isset($_POST['category']) OR empty($_POST['category']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

include ('../../../includes/bdd.php');
include ("../../../includes/style.php");

$category = $_POST['category'];

$sql = $sql = 'SELECT name FROM category WHERE id = "'.$category.'"';
$req = $bdd->query($sql);
$categoryName = $req->fetch()['name'];

?>
<div style="text-align: center">
    <h3>Category : <?= $categoryName ?></h3>
</div>
<div style="display: flex; text-align: center; justify-content: center; align-items: center;">
<?php

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

    <a href="/product/?r=<?= $key?>">
        <img style="max-height: 250px;" src="<?= $src ?>">
        <h4><?= $name ?> : <?= $value ?> sold.</h4>
    </a>

    <?php
}

?>

</div>
