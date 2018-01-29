<input type="submit" name="Submit" value="Submit">

  echo '<input type="hidden" name="weaponID" value="'.$row["weaponID"].'">';

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
  
  
  
  <?php
  
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
  

?>