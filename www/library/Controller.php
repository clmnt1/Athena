<?php

abstract class Controller implements ControllerInterface
{
	
	protected $request; // Private => seule Controller les voient, protected => Controller et ses enfants les voient, public => tout le monde les voient.
	protected $response;
	protected $view;
	protected $titre = 'titre';
	protected $description = 'description';
	protected $keywords = 'mots clés';
	
	public function __construct(Request $request, Response $response, View $view)
	{
		$this->request = $request;
		$this->response = $response;
		$this->view = $view;
		
	}
	
}