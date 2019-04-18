<?php include_once '../../konfiguracija.php';
provjeraOvlasti();

$greska=array();

if($_POST){
	include_once 'kontrole.php';


	if(count($greska)==0){
		unset($_POST["sifra"]);
		$izraz=$veza->prepare("insert into igrac (ime, prezime, kontakt, godina, status, fakultet, brojgolova) 
							values (:ime, :prezime, :kontakt, :godina, :status, :fakultet, :brojgolova);");
		$izraz->execute($_POST);
		header("location: igrac.php");
	}
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
		<h4 style="text-align: center;">Dodavanje igrača!</h4>

			<form action="" method="post">


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
		     	<?php if(!isset($greska["kontakt"])): ?>
						  <label>Kontakt
						    <input class="form-control"  type="text" id="kontakt" name="kontakt" placeholder="Tel broj"
						    value="<?php echo isset($_POST["kontakt"]) ? $_POST["kontakt"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						   Kontakt
						    <input type="text"  id="kontakt" name="kontakt" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["kontakt"]) ? $_POST["kontakt"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["kontakt"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>



		      <div class="form-group col-md-4">
		     	<?php if(!isset($greska["godina"])): ?>
						  <label>Godina
						    <input class="form-control"  type="number" id="godina" name="godina" placeholder="Lozinka"
						    value="<?php echo isset($_POST["lozinka"]) ? $_POST["lozinka"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Godina
						    <input type="number"  id="godina" name="godina" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["godina"]) ? $_POST["godina"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["godina"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>

		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["brojgolova"])): ?>
						  <label>Trenutni broj golova
						    <input class="form-control"  type="number" id="brojgolova" name="brojgolova" placeholder=""
						    value="<?php echo isset($_POST["brojgolova"]) ? $_POST["brojgolova"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Trenutni broj golova
						    <input type="number"  id="brojgolova" name="brojgolova" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["brojgolova"]) ? $_POST["brojgolova"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["brojgolova"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>

		    <div class="form-group col-md-4">
		     <label for="sport">Status veze
				  <select class="form-control" name="status" id="status">

								  <option value="Slobodan">Slobodan</option>
								  <option value="Komplicirano je">Komplicirano je</option>
								  <option value="Zauzet">Zauzet</option>
								  <option value="Ne želi reći">Ne želi reći</option>

				  </select>
				  </label>
		      </div>

		     <div class="form-group col-md-4">
		     <label for="sport">Ekipa
				  <select class="form-control" name="fakultet" id="fakultet">
						  	<?php
									$izraz = $veza->prepare("select * from fakultet order by naziv");
									$izraz->execute();
									$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $red):
									?>
								  <option
								  <?php
								  if(isset($_POST["fakultet"]) && $_POST["fakultet"]==$red->sifra){
								  	echo "selected=\"selected\"";
								  }
								  ?>
								   value="<?php echo $red->sifra ?>"><?php echo $red->naziv ?></option>
						<?php endforeach;?>
				  </select>
				  </label>
		      </div>
		     </div>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Dodaj igrača"></input></p>
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
	<?php elseif(isset($greska["kontakt"])):?>
	    		setTimeout(function(){ $("#kontakt").focus(); },1000);
	<?php elseif(isset($greska["godina"])):?>
	    		setTimeout(function(){ $("#godina").focus(); },1000);


	<?php endif; ?>

	</script>
	</body>

</html>

