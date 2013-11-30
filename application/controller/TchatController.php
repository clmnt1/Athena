<?php
class TchatController extends Controller
{
	
	public function process(){
 		$cxID = $_SESSION['id'];
 		$this->view->cxID = $cxID;
 		$this->view->objUser = new User($cxID, $this->connection);
		
 		if(empty($_SESSION['disauth']) || $_SESSION['disauth'] == false){
			$_SESSION['message'] = 'Veuillez d\'abord vous identifier pour accéder au chat';
			header('Location:/index');
		}
		parent::infoMessage();
	}

}