<a id="Rolls"></a>

<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="6">
        &raquo; Latest Rolls/Visits
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Mobs</strong></th>
      <th scope="col"><strong>Boss</strong></th>
      <th scope="col"><strong>Zeit</strong></th>
      <th scope="col"><strong>User</strong></th>
      <th scope="col"><strong>IP</strong></th>
    </tr>
  </thead>
  <tbody>
      
  <?php
  $sql = "SELECT * FROM rolls ORDER BY ID DESC LIMIT 10"; // Only show latest 10 entries
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
        
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  ?> 
  <tr>
    <td><?=$row["ID"]?></td>
    <td><?=$row["mobs"]?></td>
    <td><?=$row["boss"]?></td>
    <td><?=formatDate($row["date"], "datetime")?></td>
    <td><?=$row["username"]?></td>
    <td><?=$row["IP"]?></td>
  </tr>
      
  <?php
  }
  ?>
      
  <tr>
    <td colspan="6">
      <a href="edit.php?action=truncate" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-balloon="Tabelle leeren" data-balloon-pos="up">Leeren</a>
    </td>
  </tr>
  </tbody>
</table>