<?php
if ( (!empty($_POST["mobs"])) || (!empty($_POST["boss"])) || (!empty($_POST["weapons"])) ) {
  
  // Database
  require_once("config.db.php");
  require_once("functions.inc.php");
  require_once("globals.inc.php");

  // (STRING)$addEntry = $_POST["weapons"];
  // (STRING)$table    = "weapons";
  
  // DEBUG
  /*
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  */
  
  foreach ($_POST as $name => $val) {
     // echo htmlspecialchars($name . ': ' . $val) . "<br>";
    
    // db stuff
    if ( !empty($val) ) {
      $mode     = $name;
      $table    = $name;
      $table    = _GAME . "_" . $table;
      $addEntry = $val;
      $addDice  = getDiceValuePlusOne($table);
      
      // if ( !() ) echo success
      ajaxPDOInsert($table, $addDice, $addEntry);
      echo $table;
      
    
      
      // Copy over weapon image from fextralife
      if ( $mode == "weapons" ) copyWeaponFromFextra($addEntry);
      
      // Log
      logAction ($table, "post.ajax", "DICE:" . $addDice, $table."Name" , "", $addEntry);
      
      // log
      // log ($table, "add", "", $addEntry);
    }

} // END FOREACH
  

} // ENDIF
?>
