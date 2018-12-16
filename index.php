<?php
/* [INIT] */
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['userLoggedIn']) && !empty($sessData['CID'])){

}else{
    header("Location:User/login-reg.php");
}
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "lib-db.php";
require PATH_LIB . "lib-cart.php";
$cartLib = new Cart();
$products = $cartLib->pGet();
session_write_close();
/* [DRAW HTML] */
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- [META] -->
    <title>Simple PHP MYSQL Cart Demo</title>
    <meta name="description" content="Cart demo">
    <meta name="author" content="Code Boxx">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- [SCRIPTS & STYLES] -->
    <link rel="stylesheet" href="public/theme.css">
    <script src="public/general.js"></script>
    <script src="public/cart.js"></script>
  </head>
  <body>
    <!-- [NOTIFICATION BOX] -->
    <div id="noteOut"><div id="noteIn"></div></div>

    <!-- [HEADER] -->
    <header id="page-header">
      My Awesome Site
      <div id="page-cart" onclick="cart.toggle();">
        &#128722; <span id="page-cart-count">0</span>
      </div>

         <li>
            <a href="./admin.1/examples/myOrder.php">
              <i class="tim-icons icon-bus-front-12"></i>
              <p>My Orders</p>
            </a>
          </li>
 <h1>
          hello
          <?  
 $sql = "SELECT Username from CUTOMER where CID = ".$_SESSION['sessData']['CID'];

echo $sql; 
 echo $_SESSION['sessData']['CID']; ?>
</h1>

  <li>
            <a href="User/userAccount.php?logoutSubmit=1">
              <i class="tim-icons icon-bus-front-12" onclick = "<?php session_destroy();
              $_SESSION = [];
              ?>"></i>
              <p>exit </p>
            </a>
          </li>


    </header>

    <!-- [PRODUCTS] -->
    <div id="products"><?php
      if (is_array($products)) {
        foreach ($products as $id => $row) {
          ?>
          <div class="pdt">
            <img src="images/food.jpg" width="30%" height="30%"/>
            <h3 class="pdtName"><?= $row['Fname'] ?></h3>
            <div class="pdtPrice">$<?= $row['Fprice'] ?></div>
            <div class="pdtDesc"><?= $row['product_description'] ?></div>
            <input class="pdtAdd" type="button" value="Add to cart" onclick="cart.add(<?= $row['FID'] ?>);"/>

          </div>
        <?php
        }
      } else {
        echo "No products found.";
      }
      ?></div>

    <!-- [CART] -->
    <div id="cart" class="ninja"></div>

    <!-- [FOOTER] -->
    <footer id="page-footer">
      &copy; Copyright My Awesome Site. All rights reserved.
    </footer>
  </body>
</html>
