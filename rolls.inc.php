<a id="Rolls"></a>

<table class="edit">
  <tbody>
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Mobs</strong></th>
      <th scope="col"><strong>Boss</strong></th>
      <th scope="col"><strong>Zeit</strong></th>
      <th scope="col"><strong>IP</strong></th>
    </tr>
      
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
    <td><?=$row["IP"]?></td>
  </tr>
      
  <?php
  }
  ?>
      
  <tr>
    <td colspan="5">
      <a href="edit.php?action=truncate" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-balloon="Tabelle leeren" data-balloon-pos="up">Leeren</a>
    </td>
  </tr>
  </tbody>
</table>