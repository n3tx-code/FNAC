// test si user connected redirect to home

<?php

if($_POST['validation_form'])
{
    include("script_connexion.php");
}
else
{
    ?>
        formulaire en php

    <?php
}

// script_connexion.php

    test si envoie en post avec la variable de validation du form
