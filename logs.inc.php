<a id="Logs"></a>

<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="10">
        &raquo; Logs
      </th>
    </tr>

    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Section</strong></th>
      <th scope="col"><strong>Action</strong></th>
      <th scope="col"><strong>ParentID</strong></th>
      <th scope="col"><strong>ParentField</strong></th>
      <th scope="col"><strong>Old</strong></th>
      <th scope="col"><strong>New</strong></th>
      <th scope="col"><strong>User</strong></th>
      <th scope="col"><strong>IP</strong></th>
      <th scope="col"><strong>Date</strong></th>
    </tr>
  </thead>
  <tbody>
      
  <?php
  $sql = "SELECT * FROM log ORDER BY ID DESC LIMIT 10"; // Only show latest 10 entries
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
        
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  ?>
      
  <tr>
    <td><?=$row["ID"]?></td>
    <td><?=$row["section"]?></td>
    <td><?=$row["action"]?></td>
    <td><?=$row["parentID"]?></td>
    <td><?=$row["parentField"]?></td>
    <td><?=$row["old"]?></td>
    <td><?=$row["new"]?></td>
    <td><?=$row["username"]?></td>
    <td><?=$row["IP"]?></td>
    <td><?=formatDate($row["date"], "datetime")?></td>
  </tr>
      
  <?php
  }
  ?>
      
  <tr>
    <td colspan="10">
      <a href="edit.php?action=truncate2" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-balloon="Tabelle leeren" data-balloon-pos="up">Leeren</a>
    </td>
  </tr>
  </tbody>
</table>