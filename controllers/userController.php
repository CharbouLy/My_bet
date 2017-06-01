<?php

class UserController extends Controller{

	protected $modelsUser;

	function __construct(){
		parent::__construct();
		$this->modelsUser = $this->loadModel('User');
	}

	function index(){

		header('Location:'.WEBROOT);
	}

	function inscription(){

		if(!isset($_SESSION['id'])){

			$this->data['title'] = "Inscription | uBet";

			if (isset($this->data['submit'])) {

				if ($this->User->inscription($this->data['prenom'], $this->data['nom'], $this->data['date_naissance'], $this->data['login'], $this->data['email'], $this->data['mdp'], $this->data['mdp2'], $this->data['submit'])){

					header('Location:'.WEBROOT.'user/connexion');
				}
			}
			$this->render('inscription', $this->data);
		}
		else{
			header('Location:'.WEBROOT);
		}
	}

	function edit(){

		if(isset($_SESSION['id'])){

			$this->data['title'] = "Edit | uBet";
			$this->data['user'] = $this->User->getUser($_SESSION['id']);

			if (isset($this->data['submit'])) {

				if ($this->User->inscription($this->data['prenom'], $this->data['nom'], null, $this->data['login'], $this->data['email'], $this->data['mdp'], $this->data['mdp2'], $this->data['submit'])){

					header('Refresh: 0;url='.WEBROOT.'user/edit');
				}
			}
			$this->render('edit', $this->data);
		}
		else{
			header('Location:'.WEBROOT);
		}
	}

	function connexion(){

		if(!isset($_SESSION['id'])){

			$this->data['title'] = "Connexion | uBet";

			if (isset($this->data['submit'])) {
				if ($this->User->connexion($this->data['login'], $this->data['mdp'])){

					header('Location:'.WEBROOT);
				}
			}
			$this->render('connexion', $this->data);
		}
		else{
			header('Location:'.WEBROOT);
		}
	}

	function deconnexion(){

		session_start();
		session_unset();
		session_destroy();
		header('Location:'.WEBROOT);
	}

	function profil($id){

		if(isset($_SESSION['id'])){

			if ($id == null){
				header('Location:'.WEBROOT);
			}
			$this->data['title'] = "Profil | uBet";

			$id = explode("/", $_GET['p']);
			$id = $id[2];
			
			$this->data['user'] = $this->User->profil($id);
			$this->render('profil', $this->data);
		}
		else{
			header('Location:'.WEBROOT);
		}
	}
}