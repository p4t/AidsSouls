
<?php
// Set up DB and connect
$host     = "127.0.0.1";
$db       = "aids";
$user     = "aids";
$pass     = "kUk3t1%5";
$charset  = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$pdo = new PDO($dsn, $user, $pass);


/*
$stmt = $pdo->query('SELECT weaponID, weaponName FROM weapons');
while ($row = $stmt->fetch())
{
    echo $row['weaponID'] . $row['weaponName'] . "<br>";
}
*/


/*
$stmt = $pdo->query('SELECT mobsAidsID, mobsAidsName FROM mobsAids');
while ($row = $stmt->fetch())
{
    echo $row['mobsAidsID'] . $row['mobsAidsName'] . "<br>";
}
*/

/*
$stmt = $pdo->query('SELECT bossAidsID, bossAidsName FROM bossAids');
while ($row = $stmt->fetch())
{
    echo $row['bossAidsID'] . $row['bossAidsName'] . "<br>";
}
*/

if (isset($_POST["weaponName"]))
{
  $sql = "UPDATE weapons SET weaponName = ? WHERE id = ?";
  $pdo->prepare($sql)->execute([$name, $id]);
  /*
  $stmt = $pdo->query('UPDATE weapons SET weaponName = '.$_POST["weaponName"].' WHERE weaponID = '.$_POST["weaponID"].' ');
  while ($row = $stmt->fetch())
  {
      echo $row['name'] . "\n";
  }
  */
  
}
?>

<form action="edit.php" method="post" name="form1">
<table border="1" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <th scope="col">weaponID</th>
      <th scope="col">weaponNme</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>

<?php
      
$stmt = $pdo->query('SELECT weaponID, weaponName FROM weapons');
while ($row = $stmt->fetch())
{
    echo '<tr><td>';
    echo $row["weaponID"];
    echo '</td>';
    echo '<td>';
  
    // echo $row["weaponName"];
    echo '<input type="text" name="weaponName" id="weaponName" value="'.$row["weaponName"].'">';
    echo '</td>';

    echo '<td></td>';
    echo '</tr>';
}

?>


  
    </tr>
  </tbody>
</table>
<input type="submit" name="Submit" value="Submit">
</form>


<h1>Test</h1>

<?php
/*
$stmt = $pdo->query('SELECT weaponName FROM weapons');
foreach ($stmt as $row)
{
    echo $row['weaponName'] . "<br>";
}
*/
?>