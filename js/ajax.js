// Ajax

"use strict";

/* jQuery Ajax inline edit AIDS */
$(document).ready(function () {
  
	// acknowledgement message
    var message_status = $("#status");
  
  // check text length
  /*
    if ($("#field").html().length > 20) {
    short_text = $("#field").html().substr(0, 20);
    $("#field").html(short_text + "...");
    }
  */
  
    $("li[contenteditable=true]").blur(function(){
        var field = $(this).attr("id") ;
        var value = $(this).text() ;
        $.post("edit.ajax.php" , field + "=" + value, function(data){
          
          if (data !== "") {
            message_status.show();
            message_status.text(data);
            // hide the message
            setTimeout(function(){message_status.hide();},30000); // 3000
			   }
          
        });
    });
});


/* jQuery Ajax Form */
$(document).ready(function () {
  
  // clear all inputs on focus loss
  /*
  $("input").blur(function(){
      // alert("This input field has lost its focus.");
    $(this).val('');
  });
  */
  
  // on button click or enter
  $("#btn").click(function () {

    var message_status = $("#status");
    
    var vmobs     = document.getElementById("ajax_mobs").value;
    var vboss     = document.getElementById("ajax_boss").value;
    var vweapons  = document.getElementById("ajax_weapons").value;
    /*
    var vmobs     = $("input#ajax_mobs").val(); // mobs input field
    var vboss     = $("input#ajax_boss").val(); // boss field
    var vweapons  = $("input#ajax_weapons").val(); // weapons field
    */

    /*
    console.log(vmobs);
    console.log(vboss);
    console.log(vweapons);
    */
  

    
    if ($.trim(vmobs) === "" && $.trim(vboss) === "" && $.trim(vweapons) === "") {
      //alert("Mindestens 1 Feld ausfüllen!");
      
      // $("#status").replaceWith( "Mindestens 1 Feld ausfüllen!" );
      // $("#success").text("Bitte ausfüllen!" + "<br>");
      message_status.show();
      message_status.text("Mindestens 1 Feld ausfüllen!");
      // hide the message
      setTimeout(function(){message_status.hide();},3000); // 3000
      
      // discombobulate();
    } else {
      $.post("jquery_post.php", // Required URL of the page on server
        { // Data Sending With Request To Server
          mobs: vmobs,
          boss: vboss,
          weapons: vweapons
        },
        function (response, status) { // Required Callback Function
          // alert("*----Received Data----*\n\nResponse : " + response + "\n\nStatus : " + status); //"response" receives - whatever written in echo of above PHP script.
          // alert(response);
          // $("#success").append( "<p>Erfolg!</p>" );
          // $("#success").append( response + "<br>"); // show success msg for every added entry
          // $("#success").replaceWith( response ); // show success msg fonce
          // $("#status").append( response ); // show success msg fonce
          // $("#status").append( "Hinzugefügt." );
          // alert(status);
      
        
          if (status !== "") {
            message_status.show();
            // message_status.text("Hinzugefügt.");
            message_status.text(response);
            // hide the message
            setTimeout(function(){message_status.hide();},3000); // 3000
         }
        
        
          $("#form")[0].reset();
          // $("#flex-container-ajax").load("aids.ajax.php"); // load weapons list again for ajax bamboozle
         
        // console.log("response: "+response);
        // console.log("status: "+status);
        // console.log("mobs: "+mobs);
        // if (vmobs != "") console.log("debug: "+vmobs);
        
        var post_data;
        if ( vmobs !== "" ) {post_data = vmobs;}
        else if (vboss !== "" ) {post_data = vboss;}
        else if ( vweapons !== "" ) {post_data = vweapons;}
        
        // $("#"+response).append("<li>" +post_data+ "</li>");
        // $("#"+response).append("<li>" +post_data+ "</li>").hide().fadeIn(2000);
        $("#"+response).append("<li>" +post_data+ "</li>").children(":last").hide().fadeIn(2000);
        
        });
    } // ENDIF
    
  });
});


/* Ajax Delete */
$(document).ready(function () {


  $(".aidsListAjaxDel").click(function() {
    var delcart = $(this).data("value");
    var deltable = $(this).data("table");
    
        if (confirm("Are you sure want to delete?")) {
          $.ajax({
              type: "POST",
              url: "del.ajax.php",
              data: {ID : delcart, table : deltable},
              success: function (data) {
                  if (data) {
                      // alert(data);
                      // console.log(data);
                      // window.location.reload();
                        // delete HTML instead of load()
                        // $("tr[id="+delcart+"]").remove();
                        // $("tr[id="+deltable+"-"+delcart+"]").fadeOut();
                        $("li[id='table:"+deltable+":id:"+delcart+"']").fadeOut();
                        
                        /*
                        $(".delete").on("click",function() { 
                          $(this).closest("tr").remove();
                          return false;
                        });
                        */
                    
                    
                    
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