<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

$izraz = $veza->prepare("select * from sudac where sifra = :sifra;");
$izraz->execute(array(
	"sifra" => $_SESSION[$appID."autoriziran"]->sifra));
	$rezultati = $izraz->fetch(PDO::FETCH_OBJ);

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
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading" style="margin-bottom: 1em;">
					<h2 style="font-size: 20px;">MOJ PROFIL</h2>
					
				</div>
			</div>
			
					 
			<div class="row">
				
				<div class="col-md-4 text-center animate-box">
					
												<?php
												if(file_exists("../../images/sudac/" . $_SESSION[$appID."autoriziran"]->sifra . ".png")):
												?>
												<img style="max-width: 300px; max-height: 400px;" src="<?php echo $putanjaAPP; ?>images/suci/<?php echo $_SESSION[$appID."autoriziran"]->sifra ?>.png">
												<?php else: ?>
												<img style="max-width: 300px; max-height: 400px;" src="<?php echo $putanjaAPP ?>images/default.png" />
												<?php
												endif;
												?>
					
					<div class="list-group">
						<?php  if($_SESSION[$appID."autoriziran"]->uloga==="sudac"): ?>
						<a href="utakmice.php" class="list-group-item">Moje utakmice</a>
						<?php  endif; ?>
						<a href="postavkeRacuna.php?sifra=<?php echo $_SESSION[$appID."autoriziran"]->sifra ?>" class="list-group-item">Postavke računa</a>
						<a href="promijeniSliku.php?sifra=<?php echo $_SESSION[$appID."autoriziran"]->sifra ?>" class="list-group-item">Promijeni sliku</a>
								
							 
					</div>
					
				</div>
				
			  
				<div class="col-md-8 text-center animate-box">
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Ime i prezime</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $_SESSION[$appID."autoriziran"]->ime . " " . $_SESSION[$appID."autoriziran"]->prezime; ?>
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">E-mail</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $_SESSION[$appID."autoriziran"]->email; ?>
							</div>
						</div>
					</div>
					
					<?php  if($_SESSION[$appID."autoriziran"]->uloga==="sudac"): ?>
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Kontakt telefon</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $_SESSION[$appID."autoriziran"]->mobitel; ?>
							</div>
						</div>
					</div>
					
					
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Sport</label></h3>
						</div>
						
						
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $_SESSION[$appID."autoriziran"]->sport; ?>
							</div>
						</div>
					</div>
					<?php  endif; ?>
					
				</div>
				
				<div class="col-md-4 text-center animate-box">
					
				</div>
				
				
			</div>
		</div>

		
		

		
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>

	</body>
</html>

