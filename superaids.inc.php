<?php
require_once("config.db.php");
require_once("functions.inc.php");

/*******************
* AIDS             *
*******************/
// MOBS
$mobsCount  = pdoCount("mobs");
$mobsRNG    = mt_rand (1, $mobsCount);

// Boss
$bossCount  = pdoCount("boss");
$bossRNG    = mt_rand (1, $bossCount);

$stmt = $pdo->prepare("SELECT mobs.name, boss.name FROM mobs, boss WHERE mobs.dice = $mobsRNG AND boss.dice = $bossRNG");
$stmt->execute();
$rowSuperAids = $stmt->fetch(PDO::FETCH_GROUP);

$mobsSuperAids = $rowSuperAids[0];
$bossSuperAids = $rowSuperAids[1];
?>

<span class="superaids">
  <?=$mobsSuperAids?>
</span>

<span class="superaids">
  <?=$bossSuperAids?>
</span>