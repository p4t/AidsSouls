<?php
if ( !empty($_POST) ) {
	// Database
  require_once("config.db.php");
  require_once("functions.inc.php");
  
  (STRING)$table        = $_POST["table"];
  (STRING)$parentField  = $table . "Name";
  (INT)$ID              = $_POST["ID"];

  $sql = "DELETE FROM $table WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
  $stmt->execute();
  
  echo "Success!";
  
  // log
  logAction ($table, "Del", $ID, $parentField, "", "");
  
  // Check if number in dice is missing
  /*
  $count = pdoCount($table);
  if ( $ID != $count ) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
    $missing_number = missing_number($data);
    print_r( $missing_number);
  }
  */
} else {
	echo "Invalid Requests";
} // END IF

/*
echo "id: " . $_GET["id"];
echo "<br>";
echo "table: " . $_GET["table"];
*/



/*
if (!empty($_POST)) {
	// Database
  require_once("config.db.php");
  require_once("functions.inc.php");
  
	foreach ($_POST as $field => $val) {
    // echo htmlspecialchars("Fieldname: $field_name VAL:  $val <br>");
    
		// clean post values
    $field      = strip_tags(trim($field));
		$val        = strip_tags(trim($val));
		
		// from the fieldname:id get id, table
		$split_data = explode(":", $field);
		$table      = $split_data[1];
    $ID         = $split_data[3];
    $name       = $val;
    
    
    if ( !empty($ID) && !empty($table) && !empty($name) && strlen($name) <= 32 ) {
      
      // check if change was made by the user on input Ajax Inline Edit      
      if ( checkIfValueExists($ID, $table) == $name ) {
        echo "VALUE IS THE SAME";
      } else {
        // update the values      
        // $sql = "UPDATE $table SET name = :name WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);                                  
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        
        // Copy over weapon image from fextralife
        // if ( $table == "weapons" ) copyWeaponFromFextra($name);
        
        // Log
        logAction ($table, "edit.ajax", $ID, $table."Name" , "", $name);

        echo "Updated";
      }
		} else {
			echo "Invalid Requests";
		}
	}
} else {
	echo "Invalid Requests";
}
*/
?>