<?php

class Evenement extends Model{

	function getEquipe(){

		$sql = "SELECT * FROM equipe";
		$query = self::$_pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	function getCompet(){

		$sql = "SELECT * FROM competition";
		$query = self::$_pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	function getEvent(){

		$sql = "SELECT * FROM event WHERE status = 1 ORDER BY date_fin ASC";
		$query = self::$_pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function getEventAndPari($id_event){

		$sql = "SELECT * FROM event LEFT JOIN pari ON pari.id_event = event.id_event WHERE event.id_event = :id_event";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'id_event' => $id_event));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	function getJeton(){

		$sql = "SELECT jeton FROM user WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'id' => $_SESSION['id']));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	function getJetonAll($id){

		$sql = "SELECT jeton FROM user WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'id' => $id));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	function match($id){

		$sql = "SELECT * FROM event WHERE id_event = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
		'id' => $id));

		$count = $query->rowCount();
		if($count > 0){
			return $query->fetch(PDO::FETCH_ASSOC);
		}
		else{
			header('Location:'.WEBROOT.'evenement');
		}
	}

	function fin_match($event){

		date_default_timezone_set('Europe/Paris');
		for ($i=0; $i < count($event); $i++){

			$date_fin = strtotime($event[$i]['date_fin']);
			if (time() > $date_fin)
			{
		  		$this->insertStatusWinner($event[$i]['id_event'], $event[$i]['equipe1'], $event[$i]['equipe2']);
		  		$this->jeton_win($event[$i]['id_event']);
			}
			else{
				return;
			}
		}
	}

	function jeton_win($id_event){
		
		$event_pari = $this->getEventAndPari($id_event);

		for ($i=0; $i < count($event_pari); $i++) {

			if ($event_pari[$i]['equipe'] == $event_pari[$i]['winner']) {
				$this->distribJetonWin($event_pari[$i]);
			}
		}
	}

	function distribJetonWin($event_pari){

		$nbr_jeton = $this->getJetonAll($event_pari['id_user']);
		if ($event_pari['equipe'] == $event_pari['equipe1']) {

			$jeton = ($event_pari['mise'] * $event_pari['cote1']) + $nbr_jeton['jeton'];
			$this->insertJetonWin($event_pari['id_user'], $jeton);

		}
		if ($event_pari['equipe'] == $event_pari['equipe2']) {

			$jeton = ($event_pari['mise'] * $event_pari['cote1']) + $nbr_jeton['jeton'];
			$this->insertJetonWin($event_pari['id_user'], $jeton);
		}
	}

	function insertJetonWin($id, $jeton){

		$sql = "UPDATE user SET jeton = :jeton WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'jeton' => $jeton,
			'id' => $id));
		return true;
	}

	function insertStatusWinner($id_event, $equipe1, $equipe2){

		$winner = array($equipe1, $equipe2, $equipe1, $equipe2);
		$rand_win = array_rand($winner, 1);

		$sql = "UPDATE event SET status = :status, winner = :winner WHERE id_event = :id_event";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'status' => 0,
			'winner' => $winner[$rand_win],
			'id_event' => $id_event));
		return true;
	}

	function insertMise($equipe, $mise, $id_event){

		$nbr_jeton = $this->getJeton();
		if ($mise > $nbr_jeton['jeton']){
			echo "pas assew de jeton mon ami lien pour en acheter : <a href=".WEBROOT."jeton/achat>achat</a>";
		}
		else{

			$jeton = $nbr_jeton['jeton'] - $mise;
			$sql = "INSERT INTO pari(id_user, id_event, equipe, mise) VALUES(:id_user, :id_event, :equipe, :mise)";
			$sql2 = "UPDATE user SET jeton = :jeton WHERE id = :id";

			$query = self::$_pdo->prepare($sql);
			$query2 = self::$_pdo->prepare($sql2);

			$query->execute(array(
				'id_user' => $_SESSION['id'],
				'id_event' => $id_event,
				'equipe' => $equipe,
				'mise' => $mise));
			$query2->execute(array(
				'jeton' => $jeton,
				'id' => $_SESSION['id']));

			return true;
		}
	}

	function create($equipe1, $cote1, $equipe2, $cote2, $compet, $date, $time){

		date_default_timezone_set('Europe/Paris');
		$date_time = $date.' '.$time;
		$date_fin = strtotime($date_time);
		$date_bdd = date("Y-m-d H:i:s", $date_fin);

		if (time() > $date_fin)
		{
		    echo 'date avant now my friend';
		}
		else{
			$sql = "INSERT INTO event(equipe1, cote1, equipe2, cote2, compet, date_fin) VALUES(:equipe1, :cote1, :equipe2, :cote2, :compet, :date_fin)";
			$query = self::$_pdo->prepare($sql);
			$query->execute(array(
				'equipe1' => $equipe1,
				'cote1' => $cote1,
				'equipe2' => $equipe2,
				'cote2' => $cote2,
			    'compet' => $compet,
			    'date_fin' => $date_bdd));
			return true;
		}
	}
}