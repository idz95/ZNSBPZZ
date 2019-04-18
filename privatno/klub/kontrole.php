<?php

if(trim($_POST["naziv_kluba"])===""){
		$greska["naziv_kluba"]="Naziv obavezno";
	}
	
if(strlen(trim($_POST["naziv_kluba"]))>50){
		$greska["naziv_kluba"]="Naziv predugačak, smanjite ga ispod 50 znakova";
	}

if(trim($_POST["mjesto"])===""){
		$greska["mjesto"]="Mjesto obavezno";
	}
	
if(strlen(trim($_POST["mjesto"]))>50){
		$greska["mjesto"]="Mjesto, smanjite ga ispod 50 znakova";
	}


