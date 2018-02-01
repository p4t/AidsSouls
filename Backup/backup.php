<section class="aidsListing">
  <div class="floatleft"><h4>Mobs:</h4><?= displayAidsArray($mobsAids); ?></div>
  <div class="floatright"><h4>Boss:</h4><?= displayAidsArray($bossAids); ?></div>
  <div class="clearfloat">&nbsp;</div>
  <div class="floatleft"><h4>Weapons</h4><?= displayAidsArray($weaponArray); ?></div>
  <div class="clearfloat">&nbsp;</div>
</section>

<div id="flex-container">
  <div class="flex-item">
    <?= displayDice($bossDice); ?>
  </div>
  <div class="flex-item">
    <?php
    if ($bossRNG == 4) randomWeapon($weaponArray);
    ?>
  </div>
</div>