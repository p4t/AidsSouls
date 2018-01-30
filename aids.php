<?php
define("TIME", date("Y-m-d H:i:s"));

const VERSION = "";
const IP      = "";

// Set up DB and connect
$host     = "127.0.0.1";
$db       = "aids";
$user     = "aids";
$pass     = "kUk3t1%5";
$charset  = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


/*
/*
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
*/

$pdo = new PDO($dsn, $user, $pass);

//$numberOfWeapons
//mysql for mobs etc cms



// const TIME    = "";
// Declare number of mobs and boss aids items
// namespace Vendor\Model;




// würfel wer dran is, würfel ob behalten
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>\[T]/</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  var myImages1 = new Array();
  myImages1.push("dice/1.png");
  myImages1.push("dice/2.png");
  myImages1.push("dice/3.png");
  myImages1.push("dice/4.png");
  myImages1.push("dice/5.png");
  myImages1.push("dice/6.png");

  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function pickimg2() {
    document.randimg.src = myImages1[getRandomInt(0, myImages1.length - 1)];
  }
</script>

<style>  
  /* DEBUG
  * {
    border-style: groove;
    border-color: coral;
    border-width: 1px;
  }
  */
/* MOBILE */
  
</style>	


</head>

<body>

<div class="container">
  <div class="header">
    <img src="img/ds2_logo.png" alt="Dark Souls II Aids" width="630" height="80" class="headerImage">
    <h4>mit verschärftem AIDS</h4>
  </div>

<div class="content">
<div class="aidscontent">

<h2>MOBS</h2>

<?php
/*
Get IP
*/
function getRealIpAddr()
{
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

function randomWeapon ($pdo)
{
  
  unset ($weaponRNG);
  $weaponRNG   = mt_rand (1, 20);
  // $weaponRNG   = 1; // DEBUG  
  
  $stmt = $pdo->prepare('SELECT weaponName FROM weapons WHERE ID = '.$weaponRNG.' ');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  echo "&nbsp;" . "(" . $row["weaponName"] . ")";
}
	

/*
 * Display rolled dice value as image
 */

function displayDice ($diceValue)
{
  echo '<img src="dice/'.$diceValue.'.png" width="100" height="100" alt="'.$diceValue.'"/>';
}


/*
 * Display which aids was rolled
 */
function aids ($positive)
{
  echo "<strong>" . $positive . "</strong>";
}


/*
 * Get Aids Name by ID (Rolled dice value)
 */
function getAidsByID ()
{
  // 
}
 

/*
 * Display and list content of a specific Aids array (Boss, Mobs, Weapons)
 */
function displayAidsArray ($value)
{
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
 * Save 10 latest rolls
 */
function saveRolledAids () {
  // echo "Schniedel";
}


function displaySQLContent ($pdo, $table) {
    $sql = 'SELECT * FROM '.$table.'';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $countRows = $stmt->rowCount();

    echo '<ul class="aidsListing">';

    while ($row = $stmt->fetch()) { 
      // echo  $row[0] . " | " . $row[1] .  "<br/>";

      echo '<li>';
        
      echo $row[0];

      echo ': ';
      
      echo '<a href="edit.php?mode='.$table.'&ID='.$row[0].'" target="_blank" rel="noopener noreferrer">';
      echo $row[1];
      echo '</a>';
      
      echo '</li>';




    }
    echo "<ul>";
}


/*
function query ($rowID, $rowName, $table) {
  $stmt = $pdo->query('SELECT '.$rowID.', '.$rowName.' FROM '.$table.'');
}
*/

  
  
  
	
/*******************
* WEAPONS          *
*******************/

  
  
/*******************
* MOBS             *
*******************/
$mobsRNG  = mt_rand (1, 20);
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
  <div class="flex-item-aids">
    <?= $row["name"]; // display rolled Aids (Handicap) ?>
    
    <?php
      if ($mobsRNG > 16) randomWeapon($pdo); // display random weapon if corresponding Aids was rolled
    ?>
  </div>
</div>


<h2>BOSS</h2>

<?php
/*******************
* BOSS             *
*******************/
$bossRNG  = mt_rand (1, 12);
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
    <?= $row["name"]; // display rolled Aids (Handicap) ?>

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

<?php
/*
foreach ($mobsAids as $key => $value) {
	echo $key." has the value: ". $value;
	echo "<br>";

}
*/
?>

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
  
  <div class="killedBosses">
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

function replaceNameWithEmoji ($emoji) {
  if (($emoji == "Biber")) $emoji = "🐻";
  elseif (($emoji == "Katz")) $emoji = "🐱";
  elseif (($emoji == "Pat")) $emoji = "💩";
  return $emoji;
}


$sql = 'SELECT * FROM kills';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$countRows = $stmt->rowCount();
      
      
      ////////////////////////// COUNT NUMBER OF ENTRY IN TEXTAREA reg MYSQL "bossNames" FOR KILLS/////////////////////////
      
while ($row = $stmt->fetch()) { 
    
  echo '<tr>';
  
  echo '<td class="emoji">';
  echo '<a href="edit.php?mode=kills&ID='.$row["ID"].'" target="_blank" rel="noopener noreferrer">';
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
  echo nl2br($row["bossNames"]);
  echo '</td>';
  
  echo '</tr>';
  
}
?>
      
      
      
      
      
      <!--
      <tr>
        <td class="emoji">
          🐻
        </td>
        <td>5</td>
        <td>5</td>
        <td>Killed Boss</td>
      </tr>
      <tr>
        <td class="emoji">
          🐱
        </td>
        <td>5</td>
        <td>5</td>
        <td>KILLED BOSS</td>
      </tr>
      <tr>
        <td class="emoji">
          💩
        </td>
        <td>5</td>
        <td>5</td>
        <td>KILLED BOSS</td>
      </tr>
      -->

      
      
      
      
      
      
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
</div><!-- EOF Content -->
</div><!-- EOF Container -->

  

  
<?php
  
/*******************
* Keep Weapon      *
*******************/
$keepWeaponRNG  = mt_rand (0, 5);
$keepWeaponDice = $keepWeaponRNG + 1;
?>

<h2>W6</h2>
<div id="flex-container" class="keepWeapon">
  <div class="flex-item">&nbsp;</div>
  <div class="flex-item">
    <!-- JS Random Dice 1-6 -->
    <a href="#" onClick="pickimg2();return false;">
      <img src="dice/0.png" name="randimg" width="100px" height="100px">
    </a> 
  </div>
  <div class="flex-item">&nbsp;</div>
</div>



</body>
</html>
