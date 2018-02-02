<?php
define("TIME", date("Y-m-d H:i:s"));

require_once("config.db.php");

//////////////////////////////////// ZUFÄLLIGES ATTRIBUT WÄHLEN WÜRFELN ////////////////////



/*
Get IP
*/
function getRealIpAddr() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}


/*
 * Random Weapons
 */

function randomWeapon ($pdo) {
  
  $section = "weapons";
  $count = pdoCount($pdo, $section);
  // echo "WeaponsCount: " . $count . "<br>";
  
  $weaponRNG   = mt_rand (1, $count);
  // $weaponRNG   = 1; // DEBUG  
  
  $stmt = $pdo->prepare('SELECT name FROM weapons WHERE ID = '.$weaponRNG.' ');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  echo "&nbsp;" . "(" . $row["name"] . ")";
}
	

/*
 * Display rolled dice value as image
 */

function displayDice ($diceValue) {
  // echo '<span data-balloon="'.$diceValue.'" data-balloon-pos="up">';
  echo '<img src="dice/'.$diceValue.'.png" width="100" height="100" alt="'.$diceValue.'">';
  // echo '</span>';
}


/*
 * Display which aids was rolled
 */
function aids ($positive) {
  echo "<strong>" . $positive . "</strong>";
}



/*
 * Display and list content of a specific Aids array (Boss, Mobs, Weapons)
 */
function displayAidsArray ($value) {
  echo '<ul class="aidsListing">';
  foreach ($value as $key => $value) {
    echo '<li>';
    $key = $key + 1;
    echo $key . ": ". $value;
    echo '</li>';
	}
  echo '</ul>';
}


/*
 * Get Content from SQL, query
 */
function displaySQLContent ($pdo, $table) {
    $sql = 'SELECT * FROM '.$table.'';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $countRows = $stmt->rowCount();

    echo '<ul class="aidsListing">';

    while ($row = $stmt->fetch()) { 
      
      echo '<li>';
      
      /* Either use deicmal list via MySQL or list-style CSS */
      /*
      echo $row[0];
      echo ': ';
      */
        
      echo '<a href="edit.php?mode='.$table.'&ID='.$row[0].'" target="_blank" rel="noopener noreferrer">';
      echo $row[1];
      echo '</a>';
      
      echo '</li>';

    }
    echo "<ul>";
}

  
/*
 * Replace Name with Emoji because MySQL sucks
 */
function replaceNameWithEmoji ($emoji) {
  if (($emoji == "Biber")) $emoji = "🐻";
  elseif (($emoji == "Katz")) $emoji = "🐱";
  elseif (($emoji == "Pat")) $emoji = "💩";
  elseif (($emoji == "Bonfire")) $emoji = "🔥";
  return $emoji;
}



/*
 * Replace (Cheese) from field text in DB Table Kills
 */
function replaceCheeseWithEmoji ($text) {
  // $text = str_replace ("Cheese", $text, "🧀");
  $text = str_replace("Cheese", "🧀", $text);
  return $text;
}


/*
 * Count rows from Database for mt_rand(MAX)
 */
function pdoCount ($pdo, $table) {
  return $pdo->query("SELECT count(ID) FROM $table")->fetchColumn();
}

/*
function query ($rowID, $rowName, $table) {
  $stmt = $pdo->query('SELECT '.$rowID.', '.$rowName.' FROM '.$table.'');
}
*/

	

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>\[T]/</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">

  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  var myImages = new Array();
  myImages.push("dice/1.png");
  myImages.push("dice/2.png");
  myImages.push("dice/3.png");
  myImages.push("dice/4.png");
  myImages.push("dice/5.png");
  myImages.push("dice/6.png");
  myImages.push("dice/7.png");
  myImages.push("dice/8.png");
  myImages.push("dice/9.png");
  myImages.push("dice/10.png");
  myImages.push("dice/11.png");
  myImages.push("dice/12.png");

  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function pickimg() {
    document.randimgw12.src = myImages[getRandomInt(0, myImages.length - 1)];
  }
  
  

  
  
</script>


<style>  
  /* DEBUG */
  /*
  * {
    border-style: groove;
    border-color: coral;
    border-width: 1px;
  }
  */
  
  /* MOBILE */
  @media all and (max-width: 800px) {
    html, body, aidsContent, aidsListing {
      font-size: 1.2em;
      border-style: groove;
      border-color: coral;
      border-width: 1px;
    }
  }
</style>	


</head>

<body>
  
  
  

  
  
  
  

<div class="background">


<div class="container">
  <div class="header">
    <!-- <img src="bonfire-trans.gif" alt="Dark Souls Bonfire" width="111" height="124"> -->
    <img src="img/ds2_logo.png" alt="Dark Souls II Aids" width="630" height="80" class="headerImage">
    <!-- <img src="bonfire-trans.gif" alt="Dark Souls Bonfire" width="111" height="124"> -->
    <h4>mit verschärftem AIDS</h4>
  </div>

<div class="content">
<div class="aidscontent">

  <!---
<button data-balloon="Whats up!" data-balloon-pos="up">Hover me!</button> -->

  
  
<h2>MOBS</h2>

<?php

/*******************
* MOBS             *
*******************/
$section = "mobs";
$mobsCount = pdoCount($pdo, $section);
// echo "MobsCount: " . $mobsCount . "<br>";
  
$mobsRNG  = mt_rand (1, $mobsCount);
// $mobsRNG  = 19; // DEBUG to force display weapon
$mobsDice = $mobsRNG;
  
  $stmt = $pdo->prepare('SELECT name FROM mobs WHERE ID = '.$mobsRNG.' ');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>


  
