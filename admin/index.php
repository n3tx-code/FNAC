<?php

session_start();

if(!isset($_SESSION['']) OR empty($_SESSION[''])) //show admin login
{
    include('../login/index.php');
}
else
{

}

?>