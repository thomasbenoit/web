<?php
	require_once('class/Auth.php');
	require_once('class/Activiter.php');
	session_start();
	if(!Auth::islog()){
	header('Location:index.php');
	}
	if(isset($_POST) && !empty($_POST['activite']) && !empty($_POST['date'])){
		print_r($_POST);
		$time=strtotime ($_POST['date']);
		$date=gmdate ("D/M/Y",$time);

	}

	?>
