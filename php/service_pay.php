<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/Service.php');
    require_once('../src/GeneralBill.php');
    session_start();
    if(isset($_POST['service'])){
        $servise_id = $_POST['service'];
        $service = Service::get_by_id($connection,$_POST['service']);
        $general_bill = GeneralBill::get_bill($connection);
        $cost = (int)$_POST['cost'];

        $balance = (int)$general_bill->balance;
        $boll = ($balance < $cost);
        var_dump($cost);
        var_dump($balance);
        var_dump($boll);
        if($boll){
            $_SESSION['pay_massage'] = "На рахунку недостатньо коштів !";
            header('Location: /pages/service_pay_form.php');
        }else{
            $general_bill->pay_bill($connection,$cost);
            $query = "INSERT INTO `general_payment`(`id`, `service_id`, `date`, `sum`) VALUES (NULL,'$servise_id',NOW(),'$cost')";
            $result = mysqli_query($connection,$query);
            if(!$result){
                die(mysqli_error($connection));
            }
            $_SESSION['pay_massage'] = "Операція успішна !";
            header('Location: /pages/service_pay_form.php');
        }

    }