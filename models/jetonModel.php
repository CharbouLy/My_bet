<?php

class Jeton extends Model{

	function getJeton(){

		$sql = "SELECT jeton FROM user WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'id' => $_SESSION['id']));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	function ajoutJeton($jeton){

		$nbr_jeton = $this->getJeton();
		$jeton = $nbr_jeton['jeton'] + $jeton;
		$sql = "UPDATE user SET jeton = :jeton WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'jeton' => $jeton,
			'id' => $_SESSION['id']));
		return true;
	}	
}