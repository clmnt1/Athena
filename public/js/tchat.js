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
				/*setInterval(function(){
					  $.ajax({
                          type: "POST",
                          url: "chatAjax.php",
	                      dataType: "json",
                          data: {
                              type: 'getMessage',
                              lastMessage: $("#dialContents").children().children().children().length,
                        	   //Il faut chercher les id des panels actifs
                        	  conversation: '1'
						  },
                          success: function(data){
                              if(data.newMessage == true){
                            	  $("#dialContents .mCSB_container").html(data.content);
                            	  $("#dialContents").mCustomScrollbar("update");
                             	  $("#dialContents").mCustomScrollbar("scrollTo","bottom");
                              }
                          }
                      });
				  },3000);	 */ 
					  
			      /*var setDialogue = $("#btnAddPost").click(function(event){

					  alert("test");
			    	  $.ajax({
                          type: "POST",
                          url: "/js/chatAjax.php",
	                      dataType: "json",
                          data: {
                              type: 'setMessage', 
                        	  message: $("#txaMessage").val(),
        	                  userIdLogged: id[1],
                        	  //Il faut chercher l'id du bouton ou de la fenetre ou autre mais propre � la conversation
                        	  conversation: '1'
						  },
                          success: function(data){
                        	  $("#dialContents").html(data.content);
  		                      //$("#dialContents").mCustomScrollbar({});
                        	  $("#dialContents").scrollTop($(document).height());
                        	  $("#txaMessage").val("");
                        	  //$("#dialContents").mCustomScrollbar({});
                          }
                      });
			      });*/
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