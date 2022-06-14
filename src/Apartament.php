<?php
    class Apartament{
        private $id, $number;

        function __construct($number, $id = NULL){
            $this->id = $id;
            $this->number = $number;
        }
        function get_id(){
            return $this->id;
        }
        function get_number(){
            return $this->number;
        }
        static function get_sql_num($connection,$id){
            $query = "SELECT `number` FROM `apartaments` WHERE `id` = '$id'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die(printf("error: %s\n", mysqli_error($connection)));
            }
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                return (int)$row['number'];
            }
        }
        function insert_into_db($connection){
            $query = "INSERT INTO `apartaments`(`id`, `number`) VALUES (NULL,'$this->number')"; 
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die(printf("error: %s\n", mysqli_error($connection)));
            }
        }
       
    }
    
?>