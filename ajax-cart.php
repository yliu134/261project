<?php
/* [INIT] */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}


session_start();
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "lib-db.php";
require PATH_LIB . "lib-cart.php";
$cartLib = new Cart();

/* [HANDLE AJAX REQUEST] */
switch ($_POST['req']) {
  default:
    echo "INVALID REQUEST";
    break;

  // COUNT TOTAL NUMBER OF ITEMS
  case "count":
    $total = 0;
    if (is_array($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $id => $qty) {
        $total += $qty;
      }
    }
    echo $total;
    break;

  // ADD ITEM TO CART
  case "add":
    // ITEMS WILL BE STORED IN THE ORDER OF
    // $_SESSION['cart'][PRODUCT ID] = QUANTITY
    if (is_numeric($_SESSION['cart'][$_POST['FID']])) {
      $_SESSION['cart'][$_POST['FID']] ++;
    } else {
      $_SESSION['cart'][$_POST['FID']] = 1;
    }
    echo "Item added to cart test";
    break;

  // SHOW CART
  case "show":
    // FETCH PRODUCTS
    // Could be better here if you only get the items in the cart only
    $products = $cartLib->pGet();

    // SPIT OUT THE CART CONTENTS IN HTML
    $sub = 0;
    $total = 0;
    ?>
    <h1>MY CART</h1>
    <table class="zebra">
      <tr>
        <th>Qty</th>
        <th>Item</th>
        <th>Price</th>
      </tr>
      <?php
      foreach ($_SESSION['cart'] as $id => $qty) {
                // CALCULATE THE TOTALS
        echo $id;
        $sub = $qty * $products[$id]['Fprice'];
        $total += $sub;
        // THE PRODUCT
        console_log($_SESSION['cart']);
        printf("<tr><td><input id='qty_%u' onchange='cart.change(%u);' type='number' value='%u'/></td><td>%s</td><td>$%0.2f</td></tr>", $id, $id, $qty, $products[$id]['Fname'], $sub
        );
      }
      ?>
      <tr>
        <td></td>
        <td><strong>Grand Total</strong></td>
        <td><strong>$<?= $total ?></strong></td>
      </tr>
    </table>
    <?php if ($total > 0) { ?>
      <form id="cart-checkout" onsubmit="return cart.checkout(<?php $_SESSION['sessData']['CID']; ?>)">
        Address: <input type="text" id="Addr" required/>
        <input type="submit" value="Checkout"/>
      </form>
    <?php
    }
    break;

  // CHANGE QTY
  case "change":
    if ($_POST['qty'] == 0) {
      unset($_SESSION['cart'][$_POST['FID']]);
    } else {
      $_SESSION['cart'][$_POST['FID']] = $_POST['qty'];
    }
    echo "Quantity updated";
    break;

  // CHECKOUT
  // THERE ARE NO ERROR & SECURITY CHECKS IN THIS SIMPLE EXAMPLE
  // BEEF UP THIS SECTION ON YOUR OWN!
  // case "checkout":
  //   if ($cartLib->oAdd($_POST['name'], $_POST['email'])) {
  //     $_SESSION['cart'] = array();
  //     echo "OK";
  //   } else {
  //     echo $cartLib->error;
  //   }
  //   break;

  // case "checkout":      
  //   if ($cartLib->oAdd($_POST['CID'], $_POST['Addr'])) {
  //     $_SESSION['cart'] = array();
  //     echo "OK";
  //   } else {
  //     echo $cartLib->error;
  //   }
  //   break;

      case "checkout":      
     if ($cartLib->oAdd($_SESSION['sessData']['CID'], $_POST['Addr'])) {
       $_SESSION['cart'] = array();
        // session_destroy();
        header("Location:User/login-reg.php");
        session_write_close();

     } else {
       echo $cartLib->error;

     }
    break;
}
?>