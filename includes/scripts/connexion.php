<?php

    if(!empty($_POST['email']) OR !empty($_POST['mdp']))
    {
        include ("../../includes/bdd.php");
        $mailconnect = htmlspecialchars($_POST['email']);
        $mdpconnect = sha1(htmlspecialchars($_POST['mdp']));
        $requser = $bdd->prepare("SELECT * FROM client WHERE mail = ? AND password = ?");
        $requser-> execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            /* récupération des données de l'utilisateur qui vient de se connecter */
            $userinfo = $requser->fetch();
            $_SESSION['ID'] = $userinfo['id'];
            $_SESSION['name'] = $userinfo['name'];
            $_SESSION['first_name'] = $userinfo['first_name'];
            $_SESSION['cart'] = array();

            header("Location: ../");
        }
        else
        {
            $erreur_connexion = "Mauvais mail ou mauvais mot de passe !";
        }
    }
    else
    {
        $erreur_connexion = "Tout les champs doivent être complétés !";
    }


?>