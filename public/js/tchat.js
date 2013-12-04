
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
              success: function(response){
            	  $(function() {
            		  $.each(response, function(i, item) {
        		          //Cas d'une fenetre déja ouverte
	        			  if($('#user_'+item.user).is(":visible")){
	                    	  $("#dialContents_" + item.conversation).html(item.content);
	                    	  console.log(item.content);
	                    	  $("#dialContents_" + item.conversation).scrollTop($(document).height()*2);
	                    	  $('i').contents().unwrap().wrap('<p/>');
	        			  }
	        			  //Cas d'une nouvrelle fenetre
	        			  else{
	        				  popup = openWindow(item.user, item.content, item.header, item.conversation); 
	        			  }
            		  });
        		  });
                  /*if(data.newMessage == true){
                	  $("#dialContents .mCSB_container").html(data.content);
                	  $("#dialContents_" + idConversation[1]).mCustomScrollbar("update");
                 	  $("#dialContents_" + idConversation[1]).mCustomScrollbar("scrollTo","bottom");
                  }*/
              }
          });
	  },5000);
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
            	  $("#dialContents_" + idConversation[1]).scrollTop($(document).height()*2);
              }
          });
      }
  });