<?php
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$start = $time;
?>


<?php
require_once("config.db.php");
require_once("functions.inc.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Schniedel</title>


<!-- Code highlighting (Prism) -->
<!--
Markup 
CSS 
C-like 
JavaScript
PHP
HTTP
SQL
JAVA
JSON
----
Line Numbers
Show Language
Highlight Keywords
Toolbar
Copy to Clipboard Button
-->
<link href="/css/prism.css" rel="stylesheet" />
<script src="/js/prism.js"></script>
  
  
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

$data = $pdo->query("SELECT * FROM test")->fetchAll(PDO::FETCH_ASSOC); // BOTH >ASSOC< GROUP
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
      if ( $value["bossDice"] != NULL ) {
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




<?php
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in '.$total_time.' seconds.';
?>