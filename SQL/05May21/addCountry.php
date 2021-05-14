<?php
    include_once "navBar.php";
    include_once "dbConnect.php";
    if($_SESSION["isUserLoggedIn"]){
        ?>
        <!DOCTYPE html>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <title>Add a country</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <link rel='stylesheet' type='text/css' media='screen' href=''>
                    <script src=''></script>
                </head>
                <body>
                    <?php
                        if(isset($_POST["NewCountry"])){
                            $sqlInsert = $connection->prepare("INSERT INTO countries(C_Name) values(?)");
                            $sqlInsert->bind_param("s", $_POST["NewCountry"]);
                            $resultOfExecute = $sqlInsert->execute();
                            if(!$resultOfExecute){
                                print "Creation of country, failed.";
                            }
                        }
                        if(isset($_POST["deleteC"])){ 
                            $sqlDelete = $connection->prepare("DELETE from countries where C_ID=?");
                            if(!$sqlDelete){
                                die("Error in sql selete statement");
                            }
                            $sqlDelete->bind_param("i",$_POST["deleteC"]);
                            $sqlDelete->execute();
                        }
                    ?>                    
                    <form method="POST">
                        Type the name of the new country:<input name="NewCountry"> 
                        <input type="submit" value="Add">
                    </form>
                    
                    <h1>Current Existing countries in our database</h1>
                    <table>
                        <th>
                            <td>Country name:</td>
                        </th>

                        <?php
                            $sqlSelect = $connection->prepare("SELECT * from countries");
                            $selectExe = $sqlSelect->execute();
                            if($selectExe){
                                $result = $sqlSelect->get_result();
                                while($row=$result->fetch_assoc()){
                                    ?>
                                    <tr><td><?=$row["C_Name"]?> 
                                        <form method="post">
                                            <input type="hidden" value="<?=$row["C_ID"]?>" name="deleteC">
                                            <input type="submit" value="Delete">
                                        </form>
                                    </td></tr>
                                    <?php
                                }
                            } else {
                                echo "Something went wrong when selecting data";
                            }
                        ?>
                    </table>
                </body>
            </html>
        <?php
    } else {
        die("ACCESS UNAUTHORIZED: Please log in first.");
    }
?>
