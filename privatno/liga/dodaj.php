<?php
/**
 * Created by PhpStorm.
 * User: Džambo
 * Date: 18.4.2019.
 * Time: 19:26
 */

include_once '../../konfiguracija.php';
provjeraOvlasti();

$greska=array();

if($_POST){
	include_once 'kontrole.php';


	if(count($greska)==0){
		unset($_POST["sifra"]);
		$izraz=$veza->prepare("insert into liga (razina, smjer, kategorija) 
							values (:razina, :smjer, :kategorija);");
		$izraz->execute($_POST);
		header("location: lige.php");
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
		<a href="suci.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
		<h4 style="text-align: center;">Dodavanje Lige</h4>

			<form action="" method="post">


		  <div class="form-row">

              <div class="form-group col-md-4">
                  <label for="razina">Razina
                      <select class="form-control" name="razina" id="razina">

                          <option value="1">1.</option>
                          <option value="2">2.</option>
                          <option value="3">3.</option>

                      </select>
                  </label>
              </div>


		    <div class="form-group col-md-4">
                  <label for="smjer">Smjer
                      <select class="form-control" name="smjer" id="smjer">

                          <option value="Istok">Istok</option>
                          <option value="Centar">Centar</option>
                          <option value="Zapad">Zapad</option>

                      </select>
                  </label>
              </div>

              <div class="form-group col-md-4">
                  <label for="kategorija">Kategorija
                      <select class="form-control" name="kategorija" id="kategorija">

                          <option value="Seniori">Seniori</option>
                          <option value="Juniori">Juniori</option>
                          <option value="Pioniri">Pioniri</option>
                          <option value="Limači">Limači</option>

                      </select>
                  </label>
              </div>



		     </div>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Dodaj Ligu"></input></p>
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
	<?php elseif(isset($greska["mobitel"])):?>
	    		setTimeout(function(){ $("#mobitel").focus(); },1000);
	<?php elseif(isset($greska["email"])):?>
	    		setTimeout(function(){ $("#email").focus(); },1000);
	<?php elseif(isset($greska["lozinka"])):?>
	    		setTimeout(function(){ $("#lozinka").focus(); },1000);

        <?php elseif(isset($greska["datum_rodjenja"])):?>
        setTimeout(function(){ $("#datum_rodjenja").focus(); },1000);

        <?php elseif(isset($greska["mjesto"])):?>
        setTimeout(function(){ $("#mjesto").focus(); },1000);

        <?php endif; ?>

	</script>
	</body>

</html>

