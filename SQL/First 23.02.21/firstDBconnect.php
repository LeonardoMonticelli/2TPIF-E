<?php
    $servername = "localhost";
    $username="root";
    $password="";
    $dbName="wsers2";

    $connection=mysqli_connect($servername, $username, $password, $dbName);

    if(!$connection){
        die("Connection failed: ".mysqli_connect_error());
    }
    echo "Connected Succesfully";

    $mySelect ="Select Family_Name from PPL";
    $myResult = mysqli_query($connection, $mySelect);

    while($row = mysqli_fetch_assoc($myResult)){
        echo $row["Family_name"]." ".$row["First_name"]." is ".$row["age"]." years old"."</br>";
    }
?>