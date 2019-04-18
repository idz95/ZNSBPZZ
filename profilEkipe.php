<?php include_once 'konfiguracija.php'; 

	$izraz=$veza->prepare("select * from fakultet where sifra=:sifra");
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
		<h3 style="text-align: center;">Popis igrača <?php echo $_POST["naziv"]; ?></h3>	
		
		<table class="table">
						<thead>
							<tr>
								
								<?php  
								$izraz = $veza->prepare("
						
									select * from igrac where fakultet=$sifra;
									");
								
								
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								?>
								
								<th scope="col">Ime i prezime</th>
								<th scope="col">Godina na FERIT-u</th>
								<th scope="col">Status veze</th>
								<th scope="col">Statistika igrača</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->ime . " " . $red->prezime; ?></td>
								<td><?php echo $red->godina; ?>. godina</td>
								<td><?php echo $red->status; ?></td>
							
								
								<td>
									<a href="statistika.php?sifra=<?php echo $red->sifra ?>"><i class="fas fa-info-circle fa-2x"></i></a>
								</td>

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