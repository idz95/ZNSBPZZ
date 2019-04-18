<?php include_once '../konfiguracija.php'; 
provjeraOvlasti();
?>


<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "../template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		
	<?php include_once "../template/izbornik.php"; ?>
	<div class="container-wrap">
	
			<div id="fh5co-work">
		<h3>Utakmice rukomet</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domaćin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum i vrijeme</th>
								<th scope="col">Mjesto</th>
								<th scope="col">Sudac</th>
								<th scope="col">Rezultat</th>
								<th scope="col">Detalji</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.pocetak,  a.domacin_score, a.gost_score, b.ime, b.prezime, c.naziv as domacin, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
						where a.sport=3
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
								<td><?php echo $red->ime . " " . $red->prezime; ?></td>
								
								<td>
									<?php if($red->domacin_score != null): ?>
									<?php echo $red->domacin_score . " : " . $red->gost_score;  ?>
									<?php  endif; ?>
								</td>
								<td>
									<?php if($red->domacin_score != null): ?>
									<a class="detalji" id="de_<?php echo $red->sifraUtakmice ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x"></i></a>
									<?php  endif; ?>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			
		
		</div>
			
			

		
		

		
	</div><!-- END container-wrap -->

	<?php include_once "../template/podnozje.php"; ?>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: 60%;">
    
      <!-- Modal content-->
      <?php include_once "modal.php"; ?>
      
    </div>
  </div>  
	
	</div>
	<?php include_once "../template/skripte.php"; ?>
	<script>

	
	var sifraUtakmice;
	$(".detalji").click(function(){
    		
    		$("#detalji").html("Detalji utakmice");
    		sifraUtakmice = $(this).attr("id").split("_")[1];
    		$.ajax({
			  type: "POST",
			  url: "traziDetalje.php",
			  data: "utakmica=" + sifraUtakmice,
			  success: function(vratioServer){
			  	$("#sport").html("");
			  	$("#utakmicaIzmedu").html("");
			  	$("#sport").html("");
			  	$("#rezultat").html("");
			  	$("#sudac").html("");
			  	$("#datum").html("");
			  	$("#trajanje").html("");
			  	$("#opis").html("");
			  	var niz = jQuery.parseJSON(vratioServer);
			  	$( niz ).each(function(index,objekt) {
			  	$("#sport").append(objekt.naziv);
				 $("#utakmicaIzmedu").append(objekt.domacin  + " - "  + objekt.gost);
				 $("#rezultat").append(objekt.domacin_score  + " : "  + objekt.gost_score);
				 $("#sudac").append(objekt.ime  + "  "  + objekt.prezime);
				  $("#datum").append(objekt.pocetak);
				  $("#trajanje").append(objekt.trajanje + " minuta");
				  $("#opis").append(objekt.opis);
				});
				
			  }
			});
    	});
    	
	</script>
	</body>
</html>




