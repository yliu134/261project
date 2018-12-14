<?php
class Cart extends DB {
  /* [PRODUCTS] */
  function pGet () {
  // pGet () : get all products

    $sql = "SELECT * FROM `products`";
    return $this->fetch($sql, null, "product_id");
  }

  function pAdd ($name, $img, $desc, $price) {
  // pAdd () : add new product

    $sql = "INSERT INTO `products` (`product_name`, `product_image`, `product_description`, `product_price`) VALUES (?, ?, ?, ?)";
    $cond = [$name, $img, $desc, $price];
    return $this->exec($sql, $cond);
  }

  function pEdit ($id, $name, $img, $desc, $price) {
  // pEdit () : update product

    $sql = "UPDATE `products` SET `product_name`=?, `product_image`=?, `product_description`=?, `product_price`=? WHERE `product_id`=?";
    $cond = [$name, $img, $desc, $price, $id];
    return $this->exec($sql, $cond);
  }

  function pDel ($id) {
  // pDel () : delete product

    $sql = "DELETE FROM `products` WHERE `product_id`=?";
    $cond = [$id];
    return $this->exec($sql, $cond);
  }

  /* [ORDERS] */
  function oAdd ($name, $email) {
  // oAdd () : create new order
  // ! READS DATA FROM SESSION CART !

    // Init
    $this->start();

    // Create the order
    $sql = "INSERT INTO `orders` (`order_name`, `order_email`) VALUES (?, ?)";
    $cond = [$name, $email];
    $pass = $this->exec($sql, $cond);

    // Insert the items
    if ($pass) {
      $sql = "INSERT INTO `orders_items` (`order_id`, `product_id`, `quantity`) VALUES ";
      $cond = [];
      foreach ($_SESSION['cart'] as $id=>$qty) {
        $sql .= "(?, ?, ?),";
        array_push($cond, $this->lastID, $id, $qty);
      }
      $sql = substr($sql, 0, -1) . ";"; // strip last comma
      $pass = $this->exec($sql, $cond);
    }

    // Finalize
    $this->end($pass);
    return $pass;
  }

  function oGet ($id) {
  // oGet () : get order

    $sql = "SELECT * FROM `orders` WHERE `order_id`=?";
    $cond = [$id];
    $order = $this->fetch($sql, $cond);
    $sql = "SELECT * FROM `orders_items` LEFT JOIN `products` USING (`product_id`) WHERE `orders_items`.order_id=?";
    $order['items'] = $this->fetch($sql, $cond, "product_id");
    return $order;
  }
}
?>