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
<html>
<head>
  
<meta charset="utf-8">
<meta name="theme-color" content="#3f292b"> 

<meta name="viewport" content="width=device-width,initial-scale=1.0">
  
<title>\[T]/</title>

<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/datatip.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
</head>

<body>
  
  <div class="header_Edit">
    <h1>&raquo; <a href="aids.php">AIDS</a> &laquo;</h1>
  </div>


<?php
/*
 * EDIT MOBS, BOSS, WEAPONS
 */

  if ( !empty($_GET["mode"]) && (empty($_GET["action"])) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = $mode;
    (INT)$ID        = $_GET["ID"];  
  
    if ( isset($_POST["newName"]) ) {
      (STRING)$newName  = $_POST["newName"];
      (INT)$newDice     = $_POST["newDice"];

      // pdoUpdateTable($pdo, $table, $post, $ID);
      
      $sql = "UPDATE $table SET name = :name, dice = :dice WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":name", $_POST["newName"], PDO::PARAM_STR);
      $stmt->bindParam(":dice", $_POST["newDice"], PDO::PARAM_INT);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
      // UPDATE ID IF ID INPUT FIELD SHOWS DIFFERENT VALUE
      /*
      if ( $ID != $newID ) {
        $sql = "UPDATE $table SET ID = :newID WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":newID", $_POST["newID"], PDO::PARAM_INT);
        $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
        $stmt->execute();
      }
      */

      redirect("edit.php", $statusCode = 303);

    } else {
      
      $stmt = $pdo->prepare("SELECT * FROM $table WHERE ID = ".$_GET["ID"]." ");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="edit.php?mode=<?= $mode ?>&ID=<?= $_GET["ID"] ?>" method="post">

        <label>Dice:</label>
        <!-- <input type="text" name="newDice" value="<?php //$row["dice"]; ?>" required="required"> -->
        <input type="number" name="newDice" value="<?= $row["dice"]; ?>" min="1" max="99" autocomplete="off" placeholder="Würfel" required="required">
        
        <label>Entry:</label>
        <input type="text" name="newName" value="<?= $row["name"]; ?>" maxlength="32" required="required">
        <input type="submit" value="Submit">
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

if ( isset($_GET["mode"]) && ($_GET["mode"] == "kills") ) {
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
    
    redirect("edit.php", $statusCode = 303);
     
  } else {
    $stmt = $pdo->prepare('SELECT * FROM kills WHERE ID = '.$_GET["ID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="edit.php?mode=kills&ID=<?= $_GET["ID"] ?>" method="post">
        <label>Joker:</label>
        <input type="text" name="newJoker" value="<?= $row["joker"]; ?>">

        <label>Ausgegeben:</label>
        <input type="text" name="newSpent" value="<?= $row["spent"]; ?>">

        <label>bossNames:</label>
        <textarea rows="15" name="newBossNames" cols="50"><?= $row["bossNames"]; ?></textarea>

        <input type="submit" value="Submit">
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

<?php
} // ENDIF
?>
  
  
  
  
  
  
  
<?php 
  /*
 * ADD MOBS, BOSS, WEAPONS
 *
 *
 */
  
  if ( !empty($_GET["mode"]) && (!empty($_GET['action'])) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
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
      // CHECK IF DICE VALUE ALREADY EXISTS
      $sql = "INSERT INTO $table (dice, name) VALUES (:dice, :name)";
      // $sql = "INSERT INTO $table (dice, name) VALUES (:dice, :name) ON DUPLICATE KEY INSERT (dice, name) VALUES (:dice, :name)";
      $stmt = $pdo->prepare($sql);          
      $stmt->bindParam(':dice', $addDice, PDO::PARAM_INT);
      $stmt->bindParam(':name', $_POST['addEntry'], PDO::PARAM_STR);
      $stmt->execute();

      redirect("aids.php", $statusCode = 303);

    } else { // display form if coming from link within aids.php and no $_POST
      ?>
      
      <form action="edit.php?mode=<?=$table?>&action=add" method="post">
        
        <table>
          <tbody>
            <tr>
              <td data-tip="Keine Zahl überspringen, Feld freilassen für auto Dice +1. Keine doppelten Werte!">
                <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="Würfel">
              </td>
              <td data-tip="Name">
                <input type="text" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="<?=$table?> Name" required="required">
              </td>
              <td data-tip="Abschicken"><input type="submit" value="Submit">
                &nbsp;
              </td>
            </tr>
          </tbody>
        </table>
        
      </form>  
  <?php
    } // ENDIF $_POST["addEntry"]
      
  } // ENDIF

  ?>
  
  
  
  
  
<?php
/*
 * DELETE 
 *
 *
 */

if ( !empty($_GET["action"]) && $_GET["action"] == "delete" ) {
  (STRING)$mode   = $_GET["mode"];
  (STRING)$table  = $mode;
  (INT)$ID        = $_GET["ID"];

  $sql = "DELETE FROM $table WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
  $stmt->execute();

  redirect("edit.php", $statusCode = 303);
}




/*
 * TRUNCATE
 *
 *
 */

if ( !empty($_GET["action"]) && $_GET["action"] == "truncate" ) {
  $sql = "TRUNCATE rolls";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  
  redirect("edit.php", $statusCode = 303);
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
<form action="edit.php?mode=<?=$table?>&action=add" method="post">
<table>
  <tbody>
    <tr>
      <th scope="col"><strong>Dice</strong></th>
      <th scope="col"><strong><?=ucfirst($table)?></strong></th>
      <th scope="col"><strong>Action</strong></th>
    </tr>
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
    <tr>
      <td><a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[1]?></a></td>
      <td><a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>"><?=$row[2]?></a></td>
      <td>
        <a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>" data-tip="Edit">
          <img src="img/edit-icon.png" class="edit_icon" width="024" height="024" alt="Edit">
        </a>
        <a href="edit.php?mode=<?=$table?>&action=delete&ID=<?=$row[0]?>" onClick="return confirm('SICHER???????? MACH KE SCHEISS!');" data-tip="Delete">
          <img src="img/delete-icon.png" width="024" height="024" alt="Delete">
        </a>
      </td>
    </tr>
    <?php ENDWHILE ?>
    <tr>
      <td data-tip="Keine Zahl überspringen, Feld freilassen für auto Dice +1. Keine doppelten Werte!">
        <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="Würfel">
      </td>
      <td data-tip="Name">
        <input type="text" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="<?=$table?> Name" required="required">
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
  <footer>
  <p>
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    <a href="edit.php">Back</a>
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a> 
  </p>
</footer>
  

  
</body>
</html>