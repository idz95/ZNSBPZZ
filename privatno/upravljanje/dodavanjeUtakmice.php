<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

$greska=array();

if($_POST){
	include_once 'kontrole.php';
	
	
	if(count($greska)==0){
		unset($_POST["sifra"]);
		$izraz=$veza->prepare("insert into utakmica (mjesto, pocetak, kolo, sudac, delegat, domacin, gost, liga) 
							values (:mjesto, :pocetak, :kolo, :sudac, :delegat, :domacin, :gost, :liga);");
		$izraz->execute($_POST);
		
		header("location: nadolazeceUtakmice.php");
	}

}


?>


<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "../../template/head.php"; ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "../../template/izbornik.php"; ?>
	<div class="container-wrap">

	<div id="fh5co-work">
	<a href="../nadzornaPloca.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i>  Nadzorna ploča</a>
	<h4 style="text-align: center;">Dodavanje utakmice!</h4>		
	<form action="" method="post">
  <div class="form-row">
    
    <div class="form-group col-md-4">
      <label>Odaberi Ligu</label>
      <select id="liga" name="liga" class="form-control">
    			 <?php 
							
						$izraz = $veza->prepare("select * from liga order by razina");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->razina . " " . $red->smjer . " " . $red->kategorija; ?></option>
        <?php $liga=$_POST["liga"];  ?>
			<?php endforeach; ?>
      </select>
      
    </div>

      <div class="form-group col-md-4">
          <?php if(!isset($greska["kolo"])): ?>
              <label>Kolo lige
                  <input type="number" id="kolo" name="kolo" class="form-control" placeholder="Kolo"
                         value="<?php echo isset($_POST["kolo"]) ? $_POST["kolo"] : ""; ?>">
              </label>
          <?php else: ?>
              <label class="is-invalid-label">Kolo lige
                  <input type="number"  id="kolo" name="kolo" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                         value="<?php echo isset($_POST["kolo"]) ? $_POST["kolo"] : ""; ?>" >
                  <span class="form-error is-visible" id="uuid"><?php echo $greska["kolo"]; ?></span>
              </label>
          <?php endif; ?>
      </div>

    <div class="form-group col-md-4">
     	<?php if(!isset($greska["domacin"])): ?>
     	<label>Odaberi Ekipa 1
      		<select id="domacin" name="domacin" class="form-control">
        <?php 
							
						$izraz = $veza->prepare("select * from klub order by naziv_kluba");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv_kluba . " " . $red->mjesto; ?></option>
        <?php  $domacin=$_POST["domacin"];  ?>
         <?php endforeach; ?>
     		 </select>
     	</label>
      	 <?php else: ?>
      	  <label class="is-invalid-label">Odaberi Ekipa 1
      	  	<select id="domacin" name="domacin" class="form-control"  aria-invalid aria-describedby="uuid">
        		<?php 
							
						$izraz = $veza->prepare("select * from klub order by naziv_kluba");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
			        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv_kluba . " " . $red->mjesto; ?></option>
			        <?php  $domacin=$_POST["domacin"];  ?>
			         <?php endforeach; ?>
     		 </select>
      	 <span class="form-error is-visible" id="uuid"><?php echo $greska["domacin"]; ?></span>
      	  </label>
		<?php endif; ?>
      
     </div>
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["gost"])): ?>
     	<label>Odaberi Ekipa 2
      		<select id="gost" name="gost" class="form-control">
        <?php 
							
						$izraz = $veza->prepare("select * from klub order by naziv_kluba");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv_kluba . " " . $red->mjesto; ?></option>
        <?php  $gost=$_POST["gost"];  ?>
         <?php endforeach; ?>
     		 </select>
     	</label>
      	 <?php else: ?>
      	  <label class="is-invalid-label">Odaberi Ekipa 2
      	  	<select id="gost" name="gost" class="form-control"  aria-invalid aria-describedby="uuid">
        		<?php 
							
						$izraz = $veza->prepare("select * from klub order by naziv_kluba");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
			        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv_kluba . " " . $red->naziv_kluba; ?></option>
			        <?php  $gost=$_POST["gost"];  ?>
			         <?php endforeach; ?>
     		 </select>
      	 <span class="form-error is-visible" id="uuid"><?php echo $greska["gost"]; ?></span>
      	  </label>
		<?php endif; ?>
      
     </div>
 
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["pocetak"])): ?>
     	<label id="pocetak" name="pocetak">Datum i vrijeme
        <input type="datetime-local" id="pocetak" name="pocetak" class="form-control" placeholder=""
        value="<?php echo isset($_POST["pocetak"]) ? $_POST["pocetak"] : ""; ?>">
        </label>
        <?php else: ?>
        <label class="is-invalid-label">Datum i vrijeme
      	 <input type="datetime-local" id="pocetak" name="pocetak" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
        value="<?php echo isset($_POST["pocetak"]) ? $_POST["pocetak"] : ""; ?>">
        <span class="form-error is-visible" id="uuid"><?php echo $greska["pocetak"]; ?></span>
        </label>
		<?php endif; ?>
 
     </div>
     
    
    
    <div class="form-group col-md-4">
    	<label>Odaberi Sudac</label>
      <select id="sudac" name="sudac" class="form-control">
        
           <?php 
							
						$izraz = $veza->prepare("select * from sudac order by prezime, ime");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->ime . " " . $red->prezime . " - " . $red->liga; ?></option>
        <?php  $sudac=$_POST["sudac"];  ?>
         <?php endforeach; ?>
      </select>
    </div>
      <div class="form-group col-md-4">
          <label>Odaberi Delegata</label>
          <select id="delegat" name="delegat" class="form-control">

              <?php

              $izraz = $veza->prepare("select * from delegat order by prezime, ime");
              $izraz->execute();
              $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
              foreach ($rezultati as $red):
                  ?>
                  <option value="<?php echo $red->sifra; ?>"><?php echo $red->ime . " " . $red->prezime . " - " . $red->liga; ?></option>
                  <?php  $delegat=$_POST["delegat"];  ?>
              <?php endforeach; ?>
          </select>
      </div>
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["mjesto"])): ?>
     	<label>Lokacija
        <input type="text" id="mjesto" name="mjesto" class="form-control" placeholder="Mjesto održavanja"
        value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
        </label>
        <?php else: ?>
		<label class="is-invalid-label">Lokacija
			<input type="text" id="mjesto" name="mjesto" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
        	value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
        	<span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto"]; ?></span>
		</label>
		<?php endif; ?>
     </div>
     
     </div>

  		<button type="submit" class="btn btn-primary">Dodaj utakmicu</button>
  		
	</form>
	
	</div>
	
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/hr.js"></script>
    <script>
    	$("#datumpocetka").flatpickr({
    		locale: "hr",
    		minDate: "today",
    		enableTime:true
 
    	});
    </script>
	</body>

</html>

