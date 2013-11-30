<?php

class Authentification
{
	
	private $connected;
	
	public function __construct(Connect $connect, Info $infoMessage){
		require_once APP_PATH . DS . '/config.php';
		$this->connect = $connect;
		$this->infoMessage = $infoMessage;
		$connect = $connect->connect(); 
	}
	
	public function isConnected()
	{
		return $this->connected;
	}
	
	public function setConnected($connected)
	{
		$this->connected = $connected;
	}
	
	public function checkAuth(array $params, $table){
		sleep(2);
		if($params){
			
			if(isset($params['login']) && !empty($params['login'])){
				$login = $params['login'];
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le login", "error");
			}
			if(isset($params['password']) && !empty($params['password'])){
				$password = $params['password'];
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le mot de passe", "error");
			}
			
			if(isset($login) && !empty($login) && isset($password) && !empty($password)){
				$sqlAuth = "SELECT *,(CASE WHEN user_mdp = '". $password . "' THEN 1 ELSE 0 END) AS result FROM " . $table . " WHERE user_login = '" . $login . "';";
				$req = $this->connect->query($sqlAuth);
				$res = mysqli_fetch_assoc($req);
				$userId = $res['user_id'];
				if(mysqli_num_rows($req) >= 1){
					$_SESSION['id'] = $userId;
					$_SESSION['login'] = $params['login'];
					$_SESSION['disauth'] = true;
					return true;
				}else{
					$this->infoMessage->setInfoMessage("Mauvais login ou mot de passe", "error");
					return false;
				}
			}
		}
	}

}