<?php
session_start();
class Cart extends DB {
  /* [PRODUCTS] */
  function pGet () {
  // pGet () : get all Food

    $sql = "SELECT * FROM `FOOD`";
    return $this->fetch($sql, null, "FID");
  }

  function pAdd ($Fname, $Fprice) {
  // pAdd () : add new Food

    $sql = "INSERT INTO `FOOD` (`Fname`, `Fprice`) VALUES (?, ?)";
    $cond = [$Fname, $Fprice];
    return $this->exec($sql, $cond);
  }

  function pEdit ($FID, $Fname, $Fprice) {
  // pEdit () : update product

    $sql = "UPDATE `FOOD` SET `Fname`=?, `Fprice`=? WHERE `FID`=?";
    $cond = [$Fname, $Fprice, $FID];
    return $this->exec($sql, $cond);
  }

  function pDel ($ID) {
  // pDel () : delete product

    $sql = "DELETE FROM `FOOD` WHERE `FID`=?";
    $cond = [$FID];
    return $this->exec($sql, $cond);
  }

  /* [ORDERS] */
  function oAdd ($CID, $Addr) {
  // oAdd () : create new order
  // ! READS DATA FROM SESSION CART !

    // Init
    $LocID = 5;
    $this->start();

    // Create the order
    echo $CID; 
    echo $Addr;
    $sql = "INSERT INTO `ORDERS` (`Addr`,`CID`,`LocID`) VALUES (?, ?, ?)";
    $cond = [$Addr,$CID,$LocID];
    $pass = $this->exec($sql, $cond);

    //Insert the items
    var_dump($_SESSION['cart']);
    if ($pass) {
      $sql = "INSERT INTO `ITEM` (`Onum`,`FID`, `Quantity`) VALUES ";
      $cond = [];
      foreach ($_SESSION['cart'] as $id=>$qty) {
        $sql .= "(?, ?, ?),";
        array_push($cond, $this-> lastID, $id, $qty);
      }
      $sql = substr($sql, 0, -1) . ";"; // strip last comma
      $pass = $this->exec($sql, $cond);
    }

    // Finalize
    $this->end($pass);
    return $pass;
  }

  function oGet ($Onum) {
  // oGet () : get order

    $sql = "SELECT * FROM `ORDERS` WHERE `Onum`=?";
    $cond = [$Onum];

    $order = $this->fetch($sql, $cond);

    $sql = "SELECT * FROM `ITEM` LEFT JOIN `FOOD` USING (`FID`) WHERE `ITEM`.Onum=?";
    //question
    $order['items'] = $this->fetch($sql, $cond, "FID");
    return $order;
  }

  function gAdd($Lname){
//gAdd() : add new delivery group 
    $sql = "INSERT INTO `DELIVERY_GROUP` (`Lname`) VALUES (?)";
    $cond = [$Lname];
    return $this->exec($sql, $cond);
  }

  function gDel ($LocID) {
  // gDel () : delete delivery group

    $sql = "DELETE FROM `DELIVERY_GROUP` WHERE `LocID`=?";
    $cond = [$LocID];
    return $this->exec($sql, $cond);
  }

    function gGet ($LocID) {
  // gGet () : get all delivery group 

    $sql = "SELECT * FROM `DELIVERY_GROUP`";
    return $this->fetch($sql, null, "FID");
  }
  function gEdit ($LocID,$Lname) {
  // gEdit () : update delivery group

    $sql = "UPDATE `DELIVERY_GROUP` SET `Lname`=? WHERE `LocID`=?";
    $cond = [$Lname, $LocID];
    return $this->exec($sql, $cond);
  }

  //customer 

  function cAdd($Username,$Pnum,$Password){
//gAdd() : add new customer
    $sql = "INSERT INTO `CUSTOMER` (`Username`,`Pnum`, `Password`) VALUES (?, ?, ?)";
    $cond = [$Username,$Pnum,$Password];
    return $this->exec($sql, $cond);
  }

  function cDel ($CID) {
  // gDel () : delete customer

    $sql = "DELETE FROM `CUSTOMER` WHERE `CID`=?";
    $cond = [$CID];
    return $this->exec($sql, $cond);
  }

    function cGet ($CID) {
  // gGet () : get all customer

    $sql = "SELECT * FROM `CUSTOMER`";
    return $this->fetch($sql, null, "CID");
  }
  function cEdit ($CID,$Username,$Pnum,$Password) {
  // gEdit () : update customer

    $sql = "UPDATE `CUSTOMER` SET `Username`=? , `Pnum`=? ,`Password`=? WHERE `CID`=?";
    $cond = [$CID,$Username,$Pnum,$Password];
    return $this->exec($sql, $cond);
  }


}
?>