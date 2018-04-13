<a id="Kills"></a>

<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="5">
        &raquo; Kills
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Name</strong></th>
      <th scope="col"><strong>Joker</strong></th>
      <th scope="col"><strong><s>Joker</s></strong></th>
      <th scope="col"><strong>Kills</strong></th>
    </tr>
  </thead>
  <tbody>
    
  <?php
  $sql = "SELECT * FROM kills";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  ?>
  <tr>
    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>">
        <?=$row["ID"]?>
      </a>
    </td>
    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>">
        <?=$row["name"]?>
      </a>
    </td>
    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>">
        <?=$row["joker"]?>
      </a>
    </td>
    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>">
        <?=$row["spent"]?>
      </a>
    </td>
    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>">
        <?=nl2br($row["bossNames"])?>
      </a>
    </td>
  </tr>
    
  <?php
  }
  ?>
    
  </tbody>
</table>