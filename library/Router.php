<?php

class Router
{

	private $request;
	private $route;
	
	/**
	 * @param Request $request
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;
	}
	
	public function route()
	{
		if(!$this->request instanceof Request){
			throw new Exception('Vous devez définir l\'objet Request avec la mÃ©thode setRequest() avant d\'appeler la mÃ©thode route()');
		}
		
		$uri = $this->request->getUri();
		if(strstr($uri, '?')){ // Vérifier si $uri contient un "?"
			$uri = substr($uri, 0, strpos($uri, '?')); // Supprimer le "?" et ce qui suit
		}
		$uri = trim($uri, '/'); // On enlève les "/" sur les bords de la chaîne
		$uri  = explode('/', $uri); // On explose la chaîne à chaque "/" et on stocke le résultat dans un tableau

		if($uri[0] == ""){
			$uri[0] = "index";
		}
		
		$controller = strtolower($uri[0]);
		
		array_shift($uri); // Enlève le premier élément du tableau
		$params = array();
		for($i=0; $i<count($uri); $i+=2){
			if($uri[$i+1]){
				$params[$uri[$i]] = $uri[$i+1];
			}
		}
		
		$this->request->setControllerName($controller);
		$this->request->setParams($params);
		$this->request->setRouted(true);
	}
	
}