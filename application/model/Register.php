<?php
class Register
{
	private $connected;

	public function __construct(Connect $connect)
	{
		require_once APP_PATH . DS . '/config.php';
		$this->connect = $connect;
		$connect = $connect->connect();
	}

	public function isConnected()
	{
		return $this->connected;
	}

	public function setConnected($connected, Info $infoMessage)
	{
		$this->connected = $connected;
	}
	
	public function checkPassword(array $params, $table, $dest)
	{
		if($params['password'] == $params['confPassword']){
			$this->registration($params, $table, $dest);
		}
		else{
			$_SESSION['error'] = "Oups, les mots de passe ne correspondent pas !"; 
			header("location:/" . $dest);
		}
	}

	public function registration(array $params, $table, $dest)
	{
		if($params){
			if(isset($params['firstName']) && !empty($params['firstName'])){
				$firstName = utf8_encode($params['firstName']);
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le prénom", "error");
			}	
			if(isset($params['surName']) && !empty($params['surName'])){
				$surName = utf8_encode($params['surName']);
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le nom", "error");
			}	
			if(isset($params['login']) && !empty($params['login'])){
				$login = utf8_encode($params['login']);
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le login", "error");
			}
			if(isset($params['password']) && !empty($params['password'])){
				$password = md5($params['password']);
			}else{
				$this->infoMessage->setInfoMessage("Veuillez renseigner le mot de passe", "error");
			}
			
			if(isset($params['firstName']) && !empty($params['firstName']) && isset($params['surName']) && !empty($params['surName']) && isset($params['login']) && !empty($params['login']) && isset($params['password']) && !empty($params['password'])){
				$sqlReg = "INSERT INTO ".$table." (user_firstName,user_secondName,user_pseudo,user_login,user_mdp)VALUES ('".$firstName."','".$surName."','".$firstName." ".$surName."','".$login."','".$password."');";
				if($req = $this->connect->query($sqlReg)){
					$this->infoMessage->setInfoMessage("Félicitation, votre inscription est validée. Vous pouvez vous identifier", "success");
					header("location:/" . $dest);
				}	
			}
		}
	}
}