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
		public static function Add ($idActiviter,$date,$heure){
			global $cnx;
			$datet=date("Y-m-d H:i:s",strtotime($date.$heure));
			$a2=array(':idusr'=>$_SESSION['Auth']->getId(),':dat'=>$datet,':idAct'=>$idActiviter);
			$sql2='INSERT INTO reservation VALUES ("",:dat,:idAct,:idusr)';
			$req=$cnx->prepare($sql2);
			$req->execute($a2);
	    	}

	}




?>
