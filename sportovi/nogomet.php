<?php include_once '../konfiguracija.php'; 

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
			
		<h3>Najbolji strijelci</h3>
					<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Ime i prezime</th>
								<th scope="col">Ekipa</th>
								<th scope="col">Broj golova</th>
							

							</tr>
						</thead>
						<tbody>
							
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra, a.ime, a.prezime, a.brojgolova, a.fakultet, b.naziv from igrac a
						inner join fakultet b on a.fakultet=b.sifra
						order by brojgolova desc limit 5;
							");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><a style="color: green;" href="../statistika.php?sifra=<?php echo $red->sifra;  ?>"><?php echo $red->ime . " " . $red->prezime; ?></td>
								<td><a style="color: green;" href="../profilEkipe.php?sifra=<?php echo $red->fakultet;  ?>"><?php echo $red->naziv; ?></td>
								<td><?php echo $red->brojgolova; ?></td>
								

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					<h3>Finale</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Ekipa 1</th>
								<th scope="col">Ekipa 2</th>
								
								
								<th scope="col">Rezultat</th>
								<th scope="col">Detalji</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.pocetak, a.faza, a.grupa,  a.domacin_score, a.gost_score, b.ime, b.prezime, c.naziv as domacin, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
						where a.sport=1 and a.faza=4
						order by pocetak desc;
						");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->domacin ?></td>
								<td><?php echo $red->gost; ?></td>
								
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
					
					<h3>Polufinale</h3>
					<p>A) DEBili-Ekipa/////Treća je najteža-Ropovi         B) Špinci-InfOs/////Kimko je stroj - Ivo Karlović</p>
					<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Ekipa 1</th>
								<th scope="col">Ekipa 2</th>
								<th scope="col">Rezultat</th>
								<th scope="col">Detalji</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.pocetak, a.faza, a.grupa,  a.domacin_score, a.gost_score, b.ime, b.prezime, c.naziv as domacin, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
						where a.sport=1 and a.faza=3
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
					
					<h3>Četvrtfinale</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Ekipa 1</th>
								<th scope="col">Ekipa 2</th>
								<th scope="col">Vrijeme</th>
								
								<th scope="col">Detalji</th>
								<th scope="col">Rezultat</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.pocetak, a.faza, a.grupa,  a.domacin_score, a.gost_score, b.ime, b.prezime, c.naziv as domacin, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
						where a.sport=1 and a.faza=2
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
								
								<td>
									<?php if($red->domacin_score != null): ?>
									<a class="detalji" id="de_<?php echo $red->sifraUtakmice ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x"></i></a>
									<?php  endif; ?>
									
								</td>
								
								<td>
									<?php if($red->domacin_score != null): ?>
									<?php echo $red->domacin_score . " : " . $red->gost_score;  ?>
									<?php  endif; ?>
								</td>
								

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>	
		
		<h3>Grupna faza</h3>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Ekipa 1</th>
								<th scope="col">Ekipa 2</th>
								<th style="width: 10%;" scope="col">Datum i vrijeme</th>
						
								<th style="width: 10%;" scope="col">Detalji</th>
								<th style="width: 10%;" scope="col">Rezultat</th>
								<th scope="col">Grupa</th>

							</tr>
						</thead>
						<tbody>
							
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.pocetak, a.faza, a.grupa,  a.domacin_score, a.gost_score, b.ime, b.prezime, c.sifra as sifraD, c.naziv as domacin,d.sifra as sifraG, d.naziv as gost
						from utakmica a 
						inner join sudac b on a.sudac=b.sifra
						inner join fakultet c on a.domacin=c.sifra
                        inner join fakultet d on a.gost=d.sifra
						where a.sport=1 and a.faza=1
						order by pocetak asc;
						");
						$izraz->execute();
						$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><a style="color: green;" href="../profilEkipe.php?sifra=<?php echo $red->sifraD;  ?>"><?php echo $red->domacin ?></a></td>
								<td><a style="color: green;" href="../profilEkipe.php?sifra=<?php echo $red->sifraG;  ?>"><?php echo $red->gost; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								
								<td>
									<?php if($red->domacin_score != null): ?>
									<a class="detalji" id="de_<?php echo $red->sifraUtakmice ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x"></i></a>
									<?php  endif; ?>
									
								</td>
								<td>
									<?php if($red->domacin_score != null): ?>
									<?php echo $red->domacin_score . " : " . $red->gost_score;  ?>
									<?php  endif; ?>
								</td>
								
								<td><?php echo $red->grupa; ?></td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					
					
					
		
					-->


<br /><br />
		
			
		
	</div><!-- END container-wrap -->

	<?php include_once "../template/podnozje.php"; ?>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: 100%;">
    
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

