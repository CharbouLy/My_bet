<?php

class Controller{

	protected $vars = array();
	protected $layout = 'default';

	function __construct(){
		
		if (isset($_POST)){
			$this->data = $_POST;
		}
	}

	function render($filename, $data){

		extract($data);
		ob_start();

		$name = str_replace("controller", "", strtolower(get_class($this)));

		require(ROOT.'views/'.$name.'/'.$filename.'.php');

		$content_for_layout = ob_get_clean();

		if($this->layout==false){

			echo $content_for_layout;
		}
		else{
			
			require(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	function loadModel($name){

		require_once(ROOT.'models/'.strtolower($name).'Model.php');
		$this->$name = new $name();
	}
}