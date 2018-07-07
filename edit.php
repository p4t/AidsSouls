<?php
// Lib
require_once("config.db.php");
require_once("functions.inc.php");
require_once("globals.inc.php");

// DB Hack
// include_once("del.ajax.php");

// include_once("inc/edit/aids.inc.php");
// include_once("inc/edit/kills.inc.php");
// include_once("inc/edit/todo.inc.php");
// include_once("inc/edit/backups.inc.php");
// include_once("inc/edit/rolls.inc.php");
// include_once("inc/edit/logs.inc.php");
// include_once("inc/edit/config.inc.php");
// include_once("inc/edit/autocomplete.inc.php");

// include_once("inc/edit/aids.inc.php");



// Save visits to edit.php into db
// saveRolls();
?>

<!doctype html>
<html lang="de">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>\[T]/ the Edit</title>
<base href="http://ds.fahrzeugatelier.de">

<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/dice_animations.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">
  
<!-- jQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  
<!-- Balloon Tooltip -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
  
<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">
  
<!-- Font for Edit.php and Input Fields -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<!-- Font for Numbers: -->
<link href="https://fonts.googleapis.com/css?family=Kameron" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

<meta name="theme-color" content="#3f292b">
<meta name="msapplication-TileColor" content="#3f292b"> 
<meta name="apple-mobile-web-app-status-bar-style" content="#3f292b">

<meta name="mobile-web-app-capable" content="yes">
  
<meta name="google" content="notranslate">
<meta name="application-name" content="Aids Souls Edit">
<meta name="description" content="Roll dice to edit AIDS">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="google" content="nositelinkssearchbox">
  
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.tablesorter.js"></script><!-- http://tablesorter.com/docs/ -->

</head>

<body spellcheck="false" id="edit">
<div id="main">

<!-- SIDENAV -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
    <!-- &times; -->
    <i class="fas fa-times"></i>
  </a>

  <span class="sidenav-toplink">
    <a href="/" data-balloon="Zur Aids Hauptseite" data-balloon-pos="up">
      Aids <i class="fas fa-external-link-alt"></i>
    </a>
    <!-- <a href="/edit">Edit</a> -->
  </span>    

  <a href="/edit?show=aids" <?=( $_GET["show"] == "aids" || !$_GET["show"] ) ? "class='sidenav-active'" : ""?>>Mobs</a>
  <a href="/edit?show=aids" <?=( $_GET["show"] == "aids" || !$_GET["show"] ) ? "class='sidenav-active'" : ""?>>Boss</a>
  <a href="/edit?show=aids" <?=( $_GET["show"] == "aids" || !$_GET["show"] ) ? "class='sidenav-active'" : ""?>>Weapons</a>

  <span>&nbsp;</span>

  <a href="/edit?show=kills"    <?=( $_GET["show"]  == "kills"    ) ? "class='sidenav-active'" : ""?>>Kills</a>
  <a href="/edit?show=rolls"    <?=( $_GET["show"]  == "rolls"    ) ? "class='sidenav-active'" : ""?>>Rolls</a>
  <a href="/edit?show=logs"     <?=( $_GET["show"]  == "logs"     ) ? "class='sidenav-active'" : ""?>>Logs</a>
  <a href="/edit?show=todo"     <?=( $_GET["show"]  == "todo"     ) ? "class='sidenav-active'" : ""?>>Todo</a>
  <a href="/edit?show=backups"  <?=( $_GET["show"]  == "backups"  ) ? "class='sidenav-active'" : ""?>>Backup</a>

  <span>&nbsp;</span>

  <a href="/edit?show=autocomplete" <?=( $_GET["show"]  == "autocomplete" ) ? "class='sidenav-active'" : ""?>>Autocomplete</a>
  <a href="/edit?show=aidsglobal"   <?=( $_GET["show"]  == "aidsglobal"   ) ? "class='sidenav-active'" : ""?>>Global Aids</a>

  <span>&nbsp;</span>

  <a href="/edit?show=config" <?=( $_GET["show"]        == "config"       ) ? "class='sidenav-active'" : ""?>>
    <i class="fas fa-cog"></i>
  </a>
