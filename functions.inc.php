<?php
// AIDS.PHP


/*
 * Random Weapons
 */
function randomWeapon () {
  global $pdo;
  
  $section    = "weapons";
  $count      = pdoCount($section);
  $weaponRNG  = mt_rand (1, $count);
  
  $stmt = $pdo->prepare("SELECT * FROM weapons WHERE dice = $weaponRNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  $weapon = $row["name"];
  
  return $weapon;
}
	

/*
 * Get RNG for Mobs and Boss
 */
function getRNG () {
  global $pdo;
  
  // Get max dice value for mt_rand()
  $stmt = $pdo->prepare( "SELECT (SELECT COUNT(dice) FROM mobs) as mobsCount, (SELECT COUNT(dice) FROM boss) as bossCount" );
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // MOBS, BOSS RNG
  $mobsRNG  = mt_rand (1, $row["mobsCount"]);
  $bossRNG  = mt_rand (1, $row["bossCount"]);
  
  return array($mobsRNG, $bossRNG);
}



/*
 * Get Aids from DB Where dice = rng (getRNG())
 */
function getAidsByRNG ($mobsRNG, $bossRNG) {
  global $pdo;
  global $flasks;
  global $weaponIMG;
  
  $stmt = $pdo->prepare("SELECT mobs.name, boss.name FROM mobs, boss WHERE mobs.dice = $mobsRNG AND boss.dice = $bossRNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_GROUP);

  $mobsAids = $row[0];
  $bossAids = $row[1];
  
  // Random Weapon
  // if ( $mobsAids == "Zufällige Waffe" ) $mobsAids = randomWeapon() . $weaponIMG;
  // if ( $bossAids == "Zufällige Waffe" ) $bossAids = $weaponIMG . randomWeapon();
  
  if ( $mobsAids == "Zufällige Waffe" ) $mobsAids = randomWeapon();
  if ( $bossAids == "Zufällige Waffe" ) $bossAids = randomWeapon();
  
  // Shots
  /*
  if ( $mobsAids == "Jäscher" || $mobsAids == "Feige" ) $mobsAids = "";
  if ( $bossAids == "Jäscher" || $bossAids == "Feige") $bossAids = "";
  */
  
  // Flask number
  if ( $mobsAids == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, $flasks); // $flasks Number of flasks
    $mobsAids = $mobsAids . " ($flaskRNG) ";
  }

  if ( $bossAids == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, $flasks); // $flasks Number of flasks
    $bossAids = $bossAids . " ($flaskRNG) ";
  }  
  
  return array($mobsAids, $bossAids);
}


/*
 * Get one time Aids if SHOTS were rolled previously
 */
function getShotsAidsByRNG ($section) {
  global $pdo;
  global $flasks;
  
  // Get max dice value for mt_rand()
  $stmt = $pdo->prepare( "SELECT count(dice) as TMP_CNT from $section" );
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // TMP RNG
  $TMP_RNG  = mt_rand (1, $row["TMP_CNT"]);
  
  $stmt = $pdo->prepare("SELECT name FROM $section WHERE dice = $TMP_RNG");
  // WHERE DICE != JÄSCHER FEIGE
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $TMP_AIDS = $row["name"];
  
  // Random Weapon
  if ( $TMP_AIDS == "Zufällige Waffe" ) $TMP_AIDS = randomWeapon();

  // Flask number
  if ( $TMP_AIDS == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, $flasks); // $flasks Number of flasks
    $TMP_AIDS = $TMP_AIDS . " ($flaskRNG) ";
  }
  
  // echo "DEBUG: " . $TMP_RNG;
  
  return $TMP_AIDS;
}



/*
 * Replace Name with Emoji because MySQL sucks
 */
function getFlasks () {
  // 
}



  
/*
 * Replace Name with Emoji because MySQL sucks
 */
function replaceNameWithEmoji ($emoji) {
  if ($emoji == "Biber") $emoji = "🐻";
  elseif ($emoji == "Katz") $emoji = "🐱";
  elseif ($emoji == "Pat") $emoji = "💩";
  elseif ($emoji == "Coop") $emoji = "🎮";
  
  return $emoji;
}



