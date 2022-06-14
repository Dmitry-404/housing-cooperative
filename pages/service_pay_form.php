<?
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/ApartamentBill.php');
    require_once('../src/Service.php');
    require_once('../src/GeneralBill.php');
    session_start();
    if($_SESSION["user"]){
        if($_SESSION["user"]->get_housekeeper() == 1){
          require_once '../html/header_admin.html';
        }
        else {
          require_once '../html/header.html';
        }
    }
   $bill =  GeneralBill::get_bill($connection);
   $bill->draw_bill();
?>
<form class="form-signin d-grid gap-2" method="POST" action="../php/service_create.php">
 <input type="text" name="service" placeholder="Створити  послугу" class="form_control" required>
 <button type="submit" class="btn btn-primary btn-lg" >Створити</button>
 <?php
     if ($_SESSION['service_create_message']) {
         echo '<p class="msg"> ' . $_SESSION['service_create_message'] . ' </p>';
     }
     unset($_SESSION['service_create_message']);
 ?>
</form>
<form class="form-signin d-grid gap-2" method="POST" action="../php/service_pay.php">
 <?Service::draw_service($connection)?>
 <input type="number" min ="0" name="cost" placeholder="Ціна послуги" class="form_control" required>
 <button type="submit" class="btn btn-primary btn-lg" >Внести</button>
 <?php
     if ($_SESSION['pay_massage']) {
         echo '<p class="msg"> ' . $_SESSION['pay_massage'] . ' </p>';
     }
     unset($_SESSION['pay_massage']);
 ?>
</form>
<?php
    require_once "../html/footer.html"
?>