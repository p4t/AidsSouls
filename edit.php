<html>
<head>
<meta charset="utf-8">
<title>\[T]/ Praise the Edit</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">


<style>  
  /* DEBUG
  * {
    border-style: groove;
    border-color: coral;
    border-width: 1px;
  }
  */
/* MOBILE */
  
</style>	


</head>

<body>


<?php
// DEBUG
if ( isset($_GET["mode"])) {
  echo "Mode: " . $_GET["mode"] . "<br>";
}

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
?>



  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php
/*
 * WEAPON EDIT
 *
 *
 *
 */

if ( isset($_GET["mode"]) && ($_GET["mode"] == "weapons") ) {
  if ( isset($_POST["newWeaponName"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE weapons SET weaponName = :weaponName WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':weaponName', $_POST['newWeaponName'], PDO::PARAM_STR); 
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT weaponName FROM weapons WHERE ID = '.$_GET["ID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=weapons&ID=<?= $_GET["ID"] ?>" method="post">
  <label>Waffe:</label>
  <input type="text" name="newWeaponName" value="<?= $row["weaponName"]; ?>">
  <input type="submit" value="Submit">
</form>

<?php
}
?>




  
<?php
/*
 * MOBS EDIT
 *
 *
 *
 */

if ( isset($_GET["mode"]) && ($_GET["mode"] == "mobs") ) {
  if ( isset($_POST["newMobsAidsName"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE mobs SET name = :name WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':name', $_POST['newMobsAidsName'], PDO::PARAM_STR); 
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT name FROM mobs WHERE ID = '.$_GET["ID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=mobs&ID=<?= $_GET["ID"] ?>" method="post">
  <label>Mobs:</label>
  <input type="text" name="newMobsAidsName" value="<?= $row["name"]; ?>">
  <input type="submit" value="Submit">
</form>

<?php
}
?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php
/*
 * BOSS EDIT
 *
 *
 *
 */

if ( isset($_GET["mode"]) && ($_GET["mode"] == "boss") ) {
  if ( isset($_POST["newBossAidsName"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE boss SET name = :name WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':name', $_POST['newBossAidsName'], PDO::PARAM_STR); 
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT name FROM boss WHERE ID = '.$_GET["ID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=boss&ID=<?= $_GET["ID"] ?>" method="post">
  <label>Boss:</label>
  <input type="text" name="newBossAidsName" value="<?= $row["name"]; ?>">
  <input type="submit" value="Submit">
</form>

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
  if ( isset($_POST["newJoker"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE kills SET joker = :joker, spent = :spent, bossNames = :bossNames WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':joker', $_POST['newJoker'], PDO::PARAM_INT);
    $stmt->bindParam(':spent', $_POST['newSpent'], PDO::PARAM_INT);
    $stmt->bindParam(':bossNames', $_POST['newBossNames'], PDO::PARAM_STR);
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT * FROM kills WHERE ID = '.$_GET["ID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=kills&ID=<?= $_GET["ID"] ?>" method="post">
  <label>Joker:</label>
  <input type="text" name="newJoker" value="<?= $row["joker"]; ?>">
  
  <label>Ausgegeben:</label>
  <input type="text" name="newSpent" value="<?= $row["spent"]; ?>">
  
  <label>bossNames:</label>
  <textarea rows="15" name="newBossNames" cols="50"><?= $row["bossNames"]; ?></textarea>
  
  <input type="submit" value="Submit">
</form>

<?php
}
?>
  
  
  
  
  
  
  
  
  
  
  
<div id="flex-container-edit" >

  
  
  <div class="flex-item-edit">
  </div>
  


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
  ?>
  <div class="flex-item-edit">
  <?php
  include("weapons.inc.php");
  ?>
  </div>
  <div class="flex-item-edit">
  <?php
  include("mobs.inc.php");
  ?>
  </div>
  <div class="flex-item-edit">
  <?php
  include("boss.inc.php");
  ?>
  </div>
  <div class="flex-item-edit">
  <?php
  include("kills.inc.php");
  ?>
  </div>
  
<?php
}
  // go to top    res db pdo an funktio übergeben name klick anstatt edit
?>
</div>
</body>
</html>