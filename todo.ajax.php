<?php
if (!empty($_POST)) {
	// Database
  require_once("config.db.php");
  require_once("functions.inc.php");
  
	foreach ($_POST as $field => $val) {
    // echo htmlspecialchars("Fieldname: $field VAL:  $val");
    // echo "<br>";
    
		// clean post values
    // $ID       = strip_tags(trim($field));
    $ID       = 1;
		$todoText = $val;
		
		// from the fieldname:id get id, table
    /*
		$split_data = explode(":", $field);
		$table      = $split_data[1];
    $id         = $split_data[3];
    $name       = $val;
    */
    
    // echo "explode: " . $split_data[4];
    
    /*
    echo "0: " . $split_data[0];
    echo "1: " . $split_data[1];
    echo "2: " . $split_data[2];
    echo "3: " . $split_data[3];
    */
    
    if ( !empty($ID) && !empty($todoText) ) {
			// update the values      
      
      $sql = "UPDATE todo SET todoText = :todoText WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":todoText", $todoText, PDO::PARAM_STR);
      $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
      $stmt->execute();
      
      // Log
      logAction ("todo", "todo.ajax", 1, "todoText", "", $todoText);      
      
			echo "Updated";
		} else {
			echo "Invalid Requests1";
		}
	}
} else {
	echo "Invalid Requests2";
}
?>