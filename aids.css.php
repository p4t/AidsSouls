<?php
  if ( !empty($HUD_SFX) && $HUD_SFX == "TRUE" ) {
?>
  <style>
    *,
    html, body, 
    .aidscontent,
    .aidsListing,
    .container,
    .content,
    #todo,
    #flex-container-aids
    {
      background: black !important;
      border-image: none !important;

      /* No pointer events */
      /* pointer-events: none; */
    }
    table,
    .aidsListing,
    #Kills,
    #Aids,
    footer,
    nav,
    #mySidenav,
    #sidenav-icon,
    h2
    {
      /* visibility: hidden; */
      display: none;
    }

    header {
      visibility: hidden;
    }

    .flex-item-aids-left,
    .flex-item-aids-right,
    /* #flex-container-aids-text, */
    #flex-container-roll
    {
      visibility: hidden;
    }
    
    #flex-container-aids-text {
      opacity: 0.1;
    }
    #flex-container-aids-text:hover {
      opacity: 0.25;
    }

    /* Hide text*/
    /*
    #mobsAids,
    #bossAids,
    */
    #reroll_switch_button,
    #rerun_switch_button,
    .diceText
    {
      color: black;
      text-shadow: none;
    }

    .aidscontent {
      opacity: 0.2;
    }

    .aidscontent:hover .dice_wrapper,
    /* Aids Text on hover */
    /*
    .aidscontent:hover #mobsAids,
    .aidscontent:hover #bossAids,
    */
    .aidscontent:hover #flex-container-roll
    {
      visibility: visible;
    }
</style>
<?php
  }
?>


<?php
/* Rotate whole site 160° */
  if ( !empty($INVERT_SFX) && $INVERT_SFX == "TRUE" ) {
?>
  <style>
    #mobsAids, #bossAids
    {
      /* display: inline-block; */
    }
    html, body, header, header img, nav, footer, div, span, button, select, option,
    h1, h2, h4, h5, h6, h7, h8,
    .dice_wrapper img, #flex-item-aids-middle img, #bonfire img
    {
      transform:rotate(180deg);
    }
    footer, hr {
      display: none;
    }
</style>
<?php
  }
?>


<?php
  if ( !empty($BLUR_SFX) && $BLUR_SFX == "TRUE" ) {
?>
  <style>
    * {filter: blur(1px)}
  </style>
<?php
  }
?>

<?php
  if ( !empty($SYMBOL_SFX) && $SYMBOL_SFX == "TRUE") {
?>
  <script>
    play_audio("MorningStarAids");
  </script>
<?php
  }
?>