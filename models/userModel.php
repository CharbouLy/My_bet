<?php

class User extends Model{

	protected $table = 'user';
	protected $prenom;
	protected $nom;
	protected $date_naissance;
	protected $login;
	protected $email;
	protected $pass_hash;

	function getUser($id){
		
		$sql = "SELECT * FROM ".$this->table." WHERE id=:id";
		$query = self::$_pdo->prepare($sql);
		$query->bindParam(":id", $id);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	function inscription($prenom, $nom, $date_naissance, $login, $email, $mdp, $mdp2, $submit){

		$this->prenom = htmlspecialchars($prenom);
		$this->nom = htmlspecialchars($nom);
		$this->date_naissance = htmlspecialchars($date_naissance);
		$this->login = htmlspecialchars($login);
		$this->email = htmlspecialchars($email);
		$this->mdp = htmlspecialchars($mdp);
		$this->mdp2 = htmlspecialchars($mdp2);
		$this->pass_hash = hash("ripemd160", htmlspecialchars($mdp)."saltBae");


		if($submit == "S'inscrire"){
			if($this->checkDoublons($this->login, $this->email) && $this->checkMail($this->email) && $this->checkDate($this->date_naissance)){
				if ($this->mdp != $this->mdp2) {
					echo "<h1>Vos deux MDP ne sont pas IDENTIQUES !!!</h1>";
					return false;
				}
				$sql = "INSERT INTO ".$this->table."(prenom, nom, date_naissance, login, email, mdp, jeton) VALUES(:prenom, :nom, :date_naissance, :login, :email, :mdp, :jeton)";
				$query = self::$_pdo->prepare($sql);
				$query->execute(array(
					'prenom' => $this->prenom,
					'nom' => $this->nom,
					'date_naissance' => $date_naissance,
				    'login' => $this->login,
				    'email' => $this->email,
				    'mdp' => $this->pass_hash,
				    'jeton' => 20));
				return true;
			}
		}
		elseif($submit == "Modifier"){

			$sql = "UPDATE ".$this->table." SET prenom = :prenom, nom = :nom, login = :login, email = :email WHERE id = :id";
			$query = self::$_pdo->prepare($sql);
			$query->execute(array(
				'prenom' => $this->prenom,
				'nom' => $this->nom,
			    'login' => $this->login,
			    'email' => $this->email,
			    'id' => $_SESSION['id']));
			if(!empty($this->mdp) && empty($this->mdp2) || empty($this->mdp) && !empty($this->mdp2)){
				echo "<h1>Rempli tt !!!</h1>";
				return false;
			}
			if(!empty($this->mdp) && !empty($this->mdp2)){
				if ($this->mdp != $this->mdp2) {
					echo "<h1>Vos deux MDP ne sont pas IDENTIQUES !!!</h1>";
					return false;
				}
				else{
					$sql = "UPDATE ".$this->table." SET mdp = :mdp WHERE id = :id";
					$reqmdp = self::$_pdo->prepare($sql);
					$reqmdp->execute(array(
						'mdp' => $this->pass_hash,
						'id' => $_SESSION['id']));
				}
			}
			return true;
		}
	}

	function connexion($login, $mdp){

		$this->login = htmlspecialchars($login);
		$this->pass_hash = hash("ripemd160", htmlspecialchars($mdp)."saltBae");

		$sql = "SELECT * FROM ".$this->table." WHERE (login = :login OR email = :login) AND mdp = :mdp";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'login' => $this->login,
			'mdp' => $this->pass_hash));

		if($user = $query->fetch()){

			$_SESSION['id'] = $user['id'];
			$_SESSION['login'] = $user['login'];
			$_SESSION['admin'] = $user['admin'];
			return true;
		}
		else{
			echo "<h1>LOGIN OU MAIL OU MDP WRONG MY FRIEND</h1>";
			return false;
		}
	}

	function profil($id){

		$sql = "SELECT * FROM ".$this->table." WHERE id = :id";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
		'id' => $id));
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	function checkDoublons($login, $email){

		$sql = "SELECT COUNT(*) FROM ".$this->table." WHERE `login` = :login or `email` = :email";
		$query = self::$_pdo->prepare($sql);
		$query->execute(array(
			'login' => $login,
			'email' => $email));
		$resultat = $query->fetch();

		if ($resultat[0] > 0){
	    	echo "<h1>login ou email deja pris MAAAAN</h1>";
			return false;
		}
		else{
	    	return true;
		}
	}

	function checkDate($date_naissance){

		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_naissance) !== 1){
			echo "date de naissance pas bonne!! RESPECT THIS : AAAA-MM-JJ";
			return false;
		}
		if ( floor( time() - strtotime($date_naissance) ) / 31556926 < 18 ) {
			echo "Vous ne pouvez pas créer de compte, car vous n'avez pas l'âge minimum requis!";
			return false;
		}
		return true;
	}
	function checkMail($email){

		if (preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)){
			return true;
		}
		else{
			echo "<h1>EMAIL MAL TAPEZ HEHE</h1>";
			return false;
		}
	}
}