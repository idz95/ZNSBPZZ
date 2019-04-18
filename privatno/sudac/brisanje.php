<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	
		header("location: " . $putanjaAPP . "logout.php");
	
}else{
	
	$izraz=$veza->prepare("
	select a.sudac, b.ime, b.prezime
	from utakmica a inner join sudac b on a.sudac=b.sifra
	where a.sudac=:sifra;");
	$izraz->execute($_GET);
	
	$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
	
	if(count($rezultati)==0){
	
		$izraz=$veza->prepare("delete from sudac where sifra=:sifra");
		$izraz->execute($_GET);
		header("location: suci.php");
	}
}

$izraz=$veza->prepare("
	select a.*, b.naziv as domaci, c.naziv as gosti, d.naziv from utakmica a 
    inner join fakultet b on a.domacin=b.sifra
    inner join fakultet c on a.gost=c.sifra
    inner join sport d on a.sport=d.sifra
    where sudac=:sifra;
						");
	$izraz->execute($_GET);
	$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "../../template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "../../template/izbornik.php"; ?>
	<div class="container-wrap">
	
		<div id="fh5co-work">
			<a href="suci.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i> Nadzorna ploča</a>
			
			<h3 style="text-align: center;">Nemoguće obrisati suca jer sudi na utakmicama:</h3>				
			<ul>
					<?php 
					foreach ($rezultati as $red) {
						echo "<li><h4>" . $red->domaci . " : " . $red->gosti . "------" . $red->naziv . "</h4></li>";
					}
					?>
			</ul>
		
		</div>
			
		
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>

	</body>
</html>




