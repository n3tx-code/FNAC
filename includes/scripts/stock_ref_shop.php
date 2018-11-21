<?php
    if(isset($_GET['s']) AND isset($_GET['r']))
    {
        include("../bdd.php");
        $shop = htmlspecialchars($_GET['s']);
        $ref = htmlspecialchars($_GET['r']);
        $req_stock = $bdd->prepare('SELECT quantity FROM stock WHERE reference = ? AND shop = ?');
        $req_stock->execute(array($ref, $shop));
        $stock = $req_stock->fetchColumn();

        echo $stock;
    }
    else
    {
        echo "error";
    }
?>