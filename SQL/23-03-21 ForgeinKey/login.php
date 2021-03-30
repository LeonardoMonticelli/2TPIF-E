<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        if(isset($_POST["Username"],$_POST["Pswd"])){
            include_once("dbConnect.php");
            $sql = $connection->prepare("Select * from ppl where username=?");
            if(!$sql){
                die("error in your sql");
            }
            $sql->bind_param("s",$_POST["username"]);
            if(!$sql->execute()){
                die("Error executing sql statement");
            }
            $result=$sql->execute();
            
        }
    ?>
    <form action="" method="post">
        Username: <input type="text" name="Username" id="">
        Password: <input type="text" name="Pswd" id="">
        <input type="submit" name="Login" id="">
    </form>
</body>
</html>