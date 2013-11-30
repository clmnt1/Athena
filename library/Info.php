<?php

class Info{
	
	private $message;
	private $type;
	
	public function __construct(){
		
	}
	
	public function setInfoMessage($message, $type){
		$this->message = $message;
		$this->type = $type;
	}
	
	public function getInfoMessage(){
		if(isset($this->message) && !empty($this->message) && isset($this->type) && !empty($this->type)){
			
			$infoMessage =
			"<div class=\"info-message ". $this->type ."\">
				<p>". $this->message ."</p>
			</div>";
			
			return $infoMessage;
		}else{
			return null;
		}	
	}
	
	public function getInfoType(){
		if(isset($this->type) && !empty($this->type)){
			return $this->type;
		}else{
			return null;
		}
	}
	
}