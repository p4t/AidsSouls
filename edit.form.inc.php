<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="/edit?mode=<?= $mode ?>&ID=<?= $_GET["ID"] ?>" method="post" id="edit">
        <ul>
          <li><label>Dice:</label></li>
          <li><input type="number" name="newDice" value="<?=$row["dice"]?>" min="1" max="99" autocomplete="off" placeholder="#" required="required"></li>
          <li><label>Entry:</label></li>
          <li><input type="text" name="newName" value="<?=$row["name"]?>" maxlength="32" required="required"></li>
          <li><input type="text" name="fextra" value="" autocomplete="off" maxlength="99" placeholder="Fextra URL"></li>
          <li><input type="submit" value="Submit"></li>
        </ul>
        <input type="hidden" name="oldDice" value="<?=$row["dice"]?>">
        <input type="hidden" name="oldName" value="<?=$row["name"]?>">
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>