<!-- !!!AIDS: MOBS, MIDDLE, BOSS -->
<div id="flex-container-aids">

  <!-- MOBS left -->
  <div class="flex-item-aids-left">
    <h2>Mobs</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper" onClick="showRNG()">
        <div id="mobsRNGNumber" class="diceText" style="display: none"><?=$mobsRNG?></div>
        <div id="mobsRNG"><?=$mobsRNG_Output?></div>
      </div>
    </div>
  </div>
  
  <!-- Bonfire -->
  <div id="bonfire" class="flex-item-aids-middle flicker-in-1 user-select" onClick="play_audio('shrine')">
    <div class="itemsContainer">
      <div class="image"> <a href="#">  <img src="/img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt="" /> </a></div>
      <div class="play">&#9658; </div><!-- &#9646; -->
    </div>
  </div>
  
  <!-- W12/W20 output -->
  <div id="w12" class="flex-item-aids-middle" style="display: none;">
    <h2 id="dice_h2" onClick="openBonfire()">W12</h2>
    <div id="diceOnClickAnimate" class="flip-scale-up-diag-1 user-select" onclick="pickimg()">
      <!-- <img src="/img/stats/ds1/att.jpg" width="45" height="45" alt=""/> -->
      <div id="randomDiceOut">
        &nbsp;
      </div>
      <!-- <img src="/dice/0.png" class="dice flip-scale-up-diag-1" id="randimgw12" width="100" height="100" alt="Dice"> -->
      <!-- <div id="randimgw12" style="height: 100px"></div> -->
    </div>
  </div>
  
  <!-- rerunroll -->
  <div class="flex-item-aids-middle" id="rerunroll" style="display: none;"></div>

  <!-- BOSS right -->
  <div class="flex-item-aids-right">
    <h2>Boss</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper" onClick="showRNG()">
        <div id="bossRNGNumber" class="diceText" style="display: none"><?=$bossRNG?></div>
        <div id="bossRNG"><?=$bossRNG_Output?></div>
      </div>
    </div>
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- !!!OUTPUT ROLLED AIDS -->
<div id="flex-container-aids-text">
  <div>
    <div class="aidsText tracking-in-expand">
      <span id="mobsAids" data-balloon="{Description}" data-balloon-pos="right"><?=$mobsAids?></span>
      <br>
      <?php
        if ( _NEWGAMEPLUS == "TRUE" ) {
      ?>
      <span id="mobsAidsNGP" data-balloon="{Description}" data-balloon-pos="right"><?=$mobsAidsNGP?></span>
      <?php
        }
      ?>
    </div>
  </div>

  <div>
    <div class="aidsText tracking-in-expand">
      <span id="bossAids" data-balloon="{Description}" data-balloon-pos="left"><?=$bossAids?></span>
      <br>
      <?php
        if ( _NEWGAMEPLUS == "TRUE" ) {
      ?>
      <span id="bossAidsNGP" data-balloon="{Description}" data-balloon-pos="left"><?=$bossAidsNGP?></span>
      <?php
        }
      ?>
    </div>
  </div>
</div><!-- EOF flex-container-aids -->