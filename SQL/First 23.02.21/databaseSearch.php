<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Document</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>   
    <?php
        if(isset($_GET["wanted"])){
            print"Doing a search for the person named ".".";
            include_once("DBconnect.php");
            $myselect = "SELECT * from ppl where LastName='".$_GET["wanted"]."'";
            $myresult= mysqli_query($connection, $myselect);
        }
    ?>
    <form action="" method="get">
        <input type="text" name="searchFor">
        <input type="submit" value="Search for people">
    </form>
</body>
</html>