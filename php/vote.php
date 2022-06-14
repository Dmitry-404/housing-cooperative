<?
    require_once('../src/Poll.php');
    require_once('../src/User.php');
    require_once('../src/connect.php');
    session_start();
    $key;
    foreach($_POST as $k=>$v)
    {
        $key=$k;
    }
   $option = $_POST[$key];
    echo $key;
   $poll = Poll::get_poll($connection,$key);
   var_dump($poll);
   $poll->vote($connection,$option,$_SESSION['user']);
   header('Location: ../pages/application.php');
   
?>