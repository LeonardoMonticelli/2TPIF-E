<?php
    include_once "sessionCheck.php";
    $pageTitle ="Products";
    include_once "head.php";
?>
<body>
    <?php
        include_once "nav.php";
    ?>
    <div id="bigsqua">
        <div class="prod">
            <?php  
                $fileHandler = fopen("data\\shopData.txt","r");
                while($line=fgets($fileHandler)){
                    $product = explode("|", $line);
                    ?>
                    <div class="box">
                    <img class="product_image" src="<?=$product[0];?>" style="width:20em;height:15em">
                    <div class="bellow">
                        <div class="tag name"><?=$product[1];?></div>
                        <div class="tag price">Price: <?=$product[2];?></div>
                        <div class="tag desc">Description: <?=$product[3];?></div>
                    </div>
                    </div>
                <?php
                    }
                    fclose($fileHandler);
            ?>
        </div>
        <!-- <form>
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
            </div> -->
            <div>
                <?php       
                    if (isset($_POST['field1']) && isset($_POST['field2']) && isset($_POST['field3']) && isset($_POST['field4'])) {
                    $fileHandler = fopen("shopData.txt","a+");
                    $string = $_POST['field1'].' | '.$_POST['field2'].' | '.$_POST['field3'].' | '.$_POST['field4'];
                    fwrite($fileHandler,$string);
                    fclose($fileHandler);}
                ?>
                <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
        </form>
    </div>
</body>
</html>
