<?php
  require_once 'databaseco.php';
  require_once('class/Auth.php');
  require_once('class/User.php');
  session_start();
  
?>
<?php
if(!empty($_POST)){
  $pseudo=$_POST['pseudo'];
  $password=sha1($_POST['password']);
  $q=array(':pseudo' => $pseudo,':password'=>$password);
  $sql='SELECT pseudoUtilisateurs,mdpUtilisateurs FROM utilisateurs WHERE pseudoUtilisateurs=:pseudo and mdpUtilisateurs=:password';
  $req=$cnx->prepare($sql);
  $req->execute($q);
  $count=$req->rowCount();

  

  if($count==1){
    $sql='SELECT idUtilisateurs from utilisateurs where pseudoUtilisateurs=:pseudo and mdpUtilisateurs=:password';
    $req=$cnx->prepare($sql);
    $req->execute($q);
    $actif=$req->rowCount();
    $res=$req->fetchAll();
    if($actif==1){
      $_SESSION['Auth']=new User($res[0]['idUtilisateurs']);      
    }
  }
  else{
    $error_unknow='Le Pseudo ou mot de passe est incorrect';

  }
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TD2</title>
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
			echo '  <form class="navbar-form pull-right" role="form" method="post" action="index.php">
              <input type="text" placeholder="pseudo" class="form-control" name="pseudo">       
              <input type="password" placeholder="Password" class="form-control" name="password">
            <button type="submit" class="btn btn-success" name="submit">Connexion</button>
         
          </form>';
		}
?>
       <?php      
        if(Auth::islog()){ 
            echo '<ul class="nav">
                          <li class="active"><a href="index.php">Acceuil</a></li>
                          <li > <a href="activiter.php">Activite</a></li>
                        </ul>';
        }
        else{
        	echo ' <ul class="nav">
              <li class="active"><a href="index.php">Acceuil</a></li>
        
            </ul>';
        }
        ?>
          </div><!--/.nav-collapse -->
        </div>

      </div>
    </div>

<div class="container-fluid">
      <div class="row-fluid">    
        <div class="span12">
          <div class="hero-unit">
            <?php
            if(isset($_GET['message'])&& !empty($_GET['message'])){
              echo htmlentities($_GET['message']);
            }
            else{

           echo "<h1>Bonjour ";
          if(Auth::islog()) echo $_SESSION['Auth']->getPseudo(); 
        }
          ?>
          </div>
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