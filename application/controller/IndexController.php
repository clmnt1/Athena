<?php

class IndexController extends Controller
{
	
	public function process(){
		if(isset($_GET['disauth']) && $_GET['disauth'] == "disconnect"){
			$_SESSION['disauth'] = false;
			header("location:/index");
		}
		if(isset($_SESSION['disauth']) && $_SESSION['disauth'] == true){
			header("location:/tchat");
		}

		if(isset($_POST['log'])){
			$auth = new Authentification($this->connection, $this->infoMessage);
			$auth->checkAuth($_POST, USER, "tchat");
		}
		else if(isset($_POST['reg'])){
			$regist = new Register($this->connection, $this->infoMessage);
			$regist->checkPassword($_POST, USER, "index");
		}
		parent::infoMessage();
	}
	
}