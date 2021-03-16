<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
    if(isset($_POST["FName"],
             $_POST["LName"],
             $_POST["HowOldAreYou"],
             $_POST["Usrname"],
             $_POST["Psw1"],
             $_POST["Psw2"])
        ){
            print"We are sign you up!!!";
            if( $_POST["Psw1"]== $_POST["Psw2"]){
                //we are okey
                include_once("dbConnect.php");
                $sql=$connection->prepare("INSERT INTO PPL(LastName,FirstName,Age,UserName,Psw) Values(?,?,?,?,?)");
                if(!$sql){
                    print"Error in your sql";
                }
                $sql->bind_param("ssiss",$_POST["FName"],
                                         $_POST["LName"],
                                         $_POST["HowOldAreYou"],
                                         $_POST["Usrname"],
                                         $_POST["Psw1"]);
                $sql->execute();
                print"we are finish§Check your Database!";
            }
            else{
                print"the two password dont match";}


            }
    ?>
<h1>wemcome to our page</h1>
<div class="container">
<form class="myRegistration" method="POST">
   <lable for="FName">First Name</lable> <input  name="FName"><BR>
   <lable for="LName">Last Name</lable><input  name="LName"><BR>
   <lable for="HowOldAreYou">Age</lable><input  name="HowOldAreYou"><BR>
   <lable for="Usrname">Pick Username</lable><input  name="Usrname"><BR>
   <lable for="Psw1">Type a Password</lable><input type="password"  name="Psw1"><BR>
   <lable for="Psw2">Retype a Password</lable><input type="password"  name="Psw2"><BR>
   <input class="bigItem" type="submit" value="Search for people">
</form>
 </div>
</body>
</html>