<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();

if(!isset($_GET["sifra"])){
	
		header("location: " . $putanjaAPP . "logout.php");
	
}else{
	
	$izraz=$veza->prepare("
	select a.sudac, b.ime, b.prezime
	from utakmica a inner join sudac b on a.sudac=b.sifra
	where a.sudac=:sifra;");
	$izraz->execute($_GET);
	
	$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
	
	if(count($rezultati)==0){
	
		$izraz=$veza->prepare("delete from delegat where sifra=:sifra");
		$izraz->execute($_GET);
		header("location: delegati.php");
	}
}

$izraz=$veza->prepare("
	select a.*, b.naziv_kluba as domaci, c.naziv_kluba as gosti, d.razina, d.smjer, d.kategorija from utakmica a 
    inner join klub b on a.domacin=b.sifra
    inner join klub c on a.gost=c.sifra
    inner join liga d on a.liga=d.sifra
    where delegat=:sifra;
						");
$izraz->execute($_GET);
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
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
            <a href="delegati.php" style="font-weight: bold; color: red;"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i> Nadzorna ploča</a>

            <h3 style="text-align: center;">Nemoguće obrisati delegata jer sudi na utakmicama:</h3>

            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Utakmica</th>
                    <th scope="col">Liga</th>
                    <th scope="col">Datum i vrijeme</th>


                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rezultati as $red):
                    ?>
                    <tr>
                        <td><?php echo $red->domaci . " : " . $red->gosti; ?></td>
                        <td><?php echo $red->razina . ".ŽNL" . $red->smjer; ?></td>
                        <td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
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