</div>

<span id="sidenav-icon" class="sidenav-icon" onclick="openNav()">
  <!-- &#9776; --> <!-- Menü -->
  <i class="fas fa-bars"></i>
</span>





<?php
/*
 * EDIT: MOBS, BOSS, WEAPONS
 */
  if ( !empty($_GET["mode"]) && empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode         = $_GET["mode"];
    (STRING)$table        = _GAME . "_" . $mode;
    (STRING)$parentField  = $table."Name";
    (INT)$ID              = $_GET["ID"];  
  
    // if ( isset($_POST["newName"]) ) {
    if ( !empty($_POST["newName"]) ) {
      (STRING)$newName  = $_POST["newName"];
      (STRING)$oldName  = $_POST["oldName"];
      (INT)$newDice     = $_POST["newDice"];
      (INT)$oldDice     = $_POST["oldDice"];
      
      $sql = "UPDATE $table SET name = :name, dice = :dice WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":name", $_POST["newName"], PDO::PARAM_STR);
      $stmt->bindParam(":dice", $_POST["newDice"], PDO::PARAM_INT);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
      // Copy over weapon image from fextralife
      // if ( $mode == "weapons" ) copyWeaponFromFextra($newName);
      // ERROR MESSAGE:
      if ( $mode == "weapons" ) {
        
        // echo "fextraPOST: " . $_POST["fextra"];
        
        if ( empty($_POST["fextra"]) ) copyWeaponFromFextra($newName);
        else copyWeaponFromFextra($newName, $_POST["fextra"]);
      }
      
      // https://darksouls.wiki.fextralife.com/file/Dark-Souls/Wpn_Priscilla's_Dagger.png
    
      // log
      // if ( $newDice  != $oldDice ) logAction ($table, "Edit", $ID, $parentField , $oldDice, $newDice);
      // if ( $newName  != $oldName ) logAction ($table, "Edit", $ID, $parentField, $oldName, $newName);
      
      redirect("/edit", $statusCode = 303);
      
    } else {
      
      $stmt = $pdo->prepare("SELECT * FROM $table WHERE ID = ".$_GET["ID"]." ");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
    }
    ?>
  
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>

  <div class="flex-item">
    <form action="/edit?mode=<?=$mode?>&ID=<?=$_GET["ID"]?>" method="post" id="edit">
      <ul>
        <li><label>Dice:</label></li>
        <li><input type="number" name="newDice" value="<?=$row["dice"]?>" min="1" max="99" autocomplete="off" placeholder="#" required="required"></li>
        <li><label>Entry:</label></li>
        <li><input type="text" name="newName" id="tags-<?=$mode?>" value="<?=$row["name"]?>" maxlength="32" required="required"></li>
        <?php
        if ($mode == "weapons") {
          $path = sanitizeWeaponsPath ($row["name"]);
          if ( !file_exists($_SERVER["DOCUMENT_ROOT"] . $path[2]) ) {
        ?>
        <li><input type="text" name="fextra" autocomplete="off" placeholder="(Fextra) IMG URL"></li>
        <?php
          }
        }
        ?>
        <li><label>IMG:</label></li>
        <li class="text-center">
          <?php
          if ( $mode =="weapons" ) {
            // $path = sanitizeWeaponsPath ($row["name"]);
          ?>
            <img class="max-width-height border" src="<?=$path[2]?>" alt="<?=$path[3]?>">
          <?php
          } else {
            $file_name = sanitizeAids($row["name"]);
            $path = "/dice/icons/{$file_name}.png";
          ?>
            <img class="max-width-height border" src="<?=$path?>" alt="<?=$file_name?>">
          <?php
          } // ENDIF
          ?>
        </li>
        
        <li><input type="submit" value="Submit"></li>
      </ul>

      <input type="hidden" name="oldDice" value="<?=$row["dice"]?>">
      <input type="hidden" name="oldName" value="<?=$row["name"]?>">
    </form>
  </div>

  <div class="flex-item">&nbsp;</div>
</div>

<?php
} // ENDIF
?>




