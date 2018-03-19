<?php
//////////////// WARNING IF DICE ORDER IS NOT IN ORDER :-)

// DEBUG
  /*
if ( isset($_GET["mode"])) {
  echo "Mode: " . $_GET["mode"] . "<br>";
}
*/

require_once("config.db.php");
require_once("functions.inc.php");

  //////////////////////////// FELD FÜR IDEEN AUF SEITE

// $name			= $s = trim(strip_tags($_POST['name']));
?>


<!doctype html>
<html lang="de">
<head>
  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  
<title>\[T]/ the Edit</title>
<base href="http://aids.gyros-mit-zaziki.de">

<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/datatip.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">
  
<link rel="stylesheet" href="/css/balloon.css">
  
<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">

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
  
<script src="/js/jquery-3.3.1.min.js"></script>

</head>

<body>
  <header>
  <!-- <div class="header_Edit"> -->
    <h1>&raquo; <a href="/">AIDS</a> &laquo;</h1>
  <!-- </div> -->
  </header>

  <nav>
    <a href="/edit#Mobs">Mobs</a> |
    <a href="/edit#Boss">Boss</a> |
    <a href="/edit#Weapons">Weapons</a> |
    <a href="/edit#Kills">Kills</a> |
    <a href="/edit#Rolls">Rolls</a>
  </nav>
  
  
  
  
  <pre>
  <?php
/*
  $data = $pdo->query("SELECT dice FROM weapons")->fetchAll(PDO::FETCH_COLUMN);
  print_r($data);
*/
  ?>
  </pre>

  <?php
  // $arr = range(min($data), max($data));
  // $missing = min(array_diff($arr, $data));
  // print_r($missing);
  // var_dump(min(array_diff($arr,$data
  // $missing_number = missing_number($data);
 ?>
  
  
  
  
<?php
$tables = array("mobs", "boss", "weapons");
foreach($tables as $table) :
  $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
  
  $missing_number = missing_number($data);
  if ( !empty($missing_number) ) :
  ?>

<div id="flex-container-missingnumbers">
  <div class="flex-item-missingnumbers">
    Folgende Würfel fehlen in der Tabelle <strong><?=$table?></strong>:
    <p>
    <?php
    // print_r($missing_number);
    // echo $missing_number[0];
    
    foreach($missing_number as $value) {
      echo $value . "<br>";
    }
    
    ?>
    </p>
  </div>
</div>
  <?php
  ENDIF
    ?>
  
<?php
  ENDFOREACH
?>

  
  
  
  
  
  

