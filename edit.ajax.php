<?php
if (!empty($_POST)) {
	//database settings
  require_once("config.db.php");
  require_once("functions.inc.php");
  
	foreach($_POST as $field => $val){
    // echo htmlspecialchars("Fieldname: $field_name VAL:  $val <br>");
    
		// clean post values
    $field      = strip_tags(trim($field));
		$val        = strip_tags(trim($val));
		
		// from the fieldname:id get id, table
		$split_data = explode(":", $field);
		$table      = $split_data[1];
    $id         = $split_data[3];
    $name       = $val;
    
    // echo "explode: " . $split_data[4];
    
    /*
    echo "0: " . $split_data[0];
    echo "1: " . $split_data[1];
    echo "2: " . $split_data[2];
    echo "3: " . $split_data[3];
    */
    
    if (!empty($id) && !empty($table) && !empty($name)) {
			// update the values      
      $sql = "UPDATE $table SET name = :name WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
      $stmt->execute();
      
			echo "Updated";
		} else {
			echo "Invalid Requests";
		}
	}
} else {
	echo "Invalid Requests";
}
?>