<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	
	if(isset($_POST["sifra"])){

		$izraz=$veza->prepare("update sudac set ime=:ime, prezime=:prezime, 
		email=:email, lozinka=md5(:lozinka), mobitel=:mobitel where sifra=:sifra;");
		$izraz->execute($_POST);
		
		}else{
		header("location: " . $putanjaAPP . "logout.php");
		}

} else{
	
	$izraz=$veza->prepare("select * from sudac where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST=$izraz->fetch(PDO::FETCH_ASSOC);
	
}

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
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<div class="panel panel-info" style="margin-bottom: 5px;">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Ime</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<input class="form-control" type="text" id="ime" name="ime" placeholder="Ivan" 
								value="<?php echo isset($_SESSION[$appID."autoriziran"]->ime) ? $_SESSION[$appID."autoriziran"]->ime : ""; ?>" 
								style="text-align: center; font-size: 55px;">
							</div>
						</div>
					</div>
					<div class="panel panel-info" style="margin-bottom: 5px;">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Prezime</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<input class="form-control" type="text" id="prezime" name="prezime" placeholder="Horvat" 
								value="<?php echo isset($_SESSION[$appID."autoriziran"]->prezime) ? $_SESSION[$appID."autoriziran"]->prezime : ""; ?>" 
								style="text-align: center; font-size: 55px;">
							</div>
						</div>
					</div>
					<div class="panel panel-info" style="margin-bottom: 5px;">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">E-mail</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<input class="form-control" type="email" id="email" name="email" placeholder="sudac@hns.hr" 
								value="<?php echo isset($_SESSION[$appID."autoriziran"]->email) ? $_SESSION[$appID."autoriziran"]->email : ""; ?>" 
								style="text-align: center; font-size: 55px;">
							</div>
						</div>
					</div>
					
					<div class="panel panel-info" style="margin-bottom: 5px;">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Lozinka</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<input class="form-control" type="text" id="lozinka" name="lozinka" placeholder="Lozinka" 
								value="<?php echo isset($_SESSION[$appID."autoriziran"]->lozinka) ? $_SESSION[$appID."autoriziran"]->lozinka : ""; ?>" 
								style="text-align: center; font-size: 55px;">
							</div>
						</div>
					</div>
					
					<div class="panel panel-info" style="margin-bottom: 5px;">
						<div class="panel-heading" style="padding: 5px;">
							<h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">Kontakt telefon</label></h3>
						</div>
						<div class="panel-body" style="padding: 5px;">
							<div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
								<input class="form-control" type="text" id="mobitel" name="mobitel" placeholder="095 888 8888" 
								value="<?php echo isset($_SESSION[$appID."autoriziran"]->mobitel) ? $_SESSION[$appID."autoriziran"]->mobitel : ""; ?>" 
								style="text-align: center; font-size: 55px;">
							</div>
						</div>
					</div>
					
					
					
					<input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
		      		<p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Spremi"></input></p>
					</form>	
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

