<?php
 require_once('../src/connect.php');
 require_once('../src/Apartament.php');
 require_once('../src/User.php');
 session_start();

 if(isset($_POST['email'])){
    $email = $_POST['email'];
    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0){ 
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $query = "UPDATE `users` SET `housekeeper` = '1' WHERE `users`.`id` = '$id'";
        $_SESSION["massage"] = "Домоправителя успішно створено!";
        header('Location: /pages/add_housekeeper.php');
    }else{
        $_SESSION["massage"] = "Користувач не знайден!";
        header('Location: /pages/add_housekeeper.php');
    }
    
    
 }
?>