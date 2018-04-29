<?php
  // Lib
/*
  require_once("config.db.php");
  require_once("functions.inc.php");

  $tables = array("mobs", "boss", "weapons");

  foreach($tables as $table) :
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
?>
<a id="<?=ucfirst($table)?>"></a>
<form action="/edit?mode=<?=$table?>&action=add" method="post">
<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="3">
        &raquo; <?=ucfirst($table)?>
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Dice</strong></th>
      <th scope="col"><strong><?=ucfirst($table)?></strong></th>
      <th scope="col"><strong>IMG</strong></th>
      <!-- <th scope="col" class="edit_action"><strong>...</strong></th> -->
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
    <tr>
      <td>
        <?=$row[0]?>
      </td>
      <td><a href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[1]?></a></td>
      <td class="edit_col">
        <div class="title">
          <a href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[2]?></a>
          <!-- DELETE -->
          <!-- <a data-value="<?php //$row1['id'];?>" class="remove_file">Delete</a> -->
          <!-- href="/edit?mode=<?php //$table?>&action=delete&ID=<?php //$row[0]?>" -->
          <!-- onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" -->
          <a data-value="<?=$row[0]?>" data-table="<?=$table?>" class="delete" data-balloon="Löschen" data-balloon-pos="left">
            <img src="/img/delete-icon.png" width="20" height="20" alt="Delete">
          </a>
          <!-- EDIT -->
          <a class="edit-data" href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>" data-balloon="Edit" data-balloon-pos="left">
            <img src="/img/edit-icon.png" class="edit_icon" width="20" height="20" alt="Edit">
          </a>
        </div>
      </td>
      <td>       
        <?php
        if ( $table == "weapons" ) {
          $path = sanitizeWeaponsPath ($row[2]);

          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path[2]) ) {
        ?>
            <span class="diceIconPath-font">&#10004;</span>
            <div class="diceIconPath"><img src="<?=$path[2]?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">&times;</span>
          <?php
          }
                    
        } else {
          
          $file_name = sanitizeAids($row[2]);
          $path = "/dice/icons/{$file_name}.png";
          //echo $path;
          
          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path) ) {
          ?>
            <span class="diceIconPath-font">&#10004;</span>
            <div class="diceIconPath"><img src="<?=$path?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">&times;</span>
          <?php
          }
          
        }
        ?>
      </td>
    </tr>
    <?php ENDWHILE ?>
    <tr>
      <td colspan="3">
        <ul>
          <li>
            <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="#">
            <input type="text" class="edit_input" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="Name" required="required">
            <input type="submit" value="Submit">
          </li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>
</form> 
  
<?php
  ENDFOREACH
?>




