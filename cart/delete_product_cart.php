<?php
    session_start();

    if(isset($_GET['r']) AND !empty($_GET['r']))
    {
        unset($_SESSION['cart'][htmlspecialchars($_GET['r'])]);
        header("Location:". $_SERVER['HTTP_REFERER']);
    }
    else
    {
        header("Location:". $_SERVER['HTTP_REFERER']);
    }
?>