<?php
if(isset($_SESSION['id']) AND $_SESSION['id'] == 1)
{
    // ici code à faire si admin
}
else
{
    header("location: /");
}
?>