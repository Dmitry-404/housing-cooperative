<?php
    if($_SESSION["user"]){
        if($_SESSION["user"]->get_housekeeper() == 1){
          require_once '../html/header_admin.html';
        }
        else {
          require_once '../html/header.html';
        }
    }
?>