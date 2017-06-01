<?php

class HomeController extends Controller{
	
	function index(){

		$this->data['title'] = 'Accueil | uBet';
		$this->render('home', $this->data);
	}
}