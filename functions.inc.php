<?php
/***************************
*
* AIDS.PHP
*
*****************************/


/*
Get IP
*/
function getRealIpAddr() {
  if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
  }
  elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
  }
  else {
    $ip = $_SERVER["REMOTE_ADDR"];
  }
  return $ip;
}


/*
 * Random Weapons
 */
function randomWeapon () {
  global $pdo;
  $section    = "weapons";
  $count      = pdoCount($section);
  $weaponRNG  = mt_rand (1, $count);
  // echo "(" . $weaponRNG . ")";
  // $weaponRNG  = 21;
  
  $stmt = $pdo->prepare("SELECT * FROM weapons WHERE dice = $weaponRNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  echo $row["name"];
  echo "&nbsp;";
  echo "<img src=\"img/weapon_icon.png\" width=\"41\" height=\"40\" alt=\"Weapon\">\n"; // 71, 70
  
  // return $weaponRNG;
}
	



  
/*
 * Replace Name with Emoji because MySQL sucks
 */
function replaceNameWithEmoji ($emoji) {
  if ($emoji == "Biber") $emoji = "🐻";
  elseif ($emoji == "Katz") $emoji = "🐱";
  elseif ($emoji == "Pat") $emoji = "💩";
  elseif ($emoji == "\[T]/") $emoji = "🔥";
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
function pdoCount ($table) {
  global $pdo;
  // return $pdo->query("SELECT count(ID) FROM $table")->fetchColumn();
  return $pdo->query("SELECT count(dice) FROM $table")->fetchColumn();
}


/*
 * Simple Query for Aids
 */
function pdoAidsQuery ($section, $RNG) {
  global $pdo;
  
  $stmt = $pdo->prepare("SELECT name FROM $section WHERE dice = $RNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC); 
  
  return $row;
  
}


/*
 * Simple Query for everything
 */
function pdoQuery ($query, $mode) {
  global $pdo;
  if ( empty($mode) ) $mode = "PDO::FETCH_ASSOC";
  
  $stmt = $pdo->prepare("$query");
  $stmt->execute();
  $row = $stmt->fetch($mode); 
  
  return $row; 
}



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
  header("Location: " . $url, true, $statusCode);
  die();
}


 
/*
* Update MySQL Table via PDO (mobs, boss, weapons)
*/  
function pdoUpdateTable ($table, $post, $ID) {
  global $pdo;
  
  $sql = "UPDATE $table SET name = :name WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(":name", $post, PDO::PARAM_STR);
  $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
  $stmt->execute();
}
  


/*
* Delete single entry from Database
*/
function pdoDelete ($table, $post, $ID) {
  global $pdo;
  
  $sql = "UPDATE $table SET name = :name WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(':name', $post, PDO::PARAM_STR);
  $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
  $stmt->execute();
}
?>