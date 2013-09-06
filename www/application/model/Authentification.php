<?php

class Authentification
{
	
	private $connected;
	
	public function __construct(){
		require_once APP_PATH . DS . '/config.php';
		$connect = new Connect();
		$connexion = $connect->connexion(); 
	}
	
	public function isConnected()
	{
		return $this->connected;
	}
	
	public function setConnected($connected)
	{
		$this->connected = $connected;
	}
	
	public function checkAuth(array $params){
		sleep(2);
		$connexion = new PDO('mysql:host=127.0.0.1;dbname=athena;', 'athena', '0000');
		$sqlAuth = "SELECT *,(CASE WHEN user_mdp=:password THEN 1 ELSE 0 END) AS result FROM users WHERE user_login = :login;";
		$reqAuth = $connexion->prepare($sqlAuth);
		$reqAuth->execute($params);
		$resultAuth = $reqAuth->fetch();
		
		if((isset($result['result']) && 0 == $result['result'] || false === $result)){
			$auth = false;
		}else{
			$auth = true;
			$sqlName = "SELECT user_pseudo, user_id FROM users WHERE user_login = '" . $params['login'] . "'";
			$reqName = $connexion->query($sqlName);
			$resultName = $reqName->fetch();
			$_SESSION['pseudo'] = utf8_encode($resultName[0]);
			$_SESSION['id'] = $resultName[1];
		}
		
		return $resultAuth['result'];
	}

}