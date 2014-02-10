<?php
	require_once('databaseco.php');
	require_once('User.php');
?>
<?php
	class Activite {

		static function existe($date,$heure){
			global $cnx;
			$a=array(':idU'=>$_SESSION['Auth']->getId(),':dater'=> date("Y-m-d H:i:s",strtotime($date.$heure)));
			$sql='SELECT * from reservation where idUtilisateurs=:idU and dateReservation=:dater';
			$req=$cnx->prepare($sql);
			$req->execute($a);
			$res=$req->fetchAll();
			$count=$req->rowCount();
			if($count==1){	
				return true;
			}
			else{
				return false;
			}

		}
		 static function Add ($idActivite,$date,$heure){
			global $cnx;
			$datet=date("Y-m-d H:i:s",strtotime($date.$heure));
			$a2=array(':idusr'=>$_SESSION['Auth']->getId(),':dat'=>$datet,':idAct'=>$idActivite);
			$sql2='INSERT INTO reservation VALUES ("",:dat,:idAct,:idusr)';
			$req=$cnx->prepare($sql2);
			$req->execute($a2);
	    	}
static function Suppr($idActiviter,$date,$heure){
			global $cnx;
			$datet=date("Y-m-d H:i:s",strtotime($date.$heure));
			if(existe($date,$heure)){
				$a=array(':idU'=>$_SESSION['Auth']->getId(),':dater'=> date("Y-m-d H:i:s",strtotime($date.$heure)));
				$sql='DELETE from reservation WHERE idUtilisateurs=:idU and dateReservation=:dater';
				$req=$cnx->prepare($sql);
				$req->execute($a);
			}
	}
static function SuppWithId($id){
		global $cnx;
		$a=array(':id'=>$id);
		$sql='DELETE FROM reservation WHERE idReservation=:id';
		$req=$cnx->prepare($sql);
		print_r($req);
		$req->execute($a);
	}


	}
	


?>
