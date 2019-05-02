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
		<h3 style="text-align: center;">Završene utakmice</h3>
		<form method="get">
					<input type="text" name="uvjet" 
					placeholder="uvjet pretraživanja (ime i prezime suca, fakultet, sport)"
					value="<?php echo isset($_GET["uvjet"]) ? $_GET["uvjet"] : "" ?>" />
				</form>
			
			
			<?php
					
					$uvjet = "%" . (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") . "%";
					
					$izraz = $veza->prepare("
					select count(a.sifra), b.sifra, b.ime, b.prezime, c.razina, c.smjer, c.kategorija, d.naziv_kluba as domacin, e.naziv_kluba as gost from utakmica a
						 inner join sudac b on a.sudac=b.sifra
                        inner join liga c on a.liga=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
                        where concat(b.ime, b.prezime, c.razina, d.naziv_kluba, e.naziv_kluba) like :uvjet;");

					$izraz->execute(array("uvjet"=>$uvjet));
			
					
					$izraz = $veza->prepare("
						select a.sifra as sifraUtakmice, a.mjesto, a.domacin_score, a.gost_score, a.pocetak,a.kolo, b.ime, b.prezime, c.razina, c.smjer, c.kategorija, d.naziv_kluba as domacin, e.naziv_kluba as gost from utakmica a
						 inner join sudac b on a.sudac=b.sifra
                        inner join liga c on a.liga=c.sifra
                        inner join klub d on a.domacin=d.sifra
                        inner join klub e on a.gost=e.sifra
                        where concat(b.ime, b.prezime, c.razina, d.naziv_kluba, e.naziv_kluba) like :uvjet and pocetak < current_date 
						order by a.pocetak;
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
								<th scope="col">Liga</th>
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
								<td><?php echo $red->domacin; ?></td>
								<td><?php echo $red->gost; ?></td>
								<td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
								<td><?php echo $red->razina . ".ŽNL " . $red->smjer . " " . $red->kategorija; ?></td>
								<td><?php echo $red->ime . " " . $red->prezime; ?></td>
								<td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
							
								
								<td>
									<a href="promjena.php?sifra=<?php echo $red->sifraUtakmice ?>"><i class="far fa-edit fa-2x"></i></a>
									<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?sifra=<?php echo $red->sifraUtakmice ?>"><i class="far fa-trash-alt fa-2x"></i></a> 
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

