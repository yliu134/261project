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
    <title>SHE Cart</title>
    <meta name="description" content="Cart">
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
      S.H.E group
      <div id="page-cart" onclick="cart.toggle();">
        &#128722; <span id="page-cart-count">0</span>
      </div>

         <p>
            <a href="./admin.1/examples/myOrder.php">
              <button class="pdtAdd">My Orders</button>
            </a>


             <a href="User/userAccount.php?logoutSubmit=1">
              <button class="pdtAdd" onclick = "<?php session_destroy();
              $_SESSION = [];
              ?>"> EXIT </button>

            </a>

        </p>

 <h1>

   <p>
          <?php

 //          $conn = mysqli_connect("localhost", "dpan6", "%NNN5m-A");

 // $sql = "SELECT Username from CUTOMER where CID = ".$_SESSION['sessData']['CID'].";";
 // $result = $conn->query($sql);
 // echo $result;
 echo "wwwwwww".$_SESSION['sessData']['CID'];
 ?>
</p>

</h1>


  <li>

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
      &copy; Copyright S.H.E group. All rights reserved.
    </footer>
  </body>
</html>