<?php
/*
 * EDIT: KILLS
 */
if ( !empty($_GET["mode"]) && $_GET["mode"] == "kills" ) {
  
  (STRING)$mode       = $_GET["mode"];
  (STRING)$table      = _GAME . "_" . $mode;
  (INT)$ID            = $_GET["ID"];
  
  // if ( (!empty($_POST["newJoker"])) || (!empty($_POST["newSpent"])) || (!empty($_POST["newBossNames"])) ) {
  if ( !empty($_POST) ) {
    
    (INT)$postJoker   = $_POST["newJoker"];
    (INT)$oldJoker    = $_POST["oldJoker"];
    (INT)$postSpent   = $_POST["newSpent"];
    (INT)$oldSpent    = $_POST["oldSpent"];
    // (STRING)$postName = $_POST["newName"];
    
    (STRING)$postBoss = $_POST["newBossNames"];
    (STRING)$oldBoss  = $_POST["oldBossNames"];
    
    // remove last new line \r\n (jQuery Autocomplete)
    $postBoss = rtrim($postBoss); // rtrim($postBoss, "\r\n");
    
    // echo "postBoss DEBUG: " . $postBoss;
    
    // More Jokers spent than earned
    if ( $postJoker >= $postSpent ) {
    
      $sql = "UPDATE {$GAME}_kills SET joker = :joker, spent = :spent, bossNames = :bossNames WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":joker", $postJoker, PDO::PARAM_INT);
      $stmt->bindParam(":spent", $postSpent, PDO::PARAM_INT);
      $stmt->bindParam(":bossNames", $postBoss, PDO::PARAM_STR);
      $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
      $stmt->execute();

      // log
      // if ( $newJoker  != $postJoker ) logAction ($table, "Edit", $ID, "joker", $oldJoker, $postJoker);
      // if ( $newSpent  != $postSpent ) logAction ($table, "Edit", $ID, "spent", $oldSpent, $postSpent);
      // if ( $newBoss   != $postBoss ) logAction ($table, "Edit", $ID, "bossNames", $oldBoss, $postBoss);

      redirect("/edit?show=kills", $statusCode = 303); // http://ds.fahrzeugatelier.de/edit?show=kills
      
    } else {
      echo ("ERROR: Mehr Joker ausgegeben als erhalten");
    }
     
  } else {
    $stmt = $pdo->prepare("SELECT * FROM {$GAME}_kills WHERE ID = ".$_GET["ID"]." ");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="/edit?mode=kills&ID=<?=$_GET["ID"]?>" method="post" id="edit">
        <ul>
          <li><label>Joker:</label></li>
          <li><input type="number" name="newJoker" value="<?=$row["joker"]?>" min="0" max="99" autocomplete="off" placeholder="Joker insgesamt" required="required"></li>

          <li><label>Ausgegeben:</label></li>
          <li><input type="number" name="newSpent" value="<?=$row["spent"]?>" min="0" max="99" autocomplete="off" placeholder="Joker ausgegeben" required="required"></li>

          <li><label>bossNames:</label></li>
          <li>
            <textarea id="tags-bosses" rows="15" name="newBossNames" cols="50" required="required"><?=$row["bossNames"]?></textarea>
          </li>

          <li><input type="submit" value="Submit"></li>
          
        </ul>
        <input type="hidden" name="oldJoker" value="<?=$row["joker"]?>">
        <input type="hidden" name="oldSpent" value="<?=$row["spent"]?>">
        <input type="hidden" name="oldBossNames" value="<?=$row["bossNames"]?>">
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

<?php
} // ENDIF
?>




<?php
/*
 * EDIT: TODO
 */
if ( !empty($_GET["mode"]) && $_GET["mode"] == "todo" ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = _GAME . "_" . $mode;
    (INT)$ID        = $_GET["ID"];  
  
    if ( !empty($_POST["newTodo"]) ) {
      (STRING)$newTodo  = $_POST["newTodo"];
      
      $sql = "UPDATE $table SET todoText = :todoText WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":todoText", $_POST["newTodo"], PDO::PARAM_STR);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
      redirect("/edit?show=todo", $statusCode = 303);

    } else {
      
      $stmt = $pdo->prepare("SELECT * FROM $table WHERE ID = ".$_GET["ID"]." ");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="/edit?mode=<?=$mode?>&ID=<?=$_GET["ID"]?>" method="post" id="edit">
        <ul>
          <li><label>Entry:</label></li>
          <li><textarea rows="15" name="newTodo" cols="50" required="required"><?=$row["todoText"]?></textarea></li>
          <li><input type="submit" value="Submit"></li>
        </ul>
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

<?php
} // ENDIF
?>





<?php
/*
 * EDIT: CONFIG>>GAME
 */
if ( !empty($_GET["mode"]) && $_GET["mode"] == "config" ) { // mode config
  (STRING)$mode   = $_GET["mode"];
  (INT)$ID        = $_GET["ID"];  
  
  // Games
  if ( !empty($_POST) ) {
    (STRING)$newName  = $_POST["newName"];
    (STRING)$newAbbr  = trim(strtolower($_POST["newAbbr"]));
    (INT)$newActive   = $_POST["newActive"];
    (INT)$newNgp      = $_POST["newNgp"];
    
    (STRING)$oldAbbr  = $_POST["oldAbbr"];
    (INT)$oldActive   = $_POST["oldActive"];
    
    (INT)$ID          = $_GET["ID"];

    // if field active has changed use function @changeGame()
    if ( $newActive !== $oldActive ) {
      changeGame($ID);
    }
    
    // If Abbr changes alter tables in db
    // TABLE `aaa_boss`, `aaa_kills`, `aaa_log`, `aaa_mobs`, `aaa_rolls`, `aaa_todo`, `aaa_weapons`
    if ( $oldAbbr !== $newAbbr ) {
      
      // check if entry alrerady exist
      checkIfAbbrIsTaken($newAbbr);
      
      // Try to write tables into DB just to make sure they exist if adding failed previously
      // writeSQL($oldAbbr);
      
      // Rename SQL String
      $sql  = "RENAME TABLE {$oldAbbr}_boss TO {$newAbbr}_boss;";
      $sql .= "RENAME TABLE {$oldAbbr}_kills TO {$newAbbr}_kills;";
      // $sql .= "RENAME TABLE {$oldAbbr}_log TO {$newAbbr}_log;";
      $sql .= "RENAME TABLE {$oldAbbr}_mobs TO {$newAbbr}_mobs;";
      $sql .= "RENAME TABLE {$oldAbbr}_rolls TO {$newAbbr}_rolls;";
      // $sql .= "RENAME TABLE {$oldAbbr}_todo TO {$newAbbr}_todo;";
      $sql .= "RENAME TABLE {$oldAbbr}_weapons TO {$newAbbr}_weapons;";
      
      $stmt = $pdo->exec($sql);
      
      echo "<br><br><br><br><br>";
      echo "stmt: " . $stmt;
    }
    
    // Update name, abbr and ngp
    $sql = "UPDATE games SET name = :name, abbr = :abbr, ngp = :ngp WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(":name", $newName, PDO::PARAM_STR);
    $stmt->bindParam(":abbr", $newAbbr, PDO::PARAM_STR);
    $stmt->bindParam(":ngp", $newNgp, PDO::PARAM_INT);
    
    $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
    $stmt->execute();
    
    redirect("/edit?show=config", $statusCode = 303);

  } else {

    $stmt = $pdo->prepare("SELECT * FROM games WHERE ID = ".$_GET["ID"]." ");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
    <div class="flex-item">
      <form action="/edit?mode=config&item=games&ID=<?=$_GET["ID"]?>" method="post" id="edit">
        <ul>
          
          <li><label>Name:</label></li>
          <li><input type="text" name="newName" value="<?=$row["name"]?>" maxlength="32" required="required"></li>

          <li><label>Abbr:</label></li>
          <li><input type="text" name="newAbbr" id="newAbbr" value="<?=$row["abbr"]?>" maxlength="5" required="required"></li>
          
          <li><label>Active:</label></li>
          <li><input type="number" name="newActive" value="<?=$row["active"]?>" min="0" max="1" autocomplete="off" placeholder="#" required="required"></li>
          
          <li><label>NG+:</label></li>
          <li><input type="number" name="newNgp" value="<?=$row["ngp"]?>" min="0" max="1" autocomplete="off" placeholder="#" required="required"></li>

          <li><input type="submit" value="Submit"></li>
        </ul>
        
        <input type="hidden" name="oldAbbr" value="<?=$row["abbr"]?>">
        <input type="hidden" name="oldActive" value="<?=$row["active"]?>">
        
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>
  
<?php
} // ENDIF
?>
  
  
  
<?php
/*
 * ADD: CONFIG>>GAMES
 */

  if ( !empty($_GET["mode"]) && !empty($_GET["action"]) && ($_GET["mode"] == "games") ) {
    
    (STRING)$mode   = $_GET["mode"];
    (INT)$ID        = $_GET["ID"];
  
    if ( !empty($_POST["addGame"]) ) {
      (STRING)$addGame  = $_POST["addGame"];
      (STRING)$addAbbr  = trim(strtolower($_POST["addAbbr"]));
      
      // check if entry alrerady exist
      $abbrAvailable = checkIfAbbrIsTaken($addAbbr);
      
      // Add Tables into DB
      $writeSQL = writeSQL($addAbbr);
            
      // If there is no error with the SQL template and abbr is not taken
      if ( $abbrAvailable = TRUE && $writeSQL == 0 ) {
        // Insert into DB
        $sql = "INSERT INTO games (name, abbr) VALUES (:name, :abbr)";
        $stmt = $pdo->prepare($sql);          
        $stmt->bindParam(":name", $addGame, PDO::PARAM_STR);
        $stmt->bindParam(":abbr", $addAbbr, PDO::PARAM_STR);
        $stmt->execute();
      }
      
      redirect("/edit?show=config", $statusCode = 303);

    } // ENDIF (ELSE) $_POST["addGame"]
    
  } // ENDIF $_GET["mode"]
?>





<?php
/*
 * ADD: MOBS, BOSS, WEAPONS
 */
  if ( !empty($_GET["mode"]) && !empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = _GAME . "_" . $mode;
    // (INT)$ID        = $_GET["ID"];
  
    if ( !empty($_POST["addEntry"]) ) {
      (STRING)$addEntry = $_POST["addEntry"];
      (INT)$addDice     = $_POST["addDice"];
      
      if ( empty($_POST["addDice"]) ) { // if field for dice value wasn't filled
        $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice DESC LIMIT 1"); // get max value from field dice
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        (INT)$addDice = $row["dice"] + 1; // +1 of max dice value
      } else { 
        // cherck if dice alrerady exists
        $stmt = $pdo->prepare("SELECT dice FROM $table WHERE dice = $addDice"); // get max value from field dice
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row["dice"] != NULL ) die("Dice Wert schon vergeben!");
      }    
      
      // Insert Dice Value into DB
      $sql = "INSERT INTO $table (dice, name) VALUES (:dice, :name)";
      $stmt = $pdo->prepare($sql);          
      $stmt->bindParam(':dice', $addDice, PDO::PARAM_INT);
      $stmt->bindParam(':name', $_POST['addEntry'], PDO::PARAM_STR);
      $stmt->execute();

      // Copy over weapon image from fextralife
      if ( $mode == "weapons" ) copyWeaponFromFextra($addEntry);
      
      redirect("/edit", $statusCode = 303);

    } // ENDIF (ELSE) $_POST["addEntry"]
    
  } // ENDIF $_GET["mode"]
?>




<?php
/*
 * TRUNCATE
 */
if ( !empty($_GET["action"]) && $_GET["action"] == "truncate" ) {
  $sql = "TRUNCATE {$GAME}_rolls";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  
  redirect("/edit?show=rolls", $statusCode = 303);
}
?>


<?php
/*
 * CHANGE GAME
 */
if (
  
  ( !empty($_GET["mode"]) && $_GET["mode"] == "selectGame" )
  &&
  // ( !empty($_POST["selectGame"]) )
  ( !empty($_GET["game"]) )
  
   ) {
  // $selectGame = $_POST["selectGame"];
  $selectGame = $_GET["game"];
  
  changeGame($selectGame);
  redirect("/edit");
}
?>

  





<?php
/*
* NO $_REQUEST, STANDARD VIEW
*/
if ( empty($_REQUEST) || !empty($_GET["show"]) ) :
?>


  



  <!-- Header -->
  <header>
  <!-- <div class="header_Edit"> -->
      <a href="/">
        <img src="/img/<?=_GAME?>_logo.png" alt="Dark Souls Logo" style="margin-top: -25px;"> <!--  width="661" height="80" -->
      </a>
    <h1 style="margin-top: 15px;">
      &raquo;
      <a href="/">AIDS</a>
      |
      <a href="/edit">EDIT</a>
      &laquo;
    </h1>
  <!-- </div> -->
  </header>

  <!-- !!!CONFIG -->
  <div id="config">
    <ul>
      <li>
        <strong>Game:</strong>
        <?php
        if     ( _GAME == "ds1"  ) echo "Dark Souls I";
        elseif ( _GAME == "ds1r" ) echo "Dark Souls Remastered";
        elseif ( _GAME == "ds2"  ) echo "Dark Souls II";
        elseif ( _GAME == "ds3"  ) echo "Dark Souls III";
        elseif ( _GAME == "bb"   ) echo "Bloodborne";
        ?>
      </li>
      <li><strong>DB:</strong> <?=_GAME?></li>
      <li><strong>Login:</strong> Disabled</li>
      <li><strong>User:</strong> {Admin}</li>
      <li><strong>Change Game:</strong></li>
      <li>
        <select id="selectGame" name="selectGame">
          <option value="1" <?=(_GAME == "des")   ? "selected"  :""?> disabled>Demon's Souls</option>

          <option value="2" <?=(_GAME == "ds1")   ? "selected"  :""?>>Dark Souls I</option>
          <option value="3" <?=(_GAME == "ds2")   ? "selected"  :""?>>Dark Souls II</option>
          <option value="4" <?=(_GAME == "ds3")   ? "selected"  :""?>>Dark Souls III</option>
          <option value="5" <?=(_GAME == "ds1r")  ? "selected"  :""?>>Dark Souls Remastered</option>
          <option value="6" <?=(_GAME == "bb")    ? "selected"  :""?>>Bloodborne</option>
        </select>
        <!-- <input type="submit" value="Submit"> --> 
      </li>
    </ul>
  </div>






<?php
  // CHECK MISSING DICE
  checkMissingDice();
?>



  <div id="flex-container-edit">
    <div class="flex-container-edit-item">
      <?php
        /*
        * INC
        */
        if ( !empty($_GET["show"]) && $_GET["show"] == "kills"        ) include("inc/edit/kills.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "todo"         ) include("inc/edit/todo.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "backups"      ) include("inc/edit/backups.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "rolls"        ) include("inc/edit/rolls.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "logs"         ) include("inc/edit/logs.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "autocomplete" ) include("inc/edit/autocomplete.inc.php");
        if ( !empty($_GET["show"]) && $_GET["show"] == "aidsglobal"   ) include("inc/edit/aids.global.inc.php");
      
        if ( !empty($_GET["show"]) && $_GET["show"] == "config"       ) include("inc/edit/config.inc.php");

        elseif (
          empty($_GET["show"]) && 
          empty($_REQUEST) ||
          $_GET["show"] == "aids"
        )                                                               include("inc/edit/aids.inc.php");

        // include("autocomplete/ALLAUTOCOMPLETEDATA.php");
      ?>
    </div>
  </div>



<?php
ENDIF
?>


<?php
$request_uri = htmlspecialchars($_SERVER["REQUEST_URI"], ENT_QUOTES, "utf-8")
?>

<!-- FOOTER -->
<footer>
  <nav style="font-size: 2em;">
    <script>
    document.write('<a href="' + document.referrer + '" data-balloon="Zurück" data-balloon-pos="up"><i class="fas fa-arrow-left"></i></a>');
    </script>
    | 
    <a href="<?=$request_uri?>#" data-balloon="Nach oben" data-balloon-pos="up">
      <i class="fas fa-arrow-up"></i>
    </a>
    |
    <a href="/edit" data-balloon="Zu Edit" data-balloon-pos="up">
      <i class="fas fa-arrow-right"></i>
    </a>
  </nav>
</footer>

<!-- Sort Alphabetically -->
<script>
/*
$(document).ready(function() {
  $("#mobs, #boss, #weapons").tablesorter();
});
*/


$(document).ready(function() { 
    $("#mobs, #boss, #weapons").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero)
        } 
    }); 
});


