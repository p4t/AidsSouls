<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">mobsAidsName</th>
    </tr>
    <tr>
<?php

    
$sql = 'SELECT * FROM mobs';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
while ($row = $stmt->fetch()) { 
  // echo  $row[0] . " | " . $row[1] .  "<br/>";
  echo '<tr>';
  
  echo '<td>';
  echo $row["ID"];
  echo '</td>';
  
  echo '<td>';
  echo '<a href="edit.php?mode=mobs&ID='.$row["ID"].'">';
  echo $row["name"];
  echo '</a>';
  echo '</td>';

  echo '</tr>';
}

?>

    </tr>
  </tbody>
</table>