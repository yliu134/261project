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

$sql2="INSERT INTO FOOD (Fname, Fprice) VALUES ('$_POST[fname]',$_POST[fprice])";



if ($conn->query($sql2) === FALSE)

  {

  die('Error' . mysql_error());

  }

$message = '1 food added..';



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
