<?php

class Connect
{
	
	private $db = array();
	private $connected = false;
	
	public function setConfig($config)
	{
		if('null' !== $config){
			if(is_array($config)){
				$this->config = $config;
			}else{
				throw new InvalidArgumentException('Le paramètre doit être un tableau');
			}
		}
	}
	
	public function __construct($config)
	{
		$this->setConfig($config);
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
			throw new ErrorException('Connexion à la base de donn�es impossible');
		}
		
		$this->connected = true;
		$this->connection = $link;
	}
	
	public function isConnected()
	{
		return $this->connected;
	}
	
	public function query($query)
	{
		if(!$this->connected){
			$this->connect();
		}
			$query = htmlspecialchars(stripslashes($query));
			$req = mysqli_query($this->connection, $query);
			return $req;
	}
	
}