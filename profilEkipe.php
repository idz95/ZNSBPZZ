<?php include_once 'konfiguracija.php'; 

	$izraz=$veza->prepare("select * from klub where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST=$izraz->fetch(PDO::FETCH_ASSOC);
	
	$sifra=$_GET["sifra"];


?>


<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "template/izbornik.php"; ?>
	<div class="container-wrap">
	
		<div id="fh5co-work">
			<a href="lige.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i>  Sve ekipe</a>
		</div>

		<div id="fh5co-work">	
		<h3 style="text-align: center;"><?php echo $_POST["naziv_kluba"] . " " . $_POST["mjesto"]; ?></h3>
		<h6><b>Naziv stadiona: </b><?php echo $_POST["naziv_stadiona"]; ?></h6>
            <h6><b>Boja dresova domaća:: </b><?php echo $_POST["boja_dresa_domaca"]; ?></h6>
            <h6><b>Boja dresova gostujuća: </b><?php echo $_POST["boja_dresa_gost"]; ?></h6>
            <h4>Popis igrača:</h4>
		<table class="table">
						<thead>
							<tr>
								
								<?php  
								$izraz = $veza->prepare("
						
									select * from igrac where klub=$sifra;
									");
								
								
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								?>
								
								<th scope="col">Ime i prezime</th>
								<th scope="col">Broj registracije</th>
								<th scope="col">Datum rođenja</th>


							</tr>
						</thead>
						<tbody>
							
						<?php 
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->ime . " " . $red->prezime; ?></td>
								<td><?php echo $red->broj_registracije; ?></td>
								<td><?php echo date("d.m.Y.",strtotime($red->datum_rodjenja)); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			
		
		</div>
			
	</div><!-- END container-wrap -->

	<?php include_once "template/podnozje.php"; ?>
	</div>

	<?php include_once "template/skripte.php"; ?>

	</body>
</html>

*/