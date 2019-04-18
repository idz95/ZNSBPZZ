<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	$greska=array();
	
	if(isset($_POST["sifra"])){
		
		include_once 'kontrole.php';

	if(count($greska)==0){
		$izraz=$veza->prepare("update utakmica set domacin=:domacin, gost=:gost, 
		sport=:sport, sudac=:sudac,pocetak=:pocetak, mjesto=:mjesto, trajanje=:trajanje, 
		domacin_score=:domacin_score, gost_score=:gost_score, opis=:opis where sifra=:sifra;");
		$izraz->execute($_POST);
		header("location: promjenaUtakmice.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("select * from utakmica where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST=$izraz->fetch(PDO::FETCH_ASSOC);
	
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
		<a href="promjenaUtakmice.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
		<h4 style="text-align: center;">Promjena utakmice</h4>

			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		  
		  
		  <div class="form-row">
		  	
		   <div class="form-group col-md-4">
		      <label>Odaberi domaćina</label>
		      <select id="domacin" name="domacin" class="form-control">
		    			 <?php 
									
								$izraz = $veza->prepare("select sifra, naziv from fakultet order by naziv");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
								?>
		        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
		        <?php $domacin=$_POST["domacin"];  ?>
					<?php endforeach; ?>
     			 </select>
      
   			 </div>
   			 
   			 <div class="form-group col-md-4">
		      <label>Odaberi gosta</label>
		      <select id="gost" name="gost" class="form-control">
		    			 <?php 
									
								$izraz = $veza->prepare("select sifra, naziv from fakultet order by naziv");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
								?>
		        <option value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
		        <?php $gost=$_POST["gost"];  ?>
					<?php endforeach; ?>
     			 </select>
      
   			 </div>
   			 
   			 <div class="form-group col-md-4">
		      <label>Odaberi suca</label>
		      <select id="sudac" name="sudac" class="form-control">
		    			 <?php 
									
								$izraz = $veza->prepare("select sifra, ime, prezime, sport from sudac order by prezime, ime");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
								?>
		        <option value="<?php echo $red->sifra; ?>"><?php echo $red->ime . " " . $red->prezime . " - " . $red->sport; ?></option>
		        <?php $sudac=$_POST["sudac"];  ?>
					<?php endforeach; ?>
     			 </select>
      
   			 </div>
   			 
   			 <div class="form-group col-md-4">
		      <label>Odaberi sport</label>
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
		     	<?php if(!isset($greska["mjesto"])): ?>
						  <label>Lokacija
						    <input class="form-control"  type="text" id="mjesto" name="mjesto" placeholder="Horvat"
						    value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Lokacija
						    <input type="text"  id="mjesto" name="mjesto" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-4">
		     	<?php if(!isset($greska["pocetak"])): ?>
		     	<label id="" name="pocetak">Datum i vrijeme
		        <input type="date" id="pocetak" name="pocetak" class="form-control" placeholder=""
		        value="<?php echo isset($_POST["pocetak"]) ? $_POST["pocetak"] : ""; ?>">
		        </label>
		        <?php else: ?>
		        <label class="is-invalid-label">Datum i vrijeme
		      	 <input type="date" id="pocetak" name="pocetak" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
		        value="<?php echo isset($_POST["pocetak"]) ? $_POST["pocetak"] : ""; ?>">
		        <span class="form-error is-visible" id="uuid"><?php echo $greska["pocetak"]; ?></span>
		        </label>
				<?php endif; ?>
		 
		     </div>
		     
		       <div class="form-group col-md-4 fadeOutLeft">
		     	<?php if(!isset($greska["trajanje"])): ?>
						  <label>Trajanje
						    <input class="form-control"  type="number" id="trajanje" name="trajanje" placeholder="30"
						    value="<?php echo isset($_POST["trajanje"]) ? $_POST["trajanje"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Trajanje
						    <input type="number"  id="trajanje" name="trajanje" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["trajanje"]) ? $_POST["trajanje"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["trajanje"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-2">
		     	<?php if(!isset($greska["domacin_score"])): ?>
						  <label>Zgoditci domacina
						    <input class="form-control"  type="number" id="domacin_score" name="domacin_score" placeholder="Score"
						    value="<?php echo isset($_POST["domacin_score"]) ? $_POST["domacin_score"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Zgoditci domacina
						    <input type="number"  id="domacin_score" name="domacin_score" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["domacin_score"]) ? $_POST["domacin_score"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["domacin_score"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     <div class="form-group col-md-2">
		     	<?php if(!isset($greska["gost_score"])): ?>
						  <label>Zgoditci gosta
						    <input class="form-control"  type="number" id="gost_score" name="gost_score" placeholder="Score"
						    value="<?php echo isset($_POST["gost_score"]) ? $_POST["gost_score"] : ""; ?>">
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Zgoditci gosta
						    <input type="number"  id="gost_score" name="gost_score" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
						    value="<?php echo isset($_POST["gost_score"]) ? $_POST["gost_score"] : ""; ?>" >
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["gost_score"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     <div class="form-group col-md-8">
		     	<?php if(!isset($greska["opis"])): ?>
						  <label>Opis
						  	<textarea class="form-control" style="height: 100px;" type="text" id="opis" name="opis" placeholder=""
						    ><?php echo isset($_POST["opis"]) ? $_POST["opis"] : ""; ?></textarea>
						  </label>
						  <?php else: ?>
						   <label class="is-invalid-label">
						    Opis
						    <textarea class="form-control" style="height: 100px;" type="text" id="opis" name="opis" placeholder=""
						    ><?php echo isset($_POST["opis"]) ? $_POST["opis"] : ""; ?></textarea>
						    <span class="form-error is-visible" id="uuid"><?php echo $greska["opis"]; ?></span>
						  </label>
						  <?php endif; ?>
		     </div>
		     
		     </div>  
		     <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
		      <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Spremi utakmicu"></input></p>
		</form>			
	</div>
	
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/hr.js"></script>
    <script>
    	$("#pocetak").flatpickr({
    		locale: "hr",
    		minDate: "month ago",
    		enableTime:true
 
    	});
    </script>
	<script>
		
		<?php if(isset($greska["naziv"])):?>	
    		setTimeout(function(){ $("#naziv").focus(); },1000);	
    <?php elseif(isset($greska["puni_naziv"])):?>	
	    		setTimeout(function(){ $("#puni_naziv").focus(); },1000);	
	<?php elseif(isset($greska["kontakt"])):?>	
	    		setTimeout(function(){ $("#kontakt").focus(); },1000);	
	<?php elseif(isset($greska["drzava"])):?>	
	    		setTimeout(function(){ $("#drzava").focus(); },1000);	
	<?php elseif(isset($greska["grad"])):?>	
	    		setTimeout(function(){ $("#grad").focus(); },1000);	

	<?php endif; ?>
		
	</script>
	</body>

</html>

