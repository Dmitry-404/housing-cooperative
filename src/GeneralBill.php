<?php
    class GeneralBill{
        public $balance;

        function __construct($balance){
            
            $this-> balance = $balance;
        }

        static function get_bill($connection){
            $query = "SELECT `balance` FROM `general_bill` WHERE `id` = '1'";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                $bill = new GeneralBill($row['balance']);
                return $bill;
            }
        }
        public function pay_bill($connection,$summ)
        {
            $this->balance = $this->balance - $summ;
            $query = "UPDATE `general_bill` SET `balance`='$this->balance' WHERE `id` = '1'";
            $result = mysqli_query($connection,$query);
            if(!$result){
                die(mysqli_error($connection));
            }
        }
        public function to_pay($connection,$summ){
            $this->balance = $this->balance + $summ;
            $query = "UPDATE `general_bill` SET `balance`='$this->balance' WHERE `id` = '1'";
            $result = mysqli_query($connection,$query);
            if(!$result){
                die(mysqli_error($connection));
            }
        }
        public function draw_bill()
        {
            echo '<form class="form-signin d-grid gap-2">
            <div class="card text-center" style="width: 20rem;">
            <ul class="list-group list-group-flush">';
            echo '<li class="list-group-item">Баланс генерального рахунку : '.$this->balance.'</li>';
            echo '</ul></div></form>';
        }
        static function draw_made_payment($connection){
            $query = "SELECT * FROM `general_payment`  ORDER BY `id` DESC";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $servise = Service::get_by_id($connection,$row['service_id']);
                    echo '<tr>';
                    echo '<th scope="row">'.$row['id'].'</th>';
                    echo'<td>'.$servise->get_service().'</td>';
                    echo'<td>'.$row['sum'].'</td>';
                    echo'<td>'.$row['date'].'</td>';
                    echo '</tr>';
                }
            }
        }
    }
?>