<?php
  if ( !empty($HUD_CSS) && $HUD_CSS == "TRUE" ) {
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
    #flex-container-aids-text,
    #flex-container-roll
    {
      visibility: hidden;
    }

    /* Hide text*/
    #mobsAids,
    #bossAids,
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
    /* Do not show Aids Text on hover */
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
  if ( !empty($INVERT_CSS) && $INVERT_CSS == "TRUE" ) {
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
  if ( !empty($BLUR_CSS) && $BLUR_CSS == "TRUE" ) {
?>
  <style>
    * {filter: blur(1px)}
  </style>
<?php
  }
?>

<?php
  if ( !empty($SYMBOL_CSS) && $SYMBOL_CSS == "TRUE") {
?>
  <script>
    play_audio("MorningStarAids");
  </script>
<?php
  }
?>