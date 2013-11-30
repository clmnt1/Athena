<?php

class Db
{

	private $Config = array(
			'host' => 'localhost',
			'user' => 'root',
			'password' => '0000',
			'base' => 'app2',
		);
	
	private $connected = false;
	
	public function __construct()
	{
	}

	
	public function connect()
	{
		$link = mysqli_connect(
				$this->config['host'],
				$this->config['user'],
				$this->config['password'],
				$this->config['base']
				);
		
		if(!$link){
			throw new ErrorException('Connexion à la base de donnée impossible');
		}else{		
			$this->connected = true;
			$this->connection = $link;
		}
	}
	
	public function isConnect()
	{
		return $this->connected;
	}
	
	public function query($query)
	{
		if(!$this->connected){
			$this->connect();
		}
		$result = mysqli_query($query);
		return $result;
	}
	
	public function test()
	{
		$vartest = "1";
		return $vartest;	
	}
}