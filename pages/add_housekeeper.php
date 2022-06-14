<?php
    require_once('../src/autoload.php');
    session_start();
    require_once('../php/header.php');
?>
  <div class="container">
    <form class="form-signin d-grid gap-2" method="POST" action="../php/housekeeper_create.php">
      <input type="email" name="email" placeholder="User email" class="form_control" required>
      <button type="submit" class="btn btn-primary btn-lg"  >Додати домоправителя</button>
      <?php 
        if ($_SESSION['message']) {
          echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
      ?>
    </form>
  </div>
<?php
    require_once "../html/footer.html"
?>