<?php
session_start();
    if (isset($_SESSION['ID']))
    {
        // todo afficher profil
        echo "si tu es sur cette page c'est que tu es connecté <a href=\"/logout.php\">Déconexion</a>";
    }
    else
    {
        header('Location: login/');
    }

?>