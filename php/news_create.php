<?php
    require_once('../src/connect.php');
    require_once('../src/News.php');
    session_start();



    if(isset($_POST['title']) && isset($_POST['text'])){
        $news = new News($_POST['title'],$_POST['description'], $_POST['text']);
       $news->insert_into_db($connection);
       $_SESSION['message'] = 'Новина створена!';
           header('Location: ../pages/news_form.php');
      }