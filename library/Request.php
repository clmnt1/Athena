<?php

class Request
{
	
	static private $instance;
	
	private $uri;
	private $params;
	private $method;
	private $controllerName;
	private $routed;
	
	public function run()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->params = array();
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->controllerName = null;
		
	}
	
	/**
	 * @return the $uri
	 */
	public function getUri()
	{
		return $this->uri;
	}
	
	/**
	 * @return the $params
	 */
	public function getParams()
	{
		return $this->params;
	}
	
	/**
	 * @return the $params
	 */
	public function getParam($key)
	{
		if(isset($this->params[$key])){
			return $this->params[$key];
		}
		return false;
	}
	
	/**
	 * @param multitype: $params
	 */
	public function setParams(array $params) {
		$this->params = $params;
	}
	
	/**
	 * @return the $method
	 */
	public function getMethod()
	{
		return $this->method;
	}
	
	/**
	 * @return the $routed
	 */
	public function isRouted()
	{
		return $this->routed;
	}
	
	/**
	 * @return the $routed
	 */
	public function setRouted($routed)
	{
		$this->routed = (bool) $routed;
	}
	/**
	 * @return the $controllerName
	 */
	public function getControllerName()
	{
		return $this->controllerName;
	}
	
	/**
	 * @param string $controllerName
	 */
	public function setControllerName($controllerName)
	{
		$this->controllerName = (string) $controllerName;
	}
	
	private function __construct()
	{
	}
	
	static function getInstance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	private function __clone()
	{
	}

}