<?php
if ( !empty($_POST) ) {
  // Database
  require_once("config.db.php");
  require_once("functions.inc.php");
  require_once("globals.inc.php");
  
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
  
  // All other Delete requests
  $sql = "DELETE FROM $table WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
  $stmt->execute();
    
  echo "Success!";
  

} else {
	echo "Invalid Requests";
} // END IF
?>