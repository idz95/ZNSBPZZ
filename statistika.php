<?php include_once 'konfiguracija.php'; 

$izraz = $veza->prepare("select * from igrac where sifra = :sifra;");
$izraz->execute($_GET);
$rezultati=$izraz->fetch(PDO::FETCH_OBJ);	
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
			<a href="profilEkipe.php?sifra=<?php echo $rezultati->fakultet; ?>" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i> Povratak na ekipu</a>
		</div>
	<div id="fh5co-work">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading" style="margin-bottom: 1em;">
					<h2 style="font-size: 20px;">PROFIL IGRAČA <?php echo $rezultati->ime . " " . $rezultati->prezime;  ?></h2>
					
				</div>
			</div>			 
			<div class="row">
				
				<div class="col-md-4 text-center animate-box">
						<?php
						if(file_exists("images/igraci/" . $rezultati->sifra . ".jpg")):
						?>
						<img style="max-width: 300px; max-height: 400px;" src="/images/igraci/<?php echo $rezultati->sifra;  ?>.jpg" />
						<?php else: ?>
						<img style="max-width: 300px; max-height: 400px;" src="/images/rukomet.png.png" />
						<?php	endif; ?>
						
					
				</div>
				<div class="col-md-8 text-center animate-box">
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Ime i prezime</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $rezultati->ime . " " . $rezultati->prezime;  ?>
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Godina</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $rezultati->godina . ". FERIT-a";  ?>
							</div>
						</div>
					</div>
					
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Status veze</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $rezultati->status;  ?>
							</div>
						</div>
					</div>
					
					
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							
							
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Postigao golova na turniru</label></h3>
						</div>
						
						
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php echo $rezultati->brojgolova;  ?>
							</div>
						</div>
					</div>
					
					
					<div class="panel panel-info">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Odigrao utakmica</label></h3>
						</div>
						
						
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<?php 
						
								$izraz = $veza->prepare("
								select count(*) as brUtakmica from utakmica where domacin=2 or gost=2;
								");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach($rezultati as $red){
							 		echo $red->brUtakmica; 
							 } ?>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div><!-- END container-wrap -->

	<?php include_once "template/podnozje.php"; ?>
	</div>

	<?php include_once "template/skripte.php"; ?>

	</body>
</html>

