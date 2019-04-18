<?php

if(!isset($_POST["email"]) || !isset($_POST["lozinka"])){
	exit;
}

include_once 'konfiguracija.php';

$izraz=$veza->prepare("select * from admin where email=:email and lozinka=md5(:lozinka)");
$izraz->execute($_POST);
$o = $izraz->fetch(PDO::FETCH_OBJ);

 

if($o==null){
	header("location: prijava.php?neuspjelo&email=" . $_POST["email"]);
	exit;
}


$_SESSION[$appID."autoriziran"]=$o;
if($_SESSION[$appID."autoriziran"]->uloga==="admin"){
	header("location: privatno/nadzornaPloca.php"); }
if($_SESSION[$appID."autoriziran"]->uloga==="sudac"){
	header("location: privatno/profil/profil.php"); }
else {
	header("location: privatno/nadzornaPloca.php"); }
	