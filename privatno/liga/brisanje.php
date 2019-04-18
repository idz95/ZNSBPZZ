<?php
/**
 * Created by PhpStorm.
 * User: Džambo
 * Date: 18.4.2019.
 * Time: 19:39
 */

include_once '../../konfiguracija.php';
provjeraOvlasti();

if(!isset($_GET["sifra"])){

    header("location: " . $putanjaAPP . "logout.php");

}else{

    $izraz=$veza->prepare("delete from liga where sifra=:sifra");
    $izraz->execute($_GET);
    header("location: lige.php");

}

