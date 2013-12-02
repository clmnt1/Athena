<?php

class Conversation{
	
	public $id;
	public $tabUser = array();
	public static $nbUser = 0;
	public $connect;
	
	function Conversation($id, Connect $connect){
		
		$this->id=$id;
		$this->connect = $connect;
		$connect = $connect->connect();
		//On boucle sur le nombre User concernÃ© par la discussion
		$sqlGetUser = "SELECT conversation_userId FROM ".CONVERSATION." WHERE conversation_id = ".$id;
		$sqlResult = $this->connect->query($sqlGetUser);
		while($sqlRow = mysqli_fetch_array($sqlResult))
		{
			$userTemp = new User($sqlRow['conversation_userId'], $this->connect);
			$this->tabUser[] = $userTemp;
			$this->nbUser++;
		}
	}
	
	function getAllConversation($idUserLoggedAjax){
		
		$sqlSelectDialogues = "SELECT user_id, message_id, message_content, message_ridden, message_date 
			FROM ".MESSAGE." 
			WHERE conversation_id = ".$this->id." 
			ORDER BY message_date ASC;";
		$retourContent = "";
		$classUser = "";
		$userId = "";
		$sqlResultDialogues = $this->connect->query($sqlSelectDialogues);
		$isNewMessage = false;
		while($sqlRowDialogues = mysqli_fetch_array($sqlResultDialogues))
		{	
			//Si premiere lecture du message -> message_ridden à true
			$isNew = false;
			if($sqlRowDialogues['message_ridden'] <> ""){
				$messageRidden = explode(';', $sqlRowDialogues['message_ridden']);
				$newParams = "";
				foreach($messageRidden as $ligneUser)
				{
					$params = explode('=', $ligneUser);
					if($params[0] == $idUserLoggedAjax && $params[1] == "false")
					{
						//On concatène la nouveau parametre
						$isNew = true;
						$isNewMessage = true;
						$userId = $sqlRowDialogues['user_id'];
						$newParams .= $idUserLoggedAjax."=true;";
					}else{
						$newParams .= $ligneUser;
					}
				}
				if($isNew){
					//$sqlUpdateMessageRidden = "UPDATE ".MESSAGE. " SET message_ridden = '".$newParams."' WHERE message_id = ".$sqlRowDialogues['message_id'];
					//$this->connect->query($sqlUpdateMessageRidden);
				}
			}
			if($idUserLoggedAjax == $sqlRowDialogues['user_id']){
				$classUser = "userYourSelf";
			}else{
				$classUser = "userOther";
			}
			$retourContent .= "</br><span class='$classUser'>";
			if($isNew){
				$retourContent .= "<b>";
			}
			$retourContent .= $sqlRowDialogues['message_content'];
			if($isNew){
				$retourContent .= "</b>";
			}
			$retourContent .= "</span>";
		}
		
		$numChild = mysqli_num_rows($sqlResultDialogues);
		//Si pas de message
		if($numChild == 0){
			$retourContent = "<i>Aucun message </i>";
		}
		
		$tabReturn[0] = $retourContent; //Contenu html
		//$tabReturn[1] = $numChild; //Nombre de message
		$tabReturn[1] = $isNewMessage;
		$tabReturn[2] = $userId;
		$tabReturn[3] = $this->id;
		
		return $tabReturn;
	}
	
	function setMessage($message, $user){
		$strMessageRidden = "";
		foreach($this->tabUser as $userMember)
		{
			if($userMember->id != $user){
				$strMessageRidden .= $userMember->id.'=false;';
			}
		}
		$sqlInsertDialogue = "INSERT INTO ".MESSAGE." VALUE ('',".$this->id.", ".$user.", '".$message."', '".$strMessageRidden."', CURRENT_TIMESTAMP);";
		$sqlResult = $this->connect->query($sqlInsertDialogue);
		return $sqlResult;
	}
	
	function parserJson($result){
		$i = 0;
		foreach($result as $ligneResult){
			$result[$i] = str_replace(CHR(13).CHR(10),"",$ligneResult);
			$result[$i] = str_replace(CHR(9),"",$result[$i]);
			$i++;
		}
		return $result;
	}
}
?>