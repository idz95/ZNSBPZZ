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
			<div class="row">
				<div class="col-md-3 text-center animate-box">
					
					<?php 
							
						$izraz = $veza->prepare("select * from fakultet order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
						
					<a href="sportovi/<?php echo $red->naziv; ?>.php" class="work" style="background-image: url(images/nogomet.jpg);">
						<div class="desc">
							<h3><?php echo $red->naziv; ?></h3>
							<span>Klikni za igrače</span>
						</div>
					</a>
					 <?php endforeach; ?>
				</div>
			</div>
		</div>
	
	</div><!-

	<?php include_once "template/podnozje.php"; ?>
	
	</div><!-
	
	<?php include_once "template/skripte.php"; ?>

	</body>
</html>

