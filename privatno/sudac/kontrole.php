<?php

if(trim($_POST["ime"])===""){
		$greska["ime"]="Ime obavezno";
	}
	
if(strlen(trim($_POST["ime"]))>50){
		$greska["ime"]="Ime predugačko, smanjite ga ispod 50 znakova";
	}

if(trim($_POST["prezime"])===""){
		$greska["prezime"]="Prezime obavezno";
	}
	
if(strlen(trim($_POST["prezime"]))>50){
		$greska["prezime"]="Prezime predugačko, smanjite ga ispod 50 znakova";
	}

if(trim($_POST["email"])===""){
		$greska["email"]="Email obavezno";
	}
	
	
if(!isset($_POST["sifra"])){
		$_POST["sifra"]=0;
	}
	$izraz=$veza->prepare("select sifra from sudac where email=:email and sifra!=:sifra");
	$izraz->execute(array("email"=>$_POST["email"], "sifra"=>$_POST["sifra"]));
	$sifra = $izraz->fetchColumn();
	if($sifra>0){
		$greska["email"]="Email adresa postoji u bazi, odabrati drugu"; }
	
	
	if(trim($_POST["lozinka"])===""){
		$greska["lozinka"]="Lozinka obavezno";
	}
	
	if(trim($_POST["mobitel"])===""){
		$greska["mobitel"]="Kontakt obavezno";
	}
if(trim($_POST["liga"])===""){
    $greska["liga"]="Liga obavezno";
}

if(trim($_POST["mjesto"])===""){
    $greska["mjesto"]="Mjesto obavezno";
}

if(trim($_POST["datum_rodjenja"])===""){
    $greska["datum_rodjenja"]="Datum rođenja obavezno";
}
