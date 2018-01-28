<?php
define("TIME", date("Y-m-d h:i:s"));

const VERSION = "";
const IP      = "";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  /*
  jQuery(document).ready(function(){
   $('h1').mousemove(function(e){
     var rXP = (e.pageX - this.offsetLeft-$(this).width()/2);
     var rYP = (e.pageY - this.offsetTop-$(this).height()/2);
     $('h1').css('text-shadow', +rYP/10+'px '+rXP/80+'px rgba(227,6,19,.8), '+rYP/8+'px '+rXP/60+'px rgba(255,237,0,1), '+rXP/70+'px '+rYP/12+'px rgba(0,159,227,.7)');
   });
  });
  */
</script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">

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
    <img src="ds2_logo.png" alt="Dark Souls II Aids" width="630" height="80" class="headerImage">
    <h4>mit verschärftem AIDS</h4>
  </div>

<div class="content">
<div class="aidscontent">

<h2>MOBS</h1>

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
Random Weapon
*/
function randomWeapon ($weaponArray)
{
  unset ($weaponRNG);
  $weaponRNG   = mt_rand (0, 19);
  // $weaponRNG   = 19; // DEBUG
  // return $weaponDice  = $weaponRNG + 1;
  echo "&nbsp;" . "(" . $weaponArray[$weaponRNG] . ")";
}
	
/*
Display rolled dice value as image
*/
function displayDice ($diceValue)
{
  echo '<img src="dice/'.$diceValue.'.png" width="100" height="100" alt="'.$diceValue.'"/>';
}


/*
Display which aids was rolled
*/
function aids ($positive)
{
  echo "<strong>" . $positive . "</strong>";
}

/*
Get Aids Name by ID (Rolled dice value)
*/
function getAidsByID ()
{
  // 
}
 

/*
Display and list content of a specific Aids array (Boss, Mobs, Weapons)
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
Save 10 latest rolls
*/
function saveRolledAids () {
  // echo "Schniedel";
}



	
/*******************
* WEAPONS          *
*******************/
$weaponArray = array("Gyrm Axe",
                     "Flamberge",
                     "Bluemoon",
                     "Mastadon Greatsword",
                     "Lucerne",
                     "Sentier's Spear",
                     "Battle Axe",
                     "Craftman's Hammer",
                     "Uschi",
                     "Large Club",
                     "Pat's Spear",
                     "Old Knight halberd",
                     "Murokumo",
                     "Dark Scythe",
                     "Old Knight Pike",
                     "Royal Greatsword",
                     "Malformed Skull",
                     "Claws",
                     "Great Scythe",
                     "Black Knight Halberd"
                    );


/*******************
* MOBS             *
*******************/
$mobsRNG  = mt_rand (0, 19);
//$mobsRNG  = 19; // DEBUG to force display weapon
$mobsDice = $mobsRNG + 1;
$mobsAids = array("Ohne Schild",
                  "Ohne Flask",
                  "Ohne Rüstung",
                  "Fatroll",
                  "Parry/Lumbe",
                  "Waffe linke Hand",
                  "Nur RT",
                  "Ohne Backstab, Riposte",
                  "Crap Waffe",
                  "Ohne Ringe",
                  "Ohne Alles",
                  "Crap Ringe",
                  "Normal",
                  "Normal",
                  "Normal",
                  "Normal",
                  "Zufällige Waffe",
                  "Zufällige Waffe",
                  "Zufällige Waffe",
                  "Zufällige Waffe"				  
                 );

?>

<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($mobsDice); ?>
  </div>
  <div class="flex-item-aids">
    <?php
      aids($mobsAids[$mobsRNG]); // display rolled Aids (Handicap)
      if ($mobsRNG > 15) randomWeapon($weaponArray); // display random weapon if corresponding Aids was rolled
    ?>
  </div>
</div>


<h2>BOSS</h1>

<?php
/*******************
* BOSS             *
*******************/
$bossRNG  = mt_rand (0, 11);
//$bossRNG  = 4; // DEBUG to force display weapon
$bossDice = $bossRNG + 1;
$bossAids = array("Ohne Schild",
                  "Ohne Flask",
                  "Ohne Rüstung",
                  "Fatroll",
                  "Zufällige Waffe",
                  "Waffe linke Hand",
                  "Nur RT",
                  "Lumbe",
                  "Normal",
                  "Ohne Ringe",
                  "Ohne Alles",
                  "Crap Ringe"		  
                 );
?>


<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($bossDice); ?>
  </div>
  <div class="flex-item-aids">
    <?php
      aids($bossAids[$bossRNG]); // display rolled Aids (Handicap)
      if ($bossRNG == 4) randomWeapon($weaponArray); // display random weapon if corresponding Aids was rolled
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

<div id="flex-container" class="aidsListing">
  <div class="flex-item"><h3>Mobs:</h3><?= displayAidsArray($mobsAids); ?></div>
  <div class="flex-item"><h3>Boss:</h3><?= displayAidsArray($bossAids); ?></div>
  <div class="flex-item"><h3>Waffen:</h3><?= displayAidsArray($weaponArray); ?></div>
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
          . $mobsAids[$mobsRNG]
          . " - "
          . $bossDice
          . " - "
          . $bossAids[$bossRNG]
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
        <th>Kills</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="emoji">
          🐻
        </td>
        <td>IIII</td>
        <td>IIII</td>
        <td>
          <ul class="killedBosses">
            <li>The Last Giant</li>
            <li>Old Dragonslayer</li>
            <li>Flexible Sentry</li>
            <li>Belfry Gargoyles</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td class="emoji">
          🐱
        </td>
        <td><s>IIII</s> II</td>
        <td>IIII</td>
        <td>
          <ul class="killedBosses">
            <li>The Lost Sinner</li>
            <li>Skeleton Lords</li>
            <li>Covetous Demon</li>
            <li>Royal Rat Authority</li>
            <li>Dragonriderz</li>
            <li>Demon of Song</li>
            <li>Velstadt, the Royal Aegis</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td class="emoji">
          💩
        </td>
        <td><s>IIII</s> <s>IIII</s></td>
        <td><s>IIII</s> II</td>
        <td>
          <ul class="killedBosses">
            <li>Dragonrider</li>
            <li>The Pursuer</li>
            <li>Ruin Sentinels (wegen Biber)</li>
            <li>Scorpioness Najka</li>
            <li>Mytha the Baneful Queen</li>
            <li>Smelter Demon</li>
            <li>Old Iron King</li>
            <li>Prowling Magus &amp; Congregation</li>
            <li>The Duke's Dear Freja</li>
            <li>Looking Glass Knight</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td class="emoji">
          🔥
          <!-- <img src="bonfire_ascetic.png"> -->
        </td>
        <td><s>IIII</s></td>
        <td>IIII</td>
        <td>
          <ul class="killedBosses">
            <li>Rotten</li>
            <li>+1</li>
            <li>+2</li>
            <li>+3</li>
            <li>+4</li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
</div><!-- EOF killedBosses -->

</div><!-- EOF Content -->
</div><!-- EOF Container -->

  

  
  
<div id="flex-container">
  <div class="flex-item"></div>
  <div class="flex-item">16px Schniedel</div>
  <div class="flex-item"></div>
</div>

</body>
</html>

<?php

// Set up DB and connect
$host     = "127.0.0.1";
$db       = "aids";
$user     = "aids";
$pass     = "kUk3t1%5";
$charset  = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = "";
/*
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
*/
// $pdo = new PDO($dsn, $user, $pass, $opt);

/*
$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch())
{
    echo $row['name'] . "\n";
}
*/


?>