<?php include_once '../../konfiguracija.php'; 
$izraz = $veza->prepare("select * from sudac where sifra = :sifra;");
$izraz->execute(array(
	"sifra" => $_SESSION[$appID."autoriziran"]->sifra));
	$rezultati = $izraz->fetch(PDO::FETCH_OBJ);
	

$id=$_SESSION[$appID."autoriziran"]->sifra;
$date=date("Y-m-d H:i");
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
		
	<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Unos rezultata</a></li>
  <li><a data-toggle="tab" href="#menu1">Iduće utakmice</a></li>
   <li><a data-toggle="tab" href="#menu2">Suđene utakmice</a></li>

 
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    
    <h3>Prošle utakmice</h3>
    <h5>Unesi rezultat ako to nisi uradio!</h5> 
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domaćin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum i vrijeme</th>
								<th scope="col">Mjesto</th>
								<th scope="col">Sport</th>
								<th scope="col">Unesi rezultat</th>
							</tr>
						</thead>
						<tbody>
				
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.domacin_score, a.pocetak, b.sifra,b.ime, b.prezime, c.naziv, d.naziv as domacin, e.naziv as gost 
						from utakmica a 
                        inner join sudac b on a.sudac=b.sifra
                        inner join sport c on a.sport=c.sifra
                        inner join fakultet d on a.domacin=d.sifra
                        inner join fakultet e on a.gost=e.sifra
						where b.sifra=$id and a.domacin_score is null 
						order by pocetak desc;
						");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->domacin ?></td>
								<td><?php echo $red->gost; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								<td><?php echo $red->mjesto; ?></td>
								<td><?php echo $red->naziv; ?></td>
								
								
								
								<td>
									<a class="detalji" id="de_<?php echo $red->sifraUtakmice ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x"></i></a>
								</td>
								

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
		      		
					  </div>
					
					
					

  	<div id="menu2" class="tab-pane fade">
    
    <h3>Suđene utakmice</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domaćin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum i vrijeme</th>
								<th scope="col">Mjesto</th>
								<th scope="col">Sport</th>
								<th scope="col">Rezultat</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						$izraz = $veza->prepare("
						select a.sifra, a.mjesto, a.domacin_score, a.gost_score, a.pocetak, b.sifra,b.ime, b.prezime, c.naziv, d.naziv as domacin, e.naziv as gost 
						from utakmica a 
                        inner join sudac b on a.sudac=b.sifra
                        inner join sport c on a.sport=c.sifra
                        inner join fakultet d on a.domacin=d.sifra
                        inner join fakultet e on a.gost=e.sifra
						where b.sifra=$id and pocetak < '$date' and domacin_score is not null
						order by pocetak desc;
						");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->domacin ?></td>
								<td><?php echo $red->gost; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								<td><?php echo $red->mjesto; ?></td>
								<td><?php echo $red->naziv; ?></td>
								<td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
								

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			</div>
			
			
			
	<div id="menu1" class="tab-pane fade">
    
    <h3>Buduće utakmice</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domaćin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum i vrijeme</th>
								<th scope="col">Mjesto</th>
								<th scope="col">Sport</th>
								

							</tr>
						</thead>
						<tbody>
							
						<?php 
						$izraz = $veza->prepare("
						select a.sifra, a.mjesto, a.domacin_score, a.gost_score, a.pocetak, b.sifra,b.ime, b.prezime, c.naziv, d.naziv as domacin, e.naziv as gost 
						from utakmica a 
                        inner join sudac b on a.sudac=b.sifra
                        inner join sport c on a.sport=c.sifra
                        inner join fakultet d on a.domacin=d.sifra
                        inner join fakultet e on a.gost=e.sifra
						where b.sifra=$id and pocetak > '$date' and domacin_score is null
						order by pocetak desc;
						");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->domacin ?></td>
								<td><?php echo $red->gost; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								<td><?php echo $red->mjesto; ?></td>
								<td><?php echo $red->naziv; ?></td>
								
								

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			</div>
			
			
			
					
			</div>

		
	</div><!-- END container-wrap -->
			

		
		

		
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: 100%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="detalji" class="modal-title" style="text-align: center;"></h4>
        </div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="modal-body">
        	<div class="col-md-6">
				  <h4 id="tim1" class="modal-title" style="text-align: center;"></h4>
				  <br>
				  <input type="number" name="rez1" id="domacinRezultat">
        	</div>	
        	<div class="col-md-6">
				 
				  <h4 id="tim2" class="modal-title" style="text-align: center;"></h4>
				  <br>
				  <input type="number" name="rez2" id="gostRezultat" >
						
        	</div>	
        	<div class="col-md-12">
				 
				  <h4 id="opis" class="modal-title" style="text-align: center;">OPIS I NAPOMENE</h4>
				  <br>
				  <textarea name="opis" id="opisUtakmice" style="height: 200px;"></textarea> 
						
        	</div>	
        	
        	
        </div>
        </br></br>
        <div class="modal-footer">
        	<input type="hidden" name="sifra" value="<?php echo $_POST["sifraUtakmice"]; ?>"></input>
        	<p><input type="submit" class="btn btn-primary btn-modify button expanded" id="predaj" value="Predaj"></input></p>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </form>	
        </div>
      </div>
      
    </div>
  </div>  

	<?php include_once "../../template/skripte.php"; ?>
	<script>
		
		var sifraUtakmice;
	$(".detalji").click(function(){
    		
    		$("#detalji").html("UNESI REZULTAT!");
    		sifraUtakmice = $(this).attr("id").split("_")[1];
    		$.ajax({
			  type: "POST",
			  url: "unesiRezultat.php",
			  data: "utakmica=" + sifraUtakmice,
			  success: function(vratioServer){
			  	$("#tim1").html("");
			  	$("#tim2").html("");
			  	var niz = jQuery.parseJSON(vratioServer);
			  	$( niz ).each(function(index,objekt) {
			  	$("#tim1").append(objekt.domacin);
				 $("#tim2").append(objekt.gost);
				});
				
			  }
			});
			
    	});
    	
    	$("#predaj").click(function(){
			
			$.ajax({
			  type: "POST",
			  url: "predajRezultat.php",
			  data: "domaci=" + $( "#domacinRezultat" ).val() + "&gost=" + $( "#gostRezultat" ).val() + "&opis=" + $( "#opisUtakmice" ).val() + "&sifraUtakmice=" + sifraUtakmice,
			  success: function(vratioServer){
			  	if(vratioServer=="OK"){
			  		alert("Predan rezultat");
			  	
			  	}
			  }
			});
		});
    	
    	
		
	</script>

	</body>
</html>

