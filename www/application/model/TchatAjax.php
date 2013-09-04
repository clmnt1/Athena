<?php

/*session_start();
$d=array();

if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]) || !isset($_POST["action"])){
	$d["erreur"] = "Vous devez Ãªtre connectÃ© pour utiliser le tchat";
}
else{

	extract($_POST);
	$pseudo = mysql_escape_string($_SESSION["pseudo"]);

	/**
	 * Action : addMessage
	 * Permet l'ajout d'un message
	 * */
	if($_POST["action"]=="addMessage"){
		$message =  mysql_escape_string($message);
		$sql = "INSERT INTO messages(pseudo,message,date) VALUES ('$pseudo','$message',".time().")";
		mysql_query($sql) or die(mysql_error());
		$d["erreur"] ="ok";
	}


	/**
	 * Action : getMessages
	 * Permet l'affichage des dernier messages
	 * */
	if($_POST["action"]=="getMessages"){
		$lastid = floor($lastid);
		$sql = "SELECT * FROM messages WHERE id>$lastid ORDER BY date ASC";
		$req = mysql_query($sql) or die(mysql_error());
		$d["result"] = "";
		$d["lastid"] = $lastid;
		while($data = mysql_fetch_assoc($req)){
			$d["result"] .= '<p><strong>'.$data["pseudo"].'</strong>('.date("d/m/Y H:i:s",$data["date"]).') : '.htmlentities(utf8_decode($data["message"])).'</p>';
			$d["lastid"] = $data["id"];
		}
		$d["erreur"]="ok";
	}


	/**
	 * Action : getConnected
	 * Permet l'affichage des derniers connectÃ©s
	 **/
	if($_POST["action"]=="getConnected"){
		$now = time();
		$sql = "SELECT pseudo FROM connected WHERE $now-date<60";
		$req = mysql_query($sql) or die(mysql_error());
		$d["result"] = "ConnectÃ©s : ";
		while($data = mysql_fetch_assoc($req)){
			$d["result"] .= $data["pseudo"].", ";
		}
		$d["result"]  = substr($d["result"],0,-2);

		$sql = "UPDATE connected SET date = $now WHERE id={$_SESSION["idTchat"]}";
		mysql_query($sql) or die(mysql_error());

		$d["erreur"] = "ok";
	}



}



echo json_encode($d);
*/