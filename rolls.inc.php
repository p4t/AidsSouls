<div class="flex-item-edit">

  <table>
    <tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Mobs</th>
        <th scope="col">Boss</th>
        <th scope="col">Zeit</th>
        <th scope="col">IP</th>
      </tr>
      <tr>
  <?php


  $sql = 'SELECT * FROM rolls ORDER BY ID DESC LIMIT 10'; // Only show latest 10 entries
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
    echo $row["mobs"];
    echo '</td>';

    echo '<td>';
    echo $row["boss"];
    echo '</td>';

    echo '<td>';
    echo formatDate($row["date"]);
    echo '</td>';

    echo '<td>';
    echo $row["IP"];
    echo '</td>';

    echo '</tr>';
  }

  ?>

      </tr>
    </tbody>
  </table>
</div>