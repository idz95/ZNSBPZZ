<?php

include_once '../../konfiguracija.php'; 

	
	$izraz = $veza->prepare("
		update utakmica set domacin_score=:domaci, gost_score=:gost, 
		opis=:opis where sifra=:sifraUtakmice;
	");
	$izraz->execute($_POST);
	print_r($izraz);
	echo "OK";
