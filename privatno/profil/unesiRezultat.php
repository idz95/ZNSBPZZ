<?php
include_once '../../konfiguracija.php'; 

	
	$izraz = $veza->prepare("
			select a.*, b.ime, b.prezime, c.naziv_kluba as domacin, d.naziv_kluba as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join klub c on a.domacin=c.sifra
                        inner join klub d on a.gost=d.sifra
                        where a.sifra=:utakmica;

	");
	$izraz->execute($_POST);
	$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
	
	
	
	echo json_encode($rezultati);
	