<?php include_once 'konfiguracija.php';

if(!isset($_GET["sifra"])){

    header("location: " . $putanjaAPP . "logout.php");

}else {
    $liga=$_GET["sifra"];
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

            <ul class="nav nav-tabs" style="align-items: center;">
                <li class="active"><a data-toggle="tab" href="#home">Tablica</a></li>
                <li><a data-toggle="tab" href="#menu1">Raspored utakmica i rezultati</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>Tablica lige</h3>
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
                                <td><a href="profilEkipe.php?sifra=<?php echo $red->sifra; ?>"><?php echo $red->naziv_kluba . " " . $red->mjesto; ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div id="menu1" class="tab-pane fade">
                    <h3>Utakmice</h3>
                    <p><b>Status utakmica:</b> <br>Utakmica potvrđena <i class="fas fa-info-circle fa-1x" style="color: green;" title="UTAKMICA POTVRĐENA"></i>     <br>   Čeka se potvrda delegata <i class="fas fa-info-circle fa-1x" style="color: orange;" title="ČEKA SE POTVRDA DELEGATA"></i>
                        <br>   Čeka se unos rezultata <i class="fas fa-info-circle fa-1x" style="color: red;" title="ČEKA SE UNOS REZULTATA"></i></p>

                    <ul class="nav nav-tabs" style="align-items: center;">
                        <li class="active"><a data-toggle="tab" href="#1kolo">1.kolo</a></li>
                        <li><a data-toggle="tab" href="#2kolo">2.kolo</a></li>
                        <li><a data-toggle="tab" href="#3kolo">3.kolo</a></li>
                        <li><a data-toggle="tab" href="#4kolo">4.kolo</a></li>
                        <li><a data-toggle="tab" href="#5kolo">5.kolo</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="1kolo" class="tab-pane fade in active">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th scope="col">Datum i vrijeme</th>
                                    <th scope="col">Domaćin</th>
                                    <th scope="col">Gost</th>
                                    <th scope="col">Rezultat</th>
                                    <th scope="col">Detalji</th>
                                    <th scope="col">Status</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $izraz = $veza->prepare("
						          select a.sifra as sifraUtakmice, a.pocetak, a.kolo, a.domacin_score, a.gost_score, a.opis, b.naziv_kluba as domacin, b.mjesto as domacin_mjesto, c.naziv_kluba as gost, c.mjesto as gost_mjesto, d.sifra from utakmica a
						          inner join klub b on a.domacin=b.sifra
						          inner join klub c on a.gost=c.sifra
						          inner join liga d on a.liga=d.sifra
						          where a.kolo=1 and d.sifra=$liga
						         order by pocetak desc;
						");
                                $izraz->execute();
                                $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rezultati as $red):
                                    ?>

                                    <tr>
                                        <td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
                                        <td><?php echo $red->domacin . " " . $red->domacin_mjesto; ?></td>
                                        <td><?php echo $red->gost . " " . $red->gost_mjesto; ?></td>
                                        <td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
                                        <td>
                                            <?php if($red->domacin_score != null): ?>
                                                <a class="detalji" id="de_<?php echo $red->sifraUtakmice; ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x" style="color: dodgerblue;" title="KLIKNI ZA DETALJE O UTAKMICI"></i></a>
                                            <?php  endif; ?>
                                        </td>
                                        <td>
                                            <?php if($red->domacin_score == null): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: red;" title="ČEKA SE UNOS REZULTATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio==false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: orange;" title="ČEKA SE POTVRDA DELEGATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio!=false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: green;" title="UTAKMICA POTVRĐENA"></i></a>
                                            <?php  endif; ?>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>

                        <div id="2kolo" class="tab-pane fade">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th scope="col">Datum i vrijeme</th>
                                    <th scope="col">Domaćin</th>
                                    <th scope="col">Gost</th>
                                    <th scope="col">Rezultat</th>
                                    <th scope="col">Detalji</th>
                                    <th scope="col">Status</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $izraz = $veza->prepare("
						          select a.sifra as sifraUtakmice, a.pocetak, a.kolo, a.domacin_score, a.gost_score, a.delegat_potvrdio, a.opis, b.naziv_kluba as domacin, b.mjesto as domacin_mjesto, c.naziv_kluba as gost, c.mjesto as gost_mjesto, d.sifra from utakmica a
						          inner join klub b on a.domacin=b.sifra
						          inner join klub c on a.gost=c.sifra
						          inner join liga d on a.liga=d.sifra
						          where a.kolo=2 and d.sifra=$liga
						         order by pocetak desc;
						");
                                $izraz->execute();
                                $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rezultati as $red):
                                    ?>

                                    <tr>
                                        <td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
                                        <td><?php echo $red->domacin . " " . $red->domacin_mjesto; ?></td>
                                        <td><?php echo $red->gost . " " . $red->gost_mjesto; ?></td>
                                        <td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
                                        <td>
                                            <?php if($red->domacin_score != null): ?>
                                                <a class="detalji" id="de_<?php echo $red->sifraUtakmice; ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x" style="color: dodgerblue;" title="KLIKNI ZA DETALJE O UTAKMICI"></i></a>
                                            <?php  endif; ?>
                                        </td>
                                        <td>
                                            <?php if($red->domacin_score == null): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: red;" title="ČEKA SE UNOS REZULTATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio==false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: orange;" title="ČEKA SE POTVRDA DELEGATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio!=false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: green;" title="UTAKMICA POTVRĐENA"></i></a>
                                            <?php  endif; ?>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div id="3kolo" class="tab-pane fade">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th scope="col">Datum i vrijeme</th>
                                    <th scope="col">Domaćin</th>
                                    <th scope="col">Gost</th>
                                    <th scope="col">Rezultat</th>
                                    <th scope="col">Detalji</th>
                                    <th scope="col">Status</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $izraz = $veza->prepare("
						          select a.sifra as sifraUtakmice, a.pocetak, a.kolo, a.domacin_score, a.delegat_potvrdio, a.gost_score, a.opis, b.naziv_kluba as domacin, b.mjesto as domacin_mjesto, c.naziv_kluba as gost, c.mjesto as gost_mjesto, d.sifra from utakmica a
						          inner join klub b on a.domacin=b.sifra
						          inner join klub c on a.gost=c.sifra
						          inner join liga d on a.liga=d.sifra
						          where a.kolo=3 and d.sifra=$liga
						         order by pocetak desc;
						");
                                $izraz->execute();
                                $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                                foreach ($rezultati as $red):
                                    ?>

                                    <tr>
                                        <td><?php echo date("d.m.Y. G:i",strtotime($red->pocetak)); ?></td>
                                        <td><?php echo $red->domacin . " " . $red->domacin_mjesto; ?></td>
                                        <td><?php echo $red->gost . " " . $red->gost_mjesto; ?></td>
                                        <td><?php echo $red->domacin_score . " : " . $red->gost_score; ?></td>
                                        <td>
                                            <?php if($red->domacin_score != null): ?>
                                                <a class="detalji" id="de_<?php echo $red->sifraUtakmice; ?>" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-info-circle fa-2x" style="color: dodgerblue;" title="KLIKNI ZA DETALJE O UTAKMICI"></i></a>
                                            <?php  endif; ?>
                                        </td>
                                        <td>
                                            <?php if($red->domacin_score == null): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: red;" title="ČEKA SE UNOS REZULTATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio==false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: orange;" title="ČEKA SE POTVRDA DELEGATA"></i></a>
                                            <?php  endif; ?>
                                            <?php if($red->domacin_score != null and $red->delegat_potvrdio!=false): ?>
                                                <a href="#"><i class="fas fa-info-circle fa-2x" style="color: green;" title="UTAKMICA POTVRĐENA"></i></a>
                                            <?php  endif; ?>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>



        </div><!-- END container-wrap -->

        <?php include_once "template/podnozje.php"; ?>
    </div>
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document" style="width: 60%;">

            <!-- Modal content-->
            <?php include_once "modal.php"; ?>

        </div>
    </div>
    <?php include_once "template/skripte.php"; ?>
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
