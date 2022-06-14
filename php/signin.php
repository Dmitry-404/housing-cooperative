<?php
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    session_start();


  if(isset($_POST['password'])&& isset($_POST['email'])){
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $query = "SELECT * FROM `users` WHERE  `password` = '$password' AND `email` = '$email'";

      $result = mysqli_query($connection,$query);
      if(mysqli_num_rows($result) > 0){ 
            $row = mysqli_fetch_assoc($result);
            $apartament = new Apartament(Apartament::get_sql_num($connection,$row['apartament']),$row['apartament']);
            $user = new User($row['fullname'], $row['password'], $row['email'], $row['phone'],$apartament, $row['housekeeper']);
            $_SESSION["user"] = $user;
            header('Location: /pages/private_office.php');
            
      }else
      {
          $_SESSION["massage"] = "Користувач не знайден, будь ласка зареєструйтесь!";
          exit("<meta http-equiv='refresh' content='0; url=../pages/authorization.php'>");
      }
  }
?>
