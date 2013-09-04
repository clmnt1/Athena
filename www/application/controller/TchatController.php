<?php


class TchatController extends Controller
{

	public function process(){
		session_start();
		
		if(empty($_SESSION['authentified']) || $_SESSION['authentified'] == false){
			$_SESSION['message'] = 'Veuillez d\'abord vous identifier pour accéder au chat';
			header('Location:/index');
		}
		
	}

}