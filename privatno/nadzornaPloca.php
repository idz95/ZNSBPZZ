<?php include_once '../konfiguracija.php'; 
provjeraOvlasti();
?>


<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "../template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "../template/izbornik.php"; ?>
	<div class="container-wrap">

	<div id="fh5co-work">
			<div class="row animate-box" >
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2 style="font-size: 20px;">Nadzorna ploča administratora</h2>
					
				</div>
			</div>
			<div class="row">
						<div class="col-md-4 text-center animate-box">
							
								<a href="#" class="list-group-item active">Dodavanje komponenti! </a>
								<a href="upravljanje/dodavanjeUtakmice.php" class="list-group-item">Sportska utakmica</a>
								<a href="klub/dodaj.php" class="list-group-item">Ekipa</a>
								<a href="sudac/dodaj.php" class="list-group-item">Sudac</a>
								<a href="igrac/dodaj.php" class="list-group-item">Igrač</a>
								

							
							
							

						</div>
						<div class="col-md-4 text-center animate-box">
						
							<a href="#" class="list-group-item active">UPRAVLJANJE! </a>
							
							<a href="sudac/suci.php" class="list-group-item">Suci</a>
							<a href="klub/klub.php" class="list-group-item">Klubovi</a>
							<a href="igrac/igrac.php" class="list-group-item">Igrači</a>
                            <a href="delegat/delegati.php" class="list-group-item">Delegati</a>
							<a href="liga/lige.php" class="list-group-item">Lige</a>
							<a href="upravljanje/nadolazeceUtakmice.php" class="list-group-item">Nadolazeće utakmice</a>

						
						</div>
						
						<div class="col-md-4 text-center animate-box">
							<a href="upravljanje/eraDijagram.php" class="list-group-item">ERA dijagram</a>
						</div>
							

					</div>
			
				
				
			</div>
		</div>

		
			

		
		
<?php include_once "../template/podnozje.php"; ?>
		
	</div><!-- END container-wrap -->

	
	</div>

	<?php include_once "../template/skripte.php"; ?>

	</body>
</html>

