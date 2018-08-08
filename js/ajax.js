// Ajax

"use strict";

/* jQuery Ajax inline edit AIDS */
$(document).ready(function () {

  // acknowledgement message
  var message_status = $("#status");

  $("li[contenteditable=true]").blur(function () {
    var field = $(this).attr("id");
    var value = $(this).text();
    $.post("edit.ajax.php", field + "=" + value, function (data) {

      if (data !== "") {
        message_status.show();
        message_status.text(data);
        // hide the message
        setTimeout(function () {
          message_status.hide();
        }, 3000); // 3000
      }

    });
  });
});


/* jQuery Ajax Form */
$(document).ready(function () {

  // on button click or enter
  $("#btn").click(function () {

    var message_status = $("#status");

    var vmobs = document.getElementById("ajax_mobs").value;
    var vboss = document.getElementById("ajax_boss").value;
    var vweapons = document.getElementById("ajax_weapons").value;
    /*
    var vmobs     = $("input#ajax_mobs").val(); // mobs input field
    var vboss     = $("input#ajax_boss").val(); // boss field
    var vweapons  = $("input#ajax_weapons").val(); // weapons field
    */

    if ($.trim(vmobs) === "" && $.trim(vboss) === "" && $.trim(vweapons) === "") {

      message_status.show();
      message_status.text("Mindestens 1 Feld ausfüllen!");
      // hide the message
      setTimeout(function () {
        message_status.hide();
      }, 3000); // 3000

    } else {
      $.post("jquery_post.php", // Required URL of the page on server
        { // Data Sending With Request To Server
          mobs: vmobs,
          boss: vboss,
          weapons: vweapons
        },
        function (response, status) { // Required Callback Function
          // alert("*----Received Data----*\n\nResponse : " + response + "\n\nStatus : " + status); //"response" receives - whatever written in echo of above PHP script.

          if (status !== "") {
            message_status.show();
            // message_status.text("Hinzugefügt.");
            message_status.text(response);
            // hide the message
            setTimeout(function () {
              message_status.hide();
            }, 3000); // 3000
          }


          $("#form")[0].reset();
          // $("#flex-container-ajax").load("aids.ajax.php"); // load weapons list again for ajax bamboozle

          var post_data;
          if (vmobs !== "") {
            post_data = vmobs;
          } else if (vboss !== "") {
            post_data = vboss;
          } else if (vweapons !== "") {
            post_data = vweapons;
          }

          // $("#"+response).append("<li>" +post_data+ "</li>");
          $("#" + response).append("<li>" + post_data + "</li>").children(":last").hide().fadeIn(2000);

        });
    } // ENDIF

  });
});


/* Ajax Delete */
$(document).ready(function () {

  $(".aidsListAjaxDel").click(function () {
    var delcart = $(this).data("value");
    var deltable = $(this).data("table");

    if (confirm("Are you sure want to delete?")) {
      $.ajax({
        type: "POST",
        url: "del.ajax.php",
        data: {
          ID: delcart,
          table: deltable
        },
        success: function (data) {
          if (data) {
            // console.log(data);
            // delete HTML instead of load()
            $("li[id='table:" + deltable + ":id:" + delcart + "']").fadeOut();

          } else {
            // alert ("OHJE");
          }
          // $("#aidsList").load("aids.edit.ajax.php");
        }
      });
    }
    // alert($(this).data('value'));
  });

});