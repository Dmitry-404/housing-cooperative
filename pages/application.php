<?php
    require_once('../src/autoload.php');
    require_once('../src/User.php');
    session_start();
    require_once('../php/header.php');
?>
<div class="container">
    <?php Poll::drawPolls($connection,$_SESSION['user']) ?>
</div>
<?php

require_once "../html/footer.html"
?>