/* LIST */
/*
$(document).ready(function() {
  $('.link-sort-list').click(function(e) {
      var $sort = this;
      var $list = $('#sort-list');
      var $listLi = $('li',$list);
      $listLi.sort(function(a, b){
          var keyA = $(a).text();
          var keyB = $(b).text();
          if($($sort).hasClass('asc')){
              return (keyA > keyB) ? 1 : 0;
          } else {
              return (keyA < keyB) ? 1 : 0;
          }
      });
      $.each($listLi, function(index, row){
          $list.append(row);
      });
      e.preventDefault();
  });
});
*/

/* TABLE */
/*
function sortTable(table, order) {
  console.log("click");
  
    table = $(table);
    var asc   = order === 'asc',
        tbody = table.find('tbody');
    
    tbody.find('tr').sort(function(a, b) {
        if (asc) {
            // return $('td:first', a).text().localeCompare($('td:first', b).text());
            return $('td:nth-child(2)', a).text().localeCompare($('td:nth-child(2)', b).text());
        } else {
            // return $('td:first', b).text().localeCompare($('td:first', a).text());
            return $('td:nth-child(2)', b).text().localeCompare($('td:nth-child(2)', a).text());
        }
    }).appendTo(tbody);
}
// $('.myclass tr:nth-child(2)')
// sortTable($('#mobs'),'asc');
*/
</script>

