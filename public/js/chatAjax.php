<?php

	require_once '../define.php';
	require_once APP_PATH . DS . 'config.php';
	
	// Chargement des classes model
	require_once MOD_PATH . DS . 'Connect.php';
	require_once MOD_PATH . DS . 'User.php';
	require_once MOD_PATH . DS . 'Conversation.php';
	
	//ini_set("display_error", 1);
	
	//Paramï¿½tres AJAX
	$typeAjax = (isset($_POST['type'])) ? $_POST['type'] : "";
	$messageAjax = (isset($_POST['message'])) ? $_POST['message'] : "";
	$idConversationAjax = (isset($_POST['conversation'])) ? $_POST['conversation'] : "";
	$idUserLoggedAjax = (isset($_POST['userIdLogged'])) ? $_POST['userIdLogged'] : "";
	$idInterlocuteurAjax = (isset($_POST['userIdInterlocuteur'])) ? $_POST['userIdInterlocuteur'] : "";
	$lastMessageAjax = (isset($_POST['lastMessage'])) ? $_POST['lastMessage'] : "";
	$newPopupAjax = (isset($_POST['newPopup'])) ? $_POST['newPopup'] : false;
	
	//Instances
	$connect_conv = new Connect($db);
	$userConnect = new User(intval($idUserLoggedAjax), $connect_conv);
	$usersConversation = new Conversation($idConversationAjax, $connect_conv);
	switch($typeAjax){
		
		case "setMessage" : 
			if($messageAjax <> ""){
	
				//Traitement du message
				$messageAjax = addslashes($messageAjax);
				$messageAjax = str_replace(CHR(13).CHR(10),"",$messageAjax);
				$messageAjax = str_replace(CHR(9),"",$messageAjax);
				
				$valid = $usersConversation->setMessage($messageAjax, $userConnect->id);
				$result = $usersConversation->getAllConversation($idUserLoggedAjax);
				$result = $usersConversation->parserJson($result);
				
				echo '{ "content" : "'.$result[0].'"}';
			}
			else{
				//Champ textarea vide
			}
		break;
		
		case "getMessage" :
			if($newPopupAjax == true){
				$result = $userConnect->loadDialogues($idInterlocuteurAjax);
				$result = $usersConversation->parserJson($result);
				echo '{ "success" : true, "content" : "'.$result[1].'" , "header" : "'.$result[0].'" ,"conversation" : "'.$result[3].'" }';
			}
			elseif($idConversationAjax != ""){
				$result = $usersConversation->getAllConversation($idUserLoggedAjax);
				$result = $usersConversation->parserJson($result);
				if($lastMessageAjax < ($result[1]*2+2)){
					echo '{ "success" : true, "content" : "'.$result[0].'" , "newMessage" : true }';
				}
				else{
					echo '{ "success" : true, "content" : "'.$result[0].'" , "newMessage" : false }';
				}
			}else{
				echo '{ "success" : false, "content" : "Pas d\id de conversation ou de nouvelle fenetre"}';
			}
			
		break;
		
		case "getMessagePeriodic" :
			
			//On récupère tout les id de conversation du l'utilisateur connecté
			$resListId = $userConnect->getAllConversationId();
			$jsonReturn = '[';
			foreach($resListId as $convId)
			{	
							
				$objConvId = new Conversation($convId, $connect_conv);
				$result = $objConvId->getAllConversation($userConnect->id);
				if($result[1]){
					var_dump($result[1]);
					$jsonReturn .= '{ "content" : "'.$result[1].'" , 
							"header" : "'.$result[0].'" ,
							"conversation" : "'.$result[3].'", 
							"user" : "'.$result[2].'" },';
				}
			}
			$jsonReturn .= substr($jsonReturn, 0, -1);
			$jsonReturn .= ']';
			//$jsonReturn = $usersConversation->parserJson($jsonReturn);
			echo $jsonReturn;
			
		default;
		 
		break;
	}