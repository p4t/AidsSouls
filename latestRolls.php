<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );
?>

<!--
<div class="message">
  <div class="message_line">
-->
<div>
  <div class="row">
    <div class="col"><h6>Mobs:</h6></div>
    <div class="col"><h6>Boss:</h6></div>
  </div>
  <?php
  $data = $pdo->query("SELECT mobs, boss FROM rolls WHERE mobs != '' AND boss != '' AND gameID = $GAMEID ORDER BY ID DESC LIMIT 1, 4")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data as $value) :
  // formatDate($value["date"])
  ?>
  <div class="row">
    <div class="col"><?=$value["mobs"]?></div>
    <div class="col"><?=$value["boss"]?></div>
  </div>
  <?php
  ENDFOREACH
  ?>
</div>
<!--
  </div>
</div>
-->