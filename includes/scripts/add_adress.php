<?php
session_start();
if(isset($_POST['nom-prenom']) AND isset($_POST['n-rue']) AND isset($_POST['rue']) AND isset($_POST['CP'])
    AND isset($_POST['ville']) AND isset($_POST['titre']))
{
    include("../bdd.php");
    $nom_prenom = htmlspecialchars($_POST['nom-prenom']);
    $n_rue = htmlspecialchars($_POST['n-rue']);
    $rue = htmlspecialchars($_POST['rue']);
    $cp = htmlspecialchars($_POST['CP']);
    $ville = htmlspecialchars($_POST['ville']);
    $titre = htmlspecialchars($_POST['titre']);

    $add_adress = $bdd->prepare("INSERT INTO `address` (`client`, `number`, `street`, `city`, `zip_code`, `description`) VALUES
            (?,?,?,?,?,?);");
    $add_adress->execute(array($_SESSION['ID'], $n_rue, $rue, $ville, $cp, $titre));

    header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=false');
}
else
{
    header('location: ' . $_SERVER['HTTP_REFERER'] . '?error=true');
}
?>