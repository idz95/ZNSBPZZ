<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	$greska=array();
	
	if(isset($_POST["sifra"])){
		
		include_once 'kontrole.php';

	if(count($greska)==0){
		$izraz=$veza->prepare("update igrac set ime=:ime, prezime=:prezime, 
		broj_registracije=:broj_registracije, oib=:oib, datum_rodjenja=:datum_rodjenja, mjesto_rodjenja=:mjesto_rodjenja, drzavljanstvo=:drzavljanstvo, klub=:klub where sifra=:sifra;");
		$izraz->execute($_POST);
		header("location: igrac.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("select * from igrac where sifra=:sifra");
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
		<a href="igrac.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
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
		     	<?php if(!isset($greska["oib"])): ?>
						  <label>OIB
						    <input class="form-control"  type="number" id="oib" name="oib" placeholder="OIB"
						    value="<?php echo isset($_POST["oib"]) ? $_POST["oib"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						   OIB
						    <input type="number"  id="oib" name="oib" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["oib"]) ? $_POST["oib"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["oib"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		    
		     
		      <div class="form-group col-md-4">
		     	<?php if(!isset($greska["broj_registracije"])): ?>
						  <label>Broj_registracije
						    <input class="form-control"  type="number" id="broj_registracije" name="broj_registracije" placeholder=""
						    value="<?php echo isset($_POST["broj_registracije"]) ? $_POST["broj_registracije"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Broj registracije
						    <input type="number"  id="broj_registracije" name="broj_registracije" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["broj_registracije"]) ? $_POST["broj_registracije"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["broj_registracije"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["drzavljanstvo"])): ?>
						  <label>Državljanstvo
						    <input class="form-control"  type="text" id="drzavljanstvo" name="drzavljanstvo" placeholder=""
						    value="<?php echo isset($_POST["drzavljanstvo"]) ? $_POST["drzavljanstvo"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Državljanstvo
						    <input type="text"  id="drzavljanstvo" name="drzavljanstvo" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["drzavljanstvo"]) ? $_POST["drzavljanstvo"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["drzavljanstvo"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
                 <?php if(!isset($greska["mjesto_rodjenja"])): ?>
                     <label>Mjesto rođenja
                         <input class="form-control"  type="text" id="mjesto_rodjenja" name="mjesto_rodjenja" placeholder=""
                                value="<?php echo isset($_POST["mjesto_rodjenja"]) ? $_POST["mjesto_rodjenja"] : ""; ?>">
                     </label>
                 <?php else: ?>
                     <label class="is-invalid-label">
                         Mjesto rođenja
                         <input type="text"  id="mjesto_rodjenja" name="mjesto_rodjenja" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                value="<?php echo isset($_POST["mjesto_rodjenja"]) ? $_POST["mjesto_rodjenja"] : ""; ?>" >
                         <span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto_rodjenja"]; ?></span>
                     </label>
                 <?php endif; ?>
		      </div>

              <div class="form-group col-md-4">
                  <?php if(!isset($greska["datum_rodjenja"])): ?>
                      <label>Datum rođenja
                          <input class="form-control"  type="date" id="datum_rodjenja" name="datum_rodjenja" placeholder=""
                                 value="<?php echo isset($_POST["datum_rodjenja"]) ? $_POST["datum_rodjenja"] : ""; ?>">
                      </label>
                  <?php else: ?>
                      <label class="is-invalid-label">
                          Datum rođenja
                          <input type="date"  id="datum_rodjenja" name="datum_rodjenja" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                 value="<?php echo isset($_POST["datum_rodjenja"]) ? $_POST["datum_rodjenja"] : ""; ?>" >
                          <span class="form-error is-visible" id="uuid"><?php echo $greska["datum_rodjenja"]; ?></span>
                      </label>
                  <?php endif; ?>
              </div>


              <div class="form-group col-md-4">
		     <label for="klub">Klub</label>
				  <select class="form-control" name="klub" id="klub">
						  	<?php 		
									$izraz = $veza->prepare("select * from klub order by naziv_kluba");
									$izraz->execute();
									$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $red):
									?>  	
								  <option
								  <?php 
								  if(isset($_POST["klub"]) && $_POST["klub"]==$red->sifra){
								  	echo "selected=\"selected\"";
								  }
								  ?>
								   value="<?php echo $red->sifra ?>"><?php echo $red->naziv_kluba . " " . $red->mjesto ?></option>
						<?php endforeach;?>
				  </select>
		      </div>   
		     </div>  
		     <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Promijeni igrača"></input></p>
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

