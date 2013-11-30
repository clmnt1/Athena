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
					  
			      var setDialogue = $("#btnAddPost").click(function(event){
			    	  $.ajax({
                          type: "POST",
                          url: "/js/chatAjax.php",
	                      dataType: "json",
                          data: {
                              type: 'setMessage',
                        	  message: $("#txaMessage").val(),
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
			      });
			  });

			  $(document).keypress(function(e) {
			      if($("#txaMessage").is(":focus") && e.which == 13) {
			    	  $.ajax({
                          type: "POST",
                          url: "/js/chatAjax.php",
                          data: {
                              type: 'setMessage',
                        	  message: $("#txaMessage").val(),
                        	  //Il faut chercher l'id du bouton ou de la fenetre ou autre mais propre � la conversation
                        	  conversation: '1'
						  },
                          success: function(msg){
                        	  $("#dialContents").html(msg);
                        	  $("#txaMessage").val("");
                        	  $("#dialContents").scrollTop($(document).height());
                          }
                      });
			      }
			  });