<?php
require_once("config.db.php");

  // $tables = array("mobs", "boss", "weapons");
  $tables = array("mobs", "weapons", "boss");

  foreach ($tables as $table) :
    $table_output = ucfirst($table);
    if ( $table_output == "Weapons" ) $table_output = "Waffen";
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
        
        <label for="ajax_<?=$table?>">
          +&nbsp;<input type="text" id="ajax_<?=$table?>" value="" size="15" autocomplete="off" maxlength="32" placeholder="<?=ucfirst($table)?>">
        </label>
        
        
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