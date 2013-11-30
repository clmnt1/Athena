<?php

class Response
{
	
	private $httpCode = 200;
	private $headers = array();
	private $body = '';
	
	/**
	 * @param number $httpCode
	 */
	public function setHttpCode($httpCode) {
		$this->httpCode = (int) $httpCode;
	}
	
	public function addHeade($header){
		array_push($this->headers, $header);
	}
	
	/**
	 * @param string $body
	 */
	public function setBody($body) {
		$this->body = $body;
	}
	
	public function send()
	{
		foreach($this->headers as $header){
			header($header);
		}
		echo $this->body;
	}
	
	public function __construct()
	{
	}
	
}