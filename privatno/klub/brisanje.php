<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	
		header("location: " . $putanjaAPP . "logout.php");
	
}else{
	
		$izraz=$veza->prepare("delete from klub where sifra=:sifra");
		$izraz->execute($_GET);
		header("location: klub.php");

}

