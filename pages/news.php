<?php
    require_once('../src/News.php');
    require_once('../src/autoload.php');
    session_start();
    require_once('../php/header.php');
?>
<?php 
  News::get_News($connection);
?>
<?php require_once "../html/footer.html" ?>