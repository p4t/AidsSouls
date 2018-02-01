<html>
<head>
<meta charset="utf-8">
<title>\[T]/ Praise the Edit</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">


<style>  
  /*
  *  DEBUG BORDERBORDERBORDER
  */
  
  /*
  * {
    border-style: groove;
    border-color: coral;
    border-width: 1px;
  }
  */


  
</style>	
  
<script>
  var time = null
  function move() {
    window.location = "edit.php";
  }
</script>

</head>

<body>

  <h2>&raquo; <a href="aids.php">AIDS</a> &laquo;</h2>

<?php

/*
* Sanitize Query
*/
function buildQuery( $get_var ) {
    switch($get_var) {
      case "weapons":
        $tbl = 'weapons';
      break;
      case "mobs":
        $tbl = 'mobs';
      break;
      case "boss":
        $tbl = 'boss';
      break;
    }

    $sql = "SELECT * FROM $tbl";
}  


function redirect($url, $statusCode) {
  header('Location: ' . $url, true, $statusCode);
  die();
}

// DEBUG
  /*
if ( isset($_GET["mode"])) {
  echo "Mode: " . $_GET["mode"] . "<br>";
}
*/
  
// Set up DB and connect
$host     = "127.0.0.1";
$db       = "aids";
$user     = "aids";
$pass     = "kUk3t1%5";
$charset  = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


/*
/*
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
*/

$pdo = new PDO($dsn, $user, $pass);
  
  
function pdoUpdateTable ($pdo, $table, $post, $ID) {
  $sql = "UPDATE ".$table." SET name = :name WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);                                  
  $stmt->bindParam(':name', $post, PDO::PARAM_STR);
  $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
  $stmt->execute();
}
  
  
  
function displaySQLContentAsTable ($pdo, $table) {

  echo '<div class="flex-item-edit">';
  echo '<table border="1" cellspacing="1" cellpadding="1">';
  echo '<tbody>';
  echo '<tr>';
  echo '<th scope="col">ID</th>';
  echo '<th scope="col">Waffe</th>';
  echo '</tr>';
  echo '<tr>';

  $sql = 'SELECT * FROM '.$table.'';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $countRows = $stmt->rowCount();

  while ($row = $stmt->fetch()) { 

    echo '<tr>';

    echo '<td>';
    echo $row[0];
    echo '</td>';

    echo '<td>';
    echo '<a href="edit.php?mode='.$table.'&ID='.$row[0].'">';
    echo $row[1];
    echo '</a>';
    echo '</td>';

    echo '</tr>';
  }


  echo '</tr>';
  echo '</tbody>';
  echo '</table>';
  echo '</div>'; 
}

?>



<?php
/*
 * WEAPON, MOBS, BOSS EDIT
 *
 *
 *
 */

// if ( isset($_GET["mode"]) && ($_GET["mode"] == "weapons") ) {
  if ( !empty($_GET["mode"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = $mode;
    (INT)$ID        = $_GET["ID"];
  
    if ( isset($_POST["newName"]) ) {
      (STRING)$post = $_POST["newName"];

      // pdoUpdateTable($pdo, $table, $post, $ID);
      
      $sql = "UPDATE ".$table." SET name = :name WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(':name', $_POST['newName'], PDO::PARAM_STR);
      $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
      $stmt->execute();

      redirect("edit.php", $statusCode = 303);

    } else {
      
      function pdoQuery (){
        //
      }
      
      $stmt = $pdo->prepare('SELECT name FROM '.$table.' WHERE ID = '.$_GET["ID"].' ');
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    <div class="flex-item">
      <form action="edit.php?mode=<?= $mode ?>&ID=<?= $_GET["ID"] ?>" method="post">
        <label>Entry:</label>
        <input type="text" name="newName" value="<?= $row["name"]; ?>">
        <input type="submit" value="Submit">
      </form>
    </div>
  <div class="flex-item">&nbsp;</div>
</div>
  
<?php
}
?>
  
  
<?php
/*
 * KILLS EDIT
 *
 * if (!empty($_POST)) {
 *
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
}
?>
  
  
  
  
  
  
  
  
  
  
  
<div id="flex-container-edit" >
  
  <?php
    /*
   * DONT CHANGE
   *
   *
   *
   */
  /* STANDARD ANSICHT WNEN NUR EDIT.PHP
  * DISPLAY ALL TABLES WHERE TO EDIT FROM
  */
  if ( !isset($_GET["mode"]) ) {

    displaySQLContentAsTable ($pdo, "weapons");
    displaySQLContentAsTable ($pdo, "mobs");
    displaySQLContentAsTable ($pdo, "boss");
    include("kills.inc.php");


  }
    // go to top    res db pdo an funktio übergeben name klick anstatt edit
  ?>

</div>
  
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
  <div class="flex-item">
    <a href="#">^ top ^</a>
  </div>
  <div class="flex-item">&nbsp;</div>
</div>

</body>
</html>