<?php
include ("../../includes/bdd.php");
$client = [];
if(!empty($_POST['email1']) AND !empty($_POST['mdp1'])
    AND !empty($_POST['nom']) AND !empty($_POST['prenom'] AND !empty($_POST['tel']))
    AND !empty($_POST['nom-prenom']) AND !empty($_POST['n-rue']) AND !empty($_POST['rue'])
    AND !empty($_POST['CP']) AND !empty($_POST['ville'])
) {

    if ($_POST['email1'] == $_POST['email2']) {
        $client['mail'] = htmlspecialchars($_POST['email1']);

        if ($_POST['mdp1'] == $_POST['mdp2']) {
            $client['mdp'] = sha1(htmlspecialchars($_POST['mdp1']));

            $client['name'] = htmlspecialchars($_POST['nom']);
            $client['first_name'] = htmlspecialchars($_POST['prenom']);
            $client['phone'] = htmlspecialchars($_POST['tel']);


            // création client
            $req_add_client = $bdd->prepare("INSERT INTO client
                (name, first_name, phone, mail, password)
                VALUES(?, ?, ?, ?, ?)");
            $req_add_client->execute(array($client['name'], $client['first_name'], $client['phone'], $client['mail'], $client['mdp']));

            # création adresse client #

            //récupération id du client créé
            $req_created_client = $bdd->prepare('SELECT id FROM client WHERE name = ? AND first_name = ? 
            AND phone = ? AND mail = ? AND password = ?');
            $req_created_client->execute(array($client['name'], $client['first_name'], $client['phone'], $client['mail'], $client['mdp']));
            $created_client = $req_created_client->fetchColumn();

            // ajout adresse
            $num = htmlspecialchars($_POST['n-rue']);
            $street = htmlspecialchars($_POST['rue']);
            $cp = htmlspecialchars($_POST['CP']);
            $city = ($_POST['ville']);

            $req_add_address = $bdd->prepare('INSERT INTO address(client, number, street, city, zip_code) 
            VALUES(?,?,?,?,?)');
            $req_add_address->execute(array($created_client, $num, $street, $city, $cp));


            $good_inscription = "Inscription réussite";

            // ajout adresse
            $address = [];



        } else {
            $erreur_inscripiption = "Mot de passe différents";
        }
    } else {
        $erreur_inscripiption = "Adresse mail différentes";
    }
}
else
{
    $erreur_inscripiption = "Merci de remplir tous les champs avec une astérisque";
}
?>