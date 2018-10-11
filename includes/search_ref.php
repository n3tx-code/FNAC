<?php

include('bdd.php');

if(isset($_POST['search']) AND !empty($_POST['search']))
{
    $search = $_POST['search'];

    $sql = "SELECT id, name FROM reference WHERE name LIKE '%$search%'";

    $req = $bdd->prepare($sql);
    $req->execute();

    while($res = $req->fetch())
    {
        echo "<li>".$res['id']." : ".$res['name']."</li>";
    }
}

?>