<!-- Sidenav -->
<script>
function toggleNav () {
  
}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  
  /*
    window.setTimeout(function(){
      $("#sidenav-icon").css('transform', 'rotate(90deg)');
    },500);
  */
  
  $("#sidenav-icon").css({'transform': 'rotate(90deg)'});
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  // document.body.style.backgroundColor = "white";
  // document.body.style.backgroundColor.remove();
  // document.body.style.backgroundColor = "trapnsparent";
  document.body.style.backgroundColor = "rgba(0,0,0,0)";
  
  $("#sidenav-icon").css({'transform': 'rotate(0deg)'});
}
</script>

<!-- jQuery Autocomplete -->
<script>
$( function() {
  
  var availableTags         = <?php include("autocomplete.jQuery.php")?>;
  var availableTagsMobsBoss = <?php include("autocomplete/aids.php");?>;
  var availableTagsBosses   = <?php include("autocomplete/bosses.php");?>;
  
  $( "#tags-weapons" ).autocomplete({
    minLength: 0,
    source: availableTags
  });
  
  $( "#tags-mobs, #tags-boss" ).autocomplete({
    minLength: 0,
    source: availableTagsMobsBoss
  });
    
  /*
  $( "textarea#tags-bosses" ).autocomplete({
    source: availableTagsBosses
  });
  */
  
  /*
  * Autocomplete multiple: https://jqueryui.com/autocomplete/#multiple
  * <textarea>
  * modified for new line break instead of comma
  */
  
  function split( val ) {
    // return val.split( /,\s*/ );
    return val.split( /\n\s*/ ); // activate autocomplete on new line break
  }
  function extractLast( term ) {
    return split( term ).pop();
  }

  $( "#tags-bosses" )
    // don't navigate away from the field on tab when selecting an item
    .bind( "keydown", function( event ) {
      if ( event.keyCode === $.ui.keyCode.TAB &&
          $( this ).autocomplete( "instance" ).menu.active ) {
        event.preventDefault();
      }
    })
    .autocomplete({
      minLength: 0,
      source: function( request, response ) {
        // delegate back to autocomplete, but extract the last term
        response( $.ui.autocomplete.filter(
          availableTagsBosses, extractLast( request.term ) ) ); // !!! AVAILABLETAGS
      },
      focus: function() {
        // prevent value inserted on focus
        return false;
      },
      select: function( event, ui ) {
        var terms = split( this.value );
        // remove the current input
        terms.pop();
        // add the selected item
        terms.push( ui.item.value );
        // add placeholder to get the comma-and-space at the end
        terms.push( "" );
        // this.value = terms.join( ", " ); // comma
        this.value = terms.join( "\n" ); // new line
        return false;
      }
      });
  

} );
</script>
  
