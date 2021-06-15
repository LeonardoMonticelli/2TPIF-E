<?php
    include_once "dbConnect.php";
    if (isset($_POST["addPr"])){
        // array_push($_SESSION["shoppingCart"],$_POST["addPr"]);
        // ALTERNATIVE:
        if(isset($_SESSION["shoppingCart"][$_POST["addPr"]])){
            $_SESSION["shoppingCart"][$_POST["addPr"]] += $_POST["howManyItems"];
        } else {
            $_SESSION["shoppingCart"][$_POST["addPr"]] = $_POST["howManyItems"];
        }
    }
    if(isset($_POST["deletePr"])){ 
        $sqlDelete = $connection->prepare("DELETE from PRODUCTS where Pr_ID=?");
        if(!$sqlDelete){
            die("Error in sql selete statement");
        }
        $sqlDelete->bind_param("i",$_POST["deletePr"]);
        $sqlDelete->execute();
        Header('Location: '.$_SERVER['PHP_SELF']);
    }
    include_once "navBar.php"; 
    if(!$_SESSION['isUserLoggedIn']) {
        // header("Location: /");
        die("Unauthorised, you are not an user");
    } else {?>
        <h1>Current amount of products in the database</h1>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product name</th>
                <th>Product price</th>
                <th>Stock</td>
            </tr>
    
            <?php
                $sqlSelect = $connection->prepare("select Pr_ID, Pr_Name, Pr_Price, Pr_ItemsInStock from PRODUCTS");
                $selectExe = $sqlSelect->execute();
                if($selectExe)
                {
                    $result = $sqlSelect->get_result();
                    while($row=$result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?=$row["Pr_ID"]?></td>
                            <td><?=$row["Pr_Name"]?></td>
                            <td><?=$row["Pr_Price"]?> Euros</td>
                            <td><?=$row["Pr_ItemsInStock"]?></td>
                            <?php if($_SESSION['isUserLoggedIn'] && $_SESSION["role"] == "admin"){?>
                                <td>
                                    <!-- the delete is taking two clicks to act -->
                                    <form method="post">
                                        <input type="hidden" value="<?= $row["Pr_ID"]?>" name="deletePr">
                                        <input type="submit" value="Delete">
                                    </form>
                                    <td>
                                    <form method="post">
                                        <input type="hidden" value="<?= $row["Pr_ID"]?>" name="addPr">
                                        <input type="number" value=0 name="howManyItems">
                                        <input type="submit" value="Add">
                                    </form>
                                </td>
                                </td>
                            <?php } else {?>
                                <td>
                                    <form method="post">
                                        <input type="hidden" value="<?= $row["Pr_ID"]?>" name="addPr">
                                        <input type="number" value=0 name="howManyItems">
                                        <input type="submit" value="Buy">
                                    </form>
                                </td>
                            <?php }?>
                        </tr>
                        <?php
                    }
                } else {
                    echo "Something went wrong when selecting data";
                }             
            ?>
        </table>
        <?php
    }
?>