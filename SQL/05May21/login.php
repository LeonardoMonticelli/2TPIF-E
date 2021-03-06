<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <script src=''></script>
</head>

<body>

<?php
    include_once "navBar.php";
    include_once "dbConnect.php";

    if($_SESSION["isUserLoggedIn"]){
        echo "you are now logged in.";
    } else {?>
        <h1>Welcome to this login page of this website</h1>
        <form action="" method="POST">
            <label for="UserName">Please type your Username</label> <input name="Username">
            <label for="UserName">Password</label> <input name="Password" type="password">
            <input type="submit" value="login">
        </form>
        <?php
            }
            if(isset($_POST["Username"],$_POST["Password"])){

                $sql = $connection->prepare("select * from PEOPLE where UsrName=?");
                if(!$sql){
                    die("Error in the sql");
                }

                $sql->bind_param("s", $_POST["Username"]);
                if(!$sql->execute()){
                    die("Error executing the sql statement");
                }
                
                $result = $sql->get_result();

                if($result->num_rows==0){
                    print "Your username is not in our database";
                } else {
                    $row = $result->fetch_assoc();
                    if(password_verify($_POST["Password"],$row["Psw"])){
                        print "You are now logged in";
                        $_SESSION["isUserLoggedIn"] = true;
                        $_SESSION["currentUser"] = $_POST["Username"];
                        $_SESSION["role"] = $row["UserRole"];
                        header("Location: login.php");
                    } else {
                        print "The data you provided does not match with the one in our servers.";
                    }
                }
            }
        ?>
</body>
</html>