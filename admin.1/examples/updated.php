<html>

<body>


  <?php

  $conn = mysqli_connect("localhost", "dpan6", "%NNN5m-A");
  if($conn->connect_error){
    die("connection falied:". $conn-> connect_error);
  }

  $sql = "USE dpan6_3;";
  if ($conn->query($sql) === TRUE) {

  } else {
  echo "Error using database: " . $conn->error;
  }
  if (isset($_POST['delete'])) {
        $sql2="DELETE FROM DELIVERY_GROUP WHERE LocID = $_POST[lid];";
    } else {
        $sql2="UPDATE DELIVERY_GROUP SET Lname = '$_POST[lname]' WHERE LocID = $_POST[lid];";
    }





if ($conn->query($sql2) === FALSE)

  {

  die('Error' . mysql_error());

  }


if (isset($_POST['delete'])) {
      $message = '<div class="alert alert-success" role="alert">1 deliery group deleted..</div>';
  } else {
      $message = '<div class="alert alert-success" role="alert">1 deliery group updated..</div>';
  }


mysql_close($conn)

?>
<div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
          <?php echo $message; ?>
      </div>
  </div>
</body>

</html>
