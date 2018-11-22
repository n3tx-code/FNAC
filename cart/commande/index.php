<?php
session_start();
if(!isset($_SESSION['cart']) OR empty($_SESSION['cart']) OR !isset($_SESSION['shop']) OR empty($_SESSION['shop']))
{
    header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=true');
    exit();
}

include('../../includes/bdd.php');

// calcul prix total avec promo
$total_price = 0;
foreach ($_SESSION['cart'] as $key => $ref) {
    $ref_price = 0;
    $req_ref_info = $bdd->prepare('SELECT * FROM reference WHERE id = ? ');
    $req_ref_info->execute(array($key));
    $ref_info = $req_ref_info->fetch();
    $ref_price = $ref_info['price'];

    $req_promo = $bdd->prepare('SELECT percentage FROM promo WHERE reference = ?');
    $req_promo->execute(array($key));
    $promo_ref = $req_promo->fetchColumn();
    if($promo_ref)
    {
        $ref_price = $ref_price - (($ref_price / 100) * $promo_ref );
    }
    $total_price += ($ref_price * $_SESSION['cart'][$key]);
}

$sql = 'INSERT INTO command(client, price) VALUES(:client, :price)';
$req = $bdd->prepare($sql);
$req->execute(array(
    'client' => $_SESSION['ID'],
    'price' => $total_price
));

$req_command = $bdd->prepare('SELECT id FROM command WHERE client = ? ORDER BY add_date DESC');
$req_command->execute(array($_SESSION['ID']));
$command = intval($req_command->fetchColumn());

try {
    $bdd->beginTransaction();

    foreach ($_SESSION['cart'] as $key => $ref) {
        $shop = $_SESSION['shop'][$key];
        for($i = 0; $i < $_SESSION['cart'][$key]; $i++)
        {
            $req = $bdd->prepare('INSERT INTO product(reference, command, shop) VALUES(?, ?, ?)');
            $req->execute(array($key,
                $command,
                $shop));

        }
    }
    $bdd->commit();
}

catch (Exception $ex)
{
    $bdd->rollBack();

    // supression produit
    $req_del_product = $bdd->prepare('DELETE FROM product WHERE command = ?');
    $req_del_product->execute(array($command));

    // suppresion commande
    $sql = 'DELETE FROM command WHERE id = :id';
    $req_del_command = $bdd->prepare($sql);
    $req_del_command->execute(array(
       'id' => $command
    ));
    //header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=true');
    exit();
}
    $_SESSION['cart'] = array();
    header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=false');
?>