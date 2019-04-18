<?php
include_once '../../konfiguracija.php'; 

	
	$izraz = $veza->prepare("
			select a.*, b.ime, b.prezime, c.naziv as domacin, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
                        where a.sifra=:utakmica;

	");
	$izraz->execute($_POST);
	$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
	
	
	
	echo json_encode($rezultati);
	