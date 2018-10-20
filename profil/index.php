<?php
    if (isset($_SESSION['ID']))
    {
        // todo afficher profil
    }
    else
    {
        header('Location: login/');
    }

?>