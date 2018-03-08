<?php
require_once("config.db.php");
require_once("functions.inc.php");


if ( (!empty($_POST["mobs"])) || (!empty($_POST["boss"])) || (!empty($_POST["weapons"])) ) {

  // (STRING)$addEntry = $_POST["weapons"];
  // (STRING)$table    = "weapons";
  
  ///////////////////////// FUNCTIONS AND MAKE POSSIBLE
  ////////////////////////// MORE THAN ONE
  
  // DEBUG
  /*
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  */
  
  
  $vars = $_POST;
  // print_r(array_keys($vars));
  
  echo "<br><br>";

  foreach ($vars as $var) {
    // echo "<br>Var: $var <br>";
  }
  
  
  foreach (array_keys($_POST) as $field) {
    // echo $_POST[$field] . "<br>";
  }
  
  foreach ($_POST as $name => $val) {
     // echo htmlspecialchars($name . ': ' . $val) . "<br>";
    
    // db stuff
    if ( !empty($val) ) {
      $table    = $name;
      $addEntry = $val;
      $addDice  = getDiceValuePlusOne($table);
      
      ajaxPDOInsert($table, $addDice, $addEntry);
    }

} // END FOREATCH
  
  /*
  if ( !empty($_POST["mobs"]) ) {
      $table = "mobs";
      $addEntry = $_POST["mobs"];
      $addDice = getDiceValuePlusOne($table);
    
      ajaxPDOInsert($table, $addDice, $addEntry);
  } elseif ( !empty($_POST["boss"]) ) {
      $table = "boss";
      $addEntry = $_POST["boss"];
      $addDice = getDiceValuePlusOne($table);

      ajaxPDOInsert($table, $addDice, $addEntry);
  } elseif ( !empty($_POST["weapons"]) ) {
      $table = "weapons";
      $addEntry = $_POST["weapons"];
      $addDice = getDiceValuePlusOne($table);

      ajaxPDOInsert($table, $addDice, $addEntry);
  } else {
    die("ERROR: {$table} - {$addEntry}");
  }
  */
  
  // Get highest dice value and add 1
  // $addDice = getDiceValuePlusOne($table);

  // Insert Dice Value into DB
  // ajaxPDOInsert($table, $addDice, $addEntry);
  
  // echo for JavaScript ajax response(), see index.php
  // Success Message
  // echo "Würfel: {$addDice} - {$table}: {$addEntry} hinzugefügt";
  echo "Erfolgreich hinzugefügt!";
} // ENDIF
?>




<?php
/*
$stmt = $pdo->prepare("SELECT mobs.name, boss.name FROM mobs, boss WHERE mobs.dice = $mobsRNG AND boss.dice = $bossRNG");
$stmt->execute();
$rowSuperAids = $stmt->fetch(PDO::FETCH_GROUP);

$mobsSuperAids = $rowSuperAids[0];
$bossSuperAids = $rowSuperAids[1];
*/
?>