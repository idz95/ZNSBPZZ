<?php include_once '../../konfiguracija.php'; 
$izraz = $veza->prepare("select * from delegat where sifra = :sifra;");
$izraz->execute(array(
	"sifra" => $_SESSION[$appID."autoriziran"]->sifra));
	$rezultati = $izraz->fetch(PDO::FETCH_OBJ);
	

$id=$_SESSION[$appID."autoriziran"]->sifra;
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
  <li class="active"><a data-toggle="tab" href="#home">Potvrđivanje rezultata</a></li>
  <li><a data-toggle="tab" href="#menu1">Iduće utakmice</a></li>
   <li><a data-toggle="tab" href="#menu2">Suđene utakmice</a></li>

 
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    
    <h3>Prošle utakmice</h3>
    <h5>Potvrdi rezultat od suca ako to nisi učinio!</h5>
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domaćin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum i vrijeme</th>
                                <th scope="col">Rezultat</th>
								<th scope="col">Liga</th>
								<th scope="col">Detalji</th>
                                <th scope="col">Potvrdi</th>
							</tr>
						</thead>
						<tbody>
				
						<?php 
						
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.domacin_score,a.gost_score, a.pocetak, a.delegat_potvrdio, b.sifra,b.ime, b.prezime, c.razina, c.smjer, c.kategorija, d.naziv_kluba as domacin, e.naziv_kluba as gost 
						from utakmica a 
                        inner join delegat b on a.delegat=b.sifra
                        inner join liga c on a.liga=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
						where b.sifra=$id and a.pocetak<CURRENT_DATE  and a.domacin_score is not null and a.delegat_potvrdio is null 
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
                                <td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
                                <td><?php echo $red->razina . ".ŽNL " . $red->smjer . " " . $red->kategorija; ?></td>
								
								
								
								<td>
									<a class="detalji" id="de_<?php echo $red->sifraUtakmice ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x"></i></a>

                                </td>
                                <td>
                                    <a onclick="return confirm('Potvrđujem podatke od suca');" href="delegat_potvrda.php?sifra=<?php echo $red->sifraUtakmice ?>"><i class="fas fa-check-circle fa-2x"></i></a>
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

								<th scope="col">Liga</th>
								<th scope="col">Rezultat</th>


							</tr>
						</thead>
						<tbody>
							
						<?php 
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.domacin_score,a.gost_score, a.pocetak,a.opis, b.sifra,b.ime, b.prezime, c.razina, c.smjer, c.kategorija, d.naziv_kluba as domacin, e.naziv_kluba as gost 
						from utakmica a 
                        inner join delegat b on a.delegat=b.sifra
                        inner join liga c on a.liga=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
						where b.sifra=$id and a.pocetak<current_date
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

								<td><?php echo $red->razina . ".ŽNL " . $red->smjer . " " . $red->kategorija; ?></td>
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
								<th scope="col">Liga</th>
								

							</tr>
						</thead>
						<tbody>
							
						<?php 
						$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.domacin_score, a.pocetak, b.sifra,b.ime, b.prezime, c.razina, c.smjer, c.kategorija, d.naziv_kluba as domacin, e.naziv_kluba as gost 
						from utakmica a 
                        inner join delegat b on a.delegat=b.sifra
                        inner join liga c on a.liga=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
						where b.sifra=$id and a.pocetak>CURRENT_DATE and a.domacin_score is null 
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
                                <td><?php echo $red->razina . " " . $red->smjer . " " . $red->kategorija; ?></td>
								
								

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

                <div class="panel panel-info">
                    <div class="panel-heading" style="padding: 5px;">
                        <h3 id="detalji" class="modalNaslov"><label for="passwordConfirm" class="control-label panel-title"></label></h3>
                    </div>
                </div>
            </div>

            <div class="modal-body" >

                <div class="col-md-12" style="text-align: left;">
                    <h4 id="sport" class="modalOdgovor"></h4>
                    <h4 id="utakmicaIzmedu" class="modalOdgovor"></h4>
                    <h4 id="rezultat" class="modalOdgovor"></h4>
                    <h4 id="sudac" class="modalOdgovor"></h4>
                </div>


                <div class="col-md-4" style="text-align: left;">
                    <h4 id="datum" class="modalOdgovor"></h4>
                    <h4 id="pocetak" class="modalOdgovor"></h4>


                </div>
                <div class="col-md-8">

                    <div class="panel panel-info">
                        <div class="panel-heading" style="padding: 5px;">
                            <h3 class="panel-title"><label for="passwordConfirm" class="control-label panel-title">OPIS UTAKMICE</label></h3>
                        </div>
                        <div class="panel-body" style="padding: 5px;">
                            <div class="form-group" style="margin-bottom: 2px; font-size: 20px;">
                                <p id="opis"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

      
    </div>
  </div>  

	<?php include_once "../../template/skripte.php"; ?>
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

                    $("#utakmicaIzmedu").html("");
                    $("#rezultat").html("");
                    $("#pocetak").html("");
                    $("#opis").html("");

                    var niz = jQuery.parseJSON(vratioServer);
                    $( niz ).each(function(index,objekt) {
                        $("#utakmicaIzmedu").append(objekt.domacin  + " - "  + objekt.gost);
                        $("#rezultat").append(objekt.domacin_score  + " : "  + objekt.gost_score);
                        $("#datum").append(objekt.pocetak);
                        $("#opis").append(objekt.opis);

                    });

                }
            });

        });
    	
    	
		
	</script>

	</body>
</html>

