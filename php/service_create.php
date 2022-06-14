<?php 
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/Service.php');
    session_start();
    if(Service::check_service($connection,$_POST['service'])){
        $service = new Service($_POST['service']);
        if($service->insert_into_db($connection)){
            $_SESSION['service_create_message'] = "Послугу створено !";
        }
        header('Location: /pages/service_pay_form.php');
    }else{
        $_SESSION['service_create_message'] = "Подібна послуга вже існує!";
    }

?>