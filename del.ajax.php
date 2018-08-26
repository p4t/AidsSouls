<?php

// DEBUG
// print_r($_POST);

if ( !empty($_POST) ) {
  // Lib
  require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
  require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
  require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );
  
  (STRING)$table        = $_POST["table"];
  (STRING)$parentField  = $table . "Name";
  (INT)$ID              = $_POST["ID"];
  
  // check if request comes from config>>games>>delete
  if ( $table == "games" ) {
    // DROP TABLE `TMP_boss`, `TMP_kills`, `TMP_mobs`, `TMP_rolls`, `TMP_weapons`
    
    // get abbr
    $stmt = $pdo->prepare("SELECT abbr FROM games WHERE ID = $ID");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $abbr = $row["abbr"];  
    
    // form sql to drop tables
    // Hack so existing SoulsBorne data won't be deleted
    if ( $ID > 6 ) dropSQLTable($abbr);
    
    $SQLID = trim(intval($ID)); // sanitize ID
    
    $sql = "DELETE FROM rolls WHERE gameID = $SQLID;"; // clear rolls for foreign key check
    $sql .= "DELETE FROM games WHERE ID = $SQLID;"; // delete game from `games`
    
    $pdo->exec($sql); // temporarily use exec() because shenanigans
    
    // delete games folder
    deleteGameFolder($abbr);
    
  }
  
  /* DELETE MULTI */
  if ( (!empty($_POST["ID"])) ) {
    // && (count($_POST["ID"]) > 1) // only if there's more than one item to delete
    
    // init vars
    $sql = "";
    
    // more than one item to delete
    if ( sizeof($_POST["ID"]) > 1 ) {
      foreach($_POST["ID"] as $ID) {
        $sql .= "DELETE FROM $table WHERE ID = $ID;";
      }
    } else { // only one item to delete
      $sql .= "DELETE FROM $table WHERE ID = $ID;";
    }
    
    if ( !empty($sql) ) {
      $pdo->exec($sql); // temporarily use exec() because shenanigans
      echo $sql; // needed success callback msg
    }
    
  } /* else {
  
    // All other Delete requests
    $sql = "DELETE FROM $table WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
    $stmt->execute();

    echo "Success!";

  } */
  

} else {
	echo "Invalid Requests";
} // END IF
?>