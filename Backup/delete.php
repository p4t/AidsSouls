<?php
$connect = mysqli_connect("localhost", "aids", "kUk3t1%5", "aids");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM user WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
