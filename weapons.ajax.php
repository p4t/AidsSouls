<?php
require_once("config.db.php");

$table        = "weapons";
$table_output = "Waffen";

$stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
$stmt->execute();
?>

<div id="ajax">
  <div class="flex-item-aidsListing">
    <h3><?=$table_output?></h3>
    <ul class="aidsList">
      <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
      <li>
        <a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>" target="_blank">
          <?=$row[2]?>
        </a>
      </li>
      <?php ENDWHILE ?>
      <li class="noListStyle" data-tip="Max 32 Chars, hit Enter">
        <a href="/edit" target="_blank">+</a>  
      </li>
    </ul>
  </div>
</div>