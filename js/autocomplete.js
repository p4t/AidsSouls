// jQuery Autocomplete

"use strict";

// $( function() {
$( document ).ready(function() {
  
  // Mobs & Boss Aids
  /*
  var availableTagsMobsBoss;
  $.ajax({
    async: false,
    type: "GET",
    global: false,
    dataType: "json",
    url: "/autocomplete/aids.php",
    success: function (data) {
      availableTagsMobsBoss = data;
    }
  });

  // Weapons
  var availableTagsWeapons;
  $.ajax({
    async: false,
    type: "GET",
    global: false,
    dataType: "json",
    url: "/autocomplete.jQuery.php",
    success: function (data) {
      availableTagsWeapons = data;
    }
  });
  */

  console.log("availableTagsMobsBoss: " + availableTagsMobsBoss);
  console.log("----");
  console.log("availableTagsWeapons: " + availableTagsWeapons);

  // var availableTagsWeapons  = ""<?php //include("autocomplete.jQuery.php");?>;
  // var availableTagsMobsBoss = ""<?php //include("autocomplete/aids.php");?>;
  
  $( "input[data-jQAutocomplete=mobs], input[data-jQAutocomplete=boss]" ).autocomplete({
    minLength: 0,
    source: availableTagsMobsBoss
  });
  
  $( "input[data-jQAutocomplete=weapons]" ).autocomplete({
    minLength: 0,
    source: availableTagsWeapons
  });
  
  // $.fn.val = $.fn.html; // <li> Hack
  $( "li[data-autocomplete=weapons]" ).autocomplete({
    minLength: 0,
    source: availableTagsWeapons
  });
  $( "li[data-autocomplete=mobs], li[data-autocomplete=boss]" ).autocomplete({
    minLength: 0,
    source: availableTagsMobsBoss
  });

} );