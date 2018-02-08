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
  
  // return $weaponRNG;
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
    
    /*
    $stmt = $pdo->prepare('SELECT name FROM weapons WHERE ID = '.$weaponRNG.' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    */
  
    // $countRows = $stmt->rowCount();

    echo "\n";
    echo '<ul class="aidsListing">';
    echo "\n";

    while ($row = $stmt->fetch(PDO::FETCH_NUM)) { 
      
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
    echo "</ul>";
    echo "\n";
}

  
/*
 * Replace Name with Emoji because MySQL sucks
 */
function replaceNameWithEmoji ($emoji) {
  if ($emoji == "Biber") $emoji = "🐻";
  elseif ($emoji == "Katz") $emoji = "🐱";
  elseif ($emoji == "Pat") $emoji = "💩";
  elseif ($emoji == "Bonfire") $emoji = "🔥";
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


/*
 * Format date, strtotime
 */
function formatDate ($date) {
  $date = strtotime ($date);
  $date = date("d.m.Y H:i:s", $date);
  return $date;
}
























/***************************
*
* EDIT.PHP
*
*****************************/


/*
* Sanitize Query
*/
function buildQuery ($get_var) {
    switch ($get_var) {
      case "weapons":
        $tbl = 'weapons';
      break;
      case "mobs":
        $tbl = 'mobs';
      break;
      case "boss":
        $tbl = 'boss';
      break;
    }

    $sql = "SELECT * FROM $tbl";
} 


/*
* Clean String
*/
function clean_string ($string) {
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
}


/*
* redirect back to given URL, statuscode = 303
*/
function redirect($url, $statusCode) {
  header('Location: ' . $url, true, $statusCode);
  die();
}


 
/*
* Update MySQL Table via PDO (mobs, boss, weapons)
*/  
function pdoUpdateTable ($pdo, $table, $post, $ID) {
  $sql = "UPDATE ".$table." SET name = :name WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(':name', $post, PDO::PARAM_STR);
  $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
  $stmt->execute();
}
  

/*
* Display given table as HTML <table>
*/
function displaySQLContentAsTable ($pdo, $table) {

  echo '<div class="flex-item-edit">';
  echo '<table>';
  echo '<tbody>';
  echo '<tr>';
  echo '<th scope="col">ID</th>';
  echo '<th scope="col">'.ucfirst($table).'</th>';
  echo '</tr>';
  echo '<tr>';

  $sql = 'SELECT * FROM '.$table.'';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  // $countRows = $stmt->rowCount();

  while ($row = $stmt->fetch(PDO::FETCH_NUM)) { 

    echo '<tr>';

    echo '<td>';
    echo $row[0];
    echo '</td>';

    echo '<td>';
    echo '<a href="edit.php?mode='.$table.'&ID='.$row[0].'">';
    echo $row[1];
    echo '</a>';
    echo '</td>';

    echo '</tr>';
  }
  
  
  echo '<td>';
  echo '<label>Add: </label>';
  echo '</td>';
  
  echo '<td>';
  
  /* <INPUT> FOR ADDING ENTRIES*/
  echo '<form action="edit.php?mode='.$table.'&action=add" method="post">';
  
  echo '<input type="text" name="addEntry" value="">';
  echo '<br>';
  echo '<input type="submit" value="Submit">';
  echo '</form>';
  
  echo '</td>';


  echo '</tr>';
  echo '</tbody>';
  echo '</table>';

  echo '</div>'; 
}


/*
* Delete single entry from Database
*/
function pdoDelete ($pdo, $table, $post, $ID) {
  $sql = "UPDATE ".$table." SET name = :name WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(':name', $post, PDO::PARAM_STR);
  $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
  $stmt->execute();
}
?>