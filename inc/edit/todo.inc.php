<a id="Todo"></a>

<table class="edit">
  <thead onclick="toggleTable()">
    <tr>
      <th class="th-h accordion">
        &raquo;&nbsp;Todo&nbsp;<span class="toggleTableIndicatorPlus">+</span><span class="toggleTableIndicatorMinus">-</span>
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>Todo</strong></th>
    </tr>
  </thead>
  <tbody class="toggleTable">
    
  <?php
  $sql = "SELECT * FROM {$GAME}_todo";
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