<?php
/*
 * EDIT: MOBS, BOSS, WEAPONS
 */

  if ( !empty($_GET["mode"]) && empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = $mode;
    (INT)$ID        = $_GET["ID"];  
  
    if ( isset($_POST["newName"]) ) {
      (STRING)$newName  = $_POST["newName"];
      (INT)$newDice     = $_POST["newDice"];
      
      $sql = "UPDATE $table SET name = :name, dice = :dice WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":name", $_POST["newName"], PDO::PARAM_STR);
      $stmt->bindParam(":dice", $_POST["newDice"], PDO::PARAM_INT);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
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
      <form action="/edit?mode=<?= $mode ?>&ID=<?= $_GET["ID"] ?>" method="post" id="edit">
        <ul>
          <li><label>Dice:</label></li>
          <li><input type="number" name="newDice" value="<?= $row["dice"]; ?>" min="1" max="99" autocomplete="off" placeholder="Würfel" required="required"></li>
          <li><label>Entry:</label></li>
          <li><input type="text" name="newName" value="<?= $row["name"]; ?>" maxlength="32" required="required"></li>
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
 * EDIT KILLS
 */

if ( !empty($_GET["mode"]) && $_GET["mode"] == "kills" ) {
  (STRING)$mode       = $_GET["mode"];
  (STRING)$table      = $mode;
  (INT)$ID            = $_GET["ID"];
  
  if ( isset($_POST["newJoker"])) {
    (INT)$postJoker   = $_POST["newJoker"];
    (INT)$postSpent   = $_POST["newSpent"];
    (STRING)$postName = $_POST["newName"];
    (STRING)$postBoss = $_POST["newBossNames"];
    
    $sql = "UPDATE kills SET joker = :joker, spent = :spent, bossNames = :bossNames WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':joker', $_POST['newJoker'], PDO::PARAM_INT);
    $stmt->bindParam(':spent', $_POST['newSpent'], PDO::PARAM_INT);
    $stmt->bindParam(':bossNames', $_POST['newBossNames'], PDO::PARAM_STR);
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    redirect("/edit", $statusCode = 303);
     
  } else {
    $stmt = $pdo->prepare("SELECT * FROM kills WHERE ID = ".$_GET["ID"]." ");
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
          <li><textarea rows="15" name="newBossNames" cols="50" required="required"><?=$row["bossNames"]?></textarea></li>

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
 * ADD: MOBS, BOSS, WEAPONS
 *
 *
 */
  
  if ( !empty($_GET["mode"]) && !empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = $mode;
    // (INT)$ID        = $_GET["ID"];
  
    if ( isset($_POST["addEntry"]) ) {
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

      // redirect("/aids", $statusCode = 303);
      redirect("/edit", $statusCode = 303);

    } else { // display form if coming from link within aids.php and no $_POST
      ?>
      
      <form action="/edit?mode=<?=$table?>&action=add" method="post">
        <table>
          <tbody>
            <tr>
              <td data-tip="Keine Zahl überspringen, Feld freilassen für auto Dice +1. Keine doppelten Werte!">
                <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="Würfel">
              </td>
              <td data-tip="Maximal 32 Zeichen">
                <input type="text" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="Name" required="required">
              </td>
              <td data-tip="Abschicken"><input type="submit" value="Submit">
                &nbsp;
              </td>
            </tr>
          </tbody>
        </table>
      </form>  
  <?php
    } // ENDIF (ELSE) $_POST["addEntry"]
      
  } // ENDIF
  ?>
  
  
  
  
  
<?php
/*
 * DELETE 
 */

if ( !empty($_GET["action"]) && $_GET["action"] == "delete" ) {
  (STRING)$mode   = $_GET["mode"];
  (STRING)$table  = $mode;
  (INT)$ID        = $_GET["ID"];

  $sql = "DELETE FROM $table WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
  $stmt->execute();
  
  // Check if number in dice is missing
  /*
  $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
  $missing_number = missing_number($data);
  missing_number($data);
  */ 
  
  $count = pdoCount($table);
  if ( $ID != $count ) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
    $missing_number = missing_number($data);
    print_r( $missing_number);
  }
  
  
  // $stmt = $pdo->prepare("SELECT dice FROM $table ORDER BY dice DESC LIMIT 1"); // get max value from field dice
  //$stmt = $pdo->prepare("SELECT dice FROM $table WHERE ID = $ID"); // get max value from field dice
  //$stmt->execute();
  //$row = $stmt->fetch(PDO::FETCH_ASSOC);
  //$row["dice"] + 1; // +1 of max dice value
  
  
  
  redirect("/edit", $statusCode = 303);
}




/*
 * TRUNCATE
 */

if ( !empty($_GET["action"]) && $_GET["action"] == "truncate" ) {
  $sql = "TRUNCATE rolls";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  
  redirect("/edit", $statusCode = 303);
}
?>
  
  
  
  
<div id="flex-container-edit">
  

<?php
/* STANDARD ANSICHT WENN NUR EDIT.PHP
* DISPLAY ALL TABLES WHERE TO EDIT FROM
*/
if ( empty($_GET["mode"]) ) :
  $tables = array("mobs", "boss", "weapons");

  foreach($tables as $table) :
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
?>
<a id="<?=ucfirst($table)?>"></a>
<form action="/edit?mode=<?=$table?>&action=add" method="post">
<table class="edit">
  <tbody>
    <tr>
      <th scope="col"><strong>Dice</strong></th>
      <th scope="col"><strong><?=ucfirst($table)?></strong></th>
      <th scope="col" class="edit_action"><strong>...</strong></th>
    </tr>
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
    <tr>
      <td><a href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[1]?></a></td>
      <td><a href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[2]?></a></td>
      <td class="edit_action">
        <a href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>" data-tip="Edit">
          <img src="/img/edit-icon.png" class="edit_icon" width="024" height="024" alt="Edit">
        </a>
        <a href="/edit?mode=<?=$table?>&action=delete&ID=<?=$row[0]?>" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-tip="Delete">
          <img src="/img/delete-icon.png" width="024" height="024" alt="Delete">
        </a>
      </td>
    </tr>
    <?php ENDWHILE ?>
    <tr>
      <td data-tip="Keine Zahl überspringen, Feld freilassen für auto Dice +1. Keine doppelten Werte!">
        <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="Würfel">
      </td>
      <td data-tip="Max 32 Zeichen">
        <input type="text" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="Name" required="required">
      </td>
      <td data-tip="Abschicken"><input type="submit" value="Submit">
        &nbsp;
      </td>
    </tr>
  </tbody>
</table>
</form>
<?php
  ENDFOREACH
?>

  <?php
    include("kills.inc.php");
    include("rolls.inc.php");
  ?>

<?php
ENDIF // EOF if ( empty($_GET["mode"]) )
?>

</div>
  
  
  


  
<!-- FOOTER -->  
<hr>
  <footer>
    <nav>
      <a href="/edit#">^</a> |
      <a href="/edit#Mobs">Mobs</a> |
      <a href="/edit#Boss">Boss</a> |
      <a href="/edit#Weapons">Weapons</a> |
      <a href="/edit#Kills">Kills</a> |
      <a href="/edit#Rolls">Rolls</a> |
      <a href="/edit#">^</a>
    </nav>
  </footer>
<hr>

  
</body>
</html>