<?php
    class ApartamentBill{
        private $id,$apartament_id, $balance;

        function __construct($apartament_id, $balance,$id = NULL){
            $this->id = $id;
            $this->apartament_id = $apartament_id;
            $this->$balance = $balance;
        }

        function get_apartament(){
            return $this->apartament_id;
        }   

        function get_balance(){
            return $this->made_payment;
        }

        function insert_into_db($connection){
            $query = "INSERT INTO `apartaments_bills`(`id`, `apartament_id`, `balance`) VALUES (Null ,'$this->apartament_id','$this->balance')"; 
            $result = mysqli_query($connection, $query);
        }
    }
?>