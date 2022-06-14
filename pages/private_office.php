<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/ApartamentBill.php');
    session_start();
    if($_SESSION["user"]){
        if($_SESSION["user"]->get_housekeeper() == 1){
          require_once '../html/header_admin.html';
        }
        else {
          require_once '../html/header.html';
        }
    }
   
    $user = $_SESSION["user"];
?>
 <? 
    echo $user->get_user() ;  
    echo $user->get_bill($connection);  
 ?>
 <form class="form-signin d-grid gap-2" method="POST" action="../php/payment.php">
 <input type="number" min="0" name="balance" placeholder="Сумма внесення" class="form_control" required>
 <button type="submit" class="btn btn-primary btn-lg" >Внести</button>
 <?php
     if ($_SESSION['message']) {
         echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
     }
     unset($_SESSION['message']);
 ?>
</form>
<?php
    require_once "../html/footer.html"
?>