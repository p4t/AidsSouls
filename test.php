<?php
// Set up DB and connect
$host     = "127.0.0.1";
$db       = "";
$user     = "";
$pass     = "";
$charset  = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO ($dsn, $user, $pass, $opt);

require_once("functions.inc.php");
//require_once("globals.inc.php");
?>

<!doctype html>
<html>
  
<head>
<meta charset="utf-8">
<title>Schniedel</title>
</head>

<body>

<pre class="line-numbers"><code class="language-php">
<?php
/*
$data = $pdo->query("SELECT weaponDice, weaponName FROM ds3")->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

print_r($data);

$i = 0;
foreach ($data as $value => $key) {
  echo $value . $key[0] . "<br>";
  $i++;
}
*/

/*
$data = $pdo->query("SELECT weaponDice, weaponName FROM ds3")->fetchAll(PDO::FETCH_ASSOC);

print_r($data);

$i = 0;
foreach ($data as $value) {
  echo "Dice:" . $value["weaponDice"] . " Name:" . $value["weaponName"] . "<br>";
  $i++;
}
*/

$data = $pdo->query("SELECT * FROM aids")->fetchAll(PDO::FETCH_ASSOC); // BOTH >ASSOC< GROUP
print_r($data);
?>
</code></pre>
 
  
<?php
  
?>

  
<section id="Mobs">
  <h1>Mobs</h1>
  <ul>
    <?php
    // MOBS
    // foreach ($array as $key => $value) {
    // $row->fieldname
    $i = 1;
    foreach ($data as $key => $value ) {
      // echo "<li>" . "Test: " . $data[$i][0]["mobDice"] . "</li>";
      echo "<li>" . "mobDice:" . $data[$i][0]["mobDice"] . " mobName:" . $data[$i][0]["mobName"] . "</li>";
      $i++;
    }
    ?>
  </ul>
</section>

<section id="Boss">
  <h1>Boss</h1>
  <ul>
    <?php
    // BOSS
    foreach ($data as $value) {
      if ( $value["aids"] != NULL ) {
        echo "<li>" . "bossDice:" . $value["bossDice"] . " bossName:" . $value["bossName"] . "</li>";
      }
    }
    ?>
  </ul>
</section>

<section id="Waffen">
  <h1>Waffen</h1>
  <ul>
    <?php
    // WEAPONS
    foreach ($data as $value) {
      echo "<li>" . "weaponDice:" . $value["weaponDice"] . " weaponName:" . $value["weaponName"] . "</li>";
    }
    ?>
  </ul>
</section>


  
  
  

  
  
</body>
</html>