/*
 * Replace (Cheese) from field text in DB Table Kills
 */
function replaceCheeseWithEmoji ($text) {
  $text = str_replace("Cheese", "🧀", $text);
  $text = str_replace("0", "<img src=\"/img/curlup.png\" width=\"62\" height=\"51\" alt=\"Curl Up\">", $text);
  
  return $text;
}


/*
 * Count rows from Database for mt_rand(MAX)
 */
function pdoCount ($table) {
  global $pdo;

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
function numberToTally ($number) {
  $x = 1; 

    if ( $number == 0 ) {
      echo "<img src=\"/img/curlup.png\" width=\"62\" height=\"51\" alt=\"Curl Up\">";      
    } else {
    while ($x <= $number) {
      if ($x % 5 == 1) echo "<br>";
      echo "I";
      $x++;
    } // ENDWHILE
  }
}



/*
 * Format date, strtotime
 */
function formatDate ($date, $format = false) {
  $date = strtotime ($date);
  if ( !empty($format) ) $date = date("d.m.Y H:i:s", $date);
  else $date = date("H:i:s", $date);
  
  return $date;
}



/*
 * Replace <br> with comma for data-tip
 */
function replaceBrWithComma ($text) {
  $text = str_replace("\r\n", ", ", $text);
  return $text;
}


/*
 * Replace dash - with <br>
 */
function replaceDashWithBr ($text) {
  $text = str_replace("-", "<br>", $text);
  return $text;
}



/*
 * Replace Int (number of kills) with flasks
 * SUBSTRACT SPENT JOKER AND NO LONGER DISPLAY THAT ROW
 */
function replaceIntWithFlasks ($number) {
  if ( $number != 0 ) {    
    $x = 1; 
    while ($x <= $number) {
      // if ($x % 3 == 1) echo "<br>";
      echo "<img src=\"img/flask_full.png\" width=\"33\" height=\"46\" alt=\"Flask Full\">"; // full: 123x136 empty: 84x130
      $x++;
    } // ENDWHILE
  } else {
      echo "<img src=\"/img/flask_empty.png\" width=\"33\" height=\"46\" alt=\"Flask Empty\">";
  } // ENDIF
  
}


/*
* Get IP
*/
function getIpAddr() {
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
* Get (second highest) latest Roll from DB
*/
function getLatestRoll () {
  global $pdo;
  global $weaponIMG;
  
  $stmt = $pdo->prepare("SELECT mobs, boss FROM rolls WHERE mobs != '' AND boss != '' ORDER BY ID DESC LIMIT 1,1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Remove Weapon IMG
  $latestMobsAids = str_replace($weaponIMG, "", $row["mobs"]);
  $latestBossAids = str_replace($weaponIMG, "", $row["boss"]);
  
  // echo ":::".$latestBossAids.":::";
  
  return $latestMobsAids . " - " . $latestBossAids;
}

/*
* Get x amount of latest Rolls (10)
*/
function getLatestRolls () {
  global $pdo;
  
  $stmt = $pdo->prepare("SELECT date, IP, mobs, boss FROM rolls ORDER BY ID DESC LIMIT 1, 10");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // echo $row["mobs"] . "-" . $row["boss"];
  
  return $row["mobs"] . " - " . $row["boss"] . "Time:" . $row["date"] . "IP: " . $row["IP"];
}





// AJAX
/*
* Get max dice value and add 1 to insert into DB via ajaxPDOInsert
*/
function getDiceValuePlusOne ($table) {
  global $pdo;

  $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice DESC LIMIT 1"); // get max value from field dice
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row["dice"] + 1;
}


/*
* Simple PDO insert for Ajax *.inc, add Dice, Name into Table
*/
function ajaxPDOInsert ($table, $addDice, $addEntry) {
  global $pdo;

  $sql = "INSERT INTO $table (dice, name) VALUES (:dice, :name)";
  $stmt = $pdo->prepare($sql);          
  $stmt->bindParam(':dice', $addDice, PDO::PARAM_INT);
  $stmt->bindParam(':name', $addEntry, PDO::PARAM_STR);
  $stmt->execute();
}



/*
* Save rolled Aids into DB
*/
function saveRolls ($mobsAids = false, $bossAids = false) {
  global $pdo;
  
  $date = date("Y-m-d H:i:s");
  $IP   = getIpAddr();
  $sql  = "INSERT INTO rolls (date, IP, mobs, boss) VALUES (:date, :IP, :mobs, :boss)";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(":date", $date, PDO::PARAM_STR);
  $stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
  $stmt->bindParam(":mobs", $mobsAids, PDO::PARAM_STR);
  $stmt->bindParam(":boss", $bossAids, PDO::PARAM_STR);
  $stmt->execute();
  
}





/*
* Log actions
*
* TABLE `log` (
*  `ID` int(10) NOT NULL,
*  `section` varchar(255) NOT NULL,
*  `action` varchar(255) NOT NULL,
*  `parentID` int(10) NOT NULL,
*  `parentField` varchar(255) NOT NULL,
*  `old` varchar(255) NOT NULL,
*  `new` varchar(255) NOT NULL,
*  `IP` varchar(255) NOT NULL,
*  `date` datetime NOT NULL
*/

function logAction ($section, $action, $parentID, $parentField, $old, $new) {
  global $pdo;
  
  // diff()?
  
  $date = date("Y-m-d H:i:s");
  $IP   = getIpAddr();
  
  $sql  = "INSERT INTO log (section, action, parentID, parentField, old, new, IP, date) VALUES (:section, :action, :parentID, :parentField, :old, :new, :IP, :date)";
  $stmt = $pdo->prepare($sql);   
  
  $stmt->bindParam(":section", $section, PDO::PARAM_STR);
  $stmt->bindParam(":action", $action, PDO::PARAM_STR);
  $stmt->bindParam(":parentID", $parentID, PDO::PARAM_INT);
  $stmt->bindParam(":parentField", $parentField, PDO::PARAM_STR);
  $stmt->bindParam(":old", $old, PDO::PARAM_STR);
  $stmt->bindParam(":new", $new, PDO::PARAM_STR);
  
  $stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
  $stmt->bindParam(":date", $date, PDO::PARAM_STR);
  
  $stmt->execute();
}




/**********************************************************************************/





// EDIT.PHP
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
  // $mode = preg_replace('![^a-z]!', '', $mode); 

}


/*
* redirect back to given URL, statuscode = 303
*/
function redirect ($url, $statusCode = 303) {
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


/*
* CHeck if a number between 1 and max dice vlaue in db is missing
*/
function checkMissingDice () {
  global $pdo;
  
  $tables = array("mobs", "boss", "weapons");
  foreach($tables as $table) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);

    $missing_number = missing_number($data);

    if ( !empty($missing_number) ) {
      echo "
      <div id=\"flex-container-missingnumbers\">\n
      <div class=\"flex-item-missingnumbers\">\n
      Folgende Würfel fehlen in der Tabelle <strong>{$table}</strong>:\n
      <p>\n
      ";
      // print_r($missing_number);
      // echo $missing_number[0];
      foreach($missing_number as $value) {
        echo $value . "<br>\n";
      }

      echo "
      </p>\n
      </div>\n
      </div>\n
      ";
    } // ENDIF
  } // ENDFOREACH
} // ENDFUNCTION
 


/*
 * Find gaps (dice) in array
 */
function missing_number($num_list) {
  // construct a new array
  // $new_arr = range($num_list[0], max($num_list));                                                    
  $new_arr = range($num_list, max($num_list));
  // use array_diff to find the missing elements 
  return array_diff($new_arr, $num_list);
}



/*
 * Check if user made a change from Ajax inline Edit
 */
function checkIfValueExists ($ID, $table) {
  global $pdo;

  $stmt = $pdo->prepare("SELECT name FROM $table WHERE ID = $ID");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row["name"];
}



/*
 * CScan dir and list files ordered by create date
 */
function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}
?>