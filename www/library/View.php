<?php

class View
{
	
	/**
	 * @param field_type $layout
	 */
	public function setLayout($layout) 
	{
		$this->layout = $layout;
	}
	
	public function renderPage($filename)
	{
		ob_start();
		require_once VIEW_PATH . DS . $filename;
		return ob_get_clean();
	}
	
	public function renderLayout($page)
	{
		ob_start();
		require_once VIEW_PATH . DS . $this->layout;
		return ob_get_clean();
	}
	
}