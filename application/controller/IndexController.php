<?php

class IndexController extends Controller
{
	
	public function process()
	{
		if(isset($_GET['disauth']) && $_GET['disauth'] == "disconnect"){
			$_SESSION['disauth'] = false;
			$user = new User($_SESSION['id'], $this->connection);
			$user->disconnectUser($_SESSION['id']);
			header("location:/index");
		}
		
		if(isset($_POST['log'])){
			$auth = new Authentification($this->connection, $this->infoMessage);
			$authResult = $auth->checkAuth($_POST, USER);
			if($authResult === true){
				$user = new User($_SESSION['id'], $this->connection);
				$user->connectUser($_SESSION['id']);
				header("location:/tchat");
			}
		}
		
		if(isset($_SESSION['disauth']) && $_SESSION['disauth'] == true){
			$user = new User($_SESSION['id'], $this->connection);
			$user->connectUser($_SESSION['id']);
			header("location:/tchat");
		}
		
		parent::infoMessage();
	}
	
	
}