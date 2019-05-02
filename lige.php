<?php include_once 'konfiguracija.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include_once "template/head.php"; ?>
	</head>
	<body>
		
	<div class="fh5co-loader">
	</div>
	
	<div id="page">
	<?php include_once "template/izbornik.php"; ?>
	<div class="container-wrap">
		
		<div id="fh5co-work">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2 style="font-size: 20px;">Županijski nogometni savez</h2>
				</div>
			</div>
			<div class="row">


                <div class="col-md-4 text-center">

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            1. Županijska liga
                        </a>
                        <?php

                        $izraz = $veza->prepare("select * from liga where razina=1;");
                        $izraz->execute();
                        $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                        foreach ($rezultati as $red):
                            ?>
                        <a href="prikazLige.php?sifra=<?php echo $red->sifra;?>" class="list-group-item list-group-item-action"><?php echo $red->kategorija;?></a>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="col-md-4 text-center">

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            2. Županijska liga Seniori
                        </a>
                        <?php

                        $izraz = $veza->prepare("select * from liga where razina=2;");
                        $izraz->execute();
                        $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                        foreach ($rezultati as $red):
                            ?>
                            <a href="prikazLige.php?sifra=<?php echo $red->sifra;?>" class="list-group-item list-group-item-action"><?php echo "2.ŽNL " . $red->smjer;?></a>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="col-md-4 text-center">

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            3. Županijska liga
                        </a>
                        <?php

                        $izraz = $veza->prepare("select * from liga where razina=3;");
                        $izraz->execute();
                        $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                        foreach ($rezultati as $red):
                            ?>
                            <a href="prikazLige.php?sifra=<?php echo $red->sifra;?>" class="list-group-item list-group-item-action"><?php echo "3.ŽNL " . $red->smjer;?></a>
                        <?php endforeach; ?>
                    </div>

                </div>
			</div>
		</div>
		
			
	<!-- END container-wrap -->
	</div>

	<?php include_once "template/podnozje.php"; ?>
	</div>

	
	<?php include_once "template/skripte.php"; ?>

	</body>
</html>

