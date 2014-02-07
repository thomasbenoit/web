<?php
	include_once('class/Auth.php');
	require_once('databaseco.php');
		session_start();

?>
<?php
	if(!empty($_POST) && strlen($_POST['pseudo'])>4 && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)&& strlen($_POST['password'])>6 && $_POST['password']==$_POST['repeatpassword']){
		$pseudo=addslashes($_POST['pseudo']);	
		$email=addslashes($_POST['email']);
		$password=sha1($_POST['password']);
		$stmt = $cnx->prepare("SELECT COUNT(*) FROM utilisateurs WHERE pseudoUtilisateurs = :pseudo");
		$stmt->execute(array(':pseudo'=>$pseudo));
		if ($stmt->fetchColumn() == 0) {
			$stmt2 = $cnx->prepare("SELECT COUNT(*) FROM utilisateurs WHERE emailUtilisateurs = :email");
			$stmt2->execute(array(':email'=>$email));
				if ($stmt2->fetchColumn() == 0) {
					$sql= 'INSERT INTO utilisateurs (pseudoUtilisateurs,emailUtilisateurs,mdpUtilisateurs) VALUES (:pseudo, :email, :password)';
					$req=$cnx->prepare($sql);
					$req->execute(array(':pseudo'=>$pseudo,':email'=>$email,':password'=>$password))or die(print_r($req->errorInfo()));
					$confirmation="Votre compte est en attente de validation par un administrateur";
				}
				else{
					$erreuremailprise='Un compte est déjà associé a cette adresse mail';

				}
		}
		else{
			$erreurlogin='Nom d\'utilisateur deja utilisé';	
		}
	}
	else{
		if(!empty($_POST) && strlen($_POST['pseudo'])<4){
			$erreurpseudo='Votre pseudo doit comporter au minimum 4 caractere';
		}
		if(!empty($_POST) && !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$erreuremail='Votre email n\'est pas valide';
		}
		if(!empty($_POST) && strlen($_POST['password'])<6){		
			$erreurpassword='le mot de passe doit comporter au minimum 6 caractere';	
		}
		if(!empty($_POST) && !($_POST['password']==$_POST['repeatpassword'])){
			$erreurpasswordrepeat='Les mots de passe sont differents';	
		}
	}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet tuteuré</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
  </head>

  <body>
  	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Acceuil</a>
          <div class="nav-collapse collapse">
           <?php
           if(Auth::islog()){ 
				echo '<ul class="nav pull-right">';
               	echo ' <li class="dropdown">';
                echo '	<a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$_SESSION['Auth']->getPseudo().'<b class="caret"></b></a>';
                echo '	<ul class="dropdown-menu">';
            	echo ' 		<li><a href="logout.php">Déconnexion</a></li>';
            	
                echo ' 	</ul>';
              	echo ' </li>';
            	echo '</ul>';
             	echo '<p class="navbar-text pull-right">Connecté en tant que</p>';
            
			}
		
		else{
			echo '  <form class="navbar-form pull-right" role="form" method="post" action="connexion.php">
              <input type="text" placeholder="pseudo" class="form-control" name="pseudo">       
              <input type="password" placeholder="Password" class="form-control" name="password">
            <button type="submit" class="btn btn-success" name="submit">Connexion</button>
         
          </form>';
		}
?>
       <?php      
        if(Auth::islog()){ 
            echo '<ul class="nav">
                          <li><a href="index.php">Acceuil</a></li>
                         
                        </ul>';
        }
        else{
        	echo ' <ul class="nav">
              <li><a href="index.php">Acceuil</a></li>
              <li class="active"><a href="inscription.php">Inscription</a></li>

            </ul>';
        }
        ?>
          </div><!--/.nav-collapse -->
        </div>

      </div>
    </div>

<div class="container-fluid">
      <div class="row-fluid">    
        <div class="span4 offset4">
          <?php if (!Auth::islog()){

      		echo '<form class="form-signin" action="inscription.php" method="POST">
              <h2 class="form-signin-heading">Creer un compte</h2>
              <input type="text" class="input-block-level" placeholder="Pseudo" name="pseudo">';
               if(isset($erreurlogin))echo '<button class="btn btn-warning" type="button">'.$erreurlogin.'</button></br></br>';
              echo'<input type="email" class="input-block-level" placeholder="Email" name="email">';
              if(isset($erreuremailprise))  echo '<button class="btn btn-warning" type="button">'.$erreuremailprise.'</button></br></br>';
             echo ' <input type="password" class="input-block-level" placeholder="Password" name="password">';
                if(isset($erreurpassword)) echo  '<button class="btn btn-warning" type="button">'.$erreurpassword.'</button></br></br>';
           	  echo '<input type="password" class="input-block-level" placeholder="Password" name="repeatpassword">';
           if(isset($erreurpasswordrepeat)) echo '<button class="btn btn-warning" type="button">'.$erreurpasswordrepeat.'</button></br></br>';
              echo '<button class="btn btn-large btn-primary" type="submit" name="submit">S\'inscire</button>
            </form>';
            if(isset($confirmation))echo '<button class="btn btn-success" type="button">'.$confirmation.'</button></br></br>';
          }
else{
  header('Location:index.php');
}
?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>
      <footer>
        <p>&copy; IUT Orléans 2014</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>