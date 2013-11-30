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
		//On boucle sur le nombre User concerné par la discussion
		$sqlGetUser = "SELECT conversation_userId FROM ".CONVERSATION." WHERE conversation_id = ".$id;
		$sqlResult = $this->connect->query($sqlGetUser);
		while($sqlRow = mysqli_fetch_array($sqlResult))
		{
			$userTemp = new User($sqlRow['conversation_userId'], $this->connect);
			$tabUser[] = $userTemp;
			$this->nbUser++;
		}
	}
	
	function getAllConversation(){
		
		$sqlSelectDialogues = "SELECT user_id, message_id, message_content, message_date 
			FROM ".MESSAGE." 
			WHERE conversation_id = ".$this->id." 
			ORDER BY message_date ASC;";
		$retourContent = "";
		$classUser = "";
		$sqlResultDialogues = $this->connect->query($sqlSelectDialogues);
		while($sqlRowDialogues = mysqli_fetch_array($sqlResultDialogues))
		{	
			if($_SESSION["login"] == $sqlRowDialogues['user_id']){
				$classUser = "userYourSelf";
			}else{
				$classUser = "userOther";
			}
			$retourContent .= "</br><span class='$classUser'>";
			$retourContent .= $sqlRowDialogues['message_content'];
			$retourContent .= "</span>";
		}
		$numChild = mysqli_num_rows($sqlResultDialogues);
		
		//Si pas de message
		if($numChild == 0){
			$retourContent = "<i>Aucun message </i>";
		}
		
		$tabReturn[0] = $retourContent; //Contenu html
		$tabReturn[1] = $numChild; //Nombre de message
		
		return $tabReturn;
	}
	
	function setDialogue($message, $user){
		$sqlInsertDialogue = "INSERT INTO ".MESSAGE." VALUE ('',".$this->id.", ".$user.", '".$message."', CURRENT_TIMESTAMP);";
		$sqlResult = $this->connect->query($sqlInsertDialogue);
		return $sqlResult;
	}
}
?>