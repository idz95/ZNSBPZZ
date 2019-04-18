<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

$greska=array();

if($_POST){
	include_once 'kontrole.php';
	
	
	if(count($greska)==0){
		unset($_POST["sifra"]);
		$izraz=$veza->prepare("insert into utakmica (mjesto, pocetak, sport, sudac, domacin, gost, trajanje, faza, grupa) 
							values (:mjesto, :datumpocetka, :sport, :sudac, :domacin, :gost, :trajanje, :faza, :grupa);");
		$izraz->execute($_POST);
		
		header("location: ../nadzornaPloca.php");
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
      <label>Odaberi Sport</label>
      <select id="sport" name="sport" class="form-control">
    			 <?php 
							
						$izraz = $veza->prepare("select sifra, naziv from sport order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
        <?php $sport=$_POST["sport"];  ?>
			<?php endforeach; ?>
      </select>
      
    </div>
    <div class="form-group col-md-4">
     	<?php if(!isset($greska["domacin"])): ?>
     	<label>Odaberi Ekipa 1
      		<select id="domacin" name="domacin" class="form-control">
        <?php 
							
						$izraz = $veza->prepare("select * from fakultet order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
        <?php  $domacin=$_POST["domacin"];  ?>
         <?php endforeach; ?>
     		 </select>
     	</label>
      	 <?php else: ?>
      	  <label class="is-invalid-label">Odaberi Ekipa 1
      	  	<select id="domacin" name="domacin" class="form-control"  aria-invalid aria-describedby="uuid">
        		<?php 
							
						$izraz = $veza->prepare("select * from fakultet order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
			        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
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
							
						$izraz = $veza->prepare("select * from fakultet order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
        <?php  $domacin=$_POST["gost"];  ?>
         <?php endforeach; ?>
     		 </select>
     	</label>
      	 <?php else: ?>
      	  <label class="is-invalid-label">Odaberi Ekipa 2
      	  	<select id="gost" name="gost" class="form-control"  aria-invalid aria-describedby="uuid">
        		<?php 
							
						$izraz = $veza->prepare("select * from fakultet order by naziv");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
			        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
			        <?php  $domacin=$_POST["gost"];  ?>
			         <?php endforeach; ?>
     		 </select>
      	 <span class="form-error is-visible" id="uuid"><?php echo $greska["gost"]; ?></span>
      	  </label>
		<?php endif; ?>
      
     </div>
     
      <div class="form-group col-md-4">
      <label>Odaberi fazu natjecanja</label>
      <select id="faza" name="faza" class="form-control">
    			 
        <option value="1">Grupna faza natjecanje</option>
        <option value="2">Četvrtfinale</option>
         <option value="3">Polufinale</option>
          <option value="4">Finale</option>
      </select>
      
    </div>
    
     <div class="form-group col-md-4">
      <label>Odaberi grupu</label>
      <select id="grupa" name="grupa" class="form-control">
    			 
        <option value="A">A grupa</option>
         <option value="B">B grupa</option>
          <option value="C">C grupa</option>
          <option value="D">D grupa</option>
      </select>
      
    </div>
 
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["trajanje"])): ?>
     	<label id="" name="datumpocetka">Datum i vrijeme
        <input type="date" id="datumpocetka" name="datumpocetka" class="form-control" placeholder=""
        value="<?php echo isset($_POST["datumpocetka"]) ? $_POST["datumpocetka"] : ""; ?>">
        </label>
        <?php else: ?>
        <label class="is-invalid-label">Datum i vrijeme
      	 <input type="date" id="datumpocetka" name="datumpocetka" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
        value="<?php echo isset($_POST["datumpocetka"]) ? $_POST["datumpocetka"] : ""; ?>">
        <span class="form-error is-visible" id="uuid"><?php echo $greska["datumpocetka"]; ?></span>
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
        <option value="<?php echo $red->sifra; ?>"><?php echo $red->ime . " " . $red->prezime . " - " . $red->sport; ?></option>
        <?php  $sudac=$_POST["sudac"];  ?>
         <?php endforeach; ?>
      </select>
    </div>
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["trajanje"])): ?>
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
     
     <div class="form-group col-md-4">
     	<?php if(!isset($greska["trajanje"])): ?>
     	<label>Trajanje utakmice (u minutama)
        <input type="number" id="trajanje" name="trajanje" class="form-control" placeholder="30"
        value="<?php echo isset($_POST["trajanje"]) ? $_POST["trajanje"] : ""; ?>">
        </label>
		<?php else: ?>
		<label class="is-invalid-label">Trajanje utakmice (u minutama)
			<input type="number"  id="trajanje" name="trajanje" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
			value="<?php echo isset($_POST["trajanje"]) ? $_POST["trajanje"] : ""; ?>" >
			<span class="form-error is-visible" id="uuid"><?php echo $greska["trajanje"]; ?></span>
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

