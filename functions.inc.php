<?php
// AIDS.PHP

/*
 * Random Weapons
 */
function randomWeapon () {
  global $pdo;
  global $GAME;
  
  $section    = $GAME . "_weapons";
  $count      = pdoCount($section);
  $weaponRNG  = mt_rand (1, $count);
  // $weaponRNG  = 17;
  
  $stmt = $pdo->prepare("SELECT * FROM {$GAME}_weapons WHERE dice = $weaponRNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  $weapon = $row["name"];
  
  // Debug
  // $weapon = "Pickaxe";
  
  return $weapon;
}



/*
 * Get RNG for Mobs and Boss
 */
function getRNG () {
  global $pdo;
  global $GAME;
  
  // Get max dice value for mt_rand()
  $stmt = $pdo->prepare( "SELECT (SELECT COUNT(dice) FROM {$GAME}_mobs) as mobsCount, (SELECT COUNT(dice) FROM {$GAME}_boss) as bossCount" );
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if there are entries in DB
  /*
  if ( $row["mobsCount"] == 0 || $row["bossCount"] == 0 ) {
    echo ("Aids hinzufügen");
    exit;
  }
  */

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
  global $GAME;
  global $flasks;
  global $weaponIMG;
  
  // If no entries in DB
  if ( empty($mobsRNG) || empty($bossRNG) ) {
    // die("Aids hinzufügen!");
    redirect("/edit");
  }
  
  $stmt = $pdo->prepare("SELECT {$GAME}_mobs.name, {$GAME}_boss.name FROM {$GAME}_mobs, {$GAME}_boss WHERE {$GAME}_mobs.dice = $mobsRNG AND {$GAME}_boss.dice = $bossRNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_GROUP);
  
  $mobsAids = $row[0];
  $bossAids = $row[1];  

  // handle special aids: Random Weapon, Flask würfeln, Shots
  $aids = specialAids($mobsAids, $bossAids);
  $mobsAids = $aids[0];
  $bossAids = $aids [1];

  return array($mobsAids, $bossAids);
}



/*
 * Handle special Aids: Random Weapon, Flask, Shots
 */
function specialAids ($mobsAids, $bossAids) {
  // global $flasks; // _FLASKS

  // Random Weapon
  if ( $mobsAids == "Zufällige Waffe" ) $mobsAids = randomWeapon();
  if ( $bossAids == "Zufällige Waffe" ) $bossAids = randomWeapon();

  // Shots
  if ( $mobsAids == "Jäscher" || $mobsAids == "Feige" ) { // if (strcasecmp($var1, $var2) == 0) {
    // RNG # for balloon-tip
    // $mobsRNGNR   = $mobsRNG;
    $newMobsAids = getShotsAidsByRNG(_GAME."_mobs");
    $mobsAids = $mobsAids . ":&nbsp;" . $newMobsAids;
  }

  if ( $bossAids == "Jäscher" || $bossAids == "Feige") {
    // RNG # for balloon-tip
    // $bossRNGNR   = $bossRNG;
    $newBossAids = getShotsAidsByRNG(_GAME."_boss");
    $bossAids = $bossAids . ":&nbsp;" . $newBossAids;
  }

  // Flask number
  if ( $mobsAids == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, _FLASKS); // $flasks Number of flasks
    $mobsAids = $mobsAids . " ($flaskRNG) ";
  }

  if ( $bossAids == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, _FLASKS); // $flasks Number of flasks
    $bossAids = $bossAids . " ($flaskRNG) ";
  }

  return array($mobsAids, $bossAids);
} // END FUNCTION



/*
 * Get max dice value from $section for mt_rand()
 */
function getMaxDiceValue ($section) {
  global $pdo;
  // global $GAME;
  
  // $section = $GAME . "_" . $section;
  
  $stmt = $pdo->prepare( "SELECT count(dice) as TMP_CNT from $section" );
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
  return $row["TMP_CNT"];
}



