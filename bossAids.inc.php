<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">bossAidsID</th>
      <th scope="col">bossAidsName</th>
      <th scope="col">Aktion</th>
    </tr>
    <tr>
<?php

    
$sql = 'SELECT bossAidsID, bossAidsName FROM bossAids';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
while ($row = $stmt->fetch()) { 
  // echo  $row[0] . " | " . $row[1] .  "<br/>";
  echo '<tr><td>';
  echo $row["bossAidsID"];
  echo '</td>';
  echo '<td>';

  echo $row["bossAidsName"];
  echo '</td>';

  echo '<td><a href="edit.php?mode=bossAids&bossAidsID='.$row["bossAidsID"].'">Edit</td>';
  echo '</tr>';
}

?>

    </tr>
  </tbody>
</table>