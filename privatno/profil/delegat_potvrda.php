<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	
		header("location: " . $putanjaAPP . "logout.php");
	
}else{
	
		$izraz=$veza->prepare("update utakmica set delegat_potvrdio=true where sifra=:sifra");
		$izraz->execute($_GET);
		header("location: utakmiceDelegat.php");
	
}

