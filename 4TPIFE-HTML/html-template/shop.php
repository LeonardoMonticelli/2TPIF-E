<?php
    session_start();
    if(isset($_GET['userName'])) {
        $_SESSION['user'] = $_GET['userName'];
        $_SESSION['currentUser'] = $_SESSION['user'];
    }
    if(isset($_GET["logout"])){
        // $_SESSION['user'] = false;
        session_unset();
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Template</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        body {
            background-color: #d5f9de;
        }

        /*Top part of the website*/
        #bigsqua {
            background-color: #a3b6d4;
            text-align: center;
        }

        .prod {
            display: flex;
            flex-wrap: center;
            justify-content: center;
            text-align: center;
            background-color: #949ac0;
            margin: 3px;
        }

        .bellow {
            display: flex;
            flex-direction: column;
        }
        .tag {
            font-family: Verdana;
            text-align: center;
            font-size: 16px;
        }
        
        .name {
            font-size: 48px;
        }

        .product_image {
            align-self: center;
            width: auto;
            height: 150px;
        }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_SESSION['user'])){
            echo "You're now logged in " .$_SESSION['currentUser'];
            ?>
                <form method="get" action="login.php">
                    <input type="submit" name="logout" value="Logout">
                </form>
            <?php
        }
    ?>
    
    <div id="bigsqua">
        <div class="prod">
            <?php  
                $fileHandler = fopen("data\\shopData.txt","r");
                while($line=fgets($fileHandler)){
                    $product = explode("|", $line);
                    ?>
                    <img class="product_image" src="<?=$product[0];?>" style="width:20em;height:15em">
                    <div class="bellow">
                        <div class="tag name"><?=$product[1];?></div>
                        <div class="tag price">Price: <?=$product[2];?></div>
                        <div class="tag desc">Description: <?=$product[3];?></div>
                    </div>
                <?php
                    }
                    fclose($fileHandler);
            ?>
        </div>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Image name</label>
                <input 
                    type="string" 
                    class="form-control w-25" 
                    id="exampleInputEmail1" 
                    aria-describedby="emailHelp" 
                    name="field1" 
                    placeholder="image name"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input 
                    type="string" 
                    class="form-control w-25" 
                    id="exampleInputPassword1" 
                    name="field2" 
                    placeholder="name"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input 
                    type="string" 
                    class="form-control w-25" 
                    id="exampleInputPassword1" 
                    name="field3" 
                    placeholder="price in EUR"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input 
                    type="string" 
                    class="form-control w-25" 
                    id="exampleInputPassword1" 
                    name="field4" 
                    placeholder="description"
                >
            </div>
            <?php       
                if (isset($_POST['field1']) && isset($_POST['field2']) && isset($_POST['field3']) && isset($_POST['field4'])) {
                $fileHandler = fopen("shopData.txt","a+");
                $string = $_POST['field1'].' | '.$_POST['field2'].' | '.$_POST['field3'].' | '.$_POST['field4'];
                fwrite($fileHandler,$string);
                fclose($fileHandler);}
            ?>
            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>
    </div>
</body>
</html>
<?php
?>