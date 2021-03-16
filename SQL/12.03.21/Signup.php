<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Singup page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href=''>
    <script src=''></script>
    <style>
        .myRegistration{
            width:80%;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST["fName"],
        $_POST["lName"],
        $_POST["Age"],
        $_POST["Username"],
        $_POST["pswd1"],
        $_POST["pswd2"])        
        ){
            print "We are signing you up!";
            if($_POST["pswd1"]==$_POST["pswd2"]){
                //we are okay - we will insert it into the db
                include_once("dbConnect.php");
                $sql=$connect->prepare("INSERT INTO PPL(LastName, FirstName, Age, Username, Pswd) VALUES(?,?,?,?,?)");
                if(!$sql){
                    print "error in your sql";
                }
                $sql->bind_param("ssiss",$_POST["fName"],
                                        $_POST["lName"],
                                        $_POST["Age"],
                                        $_POST["Username"],
                                        $_POST["pswd1"]);
                $sql->execute();
            } else{
                //not ok
                print "The two passwords DONT match please, try again";
            }
        }
    ?>
    <h1>Welcome to our page.  Sign up here:</h1>
    <form action="" method="get">
        <label for="fName">First Name: </label><input type="text" name="fName">
        <label for="lName">Last Name: </label><input type="text" name="lName">
        <label for="Age">Age: </label> <input type="text" name="Age">
        <label for="Username">Username: </label><input type="text" name="Username">
        <label for="password">Password: </label><input type="text" name="password">
        <label for="password2">Retype password: </label><input type="text" name="password2">
        <input type="submit" value="Sign up">
    </form>
</body>
</html>