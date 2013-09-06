<?php

class User{
	
	public $id;
	public $pseudo; 
	public $firstName;
	public $secondeName;
	public $isLogged;
	
	function User($id){
	
		$dbname ='localhost';
		$dbuser = 'athena';
		$password = '0000';
		mysql_connect($dbname, $dbuser, $password);
		mysql_select_db("athena");
		
		$sqlSelectUser = "SELECT * FROM ".USER." WHERE user_id = $id";
		$sqlSelectRes = mysql_query($sqlSelectUser) or die ("Erreur : '".mysql_error()."', SQL : $sqlSelectUser");
		$sqlSelectRet = mysql_fetch_assoc($sqlSelectRes); 
		 
		if($sqlSelectRet)
		{
			$this->id          = $id;
			$this->pseudo      = utf8_encode($sqlSelectRet['user_pseudo']);
			$this->firstName   = utf8_encode($sqlSelectRet['user_firstName']);
			$this->secondeName = utf8_encode($sqlSelectRet['user_secondName']);
			$this->isLogged    = $sqlSelectRet['user_logged']; 
		}
	}
	
	function connectUser($cx_id){
	/**
	 *	Descr  : Passe le jeton de connexion à true
	 *	Auteur : Clément Régnier
	 *	Date   : 04/09/2013
	 */
		$this->isLogged = true;
		$sqlLogged = "UPDATE ".USER." SET user_logged = 1 WHERE user_id = $cx_id";
		$connexion->query($sqlLogged);
		
	}
	
	function disconnectUser($cx_id){
	/**
	 *	Descr  : Passe le jeton de connexion à false
	 *	Auteur : Clément Régnier
	 *	Date   : 04/09/2013
	 */
		$this->isLogged = false;
		$sqlLogged = "UPDATE ".USER." SET user_logged = 0 WHERE user_id = $cx_id";
		$connexion->query($sqlLogged);
	}
	
}