<?php

class Connect
{

	public function connexion(){
		$connexion = new PDO('mysql:host=127.0.0.1;dbname=athena;', 'athena', '0000');
		return $connexion;
	}

}