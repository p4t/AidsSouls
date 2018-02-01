
<?php
$host = '127.0.0.1';
$dbName = 'aids';
$username = 'aids';
$password = 'kUk3t1%5';

$pdo = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);





if (isset($_POST["SFSSFSFFSFSFFSF"]))
{
  
/*
  echo "weaponID: " . $_POST['weaponID'] . "<br>";
  echo "weaponName: " . $_POST["weaponName"] . "<br>";
  */
  
/* TODO
  $sql = "UPDATE weapons SET weaponName = :weaponName WHERE weaponID = :weaponID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(':weaponName', $_POST['weaponName'], PDO::PARAM_STR); 
  $stmt->bindParam(':weaponID', $_POST['weaponID'], PDO::PARAM_INT);
  $stmt->execute(); 
*/

  
  /*
  
  if ($stmt->rowCount()) {
      echo 'Success: At least 1 row was affected.';
  } else{
      echo 'Failure: 0 rows were affected.';
  }
  */
  
}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">weaponID</th>
      <th scope="col">weaponNme</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>

<?php


    
$sql = 'SELECT weaponID, weaponName FROM weapons';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
while ($row = $stmt->fetch()) {
  
  // echo  $row[0] . " | " . $row[1] .  "<br/>";
  echo '<tr><td>';
  echo '<input type="hidden" name="weaponID" value="'.$row["weaponID"].'">';
  echo $row["weaponID"];
  echo '</td>';
  echo '<td>';

  echo '<input type="text" name="weaponName" id="'.$row["weaponID"].'" value="'.$row["weaponName"].'">';
  echo '</td>';

  echo '<td></td>';
  echo '</tr>';
  
  
  if ( $_POST["weaponName"] ) {
    
    $sql2 = "UPDATE weapons SET weaponName = :weaponName WHERE weaponID = :weaponID";
    $stmt2 = $pdo->prepare($sql2);                                  
    $stmt2->bindParam(':weaponName', $_POST['weaponName'], PDO::PARAM_STR); 
    $stmt2->bindParam(':weaponID', $_POST['weaponID'], PDO::PARAM_INT);
    $stmt2->execute(); 
    
    
  }
  

}
      






?>


  
    </tr>
  </tbody>
</table>
<input type="submit" name="Submit" value="Submit">
</form>


<h1>Test</h1>

