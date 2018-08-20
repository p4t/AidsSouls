<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );
?>
<h5>Kills</h5>

<div class="killedBosses">
  <table>
    <thead>
      <tr>
        <th>Kaschber</th>
        <th>Kills</th>
        <th>Joker</th>
        <th>Boss</th>
      </tr>
    </thead>
    <tbody>
           
<?php
/* Get Boss Kills from SQL, display table */
$stmt = $pdo->prepare("SELECT * FROM {$GAME}_kills");
$stmt->execute();
      
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
  $joker = $row["joker"] - $row["spent"];
?>
  <tr id="id:<?=$row["ID"]?>:name:<?=$row["name"]?>" onClick="play_audio('<?=$row["name"]?>')"><!-- contenteditable="true" -->
    <td class="emoji">
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["name"]?>" data-balloon-pos="up"><?=replaceNameWithEmoji( $row["name"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["joker"]?> Bosse besiegt" data-balloon-pos="up"><?=numberToTally( $row["joker"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$joker?> Joker übrig" data-balloon-pos="up"><?=replaceIntWithFlasks( $joker )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=replaceBrWithComma( $row["bossNames"] )?>" data-balloon-pos="up" data-balloon-length="xlarge">
        <?php // replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?>
        <ul class="killsList">
          <li>
            <?=replaceCheeseWithEmoji( replaceLineBreakWithList($row["bossNames"]) )?>
            <?php // wordwrap()??? ?>
          </li>
        </ul>
      </a>
    </td>
  </tr>
<?php
ENDWHILE
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->