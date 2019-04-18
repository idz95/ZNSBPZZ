<?php include_once 'konfiguracija.php'; ?>
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
		<?php include_once "template/indexslider.php"; ?>
		

		<div id="fh5co-counter" class="fh5co-counters">
			
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="1893" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Studenata FERIT-a</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="1159" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Sportaša</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="876" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Nogometaša</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="432" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Na FERIT turniru</span>
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

