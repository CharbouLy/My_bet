<?php

class JetonController extends Controller{

	protected $modelsUser;
	protected $modelsJeton;

	function __construct(){
		parent::__construct();
		$this->modelsUser = $this->loadModel('User');
		$this->modelsJeton = $this->loadModel('Jeton');
	}

	function index(){

		header('Location:'.WEBROOT);
	}		

	function achat(){
		
		$this->data['title'] = 'Achat | uBet';

		if(isset($this->data['submit'])){
			if($this->Jeton->ajoutJeton($this->data['jeton'])){
				header('Location:'.WEBROOT.'user/profil/'.$_SESSION['id']);
			}
		}
		$this->render('achat', $this->data);
	}
}