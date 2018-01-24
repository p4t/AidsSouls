<?php
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>\[T]/</title>

<link rel="stylesheet" href="layout.css" type="text/css" media="screen" />

<link rel="stylesheet"
	  href="https://fonts.googleapis.com/css?family=Tangerine">
<style>
  body {
	font-family: 'Lato', sans-serif;
	font-size: 48px;
  }
</style>	

</head>

<body>

<div class="container">
<div class="content">
	
<h5>Roll a dice to get <a href="https://youtu.be/uA-MoS9FZHQ?t=9s"> (((AAAAIIIIIIDDDSSSSS)))</a> <span style="font-size: 40%">in Dark Souls</span></h5>
	
<h1>MOBS</h1>

<?php
/*
Random Weapon
*/
function randomWeapon () {
	unset ($weaponRNG);
	$weaponRNG   = rand (0, 19);
	$weaponDice  = $weaponRNG + 1;
	$arrlength   = count($weaponArray); // TODO
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
	echo "(" . $weaponArray[$weaponRNG] . ")";
}
	
/*
Display rolled dice value as image
*/
function displayDice ($diceValue) {
	echo '<img src="dice/'.$diceValue.'.png" width="100" height="100" alt=""/>';
	//echo "<br>";
}

/*
Display which aids was rolled
*/
function aids ($positive) {
	echo $positive;
}

function displayAidsArray ($value) {
	$arrlength = count($value);

	for($x = 0; $x < $arrlength; $x++) {
		echo $value[$x];
		echo "<br>";
	}	
}
	


/* MOBS */
$mobsRNG  = rand (0, 19);
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
				  "Zufällig gewürfelte Waffe: ",
				  "Zufällig gewürfelte Waffe: ",
				  "Zufällig gewürfelte Waffe: ",
				  "Zufällig gewürfelte Waffe: "				  
				 );

	
displayDice($mobsDice);
//echo $mobsAids[$mobsRNG];
aids($mobsAids[$mobsRNG]);

// MOBS random weapon
if ($mobsRNG > 15) randomWeapon();
?>

<h1>BOSS</h1>

<?php
/* BOSS */
$bossRNG  = rand (0, 11);
$bossDice = $bossRNG + 1;
$bossAids = array("Ohne Schild",
				  "Ohne Flask",
				  "Ohne Rüstung",
				  "Fatroll",
				  "Zufällig gewürfelte Waffe: ",
				  "Waffe linke Hand",
				  "Nur RT",
				  "Lumbe",
				  "Normal",
				  "Ohne Ringe",
				  "Ohne Alles",
				  "Crap Ringe"		  
				 );
	
	
displayDice($bossDice);
//echo $bossAids[$bossRNG];
aids($bossAids[$bossRNG]);

// BOSS random weapon
if ($bossRNG == 4) randomWeapon();

?>


<p>&nbsp;</p>
<p>&nbsp;</p>

<input type="button" value="Reroll" onClick="window.location.reload()">

<p>&nbsp;</p>

<section>
	<div class="floatleft"><?php displayAidsArray($mobsAids); ?></div>
	<div class="floatright"><?php displayAidsArray($bossAids); ?></div>
	<div class ="clearfloat">&nbsp;</div>
</section>


	
<h4>TEST</h4>
<?php
foreach ($mobsAids as $key => $value) {
	echo $key." has the value: ". $value;
	echo "<br>";

}
?>

</div><!-- EOF Content -->
</div><!-- EOF Container -->
	
</body>
</html>




<?php


/*
$arrlength = count($mobsAids);

for($x = 0; $x < $arrlength; $x++) {
    echo $mobsAids[$x];
    echo "<br>";
}
*/
?>
