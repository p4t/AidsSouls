<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">mobsAidsID</th>
      <th scope="col">mobsAidsName</th>
      <th scope="col">Aktion</th>
    </tr>
    <tr>
<?php

    
$sql = 'SELECT mobsAidsID, mobsAidsName FROM mobsAids';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
while ($row = $stmt->fetch()) { 
  // echo  $row[0] . " | " . $row[1] .  "<br/>";
  echo '<tr><td>';
  echo $row["mobsAidsID"];
  echo '</td>';
  echo '<td>';

  echo $row["mobsAidsName"];
  echo '</td>';

  echo '<td><a href="edit.php?mode=mobsAids&mobsAidsID='.$row["mobsAidsID"].'">Edit</td>';
  echo '</tr>';
}

?>

    </tr>
  </tbody>
</table>