<html>

<body>


  <?php

  echo "!!!!!!!!!!!!!!!!!";
  $conn = mysqli_connect("localhost", "dpan6", "%NNN5m-A");
  if($conn->connect_error){
    die("connection falied:". $conn-> connect_error);
  }

  $sql = "USE dpan6_3;";
  if ($conn->query($sql) === TRUE) {

  } else {
  echo "Error using  database: " . $conn->error;
  }

$sql="INSERT INTO FOOD (Fname, Fprice) VALUES ('$_POST[fname]','$_POST[fprice]')";



if (!mysql_query($sql,$conn))

  {

  die('Error' . mysql_error());

  }

echo "1 food added";



mysql_close($conn)

?>

</body>

</html>
