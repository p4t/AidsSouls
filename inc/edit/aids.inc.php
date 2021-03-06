<div id="flex-container-edit-aids">
<?php
  $tables = array("mobs", "boss", "weapons");

  foreach($tables as $table) :
    $mode = $table;
    $table = _GAME . "_" . $table;
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
?>
<a id="<?=ucfirst($table)?>"></a>
<form action="/edit?mode=<?=$mode?>&action=add" method="post">
<table class="edit tablesorter" id="<?=$mode?>">
  <thead>
    <tr>
      <th class="th-h" colspan="4">
        &raquo; <?=ucfirst($mode)?>
      </th>
    </tr>
    <tr>
      <th scope="col" class="text-center">
        <strong>Dice</strong>
        <i class="fas fa-sort"></i>
      </th>
      <th scope="col">
        <strong><?=ucfirst($mode)?></strong>
        <i class="fas fa-sort"></i>
      </th>
      <th scope="col" class="text-center">
        <strong>IMG</strong>
        <!-- <i class="fas fa-sort"></i> -->
      </th>
    </tr>
  </thead>
  <tbody id="sortable-<?=$mode?>">
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>

    <tr id="<?=$table?>-<?=$row[0]?>">
      <td class="text-center number-font cursor-move handle">
        <input type="checkbox" 
               class="checkbox_delete" 
               name="dice[]" 
               value="<?=$row[1]?>"
               data-value="<?=$row[0]?>"
               data-table="<?=$table?>"
        >
        <!--<a href="/edit?mode=<?//$mode?>&ID=<?//$row[0]?>">-->
          <i class="fas fa-expand-arrows-alt fontawesome-small"></i>
            <strong>
              <?=$row[1]?>
            </strong>
        <!--</a>-->
      </td>

      <td class="edit_col">
        <div class="title">
          <a href="/edit?mode=<?=$mode?>&ID=<?=$row[0]?>"><?=$row[2]?></a>
          
          <!-- DELETE -->
          <a data-value="<?=$row[0]?>" data-table="<?=$table?>" class="delete" data-balloon="Löschen" data-balloon-pos="left">
            <i class="fas fa-minus-circle"></i>
          </a>
          
          &nbsp;
          
          <!-- EDIT -->
          <a class="edit-data" href="/edit?mode=<?=$mode?>&ID=<?=$row[0]?>" data-balloon="Edit" data-balloon-pos="left">
            <i class="fas fa-edit"></i>
          </a>
          
        </div>
      </td>
      
      <td class="text-center">       
        <?php
        if ( $table == _GAME . "_weapons" ) {
          $path = sanitizeWeaponsPath ($row[2]);

          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path[2]) ) {
        ?>
            <span class="diceIconPath-font">
              <i class="fas fa-check-circle"></i>
            </span>
            <div class="diceIconPath"><img class="max-width-height" src="<?=$path[2]?>" alt="<?=$path[3]?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">
              <i class="fas fa-times-circle"></i>
            </span>
          <?php
          }
                    
        } else {
          
          $file_name = sanitizeAids($row[2]);
          $path = "/dice/icons/{$file_name}.png";
          
          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path) ) {
          ?>
            <span class="diceIconPath-font">
              <i class="fas fa-check-circle"></i>
            </span>
            <div class="diceIconPath"><img class="max-width-height" src="<?=$path?>" alt="<?=$file_name?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">
              <i class="fas fa-times-circle"></i>
            </span>
          <?php
          }
          
        }
        ?>
      </td>
    </tr>
    <?php ENDWHILE ?>
  </tbody>
</table>

<ul class="text-center">
  <li>
    <label><input type="checkbox" id="checkAll_<?=$mode?>"></label>
    <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="#">
    <input type="text" id="tags-<?=$mode?>" class="edit_input" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="Name" required="required">
  </li>
  <li>
    <input type="submit" value="Submit">
    <span class="checkbox_delete_toggle"><!--style="visibility: hidden;"-->
      <a data-value="<?=$row[0]?>" data-table="<?=$table?>" class="checkbox_delete" data-balloon="Löschen" data-balloon-pos="left">
        <i class="fas fa-minus-circle fa-lg"></i>
      </a>
    </span>
  </li>

</ul>

</form>

<?php
  ENDFOREACH
?>
</div>



<form action="sortable.ajax.php" method="post" name="sortables"> 
  <input type="hidden" name="test-log" id="test-log" /> 
</form>