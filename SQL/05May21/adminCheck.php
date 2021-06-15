<?php
    if(!isset($_SESSION["UserRole"]) || $_SESSION["UserRole"] != "admin"){
        header("location: homepage.php"); 
        die("Access denied");
    }
?>