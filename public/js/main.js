/* ============================================================================== */
/* ============================ POPUP CONVERSATION ============================== */
/* ============================================================================== */
function addChatWindow(userId){
	popup.init(userId);
}

function openWindow(userId, content, header, conversation){
	popup.open(userId, content, header, conversation);
}

popup = {
		id : 0,
		init : function(userId){
			this.id = userId;
			popup.parentBlock = $('#name-list').find('.name');
			popup.parentId = "user_" + userId;
			popup.id = 0;
			$('.popup').each(function(){
				popup.id++;
				popup.match = false;
				popup.popupId = $(this).attr("id");
				if(popup.parentId == popup.popupId){
					popup.match = true;
					return (false);
				}
			});
			if(popup.match == false || popup.id < 1){
				var idTemp = $(".idSpan").attr('id');
				var id = idTemp.split("log");
				$.ajax({
	                type: "POST",
	                url: "/js/chatAjax.php",
	                dataType: "json",
	                data: {
	                    type: 'getMessage',
	                    newPopup: true,
	                    userIdLogged: id[1],
	                    userIdInterlocuteur: userId
	                    //lastMessage: $("#dialContents").children().children().children().length,
	              	    //Il faut chercher les id des panels actifs
	              	    //conversation: '1'
					},
	                success: function(data){
	                	popup.open(popup.parentId, data.content, data.header, data.conversation);
                    	$("#dialContents_" + data.conversation).scrollTop($(document).height()*200);
	                	if(data.newMessage == true){
	                  	  $("#dialContents .mCSB_container").html(data.content);
	                  	  $("#dialContents").mCustomScrollbar("update");
	                   	  $("#dialContents").mCustomScrollbar("scrollTo","bottom");
	                    }
	                },
	                error: function(){
	                	alert('failure');
	                }
	            });
			}
		},
		
		open : function(parentId, content, header, conversation){
			popup.content = 
				'<div class="popup" id="user_' + parentId + '">' +
					'<div class="popup-title">' + header + '<div class="close-btn">x</div></div>' +
						'<div id="dialContents_' + conversation + '" class="dialContents">' + content + '</div>' +
						'<div id="tchatForm">' +
						'<form method="post" action="#">' +
						'<div id="answer"><div class="controls"><div><textarea id="conversation_' + conversation + '" name="message" type="text" placeholder="" class="input-large txaMessage" required=""></textarea></div></div></div>' +
						'</form>' +
					'</div>' +
				'</div>';
			$('.popup').hide();
			$('#popup-bar').append(popup.content);
			$('.popup').show('fast');
        	$("#dialContents_" + popup.conversation).scrollTop($(document).height()*4);
			$('.close-btn').click(function(){
				popup.self = $(this);
				popup.self.parent().parent().hide(500);
				setTimeout(function() {
					popup.self.parent().parent().remove();
				}, 500);
			});
			
		}
}
/* ============================================================================== */


/* ============================================================================== */
/* ================================= MESSAGE INFO =============================== */
/* ============================================================================== */
//$(function messageInfo(){
//	$('.message-info').show('1000');
//	setInterval(function() {
//		$('.message-info').hide('1500');
//	}, 30000);
//});
/* ============================================================================== */