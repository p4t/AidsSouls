<?php
// Get all folders in ./audio/
$dirs = getDirs("audio");
?>
<a id="Audio"></a>

<ul style="list-style-type: circle">
  <?php
  foreach ($dirs as $dir) {
  ?>
  <li><a href="/edit?show=audio#<?=$dir?>"><?=$dir?></a></li>
  <?php
  }
  ?>
</ul>

<table class="edit">
  <thead onclick="toggleTable()">
    <tr>
      <th class="th-h accordion">
        &raquo;&nbsp;Audio&nbsp;<span class="toggleTableIndicatorPlus">+</span><span class="toggleTableIndicatorMinus">-</span>
      </th>
    </tr>
    
    <?php
    foreach ($dirs as $dir) {
    ?>
    <tr>
      <th scope="col"><a id="<?=$dir?>"></a><strong>Dir: ./<?=$dir?></strong></th>
    </tr>
  </thead>
  <tbody class="toggleTable">
      
  <?php
  $files = scan_dir_recursively($dir);
  foreach ($files as $key => $value) {
    $link = $dir . "/" . $value;
  ?>
  <tr><td><a href="<?=$link?>"><?=$value?></a></td></tr>      
  <?php
  }
    }
  ?>

  </tbody>
</table>