<?php
session_start();
if(!isset($_SESSION['sess_user']))
{
    header("Location: index.php");
    exit;
}

if (isset($_GET['logout']))
{
   session_unset();
   session_destroy();
   header("Location: index.php");
   exit;
}

?><a href="index.php?logout=">Logga ut</a>