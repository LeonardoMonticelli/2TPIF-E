<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>FK</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        if(isset($_POST["NewCountry"])){
            include_once("DBconnect.php");
            $sqlinsert=$connection->prepare("INSERT INTO countries(countryName) values(?)");
            $sqlinsert-> bind_param("s",$_POST["NewCountry"]);
            $sqlinsert->execute();
        }
    ?>
    <form action="" method="post">
        Type the name of the country:<input name="NewCountry">
        <input type="submit" value="Add">
    </form>
</body>
</html>