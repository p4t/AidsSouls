<?php
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
  
  echo "\n";
  echo $row["name"];
  echo '&nbsp;';
  echo '<img src="img/weapon_icon.png" width="41" height="40" alt="Weapon">'; // 71, 70
  echo "\n";
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
  echo "\n";
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

    echo "\n";
    echo '<ul class="aidsListing">';
    echo "\n";

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
      echo "\n";

    }
    echo "<ul>";
    echo "\n";
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



/*
 * Replace Int with Tally Marks
 */
function numberToTally ($i) {
  // $text = str_replace("Cheese", "🧀", $text);
  
  switch ($i) {
      case 1:
          echo "I";
          break;
      case 2:
          echo "II";
          break;
      case 3:
          echo "III";
          break;
      case 4:
          echo "IIII";
          break;
      
      case 5:
          echo "<s>IIII</s>";
          break;
      case 6:
          echo "<s>IIII</s> I";
          break;
      case 7:
          echo "<s>IIII</s> II";
          break;
      case 8:
          echo "<s>IIII</s> III";
          break;
      case 9:
          echo "<s>IIII</s> IIII";
          break;
      case 10:
          echo "<s>IIII</s> <s>IIII</s>";
          break;
      
      case 11:
          echo "<s>IIII</s> <s>IIII</s> I";
          break;
      case 12:
          echo "<s>IIII</s> <s>IIII</s> II";
          break;
      case 13:
          echo "<s>IIII</s> <s>IIII</s> III";
          break;
      case 14:
          echo "<s>IIII</s> <s>IIII</s> IIII";
          break;
      case 15:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s>";
          break;
      
      case 16:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> I";
          break;
      case 17:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> II";
          break;
      case 18:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> III";
          break;
      case 19:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> IIII";
          break;
      case 20:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s>";
          break;
      
      case 21:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> I";
          break;
      case 22:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> II";
          break;
      case 23:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> III";
          break;
      case 24:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> IIII";
          break;
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s>";
          break;
      
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> I";
          break;
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> II";
          break;
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> III";
          break;
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> IIII";
          break;
      case 25:
          echo "<s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s> <s>IIII</s>";
          break;
      
      default:
          echo $i;
  }
  
}



?>