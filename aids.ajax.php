<?php
require_once("config.db.php");
require_once("functions.inc.php");
require_once("globals.inc.php");

  // $tables = array("mobs", "boss", "weapons");
  $tables = array("mobs", "boss", "weapons");

  foreach ($tables as $table) :
    $mode = $table;
    $table = _GAME . "_" . $table;

    $table_output = ucfirst($mode);
    if ( $table_output == "Weapons" ) $table_output = "Waffen";
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
  ?>
    
      <div class="flex-item-aidsListing">
        <h3><?=$table_output?></h3>
        <ul id="<?=$table?>" class="aidsList">
          <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
          
          <!-- DELETE -->
          <a data-value="<?=$row[0]?>" class="aidsListAjaxDel" data-table="<?=$table?>" data-balloon="Löschen" data-balloon-pos="right">
            <img src="/img/delete-icon.png" width="20" height="20" alt="Delete">
          </a>
          
          <!-- List Item -->
          <li id="table:<?=$table?>:id:<?=$row[0]?>" data-autocomplete="<?=$mode?>" contenteditable="true">
            <?=$row[2]?>
          </li>
          <?php ENDWHILE ?>
        </ul>
        
        <label for="ajax_<?=$mode?>">
          <span data-balloon="<?=$table_output?> hinzufügen" data-balloon-pos="down">
            +
          </span>
          &nbsp;
          <input type="text" id="ajax_<?=$mode?>" name="ajax_<?=$mode?>" data-jQAutocomplete="<?=$mode?>" size="15" autocomplete="off" maxlength="32" placeholder="<?=ucfirst($table_output)?>">
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

  <!-- jQuery Form: Add Mobs, Boss, Weapons -->
  <!-- <form id="form" method="post" onsubmit="return false"> -->
    <!-- <div id="flex-container-ajax-form"> -->
      
      <!-- Mobs -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_mobs">
          +&nbsp;<input type="text" id="ajax_mobs" value="" size="15" autocomplete="off" maxlength="32" placeholder="Mobs">
        </label>
      </div>
      -->
      
      <!-- Boss -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_boss">
          +&nbsp;<input type="text" id="ajax_boss" value="" size="15" autocomplete="off" maxlength="32" placeholder="Boss">
        </label>
      </div>
      -->
      
      <!-- Weapons -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_weapons">
          +&nbsp;<input type="text" id="ajax_weapons" value="" size="15" autocomplete="off" maxlength="32" placeholder="Waffen">
        </label>
      </div>
      -->
      <!-- </form> -->
      
    <!-- </div> -->