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

if(trim($_POST["oib"])===""){
		$greska["oib"]="OIB obavezno";
	}
	
if(trim($_POST["broj_registracije"])===""){
		$greska["broj_registracije"]="Broj registracije obavezno";
	}
if(trim($_POST["drzavljanstvo"])===""){
    $greska["drzavljanstvo"]="Državljanstvo obavezno";
}
if(trim($_POST["mjesto_rodjenja"])===""){
    $greska["mjesto_rodjenja"]="Mjesto rođenja obavezno";
}

if(trim($_POST["datum_rodjenja"])===""){
    $greska["datum_rodjenja"]="Datum rođenja obavezno";
}

if(trim($_POST["klub"])===""){
    $greska["klub"]="Klub obavezno";
}