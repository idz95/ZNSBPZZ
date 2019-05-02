<?php include_once '../../konfiguracija.php';
provjeraOvlasti();

$greska=array();

if($_POST){
    include_once 'kontrole.php';


    if(count($greska)==0){
        unset($_POST["sifra"]);
        $izraz=$veza->prepare("insert into klub (naziv_kluba, mjesto, naziv_stadiona, boja_dresa_domaca, boja_dresa_gost, liga) 
							values (:naziv_kluba, :mjesto, :naziv_stadiona, :boja_dresa_domaca, :boja_dresa_gost, :liga);");
        $izraz->execute($_POST);
        header("location: klub.php");
    }
}
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
            <a href="klub.php"><i style="color: red;" class="fas fa-arrow-alt-circle-left fa-3x"></i></a>
            <h4 style="text-align: center;">Dodavanje kluba!</h4>

            <form action="" method="post">


                <div class="form-row">

                    <div class="form-group col-md-4">
                        <?php if(!isset($greska["naziv_kluba"])): ?>
                            <label>Naziv kluba
                                <input class="form-control" type="text" id="naziv_kluba" name="naziv_kluba" placeholder="NK SLOGA"
                                       value="<?php echo isset($_POST["naziv_kluba"]) ? $_POST["naziv_kluba"] : ""; ?>">
                            </label>
                        <?php else: ?>
                            <label class="is-invalid-label">
                                Naziv kluba
                                <input type="text"  id="naziv_kluba" name="naziv_kluba" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                       value="<?php echo isset($_POST["naziv_kluba"]) ? $_POST["naziv_kluba"] : ""; ?>" >
                                <span class="form-error is-visible" id="uuid"><?php echo $greska["naziv_kluba"]; ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-md-4">
                        <?php if(!isset($greska["mjesto"])): ?>
                            <label>Mjesto
                                <input class="form-control"  type="text" id="mjesto" name="mjesto" placeholder="Kopanica"
                                       value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>">
                            </label>
                        <?php else: ?>
                            <label class="is-invalid-label">
                                Mjesto
                                <input type="text"  id="mjesto" name="mjesto" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                       value="<?php echo isset($_POST["mjesto"]) ? $_POST["mjesto"] : ""; ?>" >
                                <span class="form-error is-visible" id="uuid"><?php echo $greska["mjesto"]; ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="liga">Liga</label>
                        <select class="form-control" name="liga" id="liga">
                            <?php
                            $izraz = $veza->prepare("select * from liga order by razina");
                            $izraz->execute();
                            $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rezultati as $red):
                                ?>
                                <option
                                    <?php
                                    if(isset($_POST["liga"]) && $_POST["liga"]==$red->sifra){
                                        echo "selected=\"selected\"";
                                    }
                                    ?>
                                        value="<?php echo $red->sifra ?>"><?php echo $red->razina . ".ŽNL " . $red->smjer . " " . $red->kategorija; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <?php if(!isset($greska["naziv_stadiona"])): ?>
                            <label>Naziv stadiona
                                <input class="form-control"  type="text" id="naziv_stadiona" name="naziv_stadiona" placeholder="Naziv stadiona"
                                       value="<?php echo isset($_POST["naziv_stadiona"]) ? $_POST["oib"] : ""; ?>">
                            </label>
                        <?php else: ?>
                            <label class="is-invalid-label">
                                Naziv stadiona
                                <input type="text"  id="naziv_stadiona" name="naziv_stadiona" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                       value="<?php echo isset($_POST["naziv_stadiona"]) ? $_POST["naziv_stadiona"] : ""; ?>" >
                                <span class="form-error is-visible" id="uuid"><?php echo $greska["naziv_stadiona"]; ?></span>
                            </label>
                        <?php endif; ?>
                    </div>



                    <div class="form-group col-md-4">
                        <?php if(!isset($greska["boja_dresa_domaca"])): ?>
                            <label>Boja dresa domaća
                                <input class="form-control"  type="text" id="boja_dresa_domaca" name="boja_dresa_domaca" placeholder="Plava"
                                       value="<?php echo isset($_POST["boja_dresa_domaca"]) ? $_POST["boja_dresa_domaca"] : ""; ?>">
                            </label>
                        <?php else: ?>
                            <label class="is-invalid-label">
                                Boja dresa domaća
                                <input type="text"  id="boja_dresa_domaca" name="boja_dresa_domaca" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                       value="<?php echo isset($_POST["boja_dresa_domaca"]) ? $_POST["boja_dresa_domaca"] : ""; ?>" >
                                <span class="form-error is-visible" id="uuid"><?php echo $greska["boja_dresa_domaca"]; ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-md-4">
                        <?php if(!isset($greska["boja_dresa_gost"])): ?>
                            <label>Boja dresa gostujuća
                                <input class="form-control"  type="text" id="boja_dresa_gost" name="boja_dresa_gost" placeholder="Bijela"
                                       value="<?php echo isset($_POST["boja_dresa_gost"]) ? $_POST["boja_dresa_gost"] : ""; ?>">
                            </label>
                        <?php else: ?>
                            <label class="is-invalid-label">
                                Boja dresa gostujuća
                                <input type="text"  id="boja_dresa_gost" name="boja_dresa_gost" class="is-invalid-input"  aria-invalid aria-describedby="uuid"
                                       value="<?php echo isset($_POST["boja_dresa_gost"]) ? $_POST["boja_dresa_gost"] : ""; ?>" >
                                <span class="form-error is-visible" id="uuid"><?php echo $greska["boja_dresa_gost"]; ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                </div>
                <p><input type="submit" class="btn btn-primary btn-modify button expanded" value="Dodaj klub"></input></p>
            </form>
        </div>

    </div><!-- END container-wrap -->

    <?php include_once "../../template/podnozje.php"; ?>
</div>

<?php include_once "../../template/skripte.php"; ?>
<script>

    <?php if(isset($greska["naziv_kluba"])):?>
    setTimeout(function(){ $("#naziv_kluba").focus(); },1000);
    <?php elseif(isset($greska["mjesto"])):?>
    setTimeout(function(){ $("#mjesto").focus(); },1000);
    <?php elseif(isset($greska["naziv_stadiona"])):?>
    setTimeout(function(){ $("#naziv_stadiona").focus(); },1000);
    <?php elseif(isset($greska["boja_dresa_domaca"])):?>
    setTimeout(function(){ $("#boja_dresa_domaca").focus(); },1000);


    <?php endif; ?>

</script>
</body>

</html>

