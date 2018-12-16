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
        $sql2="DELETE FROM FOOD WHERE FID = $_POST[fid];";
    } else {
        $sql2="UPDATE FOOD SET Fname = '$_POST[fname]', Fprice= '$_POST[fprice]' WHERE FID = $_POST[fid];";
    }






if ($conn->query($sql2) === FALSE)

  {

  die('Error' . mysql_error());

  }

  if (isset($_POST['delete'])) {
        $message = '1 food deleted..';
    } else {
        $message = '1 food updated..';
    }




mysql_close($conn)

?>
<div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info">
                  <a href="./delivery.php">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-check-2"></i>
                  </button>
                </a>
                  <span><?php echo $message; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>

</html>
