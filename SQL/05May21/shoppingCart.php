<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Shopping cart</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href=''>
    <script src=''></script>
</head>
<body>
    <?php
        include_once "dbConnect.php";

        if(isset($_POST["itemToDelete"])){
            unset($_SESSION["shoppingCart"][$_POST["itemToDelete"]]);
        }

        if(isset($_POST["buyAll"]) && sizeof($_SESSION["shoppingCart"]) != 0){
            $newOrderStatus = "Order in process.";
            $sqlInsert = $connection->prepare("INSERT into ORDERS(PersonID,Order_Status) values((SELECT P_ID from people where UsrName=?),?);");
            $sqlInsert->bind_param("ss",$_SESSION["CurrentUser"],$newOrderStatus);
            $insertWentOk = $sqlInsert->execute();
            foreach($_POST["shoppingCart"] as $key => $value){
                $sqlInsert2 = $connection->prepare("INSERT into ORDERCONTENTS(OrderID,ItemToBuy,HowMany) values(?,?,?)");
                $sqlInsert2->bind_param("iii",$newOrderId, $key, $value);
                $insert2WentOk = $sqlInsert2->execute();
            }
            $_SESSION["shoppingCart"] = [];
            print "Thank you for your order. It will be processed soon!";    
        } else {
            print "The shopping cart is emtpy.";
        }
        include_once "navBar.php"
    ?>
    <h1>Shopping cart contents:</h1>
    <table>
        <tr>
            <th>Product name:</th>
            <th>You ordered:</th>
            <th>The price:</th>
        </tr>
        <?php
            $totalPrice =0;
            foreach($_SESSION["shoppingCart"] as $key => $value){

                $sqlSelect = $connection->prepare("SELECT * from PRODUCTS where Pr_ID=?");
                $sqlSelect->bind_param("i",$key);
                $selectionWentOk = $sqlSelect->execute();
                if($selectionWentOk){
                    $result = $sqlSelect->get_result();
                    $row=$result->fetch_assoc();
                    $totalPrice += $row['Pr_Price'] * $value;
                    ?>
                    <tr>
                        <td><?= $row["Pr_Name"]?></td>
                        <td><?= $value?></td>
                        <td><?= $row["Pr_Price"]?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="itemToDelete" value="<?=$key?>">
                                <input type="submit" value="Delete this item from the order">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="buyAll" value="<?=$key?>">
                                <input type="submit" value="Buy">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                else{
                    print "Not ok";
                }
               
            }
        ?>
    </table>
</body>
</html>