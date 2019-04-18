<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
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
				<a href="../nadzornaPloca.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i>  Nadzorna ploča</a>
		<h3 style="text-align: center;">Nadolazeće utakmice</h3>
		<form method="get">
					<input type="text" name="uvjet" 
					placeholder="uvjet pretraživanja (ime i prezime suca, fakultet, sport)"
					value="<?php echo isset($_GET["uvjet"]) ? $_GET["uvjet"] : "" ?>" />
				</form>
			
			
			<?php
					
					$uvjet = "%" . (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") . "%";
					
					$izraz = $veza->prepare("
					select a.sifra, a.pocetak, b.ime, b.prezime, c.ime as imeDelegat, c.prezime as prezimeDelegat, d.naziv_kluba as domacin, d.mjesto, e.naziv_kluba as gost, e.mjesto as gost_mjesto, f.razina, f.smjer, f.kategorija  from utakmica a 
                        inner join sudac b on a.sudac=b.sifra
                        inner join delegat c on a.delegat=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
                        inner join liga f on a.liga=f.sifra;");

					$izraz->execute(array("uvjet"=>$uvjet));
			
					
					$izraz = $veza->prepare("
						select a.sifra, a.pocetak, a.domacin_score, a.gost_score, b.ime, b.prezime, c.ime as imeDelegat, c.prezime as prezimeDelegat, d.mjesto, d.naziv_kluba as domacin, e.naziv_kluba as gost, e.mjesto as gost_mjesto, f.razina, f.smjer, f.kategorija  from utakmica a 
                        inner join sudac b on a.sudac=b.sifra
                        inner join delegat c on a.delegat=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
                        inner join liga f on a.liga=f.sifra;
						");
					
					$izraz->bindParam("uvjet", $uvjet);
					$izraz->execute();
					$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
				  ?>
					
					
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Domacin</th>
								<th scope="col">Gost</th>
								<th scope="col">Datum</th>
								<th scope="col">Delegat</th>
								<th scope="col">Sudac</th>
								<th scope="col">Rezultat</th>
								<th scope="col">Akcija</th>
								


							</tr>
						</thead>
						<tbody>
							
						<?php 
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->domacin . " " . $red->mjesto; ?></td>
								<td><?php echo $red->gost . " " . $red->gost_mjesto; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								<td><?php echo $red->imeDelegat . " " . $red->prezimeDelegat; ?></td>
								<td><?php echo $red->ime . " " . $red->prezime; ?></td>
								<td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
							
								
								<td>
									<a href="promjenaNadolazece.php?sifra=<?php echo $red->sifra ?>"><i class="far fa-edit fa-2x"></i></a>
									<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?sifra=<?php echo $red->sifra ?>"><i class="far fa-trash-alt fa-2x"></i></a>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			
		
		</div>
			
			

		
		

		
	</div><!-- END container-wrap -->

	<?php include_once "../../template/podnozje.php"; ?>
	</div>

	<?php include_once "../../template/skripte.php"; ?>

	</body>
</html>

