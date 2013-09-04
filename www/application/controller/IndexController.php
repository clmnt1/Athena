<?php

class IndexController extends Controller
{
	
	public function process(){
		session_start();
		$auth = new Authentification();
		
		if(!empty($_GET['disauth']) && isset($_GET['disauth']) && $_GET['disauth'] == true){
			$_SESSION['authentified'] = false;
		}
		
		if(empty($_SESSION['authentified']) || $_SESSION['authentified'] == false){
			if(!empty($_POST) && isset($_POST)){
			
				if($_POST['login'] != '' && $_POST['password'] != ''){
					$authRecept = array(
					'login' => $_POST['login'], 'password' => $_POST['password']
					);
					$authSuccess = $auth->checkAuth($authRecept);
					$_SESSION['authentified'] = $authSuccess;
				}
				
				if($authSuccess){
					header('Location:/tchat');
				}else{
					$_SESSION['message'] = 'Mauvaise identification';
					header('Location:/index');
				}
			}
		}else{
			header('Location:/tchat');
		}
	}
	
}