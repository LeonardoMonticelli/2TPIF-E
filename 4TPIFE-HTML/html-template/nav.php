<div class="navigation">
        <?php
            if(!isset($_SESSION["isUserLoggedIn"])){
                $_SESSION["isUserLoggedIn"] = false;
            }
            $navigationLinks=["home.php"=>"Home","shop.php"=>"Products","login.php"=>"Login"];
            foreach ($navigationLinks as $key => $value) {
                if(($key<>"login.php") || ($_SESSION["isUserLoggedIn"]<>true)){
                    addNavLink($key,$value);
                }
            }
        ?>
            <a class="" href="">Login</a>
            <?php
        if($_SESSION["isUserLoggedIn"])
        {
            ?>
            <a href="">
                welcome <?=$_SESSION["currentUser"]?>
            </a>
            <?php
        }
    ?>
</div>
<?php
    function addNavLink($pageLink,$pageText){
        $explodedLink=explode("/",$_SERVER["REQUEST_URI"]);
        $sizeExpLinkArray = sizeof($explodedLink);
        if($pageLink == $explodedLink[$sizeExpLinkArray-1])
        {
            ?>
            <a class="activeLink">
                <?=$pageText?>
            <?php
        }
        else {
            ?>
                <a href="<?=$pageLink?>" class="inactiveLink" onclick="on()">Login</a>
                <div class="overlay" onclick="off()">
                    <form action="" method="post">
                        <label for="">Please type your username</label>
                        <input type="username">
                        <input type="submit" value="Login">
                    </form>
                </div>
                <?php
        }
        ?>
        <script>
            function on() {
                document.getElementById("overlay").style.display = "block";
            }

            function off() {
                document.getElementById("overlay").style.display = "none";
            }
        </script>
        <?php
    }
?>