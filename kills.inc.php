<div class="flex-item-edit">

  <table border="1" cellspacing="1" cellpadding="1">
    <tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Joker</th>
        <th scope="col">Ausgegeben</th>
        <th scope="col">Kills</th>
      </tr>
      <tr>
  <?php


  $sql = 'SELECT * FROM kills';
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
    echo $row["name"];
    echo '</td>';

    echo '<td>';
    echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'">';
    echo $row["joker"];
    echo '</a>';
    echo '</td>';

    echo '<td>';
    echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'">';
    echo $row["spent"];
    echo '</a>';
    echo '</td>';

    echo '<td>';
    echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'">';
    echo nl2br($row["bossNames"]);
    echo '</a>';
    echo '</td>';

    echo '</tr>';
  }

  ?>

      </tr>
    </tbody>
  </table>
</div>