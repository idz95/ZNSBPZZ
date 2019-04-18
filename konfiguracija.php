<?php 

include_once 'funkcije.php';

session_start();

if($_SERVER["SERVER_NAME"]==="localhost"){
	$putanjaAPP = "/ZNSBPZ/" ;
}else{
	$putanjaAPP = "/";
}
$naslovAPP="ZNS BPZ";
$appID="ZNSBPZ";
$dev=true;
$brojRezultataPoStranici=10;



if ($_SERVER["HTTP_HOST"] === "ferit.byethost22.com") {
    $host = "sql305.byethost.com";
    $dbname = "b22_21939304_ferit";
    $dbuser = "b22_21939304";
    $dbpass = "vD53aSzD";
} else {
    $host="localhost";
	$dbname="znsbpz";
	$dbuser="ivica";
	$dbpass="ivica";
}

try{
	$veza = new PDO("mysql:host=" . $host . ";dbname=" . $dbname,$dbuser,$dbpass);
	$veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$veza->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8';");
	$veza->exec("SET NAMES 'utf8';");
	
}catch(PDOException $e){
	switch($e->getCode()){
		case 1049:
			header("location: " . $putanjaAPP . "greske/kriviNazivBaze.html");
			exit;
			break;
		default:
			header("location: " . $putanjaAPP . "greske/greska.php?code=" . $e->getCode());
			exit;
			break;
	}
}



 ?>