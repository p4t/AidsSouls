<?php
require_once("config.db.php");
require_once("functions.inc.php");

/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/

// $s = preg_replace('![^a-z]!', '', $s); 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="theme-color" content="#3f292b">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>\[T]/</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  // Random image out of 12
  var diceImages = new Array();
  diceImages.push("dice/1.png");
  diceImages.push("dice/2.png");
  diceImages.push("dice/3.png");
  diceImages.push("dice/4.png");
  diceImages.push("dice/5.png");
  diceImages.push("dice/6.png");
  diceImages.push("dice/7.png");
  diceImages.push("dice/8.png");
  diceImages.push("dice/9.png");
  diceImages.push("dice/10.png");
  diceImages.push("dice/11.png");
  diceImages.push("dice/12.png");

  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function pickimg() {
    document.getElementById("randimgw12").src = diceImages[getRandomInt(0, diceImages.length - 1)];
  } 
</script>
  
<script>
  // roll dice 1-100, display yes if dice is either 77 or 7
  function rerun() {

    var rnd = Math.floor((Math.random() * 100) + 1)
    var x   = document.getElementById("rerunroll");

      if (x.style.display === "none") {
          x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    
    // if (rnd > 1) { // DEBUG
    if (rnd == 7 || rnd == 77) {
      document.getElementById("rerunroll").innerHTML = "👍 " + rnd;
    } else {
      document.getElementById("rerunroll").innerHTML = "¯\\_(ツ)_/¯" + "<br>" + rnd;
    } 
  }  
</script> 

</head>

<body>

<div class="container">

  <div class="header">
    <img src="img/ds2_logo.png" alt="Dark Souls II Aids" width="630" height="80" class="headerImage">
    <h4>mit verschärftem AIDS</h4>
  </div>

<div class="content">
  
<div class="aidscontent">

  
<h2>Mobs</h2>
<?php
/*******************
* MOBS             *
*******************/
$section = "mobs";
$mobsCount = pdoCount($pdo, $section);
$mobsRNG  = mt_rand (1, $mobsCount);
$mobsDice = $mobsRNG;

// $mobsRNG  = 20; // DEBUG to force display weapon
// echo "MobsCount: " . $mobsCount . "<br>";
  
$stmt = $pdo->prepare('SELECT name FROM mobs WHERE ID = '.$mobsRNG.' ');
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<div id="flex-container">
  <div class="flex-item">
    <img src="dice/<?= $mobsDice ?>.png" width="100" height="100" alt="<?= $mobsDice ?>">
  </div>

  <div class="flex-item-aids">
    <span class="aidsText">
      <?php
      if ( $mobsRNG == 18 || $mobsRNG == 19 || $mobsRNG == 20 ) {
        randomWeapon($pdo); 
      } else {
        echo $row["name"];
      }
      ?>
    </span>
  </div>
</div>
  
  
<h2>Boss</h2>
<?php
/*******************
* BOSS             *
*******************/
$section = "boss";
$bossCount = pdoCount($pdo, $section);
$bossRNG  = mt_rand (1, $bossCount);
$bossDice = $bossRNG;
// echo "BossCount: " . $bossCount . "<br>";
// $bossRNG  = 5; // DEBUG to force display weapon
  
$stmt = $pdo->prepare('SELECT name FROM boss WHERE ID = '.$bossRNG.' ');
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div id="flex-container-aids">
  <div class="flex-item">
    <img src="dice/<?= $bossDice ?>.png" width="100" height="100" alt="<?= $bossDice ?>">
  </div>
  <div class="flex-item-aids">
    <span class="aidsText">
      <?php
      if ($bossRNG == 5) {
        randomWeapon($pdo);
      } else {
        echo $row["name"];
      }
      ?>
    </span>
  </div>
</div>


  
<div id="flex-container-roll">
  <!-- Reroll / Reload page -->
  <div class="flex-item">
    <button class="button" onClick="window.location.reload()">
      <span>🎲 Reroll </span>
    </button>   
  </div>
  <!-- w12 -->
  <div class="flex-item">
    <a href="#" onClick="pickimg();return false;">
      <img src="dice/0.png" id="randimgw12" width="100" height="100" alt="Dice 0">
    </a>  
  </div>
  <!-- Rerun? -->
  <div class="flex-item">
    <button class="button" onClick="rerun()">
      <span>🎲 Rerun? </span>
    </button>
    <!-- <div id="rerunroll"></div> -->
  </div>
 
</div>
  
<!-- Rerun output -->
<div class="rerunFont" id="rerunroll" style="display: none;"></div>


</div><!-- EOF aidscontent -->

  
  
<hr>

  
  
<div id="flex-container-aidsListing" class="aidsListing">
  <div class="flex-item"><h3>Mobs</h3><?= displaySQLContent($pdo, "mobs") ?></div>
  <div class="flex-item"><h3>Boss</h3><?= displaySQLContent($pdo, "boss") ?></div>
  <div class="flex-item"><h3>Waffen</h3><?= displaySQLContent($pdo, "weapons"); ?></div>
</div>

  
  
<hr>

  
  
<!-- Kills Table -->
<div class="killedBosses">
  <h2>Kills</h2>
  <table>
    <thead>
      <tr>
        <th>Kaschber</th>
        <th>Joker</th>
        <th><s>-</s></th>
        <th>Kills</th>
      </tr>
    </thead>
    <tbody>
           
<?php
/* Get Boss Kills from SQL, display table */
$sql = 'SELECT * FROM kills';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
      ////////////////////////// COUNT NUMBER OF ENTRY IN TEXTAREA reg MYSQL "bossNames" FOR KILLS/////////////////////////
      //// $out .=
      
while ($row = $stmt->fetch()) {
  echo "\n";
  echo '<tr>';
  echo "\n";
  
  echo '<td class="emoji">';
  echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'" target="_blank" rel="noopener noreferrer" data-balloon="'.$row["name"].'" data-balloon-pos="up">';
  echo replaceNameWithEmoji($row["name"]);
  echo '</a>';
  echo '</td>';
  
  echo "\n";
  
  echo '<td>';
  echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'" target="_blank" rel="noopener noreferrer" data-balloon="'.$row["joker"].'" data-balloon-pos="up">';
  echo numberToTally($row["joker"]);
  echo '</a>';
  echo '</td>';
  
  echo "\n";
  
  echo '<td>';
  echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'" target="_blank" rel="noopener noreferrer" data-balloon="'.$row["spent"].'" data-balloon-pos="up">';
  echo numberToTally($row["spent"]);
  echo '</a>';
  echo '</td>';
  
  echo "\n";
  
  echo '<td>';
  echo replaceCheeseWithEmoji( nl2br($row["bossNames"]) );
  echo '</td>';
  
  echo "\n";
  echo '</tr>';
  echo "\n";
}
?>
      
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
  
  
<!-- BONFIRE -->

<div id="flex-container-footer">
  <div class="flex-item">&nbsp;</div>
  
  <div class="flex-item">
    
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    | <a href="edit.php">Edit</a> | 
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    
  </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

<!--
<div class="loader">
    <span></span>
    <span></span>
    <span></span>
</div>
-->

  
</div><!-- EOF Content -->
</div><!-- EOF Container -->

  
</body>
</html>


<?php
/* save all aids to file and DB */

$file = 'latestAids.txt';
$date = date("Y-m-d H:i:s");
$IP = getRealIpAddr();

$current = file_get_contents($file);

$current .= $IP
          . " - "
          . $date
          . " - "
          . $bossDice
          . " - "
          . $mobsDice
          . "\n"
          ;


file_put_contents($file, $current);


//////////////////////////////MYSQL//////////////////
$sql = "INSERT INTO rolls (date, IP, mobs, boss) VALUES (:date, :IP, :mobs, :boss)";
$stmt = $pdo->prepare($sql);                                  
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':IP', $IP, PDO::PARAM_STR);
$stmt->bindParam(':mobs', $mobsDice, PDO::PARAM_INT);
$stmt->bindParam(':boss', $bossDice, PDO::PARAM_INT);
// $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
$stmt->execute();

// Table/Output in edit.php
?>