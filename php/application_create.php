<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/Poll.php');
    session_start();
    if(isset($_POST['subject'])&& isset ($_POST['description'])){
    $poll = new Poll($_POST['subject'],$_POST['description']);
    $options = array();
    for ($i=0; $i <= $_SESSION['number']; $i++) { 
        $str = 'option'.$i;
        $options[$i] = $_POST[$str];
    }
    $poll->incert_into_db($connection, $options);
    header('Location: /pages/application_form.php');
    }
?>