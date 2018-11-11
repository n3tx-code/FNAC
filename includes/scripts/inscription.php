<?php
include ("../../includes/bdd.php");
$client = [];
$client ['fidelity_card'] = null; // sera modifié si le client a rentré une carte de fidélité
if(!empty($_POST['email1']) AND !empty($_POST['mdp1'])
    AND !empty($_POST['nom']) AND !empty($_POST['prenom'] AND !empty($_POST['tel']))
    AND !empty($_POST['nom-prenom']) AND !empty($_POST['n-rue']) AND !empty($_POST['rue']) AND !empty($_POST['CP']) AND !empty($_POST['ville'])
) {

    if ($_POST['email1'] == $_POST['email2']) {
        $client['mail'] = htmlspecialchars($_POST['email1']);

        if ($_POST['mdp1'] == $_POST['mdp2']) {
            $client['mdp'] = sha1(htmlspecialchars($_POST['mdp1']));

            $client['name'] = htmlspecialchars($_POST['nom']);
            $client['first_name'] = htmlspecialchars($_POST['prenom']);
            $client['phone'] = intval(htmlspecialchars($_POST['tel']));

            if (!empty($_POST['carte-fidelite'])) {
                $client['fidelity_card'] = $_POST['carte-fidelite'];
            }

            // création client
            $req_add_client = $bdd->prepare("INSERT INTO client
                (fidelity_card, name, first_name, phone, mail, password)
                VALUES(?, ?, ?, ?, ?, ?)");
            $req_add_client->execute(array($client['fidelity_card'], $client['name'], $client['first_name'],
                $client['phone'], $client['mail'], $client['mdp']));

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