/*
 * Get dice values where field name = jäscher and feige (shots) to exclude in mt_rand()
 * Jäscher, Feige
 */
function getDiceValuesWhereNameIsShots($section) {
  global $pdo;
  // global $GAME;
  
  // $section = $GAME . "_" . $section;
  
  $stmt = $pdo->prepare("
  SELECT (SELECT dice
        FROM   $section
        WHERE  name = 'Feige') AS feige,
       (SELECT dice
        FROM   $section
        WHERE  name = 'Jäscher')   AS jager
  ");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_GROUP);
  
  return array($row["feige"], $row["jager"]);
}



/*
 * Get one time Aids if SHOTS were rolled previously
 */
function getShotsAidsByRNG ($section) {
  global $pdo;
  // global $GAME;
  
  // $section = $GAME . "_" . $section;
  // global $flasks; // _FLASKS
    
  // Get Max Dice Value fir mt_rand()
  $TMP_CNT = getMaxDiceValue($section);
  
  // Get dice values where field name = jäscher and feige to exclude in mt_rand()
  $shots = getDiceValuesWhereNameIsShots($section);
  
  $feige = $shots[0];
  $jager = $shots[1];
  
  // TMP RNG
  // exclude $feige and $jager
  while( in_array( ($n = mt_rand(1, $TMP_CNT)), array($feige, $jager) ) );
  
  $TMP_RNG = $n;  

  // Debug
  if ( $TMP_RNG == $feige || $TMP_RNG == $jager ) echo "ALARM";
  
  // Get aids where dice = rng
  $stmt = $pdo->prepare("SELECT name FROM $section WHERE dice = $TMP_RNG");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $TMP_AIDS = $row["name"];
  
  // Random Weapon
  if ( $TMP_AIDS == "Zufällige Waffe" ) $TMP_AIDS = randomWeapon();

  // Flask number
  if ( $TMP_AIDS == "Flask Würfeln" ) {
    $flaskRNG = mt_rand(1, _FLASKS); // $flasks Number of flasks
    $TMP_AIDS = $TMP_AIDS . " ($flaskRNG) ";
  }
    
  return $TMP_AIDS;
}



/*
 * Check if rolled aids is a random weapon and
 * Sanitize file path
 * Replace ' and white space with _
 */
function sanitizeWeaponsPath ($aids, $rng = false) {
  global $pdo;
  global $GAME;
  
  // Get all weapons in an Array
  $data = $pdo->query("SELECT name FROM {$GAME}_weapons")->fetchAll(PDO::FETCH_ASSOC);

  // Go through Array and check if rolled $aids is a weapon
  foreach ($data as $value) {
    if ( $aids == $value["name"] ) {
            
      // Replace white space and apostroph
      $weapon = str_replace( " ", "_", $value["name"] );
      $weapon = str_replace( "'", "", $weapon );
      if ( _GAME != "ds2" ) $weapon = strtolower($weapon);
      // if ( _GAME != "ds1" ) $weapon = strtolower($weapon);
      // $weapon = str_replace([" ", "'"], "_", $string);
      
      /*
      if ( _GAME == "ds1" ) {
        $path = "/dice/icons/weapons/{$GAME}/{$weapon}.png";
      } else {
        $path = "/dice/icons/weapons/{$GAME}/{$weapon}-icon.png";
      }
      */
      $path = "/dice/icons/weapons/{$GAME}/{$weapon}.png";
      
      
      if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path) ) {
        $RNG  = "<img src=\"{$path}\" alt=\"{$value["name"]}\">"; // width=\"84\" height=\"130\"
      } else {
        $RNG = "<div class=\"diceText\">" . "?" . "</div>";
      }
      
      $stop_switch = TRUE;
      
      return array($RNG, $stop_switch, $path, $weapon);
    } // END IF
    
  } // END FOREACH
}



/*
 * Sanitize file path for rolled aids
 * Replace: ', /, white space, Umlaute
 *
 * Also handle special Aids: Jäscher, Feige and Flask Würfeln
 */
