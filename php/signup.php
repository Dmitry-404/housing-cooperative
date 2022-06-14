<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    session_start();


    if(isset($_POST['email']) && isset($_POST['password'])){
        $apartament = new Apartament($_POST['apartament']);
        $user = new User($_POST['name'],md5($_POST['password']), $_POST['email'], $_POST['phone'], $apartament);     
        if($user->is_exist($connection) == 0){
            $user->insert_into_db($connection);
            $_SESSION['message'] ='Реєстрація пройшла успішно!';
            header('Location: ../index.php');
        }else{
            $_SESSION['message'] ='Користувач вже зареєстрований!';
            header('Location: ../pages/registration.php');
        }
    }
