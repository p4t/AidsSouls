<?php
// ini_set('error_reporting', E_ALL);
const VERSION   = '1.0';
const IP = '';
// namespace Vendor\Model;
// TIME
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>\[T]/</title>

<link rel="stylesheet" href="layout.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">

<style>
  body {
    font-family: 'Lato', sans-serif;
    font-size: 24px;
  }
  * {
    /*
    border-style: groove;
    border-color: coral;
    border-width: 1px;
    */
  }
</style>	

</head>

<body>

<div class="container">
  <div class="header">
    <h1>Roll a dice to get <a href="https://youtu.be/uA-MoS9FZHQ?t=9s" target="_blank" rel="noopener noreferrer"> (((AAAAIIIIIIDDDSSSSS)))</a> <span style="font-size: 25%">in Dark Souls</span></h1>
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
  echo $weaponArray[$weaponRNG];
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
  echo $positive;
}

  
  
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
//$mobsRNG  = 19; // DEBUG
$mobsDice = $mobsRNG + 1;
$mobsAids = array("Ohne Schild",
                  "Ohne Flask",
                  "Ohne Rüstung",
                  "Fatroll",
                  "Parry if you can (Lumbe)",
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
                  "Zufällig gewürfelte Waffe",
                  "Zufällig gewürfelte Waffe",
                  "Zufällig gewürfelte Waffe",
                  "Zufällig gewürfelte Waffe"				  
                 );

?>

<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($mobsDice); ?>
  </div>
  <div class="flex-item">
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
//$bossRNG  = 4; // DEBUG
$bossDice = $bossRNG + 1;
$bossAids = array("Ohne Schild",
                  "Ohne Flask",
                  "Ohne Rüstung",
                  "Fatroll",
                  "Zufällig gewürfelte Waffe",
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
  <div class="flex-item">
    <?php
      aids($bossAids[$bossRNG]); // display rolled Aids (Handicap)
      if ($bossRNG == 4) randomWeapon($weaponArray); // display random weapon if corresponding Aids was rolled
    ?>
  </div>
</div>


<div id="flex-container" class="aidsListing">
  <div class="flex-item"></div>
  <div class="flex-item">
    <button class="button" onClick="window.location.reload()"><span>🎲 Reroll </span></button>
  </div>
  <div class="flex-item"></div>
</div>



</div><!-- EOF aidscontent -->

<div id="flex-container" class="aidsListing">
  <div class="flex-item"><h3>Mobs:</h3><?= displayAidsArray($mobsAids); ?></div>
  <div class="flex-item"><h3>Boss:</h3><?= displayAidsArray($bossAids); ?></div>
  <div class="flex-item"><h3>Waffen:</h3><?= displayAidsArray($weaponArray); ?></div>
</div>


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
          . $mobsAids[$mobsRNG]
          . " - "
          . $bossDice
          . $bossAids[$bossRNG]
          . " - "
          . getRealIpAddr()
          . "\n"
          ;
  // time

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
        <td>
          <span class="emoji">🐻</span>
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
        <td>
          <span class="emoji">🐱</span>
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
        <td>Pat</td>
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
        <td>Bonfire Ascetic</td>
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
  <div class="flex-item">LINKS</div>
  <div class="flex-item">MITTE</div>
  <div class="flex-item">RECHTS</div>
</div>



</body>
</html>

<?php

/*
$host = '127.0.0.1';
$db   = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);


$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch())
{
    echo $row['name'] . "\n";
}
*/




/*
$arrlength = count ($mobsAids);

for ($x = 0; $x < $arrlength; $x++) {
    echo $mobsAids[$x];
    echo "<br>";
}
*/

	/*
	$arrlength = count($value);
	for($x = 0; $x < $arrlength; $x++) {
		echo $value[$x];
		echo "<br>";
	}
	*/
?>
