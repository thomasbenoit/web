<?php
	require_once('class/Auth.php');
	require_once('class/Activite.php');
	session_start();
	if(!Auth::islog()){
	header('Location:index.php');
	}
	if(isset($_GET) && !empty($_GET['id'])){
		Activite::SuppWithId($_GET['id']);
		header('Location:activite.php');
	}

	?>
