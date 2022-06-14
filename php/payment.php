<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/ApartamentBill.php');
    require_once('../src/GeneralBill.php');
    session_start();

    if(isset($_POST['balance'])){
        $apartament_id = $_SESSION['user']->get_apartament_id();
        $query = "SELECT `id`, `balance` FROM `apartaments_bills` WHERE `apartament_id` = '$apartament_id'";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        $bill_id = $row['id'];
        $sum = $_POST['balance'];
        $user_id = $_SESSION['user']->get_id($connection);
        $query = "INSERT INTO `made_payment`(`id`, `bill_id`, `date`, `service_id`, `sum`, `user_id`) VALUES (NULL,'$bill_id',NOW(),1,'$sum','$user_id')";
        $result = mysqli_query($connection,$query);
        $new_balance = $row['balance'] + $sum;
        $general_bill = GeneralBill::get_bill($connection);
        $general_bill->to_pay($connection,$sum);
        $query = "UPDATE `apartaments_bills` SET `balance` = `balance` + '$new_balance' WHERE `apartaments_bills`.`id` = '$bill_id'";
        $result = mysqli_query($connection,$query);
        if(!$result){
            die(mysqli_error($connection));
        }
        $_SESSION['message'] = 'Операція успішна';
        header('Location: ../pages/private_office.php');

    }
?>