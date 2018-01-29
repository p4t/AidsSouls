<html>
<head>
<meta charset="utf-8">
<title>\[T]/ Praise the Edit</title>

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

$host = '127.0.0.1';
$dbName = 'aids';
$username = 'aids';
$password = 'kUk3t1%5';

$pdo = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
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
    
    $sql = "UPDATE weapons SET weaponName = :weaponName WHERE weaponID = :weaponID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':weaponName', $_POST['newWeaponName'], PDO::PARAM_STR); 
    $stmt->bindParam(':weaponID', $_GET['weaponID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT weaponName FROM weapons WHERE weaponID = '.$_GET["weaponID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=weapons&weaponID=<?= $_GET["weaponID"] ?>" method="post">
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

if ( isset($_GET["mode"]) && ($_GET["mode"] == "mobsAids") ) {
  if ( isset($_POST["newMobsAidsName"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE mobsAids SET mobsAidsName = :mobsAidsName WHERE mobsAidsID = :mobsAidsID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':mobsAidsName', $_POST['newMobsAidsName'], PDO::PARAM_STR); 
    $stmt->bindParam(':mobsAidsID', $_GET['mobsAidsID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT mobsAidsName FROM mobsAids WHERE mobsAidsID = '.$_GET["mobsAidsID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=mobsAids&mobsAidsID=<?= $_GET["mobsAidsID"] ?>" method="post">
  <label>Waffe:</label>
  <input type="text" name="newMobsAidsName" value="<?= $row["mobsAidsName"]; ?>">
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

if ( isset($_GET["mode"]) && ($_GET["mode"] == "bossAids") ) {
  if ( isset($_POST["newBossAidsName"])) {
    echo "Update erfolgreich!";
    echo '<a href="edit.php">Zurück</s>';
    
    $sql = "UPDATE bossAids SET bossAidsName = :bossAidsName WHERE bossAidsID = :bossAidsID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':bossAidsName', $_POST['newBossAidsName'], PDO::PARAM_STR); 
    $stmt->bindParam(':bossAidsID', $_GET['bossAidsID'], PDO::PARAM_INT);
    $stmt->execute();
    
    exit;
     
  } else {
  
    $stmt = $pdo->prepare('SELECT bossAidsName FROM bossAids WHERE bossAidsID = '.$_GET["bossAidsID"].' ');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<form action="edit.php?mode=bossAids&bossAidsID=<?= $_GET["bossAidsID"] ?>" method="post">
  <label>Waffe:</label>
  <input type="text" name="newBossAidsName" value="<?= $row["bossAidsName"]; ?>">
  <input type="submit" value="Submit">
</form>

<?php
}
?>
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  


<?php
  /*
 * DONT CHANGE
 *
 *
 *
 */
/* STANDARD ANSICHT WNEN NUR EDIT.PHP */
if ( !isset($_GET["mode"]) ) {
  include("weapons.inc.php");
  include("mobsAids.inc.php");
  include("bossAids.inc.php");
}
?>
</body>
</html>