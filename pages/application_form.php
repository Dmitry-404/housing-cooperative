<?php
    require_once('../src/autoload.php');
    session_start();
    require_once('../php/header.php');
?>
 <form class="form-signin d-grid gap-2" method="POST" action=" ">
    <input type="number" min="2" name="options" placeholder="Кількість варіантів" class="form_control" required>
    <button type="submit" class="btn btn-primary btn-lg"  >Створити форму</button>
   <? if ($_SESSION['options']) {
                echo '<p class="msg"> ' . var_dump($_SESSION['options']) . ' </p>';
            }
            unset($_SESSION['options']); 
    ?>
 </form>
<?php
    if(isset($_POST['options'])){
        $number = $_POST['options'];
        $_SESSION['number'] = $_POST['options'];
        
?>
 <form class="form-signin d-grid gap-2" method="POST" action="../php/application_create.php">
    <input type="text" name="subject" placeholder="Тема заяви" class="form_control" required>
    <input type="text" name="description" placeholder="Опис" class="form_control" required>
    <?
        for ($i=1; $i <= $number; $i++) { 
           echo '<input type="text" name="option'.$i.'" placeholder= "Питання '.$i.'" class="form_control" required>';
        }
    ?>
    <button type="submit" class="btn btn-primary btn-lg"  >Створити заяву</button>
   <? if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']); 
    ?>
 </form>
<?
    }
?>
<?php
    require_once "../html/footer.html"
?>