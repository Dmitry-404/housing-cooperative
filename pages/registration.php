<?php
  require_once('../src/connect.php');
  require_once('../src/User.php');
  session_start();
  if($_SESSION["user"]){
    header('Location: /pages/private_office.php');
  }

?>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" initial-scale="header_link"/>
        <meta name="keywords" content="Інформаційна система ОСББ"/>
        <title>Інформаційна система ОСББ</title>

        <link rel="shortcut icon" href="../img/favicon.png" type="image/png" />
        <link href="../css/header.css" rel="stylesheet" />
        <link href="../css/footer.css" rel="stylesheet" />
        <link href="../css/form.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
          <form class="form-signin d-grid gap-2" method="POST" action="../php/signup.php">
            <input type="text" name="name" placeholder="Fullname" class="form_control" required>
            <input type="password" name="password" placeholder="User password" class="form_control" required>
            <input type="text" name="email" placeholder="User email" class="form_control" required>
            <input type="text" name="phone" placeholder="User phone" class="form_control" required>
            <input type="text" name="apartament" placeholder="User apartament" class="form_control" required>
            <button type="submit" class="btn btn-primary btn-lg"  >Регістрація</button>
            <a href="authorization.php" class="btn btn-primary btn-lg">Авторизація</a>
            <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
          </form>
        </div>
        </body>
</html>