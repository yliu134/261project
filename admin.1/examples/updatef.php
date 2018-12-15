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

$sql2="UPDATE FOOD SET Fname = '$_POST[fname]', Fprice= '$_POST[fprice]' WHERE FID = $_POST[fid];";



if ($conn->query($sql2) === FALSE)

  {

  die('Error' . mysql_error());

  }

echo "1 food updated";



mysql_close($conn)

?>

</body>

</html>
