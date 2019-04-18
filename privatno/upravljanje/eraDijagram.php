<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
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
			<div class="row animate-box" >
				<img  src="<?php echo $putanjaAPP ?>images/era.png" alt="ERA" />
			</div>

		</div>
	</div>

		
			

		
		
<?php include_once "../../template/podnozje.php"; ?>
		
	</div><!-- END container-wrap -->

	
	</div>

	<?php include_once "../../template/skripte.php"; ?>

	</body>
</html>

