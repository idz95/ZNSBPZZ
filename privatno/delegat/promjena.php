<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	$greska=array();
	
	if(isset($_POST["sifra"])){
		
		include_once 'kontrole.php';

	if(count($greska)==0){
		$izraz=$veza->prepare("update delegat set ime=:ime, prezime=:prezime, 
		email=:email,lozinka=md5(:lozinka), datum_rodjenja=:datum_rodjenja, mjesto=:mjesto, mobitel=:mobitel, liga=:liga where sifra=:sifra;");
		$izraz->execute($_POST);
		header("location: delegati.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("select * from delegat where sifra=:sifra");
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
		<a href="delegati.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
		<h4 style="text-align: center;">Promjena detalja!</h4>

			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		  
		  
		  <div class="form-row">
		  	
		    <div class="form-group col-md-4">
		     	<?php if(!isset($greska["ime"])): ?>
						  <label>Ime
						    <input class="form-control" type="text" id="ime" name="ime" placeholder="Ivan"
						    value="<?php echo isset($_POST["ime"]) ? $_POST["ime"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Ime
						    <input type="text"  id="ime" name="ime" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["ime"]) ? $_POST["ime"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["ime"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		    <div class="form-group col-md-4">
		     	<?php if(!isset($greska["prezime"])): ?>
						  <label>Prezime
						    <input class="form-control"  type="text" id="prezime" name="prezime" placeholder="Horvat"
						    value="<?php echo isset($_POST["prezime"]) ? $_POST["prezime"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Prezime
						    <input type="text"  id="prezime" name="prezime" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["prezime"]) ? $_POST["prezime"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["prezime"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["email"])): ?>
						  <label>Email adresa
						    <input class="form-control"  type="text" id="email" name="email" placeholder="primjer@hns.hr"
						    value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Email adresa
						    <input type="text"  id="email" name="email" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["email"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		    
		     
		      <div class="form-group col-md-4">
		     	<?php if(!isset($greska["email"])): ?>
						  <label>Lozinka
						    <input class="form-control"  type="text" id="lozinka" name="lozinka" placeholder="Lozinka"
						    value="<?php echo isset($_POST["lozinka"]) ? $_POST["lozinka"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Lozinka
						    <input type="text"  id="lozinka" name="lozinka" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["lozinka"]) ? $_POST["lozinka"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["lozinka"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		      <div class="form-group col-md-4">
		     	<?php if(!isset($greska["mobitel"])): ?>
						  <label>Kontakt telefon
						    <input class="form-control"  type="text" id="mobitel" name="mobitel" placeholder="091 999 9999"
						    value="<?php echo isset($_POST["mobitel"]) ? $_POST["mobitel"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Kontakt telefon
						    <input type="text"  id="mobitel" name="mobitel" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["mobitel"]) ? $_POST["mobitel"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["mobitel"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     <label for="liga">Liga
				  <select class="form-control" name="liga" id="liga">

								  <option value="1.ŽNL">1.ŽNL</option>
								   <option value="2.ŽNL">2.ŽNL</option>
                                    <option value="3.ŽNL">3.ŽNL</option>

                  </select>
				  </label>
		      </div>

              <div class="form-group col-md-4">
                  <?php if(!isset($greska["mjesto"])): ?>
                      <label>Mjesto
                          <input class="form-control"  type="text" id="mjesto" name="mjesto" placeholder="Općina"
                                 value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
                      </label>
                  <?php else: ?>
                      <label class="is-invalid-label">
                          Kontakt telefon
                          <input type="text"  id="mjesto" name="mjesto" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                 value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>" >
                          <span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto"]; ?></span>
                      </label>
                  <?php endif; ?>
              </div>

              <div class="form-group col-md-4">
                  <?php if(!isset($greska["datum_rodjenja"])): ?>
                      <label>Datum rođenja
                          <input class="form-control"  type="date" id="datum_rodjenja" name="datum_rodjenja"
                                 value="<?php echo isset($_POST["datum_rodjenja"]) ? $_POST["datum_rodjenja"] : ""; ?>">
                      </label>
                  <?php else: ?>
                      <label class="is-invalid-label">
                          Datum Rođenja
                          <input type="date"  id="datum_rodjenja" name="datum_rodjenja" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                 value="<?php echo isset($_POST["datum_rodjenja"]) ? $_POST["datum_rodjenja"] : ""; ?>" >
                          <span class="form-error is-visible" id="uuid"><?php echo $greska["datum_rodjenja"]; ?></span>
                      </label>
                  <?php endif; ?>
              </div>
		    
		     

		     <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Promijeni podatke za suca"></input></p>
		</form>			
	</div>
	
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>
	<script>
    <?php if(isset($greska["ime"])):?>	
    		setTimeout(function(){ $("#ime").focus(); },1000);	
    <?php elseif(isset($greska["prezime"])):?>	
	    		setTimeout(function(){ $("#prezime").focus(); },1000);	
	<?php elseif(isset($greska["email"])):?>	
	    		setTimeout(function(){ $("#email").focus(); },1000);	
	<?php elseif(isset($greska["lozinka"])):?>	
	    		setTimeout(function(){ $("#lozinka").focus(); },1000);	
	<?php elseif(isset($greska["mobitel"])):?>	
	    		setTimeout(function(){ $("#mobitel").focus(); },1000);	

	<?php endif; ?>
    </script>
	</body>

</html>

