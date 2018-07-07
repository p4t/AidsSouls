<?php
// AIDS.PHP

/*
class Aids {
  public $test;
  co
  public function getRNG () {
    //
  }
  
  public function getAidsByRNG () {
    //
  }
  
  public function RandomWeapon () {
    //
  }
  
}
*/




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




function specialAids ($mobsAids, $bossAids) {
  // global $flasks; // _FLASKS

  // Random Weapon
  if ( $mobsAids == "Zufällige Waffe" ) $mobsAids = randomWeapon();
  if ( $bossAids == "Zufällige Waffe" ) $bossAids = randomWeapon();

  // Shots
  if ( $mobsAids == "Jäscher" || $mobsAids == "Feige" ) { // if (strcasecmp($var1, $var2) == 0) {
    // RNG # for balloon-tip
    $mobsRNGNR   = $mobsRNG;
    $newMobsAids = getShotsAidsByRNG(_GAME."_mobs");
    $mobsAids = $mobsAids . ":&nbsp;" . $newMobsAids;
  }

  if ( $bossAids == "Jäscher" || $bossAids == "Feige") {
    // RNG # for balloon-tip
    $bossRNGNR   = $bossRNG;
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
 * Get dice values where field name = jäscher and feige to exclude in mt_rand()
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
  
  
  /* OLD SWITCH */
  /*
  switch ($aids) {
  // switch ( strtolower($aids) ) {
    // width=\"\" height=\"\"
    case stristr($aids, "Ohne Flask"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;

    case stristr($aids, "Invade"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
    case stristr($aids, "Symbol of Aids"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Jäscher"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Ohne Schild"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Normal"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Ohne Rüstung"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Flask Würfeln"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Fatroll"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case "Crap Ringe":
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
    
    case stristr($aids, "Crap Waffe"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
    
    case stristr($aids, "Lumbe"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
    
    case "No Dodge/Run":
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
  
    case stristr($aids, "Nur R2"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Ohne Ringe"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Feige"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;

    case stristr($aids, "Invert Controls"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Parry"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.gif\" alt=\"{$aids}\">";
      break;
  
    case stristr($aids, "Ohne Alles"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Kill on Sight"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
      
    case stristr($aids, "Waffe linke Hand"):
      $RNG = "<img src=\"/dice/icons/{$aids_normalized}.png\" alt=\"{$aids}\">";
      break;
    
    /*
    default:
      if ( $stop_switch != TRUE ) { // make sure image isn't overwritten with dice number
        $RNG = $rng;
        // check if dice is only a number (no image available) and assign a class to increase font-size to 5em and leave the image alone (centering shenanigans)
        if ( is_numeric($RNG) ) {
          $RNG = "<div class=\"diceText\">" . $RNG . "</div>";
        }
        
      }
      // return false;
      
  } // END SWITCH
  */
  
  return $RNG;
} // END FUNCTION







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
  global $weaponIMG;
  
  $stmt = $pdo->prepare("SELECT mobs, boss FROM {$GAME}_rolls WHERE mobs != '' AND boss != '' ORDER BY ID DESC LIMIT 1,1");
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
  $out = "<pre>";

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
  
  $userID = $_SESSION["userID"];
  $username = $_SESSION["username"];
    
  $date = date("Y-m-d H:i:s");
  $IP   = getIpAddr();
  $sql  = "INSERT INTO {$GAME}_rolls (date, userID, username, IP, mobs, boss) VALUES (:date, :userID, :username, :IP, :mobs, :boss)";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(":date", $date, PDO::PARAM_STR);
  $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
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
      // throw $e;
      echo "MISSING DICE!!!";
    }
  }
  
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
/*
function logAction ($section, $action, $parentID, $parentField, $old, $new) {
  global $pdo;
  global $GAME;
  // global $_SESSION["username"];
  
  // diff()?
  
  if ( !empty($_SESSION["username"]) ) $username = $_SESSION["username"];
  else $username = "0";
  
  if ( !empty($_SESSION["userID"]) ) $userID = $_SESSION["userID"];
  else $userID = "0";
    
  $date = date("Y-m-d H:i:s");
  $IP   = getIpAddr();
  
  $sql  = "INSERT INTO {$GAME}_log (section, action, parentID, parentField, old, new, userID, username, IP, date) VALUES (:section, :action, :parentID, :parentField, :old, :new, :userID, :username, :IP, :date)";
  $stmt = $pdo->prepare($sql);   
  
  $stmt->bindParam(":section", $section, PDO::PARAM_STR);
  $stmt->bindParam(":action", $action, PDO::PARAM_STR);
  $stmt->bindParam(":parentID", $parentID, PDO::PARAM_INT);
  $stmt->bindParam(":parentField", $parentField, PDO::PARAM_STR);
  $stmt->bindParam(":old", $old, PDO::PARAM_STR);
  $stmt->bindParam(":new", $new, PDO::PARAM_STR);
  $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
  $stmt->bindParam(":username", $username, PDO::PARAM_STR);
  
  $stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
  $stmt->bindParam(":date", $date, PDO::PARAM_STR);
  
  $stmt->execute();
}
*/



/**********************************************************************************/





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
  
  $tables = array($GAME."_mobs", $GAME."_boss", $GAME."_weapons");
  foreach($tables as $table) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
    
    if ( empty($data) ) {
      echo "{$table} Aids hinzufügen<br>";
    } else {
      $missing_number = missing_number($data); 
    }
    
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
 * Scan dir and list files ordered by create date
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
    
    default:
      die("FEXTRA URL FEHLER");
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




// @rtrim()
function replaceLastRN ($str) {
  // \r\n
  // $str = preg_replace('/\bblank$/', '', $str);
  $str = preg_replace('/\bblank$/', '', $str);
  return $str;
}

function str_lreplace($search, $replace, $subject) {
  $pos = strrpos($subject, $search);

  if($pos !== false) {
      $subject = substr_replace($subject, $replace, $pos, strlen($search));
  }

  return $subject;
}


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
 * Get the game currently set in DB
 */
function getGame () {
  global $pdo;
  
  $stmt = $pdo->prepare("SELECT name, abbr FROM games WHERE active=1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return $row["abbr"]; // get abbrevation (ds1, bb, etc) for db prefix
}


/*
 * Change the Game in DB
 *
 * GAMES:
 * Dark Souls 1
 * Dark Souls 2
 * Dark Souls 3
 * Bloodborne
 * Dark Souls 1 Remastered
 * Demon's Souls
 */
function changeGame ($game) { // $game = INT(ID)
  global $pdo;
  
  /*
  // all available Games
  $games = array("ds1", "ds2", "ds3", "bb", "ds1r", "des");
  // Check if var = in $games
  if ( !in_array($game, $games) || empty($game) ) die("OH GOTT WAS ISSN PASSIERT? @changeGame()" . "<br>" .'$game: ' . $game);
  */
  
  echo $game;
  
  $sql = "UPDATE games SET active = IF (id = :ID,1,0)";
  // $sql  = "UPDATE games SET active = 0 WHERE active = 1";
  // UPDATE games SET active = IF (id = 1,1,0);
  $stmt = $pdo->prepare($sql);                                  
  // $stmt->bindParam(":abbr", $game, PDO::PARAM_STR);
  $stmt->bindParam(":ID", $game, PDO::PARAM_INT);
  $stmt->execute();
}

?>