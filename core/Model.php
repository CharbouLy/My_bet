<?php

class Model{

	protected $table;
	protected static $_pdo = null;

	function __construct(){
		
		$user = "root";
		$password = "";
		$database = "bet";
		$host = "localhost";

		if (self::$_pdo === null){
			try
			{
				self::$_pdo = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $user, $password);
				self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
    			die('Erreur : ' . $e->getMessage());
			}
		}
	}
}