<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

?>


<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "../../template/head.php"; ?>
		<link rel="stylesheet" href="<?php echo $putanjaAPP;  ?>css/cropper/cropper.css">
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "../../template/izbornik.php"; ?>
	<div class="container-wrap">
		
		<div class="col-md-4 text-center animate-box">
			
			<?php 
								
								if(file_exists("../../images/sudac/" . $_SESSION[$appID."autoriziran"]->sifra . ".png")):
								
								?>
								<img id="staro" style="max-width: 300px; max-height: 400px;" src="<?php echo $putanjaAPP; ?>images/suci/<?php echo $_SESSION[$appID."autoriziran"]->sifra ?>.png">
								<?php else: ?>
								<img style="max-width: 300px; max-height: 400px;" src="<?php echo $putanjaAPP ?>images/default.png" />
									<?php  endif;
									?>
			
		</div>
		<div class="col-md-8 text-center animate-box">
			
					    
				<img id="image" src="<?php echo $putanjaAPP . "images/default.png"; ?>" alt="Picture">
					    
			
				
			<input style="float:center;" type="file" id="inputImage" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            
			<a class="success button" href="#" id="spremi">Spremi</a>
			
			<a class="success button" href="profil.php">Završi</a>
			
		</div>
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>
	<script src="<?php echo $putanjaAPP; ?>js/cropper/cropper.js"></script>
    <script src="<?php echo $putanjaAPP; ?>js/cropper/main.js"></script>
    <script>
    
    	$("#spremi").click(function(){
		  	var cropcanvas = $('#image').cropper('getCroppedCanvas');
			var croppng = cropcanvas.toDataURL("image/png");
			
		  	$.ajax({
			  type: "POST",
			  url: "spremiSliku.php",
			  data: {sifra: <?php echo $_GET["sifra"] ?>, slika: croppng},
			  success: function(status){
			  	if(status==="OK"){
			  		$("#staro").attr("src",croppng);
			  	}else{
			  		alert(status);
			  	}
			  }
			});
			
		  	return false;
		  });
		 

		  
    </script>

	</body>
</html>

