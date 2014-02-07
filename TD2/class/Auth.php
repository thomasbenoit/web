<?php
	require_once('databaseco.php');
	require_once('User.php');

?>

<?php
	class Auth{
		

		static function islog(){
			global $cnx;
			if(isset($_SESSION['Auth'])){
				$q=array(':pseudo'=>$_SESSION['Auth']->getPseudo(),':password'=>$_SESSION['Auth']->getMdp());
				$sql='SELECT pseudoUtilisateurs,mdpUtilisateurs from utilisateurs WHERE pseudoUtilisateurs=:pseudo and mdpUtilisateurs =:password';
				$req=$cnx->prepare($sql);
				$req->execute($q);
				$count=$req->rowCount();
				if($count==1){
					return true;					
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}

		}
	
	}


?>