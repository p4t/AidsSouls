<?php
require_once("config.db.php");

  // $tables = array("mobs", "boss", "weapons");
  $tables = array("mobs", "boss", "weapons");

  foreach ($tables as $table) :
    $table_output = ucfirst($table);
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
  ?>
    
      <div class="flex-item-aidsListing">
        <h3><?=$table_output?></h3>
        <ul id="<?=$table?>" class="aidsList">
          <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
          <li id="table:<?=$table?>:id:<?=$row[0]?>" contenteditable="true">
            <?=$row[2]?>
          </li>    
          <?php ENDWHILE ?>
        </ul>
      </div><!-- EOF .flex-item-aidsListing -->
    
  <?php
    ENDFOREACH
  ?>



<?php
// BACKUP
  /*
            <li>
            <a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>" target="_blank">
              <?=$row[2]?>
            </a>
          </li>  
  
  */
?>