(function($){
		$(window).load(function(){
			var totalScrollOffsetH=$(".totalScrollOffset").height();
			/*$("#dialContents").mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});*/
		});
	})(jQuery);

	  $(document).ready(function(){
		setInterval(function(){
	
			//var idTxtArea = e.target.id;
			//var idConversation = idTxtArea.split("_");
			var idUserTemp = $(".idSpan").attr('id');
			var idUser = idUserTemp.split("log");
			
			$.ajax({
              type: "POST",
              url: "/js/chatAjax.php",
              dataType: "json",
              data: {
                  type: 'getMessagePeriodic',
                  userIdLogged: idUser[1]
			  },
              success: function(data){
            	  //Si au moins 1 nouveau message
            	  if(data.occurence > 0)
            	  {
            		  for(var i = 0; i<data.occurence; i++){
            			  
            			  
            			  var user = data.user[i];
            			  //Cas de la fenetre déja ouverte
            			  //if($(".user_"+data.user.i)){
            				  console.log(user);
            				 
            			  //}
            			  //Cas d'une nouvelle fenetre
            			  
            		  }
            	  }
                  /*if(data.newMessage == true){
                	  $("#dialContents .mCSB_container").html(data.content);
                	  $("#dialContents_" + idConversation[1]).mCustomScrollbar("update");
                 	  $("#dialContents_" + idConversation[1]).mCustomScrollbar("scrollTo","bottom");
                  }*/
              }
          });
	  },3000);
  });

  $(document).keypress(function(e) {
		  
	  var idTxtArea = e.target.id;
	  var idConversation = idTxtArea.split("_");
	  var idUserTemp = $(".idSpan").attr('id');
	  var idUser = idUserTemp.split("log");
	  
	  if($("#"+idTxtArea).is(":focus") && e.which == 13) {
    	  $.ajax({
              type: "POST",
              url: "/js/chatAjax.php",
              dataType: "json",
              data: {
                  type: 'setMessage',
            	  message: $("#"+idTxtArea).val(),
            	  userIdLogged: idUser[1],
            	  conversation: idConversation[1]
			  },
              success: function(msg){
            	  $("#dialContents_" + idConversation[1]).html(msg.content);
            	  $("#"+idTxtArea).val("");
            	  $("#dialContents_" + idConversation[1]).scrollTop($(document).height());
              }
          });
      }
  });