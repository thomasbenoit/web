<?php

	require_once('databaseco.php');
	
?>
<?php
	class User {

		private $id;
		private $nom;
		private $prenom;
		private $mdp;
		private $pseudo;
		private $email;


		public function __construct($id){
			global $cnx;
			$a=array(':id'=>$id);
			$sql='SELECT * from utilisateurs where idUtilisateurs=:id';
			$req=$cnx->prepare($sql);
			$req->execute($a);
			$res=$req->fetchAll();
			$count=count($req);
			if($count==1){	
				$this->id=$id;
				$this->pseudo=$res[0]['pseudoUtilisateurs'];
				$this->nom=$res[0]['nomUtilisateurs'];
				$this->prenom=$res[0]['prenomUtilisateurs'];
				$this->email=$res[0]['emailUtilisateurs'];
				$this->mdp=$res[0]['mdpUtilisateurs'];
			}

						
		}
		static function existPUser($pseudo){
			global $cnx;
			$a=array(':pseudo'=>$pseudo);
			$sql='SELECT * from utilisateurs where pseudoUtilisateurs=:pseudo';
			$req=$cnx->prepare($sql);
			$req->execute($a);
			$count=count($req);
			if($count==1){	
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
		}
	    static function existNPUser($nom,$prenom){
	    	global $cnx;
	    	$a=array(':nom'=>$nom,':prenom'=>$prenom);
			$sql='SELECT * from utilisateurs where nomUtilisateurs=:nom and prenomUtilisateurs=:prenom';
			$req=$cnx->prepare($sql);
			$req->execute($a);
			$count=count($req);
			if($count==1){	
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
	    }
	   
	    public function affiche(){
	    	return $this->pseudo;
	    }
	    public function getPseudo(){
	    	return $this->pseudo;
	    }
	    public function getMdp(){
	    	return $this->mdp;
	    }
	    public function getId(){
	    	return $this->id;
	    }
	    





	}




?>