function sanitizeAids ($aids) {
  
  // Sanitize and Normalize string / URL
  $sanitize = array (
    "ä" => "ae",
    "ö" => "oe",
    "ß" => "ss",
    "ü" => "ue",
    "æ" => "ae",
    "ø" => "oe",
    "å" => "aa",
    "é" => "e",
    "è" => "e",
    "/" => "_",
    " " => "_"
  );
  

  $aids_normalized = str_replace(array_keys($sanitize), 
                                 array_values($sanitize), 
                                 strtolower($aids)
                                );
  // echo "<pre>" . "aidsnorm:" . $aids_normalized . "<br>" . "</pre>";
  return $aids_normalized;
}



/*
 * Replace Dice Number with Symbol
 */
function replaceDiceWithSymbol ($aids, $rng) {

  // Sanitize file path for weapons and check if $aids is a rolled random weapon
  $sanitizeWeapon = sanitizeWeaponsPath($aids, $rng);
  $RNG            = $sanitizeWeapon[0];
  $stop_switch    = $sanitizeWeapon[1]; // TRUE if sanitizeWeaponsPath finds a aids was rolled as a weapon
  
  // if rolled aids isn't a random weapon
  if ( $stop_switch != TRUE ) {
    
    /* Check for extraordinary Aids Names */
    // Jäscher and Feige
    // Flask Würfeln (n)
    if (stripos($aids, "Jäscher") !== FALSE) {
      $split_aids = explode(":", $aids);
      $aids       = $split_aids[0];
    }
    elseif (stripos($aids, "Feige") !== FALSE) {
      $split_aids = explode(":", $aids);
      $aids       = $split_aids[0];
    }

    // Check Flask Würfeln (n)
    elseif (stripos($aids, "Flask Würfeln") !== FALSE) {
      $split_aids = explode("(", $aids);
      $aids       = trim($split_aids[0]);
    }


    // Sanitize file path for aids (no weapons) 
    $aids_normalized = sanitizeAids($aids);
    $extension = "png";
    // Change file extension to gif for single entries
    if ( stristr($aids_normalized, "Parry") ) $extension = "gif";
    $path = $_SERVER["DOCUMENT_ROOT"] . "/dice/icons/" . $aids_normalized . "." . $extension;

    // if file exists on Server instead of switch loop for every entry
    if ( file_exists( $path ) ) {
      // echo "DEBUG";
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.{$extension}\" alt=\"{$aids}\">";
    } else {
      $RNG = "<div class=\"diceText\">" . $rng . "</div>";
    }
    
  } // END IF (random weapon)
    
  return $RNG;
} // END FUNCTION



  
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
 * Replace (Cheese) from field text in DB Table Kills - ignore case sensitivity
 */
function replaceCheeseWithEmoji ($text) {
  $curl_up_img = "<img src=\"/img/curlup.png\" width=\"62\" height=\"51\" alt=\"Curl Up\">";
  
  $text = str_ireplace("Cheese", "🧀", $text);
  $text = str_ireplace("0", $curl_up_img, $text);
  
  if ( empty($text) ) $text = $curl_up_img;
  
  return $text;
}



/*
 * Count rows from Database for mt_rand(MAX)
 */
