<?php

class TchatAjax
{
		
	public function __construct(){
		$connect = new Connect();
		$connexion = $connect->connexion();
	}
	
	public function runTchat()
	{
		$d=array();
				
			$pseudo = $_SESSION['pseudo'];
		
			/**
			 * Action : addMessage
			 * Permet l'ajout d'un message
			 * */
			if($_POST["action"]=="addMessage"){
				$message =  mysql_escape_string($message);
				$sqlAdd = "INSERT INTO messages(pseudo,message,date) VALUES ('$pseudo','$message',".time().")";
				$this->connexion->query($sqlAdd);
				$d["erreur"] ="ok";
			}
		
			/**
			 * Action : getMessages
			 * Permet l'affichage des dernier messages
			 * */
			if($_POST["action"]=="getMessages"){
				$lastid = floor($lastid);
				$sqlGet = "SELECT * FROM messages WHERE id>$lastid ORDER BY date ASC";
				$this->connexion->query($sqlGet);
				$d["result"] = "";
				$d["lastid"] = $lastid;
				while($data = $this->connexion->fetch($req)){
					$d["result"] .= '<p><strong>'.$data["pseudo"].'</strong>('.date("d/m/Y H:i:s",$data["date"]).') : '.htmlentities(utf8_decode($data["message"])).'</p>';
					$d["lastid"] = $data["id"];
				}
				$d["erreur"]="ok";
			}
			echo json_encode($d);
		}

}