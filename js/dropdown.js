// Dropdown

"use strict";

$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
    
    // Fix Text on Button
    $("#dice_switch_button").text($("#dice_dropdown").val());
    
    // W12 etc
    pickimg();
    // Check if some other function shows bonfire
    
  });
  $(this).parents(".custom-select").toggleClass("opened");
  
  // show bonfire on select click to show dropdown options
  $("#rerunroll").hide();
  $("#w12").hide();
  $("#bonfire").show();
  // pickimg();
  
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});




/* Checkbox Switch Text */
$( document ).ready(function() {
  // Select
  $("select#dice_dropdown").change(function() {
    if ($(this).val() == "W6") {
      $("#dice_switch_button").text("W6");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W12") {
      $("#dice_switch_button").text("W12");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W20") {
      $("#dice_switch_button").text("W20");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W30") {
      $("#dice_switch_button").text("W30");
      return;
     }        
  });

  // W20
  $("#dice_switch").change(function () {
    if ( $("#dice_switch").is(":checked") ) {
      // "checked"
      $("#dice_switch_button").text("W20");

      return;
    }
    // "unchecked"
    $("#dice_switch_button").text("W12");
  });
  
  // W12, W20
  $("#rerun_switch").change(function () {
    if ( $("#rerun_switch").is(":checked") ) {
      // "checked"
      $("#rerun_switch_button").text("Rerun?");

      return;
    }
    // "unchecked"
    $("#rerun_switch_button").text("Run");
  });
  

  // Reroll
  $("#reroll_switch").change(function () {
    if ( $("#reroll_switch").is(":checked") ) {
      // "checked"
      $("#reroll_switch_button").text("-((()))");

      return;
    }
    // "unchecked"
    $("#reroll_switch_button").text("Roll");
  });
  
  
  
});