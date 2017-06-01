<?php

class EvenementController extends Controller{

	protected $modelsUser;
	protected $modelsEvenement;

	function __construct(){
		parent::__construct();
		$this->modelsUser = $this->loadModel('User');
		$this->modelsEvenement = $this->loadModel('Evenement');
	}
	
	function index(){

		$this->data['title'] = 'Match | uBet';

		$this->data['match'] = $this->Evenement->getEvent();

		////////////////////Convert_date////////////////////
		$count = count($this->data['match']);
		setlocale (LC_TIME,'fr_FR.utf8','fra');
		for ($i=0; $i < $count; $i++){

			$date = $this->data['match'][$i]['date_fin'];
			$timestamp = strtotime($date);
			$date = utf8_encode(strftime("%A %d %B %Y", $timestamp));
			$heure = strftime("%H:%M", $timestamp);
			$this->data['match'][$i]['date'] = $date;
			$this->data['match'][$i]['heure'] = $heure;
		}
		////////////////////Convert_date////////////////////
		
		$this->Evenement->fin_match($this->data['match']);
		
		$this->render('index', $this->data);
	}

	function match($id){

		$this->data['title'] = 'Match | uBet';

		$id = explode("/", $_GET['p']);
		$id = $id[2];

		$this->data['match'] = $this->Evenement->match($id);

		if(isset($this->data['submit'])){
			if($this->Evenement->insertMise($this->data['equipe'], $this->data['mise'], $this->data['match']['id_event'])){
				header('Location:'.WEBROOT.'user/profil/'.$_SESSION['id']);
			}
		}
		////////////////////Convert_date////////////////////
		$count = count($this->data['match']);
		setlocale (LC_TIME,'fr_FR.utf8','fra');
		$date = $this->data['match']['date_fin'];
		$timestamp = strtotime($date);
		$date = utf8_encode(strftime("%A %d %B %Y", $timestamp));
		$heure = strftime("%H:%M", $timestamp);
		$this->data['match']['date'] = $date;
		$this->data['match']['heure'] = $heure;
		////////////////////Convert_date////////////////////
		$this->render('match', $this->data);
	}

	function create(){

		if($_SESSION['admin'] == "1"){

			$this->data['title'] = 'Create | uBet';

			$this->data['equipe'] = $this->Evenement->getEquipe();
			$this->data['compet'] = $this->Evenement->getCompet();
			if (isset($this->data['submit'])) {
			
				if($this->Evenement->create($this->data['equipe1'], $this->data['cote1'], $this->data['equipe2'], $this->data['cote2'], $this->data['competition'], $this->data['date'], $this->data['time'])){

					header('Location:'.WEBROOT.'evenement');
				}
			}

			$this->render('create', $this->data);
		}
		else{
			header('Location:'.WEBROOT);
		}
	}
}