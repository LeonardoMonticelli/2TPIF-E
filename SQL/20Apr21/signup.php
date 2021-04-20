<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Signup</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href=''>
    <script src=''></script>
</head>
<body>
    <?php
        include_once("dbConnect.php");

        if (isset($_POST["FName"],$_POST["LName"],$_POST["UsrName"],$_POST["Psw"],$_POST["Psw2"])){
                print "We are signing you up!";
                if ($_POST["Psw"] == $_POST["Psw2"]) {
                    //we are ok -we will start instert this into db
        
                    $sql = $connection->prepare("INSERT INTO PEOPLE(FName, LName, UsrName, Psw) VALUES(?,?,?,?)");
        
                    if (!$sql) {
                        print "Error in your sql";
                    }
        
                    $hashedPassword = password_hash($_POST["Psw"], PASSWORD_BCRYPT);
        
                    $sql->bind_param(
                        "ssss",
                        $_POST["FName"],
                        $_POST["LName"],
                        $_POST["UsrName"],
                        $hashedPassword,
                    );
        
                    $SQLexecute = $sql->execute();
                    if ($SQLexecute) {
                        print "We are done. Please check the database!";
                    } else {
                        print 'Problem running SQLexecute.';
                    }
                } else {
                    print "Passwords do not match.";
                }
            }
            ?>
            <h1>Welcome to our page. You will signup here</h1>
            <div class="container">
                <form class="myRegistration" method="POST"><BR>
                    <label for="FirstName">First Name</label> <input name="FName"><BR>
                    <label for="LastName">Last Name</label> <input name="LName"><BR>
                    <label for="UserName">Username</label> <input name="UsrName"><BR>
                    <label for="Psw">Password</label> <input name="Psw" type="password"><BR>
                    <label for="Psw2">Re-type Password</label> <input name="Psw2" type="password"><BR>
        
                    <label for="Country">Choose your country of origin:</label>
                    <select name="Country">
        
                        <?php
                        $sqlSelect = $connection->prepare("SELECT * from COUNTRIES");
                        $selectionWentOK = $sqlSelect->execute();
        
                        if ($selectionWentOK) {
        
                            $result = $sqlSelect->get_result();
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <option value="<?= $row["C_ID"] ?>"><?= $row["C_Name"] ?></option>
                        <?php
                            }
                        } else {
                            print "Something went wrong when selecting data";
                        }
                        ?>
        
                    </select>
        
                    <input type="submit" name="submit">
                </form>
        
                        <p><a href="login.php">Click here to go to Login Page!</p>
</body>
</html>