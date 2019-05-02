<?php

if(!isset($_POST["email"]) || !isset($_POST["lozinka"])){
	exit;
}

include_once 'konfiguracija.php';

$izraz=$veza->prepare("select sifra,ime,prezime, email, lozinka, uloga from admin where email=:email and lozinka=md5(:lozinka) UNION
    select sifra,ime, prezime, email, lozinka, uloga from sudac where email=:email and lozinka=md5(:lozinka) UNION
    select sifra,ime, prezime, email, lozinka, uloga from delegat where email=:email and lozinka=md5(:lozinka)");
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
	header("location: privatno/profil/profilSuca.php"); }

if($_SESSION[$appID."autoriziran"]->uloga==="delegat"){
    header("location: privatno/profil/profilDelegat.php"); }

	