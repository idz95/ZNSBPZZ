<?php include_once 'konfiguracija.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader">
	</div>
	
	<div id="page">
	<?php include_once "template/izbornik.php"; ?>
	<div class="container-wrap">
		
		<div id="fh5co-work">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2 style="font-size: 20px;">Sve ekipe FERIT turnira</h2>
					<p>Klikom na sliku otvarate detalje o ekipi, te popis svih igrača</p>
				</div>
			</div>
			<div class="row">
				<?php 
							
						$izraz = $veza->prepare("select * from klub order by naziv_kluba");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
				<div class="col-md-4 text-center animate-box">
					
					<a href="profilEkipe.php?sifra=<?php echo $red->sifra; ?>" class="work" style=" width: 315px; height: 270px; background-image: url(images/<?php echo $red->puni_naziv; ?>.png);">
						<div class="desc">
						</div>
					</a>
					
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		
			
	<!-- END container-wrap -->
	</div>

	<?php include_once "template/podnozje.php"; ?>
	</div>

	
	<?php include_once "template/skripte.php"; ?>

	</body>
</html>

