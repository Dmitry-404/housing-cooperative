<?php
    class Service{
        private $service;

        function __construct($service)
        {
            $this->service = $service;
        }
        public function get_service()
        {
            return $this->service;
        }
        public function get_cost()
        {
            return $this->cost;
        }
        function insert_into_db($connection){
            $query = "INSERT INTO `services`(`id`, `service`) VALUES (NULL,'$this->service')";
            $result = mysqli_query($connection,$query);
            if(!$result){
                echo $this->get_service();
                echo $this->get_cost();
                die(mysqli_error($connection));
            }
        }
        static function draw_service($connection)
        {
            $query = "SELECT * FROM `services` WHERE `id` != '1'";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)>0){
                echo'<select class="form-select" name="service">';
                while($row = mysqli_fetch_assoc($result)){
                    echo '<option value = "'.$row['id'].'">'.$row['service'].'</option>';
                }
                echo'</select>';
            }
        }
        static function get_by_id($connection,$id){
            $query = "SELECT * FROM `services` WHERE `id` = '$id'";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($result);
            return new Service($row['service'],$row['cost']);
        }
        static function check_service($connection,$service){
            $query = "SELECT * FROM `services` WHERE `service` = '$service'";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)!= 0){
                return false;
            }
            return true;
        }
    }
?>