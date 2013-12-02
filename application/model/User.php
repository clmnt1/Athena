<?php

class User
{
	
	public $id;
	public $pseudo; 
	public $firstName;
	public $secondName;
	public $isLogged;
	public $connect;
	
	function User($id, Connect $connect){
		require_once APP_PATH . DS . '/config.php';
		$this->connect = $connect;
		$connect = $connect->connect();
		
		$sqlSelectUser = "SELECT * FROM ".USER." WHERE user_id = $id";
		$sqlSelectRes = $this->connect->query($sqlSelectUser);
		$sqlSelectRet = mysqli_fetch_assoc($sqlSelectRes); 
		
		if($sqlSelectRet)
		{
			$this->id          = $id;
			$this->pseudo      = $sqlSelectRet['user_pseudo'];
			$this->firstName   = $sqlSelectRet['user_firstName'];
			$this->secondName  = $sqlSelectRet['user_secondName'];
			$this->isLogged    = $sqlSelectRet['user_logged']; 
		}
	}
	
	function connectUser($cx_id){
	/**
	 *	Descr  : Passe le jeton de connexion à true
	 *	Auteur : Clément Régnier
	 *	Date   : 04/09/2013
	 */
		$this->isLogged = true;
		$sqlLogged = "UPDATE ".USER." SET user_logged = 1 WHERE user_id = $cx_id";
		$this->connect->query($sqlLogged);
		
	}
	
	function disconnectUser($cx_id){
	/**
	 *	Descr  : Passe le jeton de connexion à false
	 *	Auteur : Clément Régnier
	 *	Date   : 04/09/2013
	 */
		$this->isLogged = false;
		$sqlLogged = "UPDATE ".USER." SET user_logged = 0 WHERE user_id = $cx_id";
		$this->connect->query($sqlLogged);
	}
	
	function getAllUser(){
		/**
		 *	Descr  : Retourne la liste des utilisateurs de l'entreprise
		 *	Auteur : Clément Régnier
		 *	Date   : 07/06/2013
		 *	Return : utilisateurs de l'entreprise
		 */
		$sqlAllUsers = "SELECT * FROM ".USER;
		$sqlResult = $this->connect->query($sqlAllUsers);
		$occ = 0;
		while($sqlRow = mysqli_fetch_array($sqlResult))
		{
			$tabReturn[$occ]['firstName'] = $sqlRow['user_firstName'];
			$tabReturn[$occ]['secondName'] = $sqlRow['user_secondName'];
			$tabReturn[$occ]['userId'] = $sqlRow['user_id'];
			$tabReturn[$occ]['logged'] = $sqlRow['user_logged'];
			$occ++;
		}
		return $tabReturn;
	}
	
	function displayAllUser(){
		/**
		 *	Descr  : Affiche les utilisateurs de l'entreprise, ainsi que leurs disponibilitï¿½s
		 *	Auteur : Clément Régnier
		 *	Date   : 07/06/2013
		 */
		$tabUsers = $this->getAllUser();
		foreach($tabUsers as $user)
		{
			if($_SESSION['id'] == $user['userId']){
				continue;
			}
			echo '<tr><td><div id="user_'.$user['userId'].'" class="name" style="cursor:hand;" onClick="addChatWindow('.$user['userId'].')">'.$user['firstName'].' '.$user['secondName'].'</div></td><td>';
			if($user['logged'])
			{
				echo '&nbsp;<img src="img/loggedIn.png"></a></td></tr>';
			}
			else
			{
				echo '&nbsp;<img src="img/loggedOut.png"></a></td></tr>';
			}
		}
	}
	
	function loadDialogues($idInterlocutor){
		/**
		 *	Descr  : Retourne les dialogues existants avec l'interlocuteur sous format HTML
		 *	Auteur : Clément Régnier
		 *	Date   : 08/11/2013
		 */	
		$htmlDialogue = "";
		$userInterlocutor = new User($idInterlocutor, $this->connect);
		$sqlGetDialogue = "SELECT DISTINCT conversation_id FROM ".CONVERSATION."
		WHERE conversation_userId = $this->id
		AND conversation_id
		IN (SELECT conversation_id FROM ".CONVERSATION." WHERE conversation_userId = $userInterlocutor->id)";
	
		$sqlResult = $this->connect->query($sqlGetDialogue);
		$idDiscussionTemp = mysqli_fetch_assoc($sqlResult);
		$idDiscussion = (isset($idDiscussionTemp['conversation_id'])) ? $idDiscussionTemp['conversation_id'] : "";
		$conversation = new Conversation($idDiscussion, $this->connect);
		
		//Header conversation
		$htmlHeader = "<div id ='dialogueHeader'>
							<div class='glyphicon icon-pencil'></div>
								<b>&nbsp;".$userInterlocutor->firstName."&nbsp;".$userInterlocutor->secondName."</b>
							</div>";
		//Contents
		if($idDiscussion == '')
		{
			//Nouvau dialogue - On insert les id des utilisateurs en base
			$tabTempDialogue = "<i> Aucun message </i>";
			$sqlInsertIdConversation = "INSERT INTO ". CONVERSATION . " VALUES ( '',".$this->id.")";
			$sqlResult = $this->connect->query($sqlInsertIdConversation);
			$sqlInsertIdConversationOther = "INSERT INTO ". CONVERSATION . " VALUES (LAST_INSERT_ID(),".$userInterlocutor->id.")";
			$idDiscussion = mysqli_insert_id();
			$sqlResultOther = $this->connect->query($sqlInsertIdConversationOther);	
			
		}else{
			$tabTempDialogue = $conversation->getAllConversation($this->id);
		}
		$tabReturn[0] = $htmlHeader; // Header de la fenetre de dialogue
		$tabReturn[1] = $tabTempDialogue[0]; // Message(s)
		$tabReturn[2] = $tabTempDialogue[1]; // Booléen - Nouveau message
		$tabReturn[3] = $idDiscussion; // Booléen - Nouveau message
		
	return $tabReturn;
	}
	
	//Retourn la liste des ID dont l'utilisateur fait partie
	function getAllConversationId(){
		$sqlGetDialogue = "SELECT DISTINCT conversation_id FROM ".CONVERSATION."
		WHERE conversation_userId = $this->id";
		$sqlResult = $this->connect->query($sqlGetDialogue);
		$tabDialogueId = array();
		$i = 0;
		while($idRowDiscussion = mysqli_fetch_array($sqlResult)){
			$tabDialogueId[$i] = $idRowDiscussion['conversation_id'];
			$i++;
		}
		return $tabDialogueId;
	}
}