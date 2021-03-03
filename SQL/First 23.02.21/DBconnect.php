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

    $mySelect ="Select LastName from PPL";
    $myResult = mysqli_query($connection, $mySelect);

    while($row = mysqli_fetch_assoc($myResult)){
        echo $row["LastName"]." ".$row["FirstName"]." is ".$row["Age"]." years old"."</br>";
    }
?>