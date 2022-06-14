<?php
    class News{
        public $title,$description,$text;

        function __construct($title,$description, $text)
        {
            $this->title = $title;
            $this->description = $description;
            $this->text = $text;
        }
        function insert_into_db($connection){
            $query = "INSERT INTO `news`(`id`, `title`, `description`, `text`, `date`) VALUES (NULL,'$this->title','$this->description','$this->text',NOW())"; 
            $result = mysqli_query($connection, $query);
        }
        static function get_News($connection){
            $query = "SELECT * FROM `news` ORDER BY `id` DESC";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result)>0){
                echo'<div class="row row-cols-1 row-cols-md-3 g-4" style = "margin:10px" align = "center">';
                while($row = mysqli_fetch_assoc($result)) { 
                    echo'
                        <div class="col">
                            <div class="card" style="width: 18rem; margin:0px 0px 30px 0px">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['title'].'</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">'. $row['date'].'</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">'. $row['description'] .'</h6>
                                    <p class="card-text">'. $row['text'] .'</p>                
                                </div>
                            </div>
                        </div>';
                        }
                        echo'</div>';
                    }
        }
    }
?>