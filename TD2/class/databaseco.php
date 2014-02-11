<?php
$server='info2';
$user='rangeard';
$pass='rangeard';
$bdd='DBrangeard';
$port='3306';
try{
	$cnx=new PDO('mysql:host='.$server.';port='.$port.';dbname='.$bdd,$user,$pass);
}
catch(PDOException $e){
	echo $e->getMessage();
}

?>