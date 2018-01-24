<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>\[T]/</title>
</head>

<body>
	
<h1>MOBS</h1>

<?php
/* WEAPON FUNCTION */
function randomWeapon () {
	unset ($weaponRNG);
	$weaponRNG   = rand (0, 19);
	$weaponDice  = $weaponRNG + 1;
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

/* MOBS */
$mobsRNG  = rand (0, 19);
// $mobsRNG  = 17; //debug 
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

echo "MobsWürfel: " . $mobsDice . "<br>" . $mobsAids[$mobsRNG];

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
				  "Normal (Effigy)",
				  "Ohne Ringe",
				  "Ohne Alles",
				  "Crap Ringe"		  
				 );
	
echo "BossWürfel: " . $bossDice . "<br>" . $bossAids[$bossRNG];


// BOSS random weapon
if ($bossRNG == 4) randomWeapon();

?>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<input type="button" value="Reroll" onClick="window.location.reload()">

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
