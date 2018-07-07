<a id="Config"></a>
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
    </tr>
  </thead>
  
  <tbody class="toggleTable">  
    <?php
    $sql = "SELECT * FROM games";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    ?> 
    <tr>    
      <td><?=$row["ID"]?></td>

        <td class="edit_col">
          <div class="title">
            <a href="/edit?mode=config&item=games&ID=<?=$row["ID"]?>"><?=$row["name"]?></a>

            <!-- DELETE -->
            <!--
            <a data-value="<?php//$row[0]?>" data-table="<?php//$table?>" class="delete" data-balloon="Löschen" data-balloon-pos="left">
              <i class="fas fa-minus-circle"></i>
            </a>
            -->

            &nbsp;

            <!-- EDIT -->
            <a class="edit-data" href="/edit?mode=config&item=games&ID=<?=$row["ID"]?>" data-balloon="Edit" data-balloon-pos="left">
              <i class="fas fa-edit"></i>
            </a>

          </div>
        </td>

      <td><?=$row["abbr"]?></td>
      <td><?=$row["active"]?></td>
      <td><?=$row["ng+"]?></td>
    </tr>

    <?php
    }
    ?>

    <tr>
      <td colspan="6">
        <a href="edit.php?action=schnagges" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-balloon="Tabelle leeren" data-balloon-pos="up">Leeren</a>
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