function pdoCount ($table) {
  global $pdo;
  // global $GAME;
  
  // $table = $GAME . "_" . $table;

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
 * Replace New line break with <li> item
 */
function replaceLineBreakWithList ($text) {
  $text = str_replace("\r\n", "<li>", $text);
  // $text = "<li>" . $text . "</li>";
  return $text;
}



/*
 * Replace dash - with <br> (for Todo)
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
  global $GAME;
  global $GAMEID;
  
  global $weaponIMG;
  
  $stmt = $pdo->prepare("SELECT mobs, boss FROM rolls WHERE mobs != '' AND boss != '' AND gameID = $GAMEID ORDER BY ID DESC LIMIT 1,1");
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
  global $GAME;
  
  $stmt = $pdo->prepare("SELECT date, IP, mobs, boss FROM {$GAME}_rolls ORDER BY ID DESC LIMIT 1, 10");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // echo $row["mobs"] . "-" . $row["boss"];
  
  return $row["mobs"] . " - " . $row["boss"] . "Time:" . $row["date"] . "IP: " . $row["IP"];
}



/*
* Output Debug 
*/
function debug ($mobsRNG, $mobsAids, $bossRNG, $bossAids, $randomWeapon) {
  $out  = "<pre>";

  $out .= "MobsRNG: " . $mobsRNG;
  $out .= "<br>";
  $out .= "BossRNG: " . $bossRNG;
  $out .= "<br>";
  $out .= "<br>";
  $out .= "MobsAids: " . $mobsAids;
  $out .= "<br>";
  $out .= "BossAids: " . $bossAids;
  $out .= "<br>";
  $out .= "<br>";
  $out .= "RandomWeapon: " . $randomWeapon;

  $out .= "</pre>";
  
  //  echo $out; 
  
  return $out;
  
}



/*
* Replace Umlaute and other 
*/
function replaceUmlaut ($word) {

  // Sanitize and Normalize string
  $umlaut = array(
    "ä" => "ae",
    "ö" => "oe",
    "ß" => "ss",
    "ü" => "ue",
    "æ" => "ae",
    "ø" => "oe",
    "å" => "aa",
    "é" => "e",
    "è" => "e"
  );
  
  $word = str_replace( array_keys($umlaut), array_values($umlaut), $word );
  return $word;
  
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
  global $GAME;
  global $GAMEID;
  
  if ( _LOGIN == TRUE && session_status() == 2 ) { // Login enabled in config and session = ACTIVE
    $userID = $_SESSION["userID"];
    $username = $_SESSION["username"];
  } else {
    $userID = 0;
    $username = "Admin";
  }
    
  $date = date("Y-m-d H:i:s");
  $IP   = getIpAddr();
  $sql  = "INSERT INTO rolls (date, userID, gameID, username, IP, mobs, boss) VALUES (:date, :userID, :gameID, :username, :IP, :mobs, :boss)";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(":date", $date, PDO::PARAM_STR);
  $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
  
  $stmt->bindParam(":gameID", $GAMEID, PDO::PARAM_INT);
  
  $stmt->bindParam(":username", $username, PDO::PARAM_STR);
  $stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
  $stmt->bindParam(":mobs", $mobsAids, PDO::PARAM_STR);
  $stmt->bindParam(":boss", $bossAids, PDO::PARAM_STR);
  
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    $existingkey = "Integrity constraint violation: 1062 Duplicate entry";
    
    if (strpos($e->getMessage(), $existingkey) !== FALSE) {
      // Take some action if there is a key constraint violation, i.e. duplicate name
    } else {
      throw $e;
      // echo "SAVE ROLLS NOT WORKING";
    }
  }
  
}



// EDIT.PHP

