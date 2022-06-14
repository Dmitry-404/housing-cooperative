<?php
    session_start();
    if($_SESSION["user"]){

        header('Location: ../pages/private_office.php');
      }
    header('Location: ../pages/authorization.php');

?>