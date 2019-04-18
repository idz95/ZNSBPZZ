<?php include_once 'konfiguracija.php';

if(!isset($_GET["sifra"])){

    header("location: " . $putanjaAPP . "logout.php");

}else {

    $izraz = $veza->prepare("
	select a.sifra, a.naziv_kluba, a.mjesto, b.sifra as sifraLige, b.razina, b.smjer, b.kategorija from klub a 
			inner join liga b on a.liga=b.sifra where b.sifra=:sifra;");
    $izraz->execute($_GET);

    $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <?php include_once "template/head.php"; ?>
</head>
<body>

<div class="fh5co-loader"></div>

<div id="page">

    <?php include_once "template/izbornik.php"; ?>
    <div class="container-wrap">

        <div id="fh5co-work">

            <h3 style="text-align: center;">Liga </h3>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Klub</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rezultati as $red):
                    ?>
                    <tr>
                        <td><?php echo $red->naziv_kluba . " " . $red->mjesto; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- END container-wrap -->

        <?php include_once "template/podnozje.php"; ?>
    </div>

    <?php include_once "template/skripte.php"; ?>

</body>
</html>
