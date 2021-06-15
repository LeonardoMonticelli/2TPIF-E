<?php
    if(!isset($_SESSION["userRole"]) || $_SESSION["userRole"] != "admin"){
        header("location: homeüage.php"); 
        die("Access denied");
    }
?>