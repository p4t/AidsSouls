<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">weaponID</th>
      <th scope="col">weaponNme</th>
      <th scope="col">Aktion</th>
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
  echo $row["weaponID"];
  echo '</td>';
  echo '<td>';

  echo $row["weaponName"];
  echo '</td>';

  echo '<td><a href="edit.php?mode=weapons&weaponID='.$row["weaponID"].'">Edit</td>';
  echo '</tr>';
}

?>

    </tr>
  </tbody>
</table>