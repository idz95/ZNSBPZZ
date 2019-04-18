<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
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
				<a href="../nadzornaPloca.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i>Nadzorna ploča</a>
		<h3 style="text-align: center;">Ekipe</h3>
		<form method="get">
					<input type="text" name="uvjet" 
					placeholder="uvjet pretraživanja (ime, prezime, email)"
					value="<?php echo isset($_GET["uvjet"]) ? $_GET["uvjet"] : "" ?>" />
				</form>
			<div class="large-12 cell">
					<a href="dodaj.php" class="button success expanded"><i style="color: white;" class="fas fa-user-plus fa-2x"></i></a>
			</div>
			
			<?php
					
					$uvjet = "%" . (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") . "%";
					
					$izraz = $veza->prepare("select count(*) from klub
					where concat(naziv_kluba,mjesto) like :uvjet");

					$izraz->execute(array("uvjet"=>$uvjet));
			
					
					$izraz = $veza->prepare("
						
						select * from klub 
						where concat(naziv_kluba, mjesto) like :uvjet
						order by mjesto;
						");
					
					$izraz->bindParam("uvjet", $uvjet);
					$izraz->execute();
					$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
				  ?>
					
					
		<table class="table">
						<thead>
							<tr>
								
								<th scope="col">Klub</th>
								<th scope="col">Mjesto</th>
								<th scope="col">Naziv stadiona</th>
								<th scope="col">Boja dresa H</th>
								<th scope="col">Akcija</th>
								


							</tr>
						</thead>
						<tbody>
							
						<?php 
						foreach ($rezultati as $red):
						?>
							
							<tr>
								<td><?php echo $red->naziv_kluba; ?></td>
								<td><?php echo $red->mjesto; ?></td>
								<td><?php echo $red->naziv_stadiona; ?></td>
								<td><?php echo $red->boja_dresa_domaca; ?></td>
							
								
								<td>
									<a href="promjena.php?sifra=<?php echo $red->sifra ?>"><i class="far fa-edit fa-2x"></i></a>
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

