<?php
	require_once('databaseco.php');
	require_once('User.php');
?>
<?php
	class Activite {

		static function existeactiviter($id){
			global $cnx;
			$a=array(':id'=>$id);
			$sql='SELECT * from activite where idActivite=:id';
			$req=$cnx->prepare($sql);
			$req->execute($a);
			$res=$req->fetchAll();
			$count=$req->rowCount();
			if($count==1){	
				return true;
			}		
			else return false;			
		}
		static function existe($date){
			global $cnx;
			$a=array(':idU'=>$_SESSION['Auth']->getId(),':dater'=> gmdate("Y-m-d",strtotime($date)));
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
		public static function Add ($idActiviter,$date){
			global $cnx;
			$datet=gmdate("Y-m-d",strtotime($date));
			$a2=array(':idusr'=>$_SESSION['Auth']->getId(),':dat'=>$datet,':idAct'=>$idActiviter);
			$sql2='INSERT INTO reservation VALUES ("",:dat,:idAct,:idusr)';
			$req=$cnx->prepare($sql2);
			$req->execute($a2);
	    	}

	}




?>
