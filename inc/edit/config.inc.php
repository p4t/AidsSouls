<a id="Games"></a>
<form action="/edit?mode=games&action=add" method="post">

<table class="edit">
  <thead onclick="toggleTable()">
    <tr>
      <th class="th-h accordion" colspan="6">
        &raquo;&nbsp;Games&nbsp;<span class="toggleTableIndicatorPlus">+</span><span class="toggleTableIndicatorMinus">-</span>
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Name</strong></th>
      <th scope="col"><strong>Abbr</strong></th>
      <th scope="col"><strong>Active</strong></th>
      <th scope="col"><strong>NG+</strong></th>
      <th scope="col"><strong>BG IMG</strong></th>
    </tr>
  </thead>
  
  <tbody class="toggleTable">  
    <?php
    $sql = "SELECT * FROM games";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Check if DB Tables exist
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?> 
    <tr id="games-<?=$row["ID"]?>" <?=($row["active"] == 1) ? "class='active_game'" : ""?>>
      
      <td><?=$row["ID"]?></td>

        <td class="edit_col">
          <div class="title">
            <a href="/edit?mode=config&item=games&ID=<?=$row["ID"]?>"><?=$row["name"]?></a>

            <?php
            if ( $row["ID"] > 6 && $row["active"] != 1 ) { // only show delete icon if game is no active and not preexisting SoulsBorne
            ?>
            <!-- DELETE -->
            <a data-value="<?=$row["ID"]?>" data-table="games" class="delete" data-balloon="Löschen" data-balloon-pos="left">
              <i class="fas fa-minus-circle"></i>
            </a>
            <?php
            }
            ?>

            &nbsp;

            <!-- EDIT -->
            <a class="edit-data" href="/edit?mode=config&item=games&ID=<?=$row["ID"]?>" data-balloon="Edit" data-balloon-pos="left">
              <i class="fas fa-edit"></i>
            </a>

          </div>
        </td>

      <td><?=$row["abbr"]?></td>
      <td><?=$row["active"]?></td>
      <td><?=$row["ngp"]?></td>
      <td>X</td>
    </tr>

    <?php
    }
    ?>

    <tr>
      <td colspan="6">
        <label>Duplicate Game:</label>
          <select id="duplicateGame" name="duplicateGame">
            <option selected></option>
            <?php
            $data = getGames();

            foreach ($data as $value) {
            ?>
            <option value="<?=$value["abbr"]?>"><?=$value["name"]?></option>
            <?php
            }
            ?>
          </select>
      </td>
    </tr>

  </tbody>
  
</table>

<ul class="text-center">
  <li>
    <!-- <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="#"> -->
    <input type="text" id="game" class="edit_input" name="addGame" value="" autocomplete="off" maxlength="32" placeholder="Game" required="required">
    <input type="text" id="abbr" class="edit_input" name="addAbbr" value="" autocomplete="off" maxlength="5" placeholder="Abbr" required="required">
  </li>
  <li><input type="submit" value="Submit"></li>
</ul>

</form>