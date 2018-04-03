<a id="Todo"></a>

<table class="edit">
  <tbody>
    <tr>
      <th scope="col"><strong>Todo</strong></th>
    </tr>
    
  <?php
  $sql = "SELECT * FROM todo";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  ?>

  <tr>
    <td>
      <a href="edit.php?mode=todo&ID=<?=$row["ID"]?>">
        <?=nl2br($row["todoText"])?>
      </a>
    </td>
  </tr>
    
  <?php
  }
  ?>
    
  </tbody>
</table>