<?php

class Dispatcher{
	
	private $request;
	private $response;
	private $view;
	private $connection;
	private $infoMessage;
	
	public function setRequest(Request $request)
	{
		$this->request = $request;
	}
	
	public function setResponse(Response $response)
	{
		$this->response = $response;
	}
	
	public function setView(View $view)
	{
		$this->view = $view;
	}
	
	public function setConnection(Connect $connection)
	{
		$this->connection = $connection;
	}
	
	public function setInfoMessage(Info $infoMessage)
	{
		$this->infoMessage = $infoMessage;
	}
	
	public function dispatch(){
		$controllerName = $this->request->getControllerName();
		$controllerClassname = ucfirst($controllerName) . 'Controller';
		$controllerFilename = $controllerClassname . '.php';
		
		// Instancie le controller
		require_once APP_PATH . DS . 'controller' . DS . $controllerFilename;
		$controller = new $controllerClassname($this->request, $this->response, $this->view, $this->connection, $this->infoMessage); // Instancie une class dont le nom est contenu dans une variable. Ici, $controllerClassname() = .
		$controller->process();
	}
	
}