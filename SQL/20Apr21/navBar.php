<!DOCTYPE html>
 <html>
 <head>
    <style>
        .topnav {
         background-color: #333;
         overflow: hidden;
        }

        .topnav a{
         float: left;
         color: #f2f2f2;
         text-align: center;
         padding: 14px 16px;
         text-decoration: none;
         font-size: 17px;
        }

        .topnav :hover {
         background-color: #ddd;
         color: black;
        }

        .topnav :active {
         background-color: rgb(80, 157, 209);
         color: white;
        }

        .topnav input {
         float: right;
         border: none;
         float: left;
         color: #f2f2f2;
         text-align: center;
         padding: 14px 16px;
         text-decoration: none;
         font-size: 17px;
        }
    </style>
 </head>
 <body>
   <?php
      include_once "dbConnect.php";
      $pages = array();

      if(!$_SESSION['isUserLoggedIn']) {
         $pages["signup.php"] = "Signup";
         $pages["login.php"] = "Login";
      } else {
         switch($_SESSION['role']) {
            case 'admin':
               $pages["addCountry.php"] = "Add a country";
               $pages["addProducts.php"] = "Add a product";
               break;
            case 'user':
               $pages["viewProducts.php"] = "View products";
               break;
         }
     }
     

      if(isset($_POST["logout"])){
         session_unset();
         session_destroy();
         $_SESSION["isUserLoggedIn"] = false;
         header("Location: login.php");
      }
   ?>     
   <div class="topnav">
      <?php foreach($pages as $url=>$title){?>
         <a href="<?=$url?>">
            <?=$title?>
         </a>
      <?php }?>
      <?php if($_SESSION["isUserLoggedIn"]){?>
      <form method="POST">
         <input class="topnav" type="submit" value="Logout" name="logout">
      </form>
      <?php }?>
   </div>
 </body>
 </html>