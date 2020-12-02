<?php
    function addNav($pageLink,$pageText){
        $explodedLink=explode("/",$_SERVER["REQUEST_URI"]);
        $sizeExpLinkArray = sizeof($explodedLink);
        if($pageLink == $explodedLink[$sizeExpLinkArray-1])
        {
            ?>
            <a class="activeLink"><?=$pageText?>
            <?php
        }
        else {
            ?>
            <a href="<?=$pageLink?>" class="inactiveLink"><?=$pageText?></a>
            <?php
        }
    }
?>
<div class="navigation">
    <?php
        $navigationLinks=["home.php"=>"Home","shop.php"=>"Products","login.php"=>"Login"];
        foreach ($navigationLinks as $key => $value) {
            if(($key<>"login.php") || ($_SESSION["isUserLoggedIn"]<>true)){
                addNavLink($key,$value);
            }
        }
    ?>
</div>