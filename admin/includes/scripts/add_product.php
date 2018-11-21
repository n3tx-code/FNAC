<?php
include('../../../includes/bdd.php');

$name = htmlspecialchars($_POST['product_name']);
$ref_product = htmlspecialchars($_POST['product_ref']);
$partner = (isset($_POST['product_partner']) AND !empty($_POST['product_partner'])) ? $_POST['product_partner'] : null;
$category = htmlspecialchars($_POST['product_cat']);
$description = htmlspecialchars($_POST['product_description']);
$price = intval((htmlspecialchars($_POST['product_price'])));
$files = $_FILES['product_img'];

$bdd->beginTransaction();

$sql = 'INSERT INTO reference(category, partner, ref_product, name, description, price)
VALUES(:category, :partner, :ref_product, :name, :description, :price)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'category' => $category,
    'partner' => $partner,
    'ref_product' => $ref_product,
    'name' => $name,
    'description' => $description,
    'price' => $price
));

$sql = 'SELECT id FROM reference WHERE category = :category AND ref_product = :ref_product 
AND name = :name AND description = :description AND price = :price';

$req = $bdd->prepare($sql);
$req->execute(array(
    'category' => $category,
    'ref_product' => $ref_product,
    'name' => $name,
    'description' => $description,
    'price' => $price
));

$reference = $req->fetch()['id'];
$ts = time();

for($i = 0; $i < count($files['name']); $i++)
{
    $filename = $files['name'][$i];
    $tmp_name = $files['tmp_name'][$i];

    $path = "/img/uploads/".$ts."_".$filename;
    $offset = "../../..";
    if(is_array(getimagesize($tmp_name)) AND move_uploaded_file($tmp_name, $offset.$path))
    {
        $sql = 'INSERT INTO image(reference, src) VALUES(:reference, :src)';

        $req = $bdd->prepare($sql);
        $req->execute(array(
            'reference' => $reference,
            'src' => $path
        ));
    }
    else
    {
        $bdd->rollBack();
        header("Location: /admin/?type=product&error=img&name=" . $filename);
        exit();
    }
}

$bdd->commit();

header("Location: /admin/?type=product&error=false&name=" . $name);

?>