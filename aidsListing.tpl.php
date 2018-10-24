<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );
?>
<h5>
  <span id="AjaxCloseAidsListing" style="cursor: pointer">Aids</span>
</h5>

<script>
$( "#AjaxCloseAidsListing" ).click(function() {
  console.log( "Hide aidsListing." );
  $( "#aidsListing" ).hide();
});
</script>

<form id="form" method="post" onsubmit="return false">

<div class="aidsListing">
  <div id="flex-container-ajax">
    <?php
    // include_once("aids.ajax.php");

    // $tables = array("mobs", "boss", "weapons");
    $tables = array("mobs", "boss", "weapons");

    foreach ($tables as $table) :
      $mode = $table;
      $table = _GAME . "_" . $table;

      $table_output = ucfirst($mode);
      if ( $table_output == "Weapons" ) $table_output = "Waffen";
      $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
      $stmt->execute();
    ?>

        <div class="flex-item-aidsListing">
          <h3><?=$table_output?></h3>
          <ul id="<?=$table?>" class="aidsList">
            <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>

            <!-- DELETE -->
            <!--
            <a data-value="<?php//$row[0]?>" class="aidsListAjaxDel" data-table="<?php//$table?>" data-balloon="Löschen" data-balloon-pos="right">
              <img src="/img/delete-icon.png" width="20" height="20" alt="Delete">
            </a>
            -->

            <!-- List Item -->
            <li id="table:<?=$table?>:id:<?=$row[0]?>" data-autocomplete="<?=$mode?>" contenteditable="true">
              <?=$row[2]?>
            </li>
            <?php ENDWHILE ?>
          </ul>

          <label for="ajax_<?=$mode?>">
            <span data-balloon="<?=$table_output?>-Aids hinzufügen" data-balloon-pos="down">
              +
            </span>
            &nbsp;
            <input type="text" id="ajax_<?=$mode?>" name="ajax_<?=$mode?>" data-jQAutocomplete="<?=$mode?>" size="15" autocomplete="off" maxlength="32" placeholder="<?=ucfirst($table_output)?>">
          </label>

        </div><!-- EOF .flex-item-aidsListing -->

    <?php
      ENDFOREACH
    ?>





  </div><!-- .flex-container-ajax -->

  <div id="ajax-form-button">
    <label for="btn">
      <button id="btn" class="button_small">+</button>
    </label>
  </div>
  
</div><!-- EOF flex-container-aidsListing -->

</form>

<!-- Load needed scripts -->
<script src="/js/ajax.min.js"></script>
<script src="/js/autocomplete.min.js"></script>