<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($mobsDice); ?>
  </div>
<!--
<div class="bonfire">
  <img src="bonfire-trans.gif" alt="Dark Souls Bonfire" width="111" height="124">
</div>
-->

  <div class="flex-item-aids">
    <span class="aidsText">
      <?= $row["name"]; // display rolled Aids (Handicap) ?>
    </span>
    
    <?php
      if ($mobsRNG >= 18) randomWeapon($pdo); // display random weapon if corresponding Aids was rolled
    ?>
  </div>
</div>
  
<h2>BOSS</h2>

<?php
/*******************
* BOSS             *
*******************/
$section = "boss";
$bossCount = pdoCount($pdo, $section);
// echo "BossCount: " . $bossCount . "<br>";

$bossRNG  = mt_rand (1, $bossCount);
// $bossRNG  = 5; // DEBUG to force display weapon
$bossDice = $bossRNG;
  
  $stmt = $pdo->prepare('SELECT name FROM boss WHERE ID = '.$bossRNG.' ');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($bossDice); ?>
  </div>
  <div class="flex-item-aids">
    <span class="aidsText">
      <?= $row["name"]; // display rolled Aids (Handicap) ?>
    </span>
    
    <?php
      if ($bossRNG == 5) randomWeapon($pdo); // display random weapon if corresponding Aids was rolled
    ?>
  </div>
</div>

<div id="flex-container" class="aidsListing">
  <div class="flex-item">&nbsp;</div>
  <div class="flex-item">
    <button class="button" onClick="window.location.reload()"><span>🎲 Reroll </span></button>
  </div>
  <div class="flex-item">&nbsp;</div>
</div>

</div><!-- EOF aidscontent -->

<hr>

<?php
  
?>

<div id="flex-container" class="aidsListing">
  <div class="flex-item"><h3>Mobs:</h3><?= displaySQLContent($pdo, "mobs") ?></div>
  <div class="flex-item"><h3>Boss:</h3><?= displaySQLContent($pdo, "boss") ?></div>
  <div class="flex-item"><h3>Waffen:</h3><?= displaySQLContent($pdo, "weapons"); ?></div>
</div>

<hr>
  
  
  <div class="killedBosses">
    <h2>Kills</h2>
  <table>
    <thead>
      <tr>
        <th>Kaschber</th>
        <th>Joker</th>
        <th>Ausgegeben</th>
        <th>Kills <span class="edit">[Edit]</span></th>
      </tr>
    </thead>
    <tbody>
      
      
      
<?php
/* Get Boss Kills from SQL, display table */
$sql = 'SELECT * FROM kills';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
      ///////// COIUNT ROEWWWWS FOR RAND()
      
      
      ////////////////////////// COUNT NUMBER OF ENTRY IN TEXTAREA reg MYSQL "bossNames" FOR KILLS/////////////////////////
      
while ($row = $stmt->fetch()) {  
  echo '<tr>';
  
  echo '<td class="emoji">';
  
  echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'" target="_blank" rel="noopener noreferrer" data-balloon="'.$row["name"].'" data-balloon-pos="up">';
  echo replaceNameWithEmoji($row["name"]);
  echo '</a';
  echo '</td>';
  
  echo '<td>';
  echo $row["joker"];
  echo '</td>';
  
  echo '<td>';
  echo $row["spent"];
  echo '</td>';
  
  echo '<td>';
  echo replaceCheeseWithEmoji( nl2br($row["bossNames"]) );
  echo '</td>';
  
  echo '</tr>'; 
}
?>
      
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
  
  
  
  
  
  
<!-- WAFFE BEHALTEN/LEVELN -->
<h2>W12</h2>
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
  
  <div class="flex-item">
    <a href="#" onClick="pickimg();return false;">
      <img src="dice/0.png" name="randimgw12" width="100px" height="100px">
    </a> 
  </div>
  
  <div class="flex-item">&nbsp;</div>
</div>
  

<!-- RERUN -->
<h2>Rerun?</h2>  
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
  
  <div class="flex-item">
    <button class="button" onClick="rerun()"><span class="buttonFont">🎲 Rerun? </span></button>
    <div class="rerunFont" id="rerunroll"></div>

    <script>
    function rerun() {
      
      var rnd = Math.floor((Math.random() * 100) + 1)
      if (rnd == 7 || rnd == 77) {
        
        document.getElementById("rerunroll").innerHTML = "Jo: " + rnd;
      } else {
        document.getElementById("rerunroll").innerHTML = "Nö: " + rnd;

      } 
    }
    </script>  
    
  </div>
  
  <div class="flex-item">&nbsp;</div>
</div>
  
  
<!-- BONFIRE -->
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
  
  <div class="flex-item">
    <a href="#">
      <img src="img/bonfire-trans.gif" alt="Dark Souls Bonfire" width="672" height="824">
    </a>
  </div>
  
  <div class="flex-item">&nbsp;</div>
</div>



  
  
  
  
  
  
</div><!-- EOF Content -->
</div><!-- EOF Container -->

  



</div><!-- EOF background -->

  
  




  
  
</body>
</html>





<?php

// $mobsDice;
// $mobsAids[$mobsRNG];

$file = 'latestAids.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= $mobsDice
          . " - "
          . $bossDice
          . " - "
          . getRealIpAddr()
          . " - "
          . TIME
          . "\n"
          ;

// Write the contents back to the file
file_put_contents($file, $current);
?>