/*
* Sanitize Query
*/
function buildQuery ($get_var) {
    switch ($get_var) {
      case "weapons":
        $tbl = "weapons";
      break;
      case "mobs":
        $tbl = "mobs";
      break;
      case "boss":
        $tbl = "boss";
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
* Check if a number between 1 and max dice vlaue in db is missing
*/
function checkMissingDice () {
  global $pdo;
  global $GAME;
  
  $warning = FALSE;
  
  $tables = array($GAME."_mobs", $GAME."_boss", $GAME."_weapons");
  foreach($tables as $table) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
    
    if ( empty($data) ) {
      echo "{$table} Aids hinzufügen<br>";
      $warning = TRUE;
      $warning_msg = "Missing Aids\n";
    } else {
      $missing_number = missing_number($data); 
    }
    
    if ( !empty($missing_number) ) {
      
      $warning = TRUE;
      $warning_msg = "Missing Dice\n";
      
      echo "
      <div id=\"flex-container-missingnumbers\">\n
      <div class=\"flex-item-missingnumbers\">\n
      Dice missing in Table <strong>{$table}</strong>:\n
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
  
  if ( $warning == TRUE ) {
    $subject = "WARNING";
    $msg = $warning_msg . "\n" . "Game: {$GAME}" . "\n";

    mail_warning ($subject, $msg);
  }
  
  
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
 * Send mail if an important warning occurs
 */
function mail_warning ($subject, $msg) {
  
  $to = "patrick@nauerz.net";
  $from = "From: Aids Warning <aids@aids.aids>";
  
  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg, 70);
  $msg .= "\n\nIP: " . getIpAddr();

  // send email
  mail($to, $subject, $msg, $from);
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
 * Scan dir and list files ordered by create date
 */
function scan_dir($dir) {
  $ignored = array(".", "..", ".svn", ".htaccess");

  $files = array();    
  foreach (scandir($dir) as $file) {
      if (in_array($file, $ignored)) continue;
      $files[$file] = filemtime($dir . '/' . $file);
  }

  arsort($files);
  $files = array_keys($files);

  return ($files) ? $files : false;
}



/*
 * Scan dir recursively
 * use DirectoryIterator
 */
function scan_dir_recursively($path) {
  
  $files = array(); 
  
  foreach (new DirectoryIterator($path) as $fileInfo) {
    if ( $fileInfo->isDot() ) continue;
    if ( $fileInfo->isFile() ) $files[] = $fileInfo->getFilename();
  }
  
  sort($files);
  
  return ($files) ? $files : false;

}


/*
 * Get all folders in given $dir
 */
function getDirs($dir) {

  $dirs = glob("$dir/*", GLOB_ONLYDIR);
  array_unshift($dirs, $dir); // add base folder in front of array
  
  return $dirs;
}



/*
 * Check if file exists on external server
 */
function checkExternalFile($url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_exec($ch);
  $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return $retCode;
  /*
  $fileExists = checkExternalFile("http://example.com/your/url/here.jpg");

  // $fileExists > 400 = not found
  // $fileExists = 200 = found.
  */
}



/*
* Get filename and ext from $fextra
* prepare filename to copy over to destination folder
* @see functions.inc.php
*
* Also: Check if file exists on server, if not, copy from fextralife
* MAKE EXTRA FOLDER FOR MODE (ds3. ds2, blood borne etc...)
*
*
* ////// TODO BETTER ERROR HANDLING
*/

function copyWeaponFromFextra ($weapon, $res = "") {
// function copyWeaponFromFextra ($weapon, $err_mode = "") {
  global $GAME; 
  
  $weapon = sanitizeWeaponsPath($weapon)[3];
  
  // Set Fextralife URL depending on Game
  switch ($GAME) {
    case "ds1":
      $fextraURL = "http://darksouls.wiki.fextralife.com/file/Dark-Souls/";
      $source = "{$fextraURL}{$weapon}.png";
      break;
    case "ds1r":
      $fextraURL = "http://darksouls.wiki.fextralife.com/file/Dark-Souls/";
      $source = "{$fextraURL}{$weapon}.png";
      break;
    case "ds2":
      $fextraURL = "http://darksouls2.wiki.fextralife.com/file/Dark-Souls-2/";
      $source = "{$fextraURL}{$weapon}.png";
      break;
    case "ds3":
      $fextraURL = "http://darksouls3.wiki.fextralife.com/file/Dark-Souls-3/";
      // $source = "{$fextraURL}{$weapon}-icon.png"; // IF FILE IS TO LARGE
      $source = "{$fextraURL}{$weapon}.png";
      break;
    case "bb":
      $fextraURL = "http://bloodborne.wiki.fextralife.com/file/Bloodborne/";
      // http://bloodborne.wikidot.com/weapons
      $source = "{$fextraURL}{$weapon}.png";
      break;
    // Not implemented:
    case "des":
      $fextraURL = "https://demonssouls.wiki.fextralife.com/file/Demons-Souls/";
      $source = "{$fextraURL}{$weapon}.png";
      break;
    
    /*
    default:
      die("FEXTRA URL FEHLER");
    */
}
  
  // if URL is provided because of fextra shenanigans
  if ( !empty($res) ) $source = $res;
  
  
  $dest = _DR . "/dice/icons/weapons/" . _GAME . "/{$weapon}.png";
  $ext = "png";
  
  // Debug
  /*
  echo "weapon: " . $weapon . "<br>";
  echo "source: " . $source . "<br>";
  echo "dest: " . $dest . "<br>";
  */
  
  // only try to copy if file doesn't exist
  if ( !file_exists($dest) ) {

    $msg = "FILE NOT ON INTERNAL SERVER<br>";
    
    // SEEMS TO BE NOT WORKING
    // $fileExists = checkExternalFile("http://example.com/your/url/here.jpg");
    // $msg = "FILE DOES NOT EXIST ON FEXTRALIFE. WEAPON NAME MISSPELLED?<br>"; // weapon name misspelled
    // echo $msg;
    // TRY LOWER CASE UPPER CASE
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    if ( !@copy($source, $dest) ) { // @ for own error handling

      $errors = error_get_last();
      
      /*
      echo "<br>";
      echo "COPY ERROR: ".$errors["type"];
      echo "<br>";
      echo $errors["message"];
      echo "<br>";
      echo "Copy().Error.";
      echo "<br>";
      */

    } else {
      $msg = "Copy().Success.<br>";
      // echo $msg;
    }

  } else {
    $msg = "FILE ALREADY EXISTS<br>";
  }
  // echo $msg;
  return array($msg, $errors);
} // END FUNCTION



/*
 * Replace last new line break (\n\r)
 */
function replaceLastRN ($str) {
  // \r\n
  // $str = preg_replace('/\bblank$/', '', $str);
  $str = preg_replace('/\bblank$/', '', $str);
  return $str;
}



/*
 * Replace last occurance of %search within string
 */
function str_lreplace($search, $replace, $subject) {
  $pos = strrpos($subject, $search);

  if($pos !== false) {
      $subject = substr_replace($subject, $replace, $pos, strlen($search));
  }

  return $subject;
}


/*
 * Strip whitespace (or other characters) from the end of a string
 * @ rtrim()
 */
function strrtrim($message, $strip) {
  // break message apart by strip string
  $lines = explode($strip, $message);
  $last  = "";
  // pop off empty strings at the end
  do {
    $last = array_pop($lines);
  } while (empty($last) && (count($lines)));
  // re-assemble what remains
  return implode($strip, array_merge($lines, array($last)));
}


/*
 * Simple print error $msg
 */
function print_error ($msg) {
  echo "
  <div id='flex-container'>
    <div class='flex-item'>&nbsp;</div>

      <div class='flex-item'>
        <span class='error'>
          {$msg}
        </span>
      </div>

    <div class='flex-item'>&nbsp;</div>
  </div>
  ";
}



/*
 * Create JSON file
 */
function createJSON ($filename, $content) {
  $dir = _DR . "/";
  
  // Create JSON file
  $file = $filename . ".json";
  // check if string is in JSON format
  isJSON($content);
  // Write the contents back to the file
  file_put_contents($file, $content);
}


/*
* Check if string is in JSON format
*/
function isJSON($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}




/******************** LOGIN ***********************/

/*
 * Login, check if username and password entered are valid (Database)
 */
function login (string $username, string $password) {
  global $pdo;
  
  $query  = "SELECT * FROM user WHERE username=:username AND password=:password";
  $stmt   = $pdo->prepare($query);
  $stmt->bindParam("username", $username, PDO::PARAM_STR);
  $stmt->bindValue("password", $password, PDO::PARAM_STR);
  $stmt->execute();
  $count  = $stmt->rowCount();
  $row    = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ( ($count == 1) && (!empty($row)) ) {
    if ( $username == "Biber" ) $userID = 1;
    else if ( $username == "Katz" ) $userID = 2;
    else if ( $username == "Pat" ) $userID = 3;
    
    $_SESSION["valid"]    = true;
    $_SESSION["timeout"]  = time();
    $_SESSION["username"] = $username;
    $_SESSION["userID"]   = $userID;
    
    redirect("/", $statusCode = 303);
  } else {
    $error = "Wrong username or password";
    return $error;
  }
}



/*
 * Logout, Destroy all sessions
 */
function logout() {
  session_start();
  unset($_SESSION["userID"]);
  unset($_SESSION["username"]);
  unset($_SESSION["valid"]);
	session_destroy();
  redirect("/", $statusCode = 303);
}




/* CONFIG */
/*
 * Get active game
 */
function getActiveGame () {
  global $pdo;
  
  $stmt = $pdo->prepare("SELECT ID, abbr FROM games WHERE active = 1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return array($row["ID"], $row["abbr"]); // get abbrevation (ds1, bb, etc) for db prefix
}



/*
 * Get all games listed in `games`
 */
function getGames () {
  global $pdo;
  
  return $pdo->query("SELECT * FROM games")->fetchAll(PDO::FETCH_ASSOC);
}



/*
 * Get Globals from config
 */
function getGlobals () {
  global $pdo;
  
  return $pdo->query("SELECT * FROM config")->fetchAll(PDO::FETCH_ASSOC);
}



/*
 * Change the Game in DB
 *
 */
function changeGame ($gameID) {
  global $pdo;

  /*
  // all available Games
  $games = array("ds1", "ds2", "ds3", "bb", "ds1r", "des");
  // Check if var = in $games
  if ( !in_array($game, $games) || empty($game) ) die("OH GOTT WAS ISSN PASSIERT? @changeGame()" . "<br>" .'$game: ' . $game);
  */
  
  
  $sql = "UPDATE games SET active = IF (id = :ID,1,0)";
  // $sql  = "UPDATE games SET active = 0 WHERE active = 1";
  // UPDATE games SET active = IF (id = 1,1,0);
  $stmt = $pdo->prepare($sql);                                  
  // $stmt->bindParam(":abbr", $game, PDO::PARAM_STR);
  $stmt->bindParam(":ID", $gameID, PDO::PARAM_INT);
  $stmt->execute();
  
  if ( $stmt == TRUE ) createActiveGameJSON($gameID);
}


/*
 * Create/Edit JSON file with active GAME abbr
 */
function createActiveGameJSON ($gameID) {
  global $pdo;
  
  // get abbr for new ID
  $stmt = $pdo->prepare("SELECT abbr FROM games WHERE ID = $gameID");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Create JSON file
  $file = "activeGame.json";
  // content
  // $content = "{" . $row["abbr"] . "}";
  $content = json_encode( $row["abbr"] );
  // Write the contents back to the file
  file_put_contents($file, $content);
}


/*
 * Write tables for a new game
 * TABLES: `TMP_boss`, `TMP_kills`, `TMP_log`, `TMP_mobs`, `TMP_rolls`, `TMP_todo`, `TMP_weapons`
 */
function writeSQL ($abbr) {
  global $pdo;
  
  $SQLFile = "";
  // Get Template
  $SQLFile = file_get_contents(_DR . "/addGame.sql");

  // Replace TMP with Abbr
  $SQLString = str_replace("TMP", $abbr, $SQLFile);

  $sql = $SQLString;

  // No error output
  return $stmt = $pdo->exec($sql);
}


/*
* Create Game Folder (abbr) for @copyWeaponFromFextra
* Path: /dice/icons/weapons/
*/
function createGameFolder($abbr) {
  if (!file_exists(_DR . "/dice/icons/weapons/$abbr")) {
    $oldmask = umask(0);
    mkdir(_DR . "/dice/icons/weapons/$abbr", 0777, true);
    umask($oldmask);
  }
}


/*
* Delete Game Folder (abbr) for @copyWeaponFromFextra
* Path: /dice/icons/weapons/
*/
function deleteGameFolder($abbr) {
  if (file_exists(_DR . "/dice/icons/weapons/$abbr")) {
    array_map('unlink', glob("/dice/icons/weapons/$abbr/*.*"));
    rmdir(_DR . "/dice/icons/weapons/$abbr");
  }
}


/*
* Rename SQL Tables prefix (abbr)
*/
function renameSQLTable ($old, $new) {
  global $pdo;
  
  $sql  = "RENAME TABLE {$old}_boss TO {$new}_boss;";
  $sql .= "RENAME TABLE {$old}_kills TO {$new}_kills;";
  $sql .= "RENAME TABLE {$old}_mobs TO {$new}_mobs;";
  $sql .= "RENAME TABLE {$old}_weapons TO {$new}_weapons;";

  $stmt = $pdo->exec($sql);
}



/*
* Drop Table for given abbr (foreign key `games`)
*/
function dropSQLTable ($abbr) {
  global $pdo;
  
  $sql  = "DROP TABLE {$abbr}_boss;";
  $sql .= "DROP TABLE {$abbr}_kills;";
  $sql .= "DROP TABLE {$abbr}_mobs;";
  $sql .= "DROP TABLE {$abbr}_weapons;";
  
  $stmt = $pdo->exec($sql);
}


/*
* Check if Abbr is already taken
*/
function checkIfAbbrIsTaken ($abbr) {
  global $pdo;

  $sql = 'SELECT abbr FROM games WHERE abbr = "'.$abbr.'"';
  
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row["abbr"] != NULL) {
    print_error("ABBR ALREADY TAKEN");
    die();
  }
  
  // return $row["abbr"];
  return TRUE;
}



/*
* Upload Image to dir
*/
function uploadIMG ($filename, $dir, $filesize, $newfilename) {

  // $filename        = $_FILES["file"]["name"];
  // $dir             = _DR . "/img/bg/";
  // $filesize        = $_FILES["file"]["size"];
  // $newfilename     = $newAbbr . $new_file_ext;

  $file_basename      = substr($filename, 0, strripos($filename, ".")); // get file extention
  $file_ext           = substr($filename, strripos($filename, ".")); // get file name

  $allowed_file_size  = 2000000;
  $allowed_file_types = array(".jpg", ".png", ".gif");

  // $new_file_ext       = ".jpg";
  
  // check if file extension is allowed && file not too large
  if (in_array($file_ext, $allowed_file_types) && ($filesize < $allowed_file_size)) {	
    // Rename file
    // $newfilename = md5($file_basename) . $file_ext;
    if (file_exists($dir . $newfilename)) {
      // file already exists error
      echo "You have already uploaded this file.";
    } else {		
      move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $newfilename);
      echo "File uploaded successfully.";		
    }
  } elseif (empty($file_basename)) {	
    // file selection error
    echo "Please select a file to upload.";
  } elseif ($filesize > $allowed_file_size) {	
    // file size error
    echo "The file you are trying to upload is too large.";
  } else {
    // file type error
    echo "Only these file typs are allowed for upload: " . implode(", ", $allowed_file_types);
    unlink($_FILES["file"]["tmp_name"]);
  }


/**
 * easy image resize function
 * @param  $file - file name to resize
 * @param  $string - The image data, as a string
 * @param  $width - new image width
 * @param  $height - new image height
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @param  $grayscale - if true, image will be grayscale (default is false)
 * @return boolean|resource
 * @git    https://github.com/Nimrod007/PHP_image_resize
 */
  function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
                              $quality            = 100,
                              $grayscale          = false
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;

    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }

    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    # Making the image grayscale, if needed
    if ($grayscale) {
      imagefilter($image, IMG_FILTER_GRAYSCALE);
    }    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);

      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }

    return true;
  }



  
} // ENDFUNCTION
?>