<?php
class Poll{
    private $subject, $description;
    
    public function __construct($subject, $description){
        $this->subject = $subject; 
        $this->description = $description;
    }
    function get_id($connection){
        $query = "SELECT `id` FROM `polls` WHERE `subject` = '$this->subject' AND `description` = '$this->description'";
        $result= mysqli_query($connection,$query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
        else{
            echo "немає";
        }
    }
    function get_subject(){
        return $this->subject;
    }

    function get_description(){
        return $this->description;
    }

    static private function getOptions($connection,$poll_id){
        $query = "SELECT * FROM `poll_options` WHERE `poll_id` = '$poll_id'";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) { 
                echo '<input type="radio" value="'.$row['name'].'" name ="'.$poll_id.'" class="form-check-input" > '.$row['name'].'<br>';
            }
        }
    }
    static function get_votes($connection,$poll_id){
        $votes = array();
        $query = "SELECT * FROM `poll_options` WHERE `poll_id` = '$poll_id'";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) { 
                $votes[$row['name']] = 0;
            }
            foreach($votes as $key=>$value){
                $option_id = POLL::get_option_id($connection,$key,$poll_id);
                $query = "SELECT * FROM `poll_votes` WHERE `poll_option_id` = '$option_id' AND `poll_id` = '$poll_id'";
                $result = mysqli_query($connection,$query);
                $value = mysqli_num_rows($result);
                echo '<p class="card-text">За пункт '.$key.' проголосувало '.$value.'</p>';
            }
        }
        

    }
    static function drawPolls($connection,$user){
        $is_vote = false;
        $query = "SELECT * FROM `polls` ORDER BY `id` DESC";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="row row-cols-1 row-cols-md-3 g-4" style = "margin:10px" align = "center">';
           while ($row = mysqli_fetch_assoc($result)) { 
                echo '<form class="form-signin d-grid gap-2 myclass" method="POST" action="../php/vote.php">
                        <div class="col">
                        <div class="card" style="width: 20rem; margin-bottom: 50px;"><div class ="card-body">
                        <h5 class="card-title">'.$row['subject'].'</h5>
                        <p class="card-text">'.$row['description'].'</p>';
                if(!is_user_vote($connection,$user,$row['id'])){
                        POLL::getOptions($connection, $row['id'],$row['subject'],$row['description']);
                        echo  '<button type="submit" class="btn btn-primary btn-lg"  >Проголосувати</button>';
                }
                POLL::get_votes($connection,$row['id']);
            echo '</div></div>
            </form>
            </div>
            <br>';
             }
        }
    }
    
   public function incert_into_db($connection, array $options)
   {
    $query = "INSERT INTO `polls`(`id`, `subject`, `description`, `created`) VALUES (NULL,'$this->subject','$this->description',NOW())";
    $result = mysqli_query($connection, $query);
    $get_id_query = "SELECT `id` FROM `polls` WHERE `subject` = '$this->subject' AND `description` = '$this->description'";
    $get_id = mysqli_query($connection,$get_id_query);
    $row = mysqli_fetch_assoc($get_id);
    $id = $row['id'];
    $counter = count($options);
    for ($i = 1; $i < $counter; $i++) { 
        $option = $options[$i];
        $options_query = "INSERT INTO `poll_options`(`id`,`poll_id`, `name` ) VALUES (NULL,'$id','$option')";
        $options_result = mysqli_query($connection,$options_query);
        if (!$options_result) {
            die(mysqli_error($connection));
        }
    }
    
   }
   public static function get_option_id($connection,$vote,$poll_id){
    $query = "SELECT `id` FROM `poll_options` WHERE `poll_id` = '$poll_id' AND `name` = '$vote'";
    $result= mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    }
   }
   public static function get_poll($connection,$id){
    $query = "SELECT `subject`,`description` FROM `polls` WHERE `id` = '$id'";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $poll = new Poll($row['subject'],$row['description']);
        var_dump($poll);
        return $poll;
    }
   }
   public function vote($connection,$vote,$user){
    $user_id = $user->get_id($connection);
    $poll_id = (int)$this->get_id($connection);
    $vote_id = (int)Poll::get_option_id($connection,$vote,$poll_id);
    $query = "INSERT INTO `poll_votes`(`id`, `poll_id`, `poll_option_id`, `user_id`) VALUES (NULL,'$poll_id','$vote_id','$user_id')";
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die(mysqli_error($connection));
    }
    }
}
function is_user_vote($connection,$user,$poll_id)
{
    
    $user_id = $user->get_id($connection);
    $query = "SELECT * FROM `poll_votes` WHERE `user_id` = '$user_id' AND `poll_id` = '$poll_id'";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}