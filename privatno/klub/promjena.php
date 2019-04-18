<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	$greska=array();
	
	if(isset($_POST["sifra"])){
		
		include_once 'kontrole.php';

	if(count($greska)==0){
		$izraz=$veza->prepare("update klub set naziv_kluba=:naziv_kluba, mjesto=:mjesto, 
		naziv_stadiona=:naziv_stadiona, boja_dresa_domaca=:boja_dresa_domaca, boja_dresa_gost=:boja_dresa_gost where sifra=:sifra;");
		$izraz->execute($_POST);
		header("location: klub.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("select * from klub where sifra=:sifra");
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
		<a href="klub.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
		<h4 style="text-align: center;">Promjena detalja o klubu</h4>

			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		  
		  
		  <div class="form-row">
		  	
		    <div class="form-group col-md-4">
		     	<?php if(!isset($greska["naziv_kluba"])): ?>
						  <label>Naziv
						    <input class="form-control" type="text" id="naziv_kluba" name="naziv_kluba" placeholder="FERIT"
						    value="<?php echo isset($_POST["naziv_kluba"]) ? $_POST["naziv_kluba"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Naziv
						    <input type="text"  id="naziv_kluba" name="naziv_kluba" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["naziv"]) ? $_POST["naziv"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["naziv"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		    <div class="form-group col-md-4">
		     	<?php if(!isset($greska["mjesto"])): ?>
						  <label>Mjesto
						    <input class="form-control"  type="text" id="mjesto" name="mjesto" placeholder="Jaruge"
						    value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Mjesto
						    <input type="text"  id="mjesto" name="mjesto" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["naziv_stadiona"])): ?>
						  <label>Stadion
						    <input class="form-control"  type="text" id="naziv_stadiona" name="naziv_stadiona" placeholder="091 999 9999"
						    value="<?php echo isset($_POST["naziv_stadiona"]) ? $_POST["naziv_stadiona"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Stadion
						    <input type="text"  id="naziv_stadiona" name="naziv_stadiona" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["naziv_stadiona"]) ? $_POST["naziv_stadiona"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["naziv_stadiona"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		       <div class="form-group col-md-4">
		     	<?php if(!isset($greska["boja_dresa_domaca"])): ?>
						  <label>Boja dresa domaći
						    <input class="form-control"  type="text" id="boja_dresa_domaca" name="boja_dresa_domaca" placeholder="Hrvatska"
						    value="<?php echo isset($_POST["boja_dresa_domaca"]) ? $_POST["boja_dresa_domaca"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
                               Boja dresa domaći
						    <input type="text"  id="boja_dresa_domaca" name="boja_dresa_domaca" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["boja_dresa_domaca"]) ? $_POST["boja_dresa_domaca"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["boja_dresa_domaca"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["boja_dresa_gost"])): ?>
						  <label>Boja dresa Gost
						    <input class="form-control"  type="text" id="boja_dresa_gost" name="boja_dresa_gost" placeholder="Zagreb"
						    value="<?php echo isset($_POST["boja_dresa_gost"]) ? $_POST["boja_dresa_gost"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Boja dresa gost
						    <input type="text"  id="boja_dresa_gost" name="boja_dresa_gost" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["boja_dresa_gost"]) ? $_POST["boja_dresa_gost"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["boja_dresa_gost"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     </div>  
		     <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Dodaj Fakultet"></input></p>
		</form>			
	</div>
	
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>
	<script>
		
		<?php if(isset($greska["naziv_kluba"])):?>
    		setTimeout(function(){ $("#naziv_kluba").focus(); },1000);
    <?php elseif(isset($greska["mjesto"])):?>
	    		setTimeout(function(){ $("#mjesto").focus(); },1000);
	<?php elseif(isset($greska["naziv_stadiona"])):?>
	    		setTimeout(function(){ $("#naziv_stadiona").focus(); },1000);
	<?php elseif(isset($greska["boja_dresa_domaci"])):?>
	    		setTimeout(function(){ $("#boja_dresa_domaci").focus(); },1000);
	<?php elseif(isset($greska["boja_dresa_gost"])):?>
	    		setTimeout(function(){ $("#boja_dresa_gost").focus(); },1000);

	<?php endif; ?>
		
	</script>
	</body>

</html>

