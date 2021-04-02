<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Singup</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<style>
    .container{
        width:50%
    }
    .myRegistration{
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
    }
    .myRegistration lable{
        width:50%;
    }
    .bigItem{
        width:80%
    }
</style>
<body>
<?php
    include_once("dbConnect.php");
    if(isset($_POST["FirstName"],
             $_POST["LastName"],
             $_POST["Age"],
             $_POST["Username"],
             $_POST["Pswd1"],
             $_POST["Pswd2"],
             $_POST["ID_Country"]))
             {
            if( $_POST["Pswd1"]== $_POST["Pswd2"]){

                $sql=$connection->prepare("INSERT INTO users(LastName,FirstName,Age,Username,Pswd,ID_Country) VALUES(?,?,?,?,?,?)");
                if(!$sql){
                    print"Error in your sql<br>";
                }
                $sql->bind_param("ssissi",$_POST["LastName"],
                                         $_POST["FirstName"],
                                         $_POST["Age"],
                                         $_POST["Username"],
                                         $_POST["Pswd1"],
                                         $_POST["ID_Country"]);
                $check=$sql->execute();
                if(!$check){
                    print $sql->error;
                } else{
                    print"We signed you up, check the database";
                }
            }
            else{
                print"The two passwords do not match, please try again";
            }
            }
    ?>
    <div class="container">
        <form action="" method="post" class="myRegistration">
            <lable for="FName">First Name</lable> <input  name="FirstName"><br>
            <lable for="LName">Last Name</lable><input  name="LastName"><br>
            <lable for="HowOldAreYou">Age</lable><input  name="Age"><br>
            <lable for="Usrname">Pick Username</lable><input  name="Username"><br>
            <lable for="Psw1">Type a Password</lable><input type="password"  name="Pswd1"><br>
            <lable for="Psw2">Retype a Password</lable><input type="password"  name="Pswd2"><br>
            <label for="Country">Choose your country:</label>
            <select name="Country">
                <?php
                    $sqlSelect=$connection->prepare("SELECT * FROM countries");
                    $selectOK=$sqlSelect->execute();
                    if(!$selectOK){
                        print "Something went wrong when selecting the countries";
                        die();
                    }
                    $countryResult=$sqlSelect->get_result();
                    while($row = $countryResult->fetch_assoc()){
                        ?>
                            <option value="<?=$row["ID_Country"]?>"><?=$row["CountryName"]?></option>
                        <?php
                    }
                ?>
            </select><br>
            <input type="submit" class="BigItem" value="Singup">
        </form>
    </div>
</body>
</html>