<!-- Toggle Table -->
<script>
function toggleTable () {
  event.preventDefault();
  
  $(".toggleTable").toggle("slow");
  
  $(".toggleTableIndicatorPlus").toggle("slow");
  $(".toggleTableIndicatorMinus").toggle("slow");

  // console.log($(".toggleTableIndicator").text());
  
}
</script>

<!-- Change Game Dropdown -->
<script>
$(function(){
  // bind change event to select
  $("#selectGame").on("change", function () {
    // var url = $(this).val(); // get selected value
    var game = $(this).val(); // get selected value
    var url = "/edit?mode=selectGame&game="+game;
    if (url) { // require a URL
        window.location = url; // redirect
    }
    return false;
  });
});
</script>

<!-- Ajax Delete -->
<script>
$(document).ready(function () {
  $(".delete").click(function() {
    var delcart = $(this).data("value");
    var deltable = $(this).data("table");
    
        if (confirm("Are you sure want to delete?")) {
          $.ajax({
              type: "POST",
              url: "del.ajax.php",
              data: {ID : delcart, table : deltable},
              success: function (data) {
                  if (data) {
                      //alert(data);
                      // window.location.reload();
                        // delete HTML instead of load()
                        // $("tr[id="+delcart+"]").remove();
                        $("tr[id="+deltable+"-"+delcart+"]").fadeOut();
                        
                        /*
                        $(".delete").on("click",function() { 
                          $(this).closest("tr").remove();
                          return false;
                        });
                        */
                    
                    
                    
                      } else {
                        // alert ("OHJE");
                      }
                        // $("#aidsList").load("aids.edit.ajax.php");
                      }
                      });
        }
        // alert($(this).data('value'));
        });
});
</script>

<!-- animate-sidenav-icon() -->

<script>
  /*
$( "#sidenav-icon" ).click(function() {
  console.log("click");
  $("#sidenav-icon").css({'transform': 'rotate(90deg)'});
});
*/
</script>

  
<!-- Background Image per _GAME -->
<style>
  html {
    background: url("/img/bg/<?=$GAME?>.jpg") no-repeat center center fixed;
    
    background-color: black;

    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
</style>

</div> <!-- EOF #main -->
</body>
</html>