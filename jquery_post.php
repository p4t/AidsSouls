<?php
if ( (!empty($_POST["mobs"])) || (!empty($_POST["boss"])) || (!empty($_POST["weapons"])) ) {
  
  // Database
  require_once("config.db.php");
  require_once("functions.inc.php");

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
      $table    = $name;
      $addEntry = $val;
      $addDice  = getDiceValuePlusOne($table);
      
      ajaxPDOInsert($table, $addDice, $addEntry);
      
      // Copy over weapon image from fextralife
      if ( $table == "weapons" ) copyWeaponFromFextra($addEntry);
      
      // Log
      logAction ($table, "post.ajax", "DICE:" . $addDice, $table."Name" , "", $addEntry);
      
      // log
      // log ($table, "add", "", $addEntry);
    }

} // END FOREACH
  

} // ENDIF
?>
