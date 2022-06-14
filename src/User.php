<?php
    class User{
        private $fullname, $email, $password, $phone, $apartament, $housekeeper;

        function __construct( $fullname, $password, $email, $phone, $apartament, $housekeeper = 0){
            $this->fullname = $fullname;
            $this->password =$password;
            $this->email = $email;
            $this->phone = $phone;
            $this->apartament = $apartament;
            $this->housekeeper = (int) $housekeeper;
        }

        function get_id($connection){
            $query = "SELECT `id` FROM `users` WHERE `fullname` = '$this->fullname' AND `email` = '$this->email'";
            $result= mysqli_query($connection,$query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                return $row['id'];
            }
        }
        function get_name(){
            return $this->fullname;
        }
        function get_password(){
            return $this->password;
        }
        function get_email(){
            return $this->email;
        }
        function get_phone(){
            return $this->phone;
        }
        function get_apartament(){
            return $this->apartament->get_number();
        }
        function get_apartament_id(){
            return $this->apartament->get_id();
        }
        function get_housekeeper(){
           return $this->housekeeper;
        }

        function vote($application, $vote){
            array_push($application->votes, $vote);
        }
        
        function pay($general_bill, $sum, $date){
            $this->apartament->apartment_bill->add_payment($sum, $date);
            $general_bill->balance += $sum;
        }

        function is_exist($connection){
            $query = "SELECT * FROM `users` WHERE `password` = '$this->password' OR `email` = '$this->email'";
            $result = mysqli_query($connection, $query);
            return mysqli_num_rows($result);
        }

        private function check_apartament($connection, $apartament){
            $number = $apartament->get_number();
            $query = "SELECT * FROM `apartaments` WHERE `number` = '$number'";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) == 0){ 
                $apartament->insert_into_db($connection);
                $apartament_id = mysqli_insert_id($connection);
                $apartament_bill = new ApartamentBill(Null,$apartament_id,0);
                $apartament_bill->insert_into_db($connection);
                return $apartament_id;
            }
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
        function get_user(){
            
            echo '<form class="form-signin d-grid gap-2">
            <div class="card text-center" style="width: 20rem;">
            <ul class="list-group list-group-flush">';
            echo'<li class="list-group-item">ПІБ : '.$this->get_name().'</li>';
            echo'<li class="list-group-item">Пошта : '.$this->get_email().'</li>';
            echo'<li class="list-group-item">Номер телефону : '.$this->get_phone().'</li>';
            echo'<li class="list-group-item">Номер квартири : '.$this->get_apartament().'</li>';
            
        }
        function insert_into_db($connection){
            $id = $this->check_apartament($connection, $this->apartament);
            $query = "INSERT INTO `users`(`id`, `fullname`, `password`, `email`, `phone`, `apartament`, `housekeeper`) VALUES (NULL, '$this->fullname', '$this->password', '$this->email', '$this->phone', '$id', '$this->housekeeper')"; 
            $result = mysqli_query($connection, $query);
            
        }
        function get_bill($connection){
            $apartament_id = $this->apartament->get_id();
            $query = "SELECT `id` FROM `apartaments_bills` WHERE `apartament_id` = '$apartament_id'";
            $result = mysqli_query($connection,$query);
            if(!$result){
                die(mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($result);
            $bill_id = $row['id'];
            $now_month_first_date = date('Y-m-01');
            $now_month_last_date = date('Y-m-d',strtotime(date('Y-m-1',strtotime('next month')).'-1 day'));
            $query = "SELECT `sum` FROM `made_payment` WHERE `bill_id` = '$bill_id' AND `date` BETWEEN '$now_month_first_date' AND '$now_month_last_date'";
            $result = mysqli_query($connection,$query);
            $made_payment = 0;
            while($row = mysqli_fetch_assoc($result)){
                $made_payment = $made_payment + $row['sum'];
            }
                echo '<li class="list-group-item"> Внесено за поточний місяць: '.$made_payment.'</li>';
                echo '</ul></div></form>';
        }
    }
?>