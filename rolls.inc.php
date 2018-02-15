<!-- <div class="flex-item-edit"> -->

  <table>
    <tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Mobs</th>
        <th scope="col">Boss</th>
        <th scope="col">Zeit</th>
        <th scope="col">IP</th>
      </tr>
  <?php


  $sql = 'SELECT * FROM rolls ORDER BY ID DESC LIMIT 10'; // Only show latest 10 entries
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $countRows = $stmt->rowCount();
        
  while ($row = $stmt->fetch()) { 
    // echo  $row[0] . " | " . $row[1] .  "<br/>";
    echo "\n<tr>\n";

    echo "<td>";
    echo $row["ID"];
    echo "</td>";
    
    echo "\n";

    echo "<td>";
    echo $row["mobs"];
    echo "</td>";
    
    echo "\n";

    echo "<td>";
    echo $row["boss"];
    echo "</td>";

    echo "\n";
    
    echo "<td>";
    echo formatDate($row["date"]);
    echo "</td>";
    
    echo "\n";

    echo "<td>";
    echo $row["IP"];
    echo "</td>";
    
    echo "\n";

    echo "</tr>\n";
  }

  ?>

    </tbody>
  </table>
<!-- </div> -->