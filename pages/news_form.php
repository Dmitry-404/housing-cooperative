<?php
    require_once('../src/autoload.php');
    session_start();
    require_once('../php/header.php');
?>
<div class="container">
          <form class="form-signin d-grid gap-2" method="POST" action="../php/news_create.php">
            <input type="text" name="title" placeholder="Заголовок" class="form_control" required>
            <input type="text" name="description" placeholder="Короткий опис" class="form_control" required>
            <textarea  type="text" rows="5" cols="25" name="text" placeholder="Текст" class="form_control" required></textarea>
            <button type="submit" class="btn btn-primary btn-lg"  >Додати новину</button>
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