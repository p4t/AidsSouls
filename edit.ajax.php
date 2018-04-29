<?php
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
    
    // echo "explode: " . $split_data[4];
    
    /*
    echo "0: " . $split_data[0];
    echo "1: " . $split_data[1];
    echo "2: " . $split_data[2];
    echo "3: " . $split_data[3];
    */
    
    if ( !empty($ID) && !empty($table) && !empty($name) && strlen($name) <= 32 ) {
      
      // check if change was made by the user on input Ajax Inline Edit      
      if ( checkIfValueExists($ID, $table) == $name ) {
        echo "VALUE IS THE SAME";
      } else {
        // update the values      
        $sql = "UPDATE $table SET name = :name WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);                                  
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        
        // Copy over weapon image from fextralife
        if ( $table == "weapons" ) copyWeaponFromFextra($name);
        
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
?>