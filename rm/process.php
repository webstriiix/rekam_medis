<?php
require_once "../_config/config.php";
require_once "../_assets/libs/vendor/autoload.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])){
    $uuid = Uuid::Uuid4()->toString();
    $pasien = trim(mysqli_real_escape_string($con, $_POST['pasien']));
    $keluhan = trim(mysqli_real_escape_string($con, $_POST['keluhan']));
    $dokter = $_SESSION['user'];
    $diagnosa = trim(mysqli_real_escape_string($con, $_POST['diagnosa']));

    // Pengujian fisik
    $kepala = trim(mysqli_real_escape_string($con, $_POST['kepala']));
    $leher = trim(mysqli_real_escape_string($con, $_POST['leher']));
    $thorak = trim(mysqli_real_escape_string($con, $_POST['thorak']));
    $abdomen = trim(mysqli_real_escape_string($con, $_POST['abdomen']));
    $inguinal = trim(mysqli_real_escape_string($con, $_POST['inguinal']));
    $ekstremitas = trim(mysqli_real_escape_string($con, $_POST['ekstremitas']));

    // pengujian organ vital
    $tensi = array($_POST['sys'],$_POST['dia']);
    $nadi = trim(mysqli_real_escape_string($con, $_POST['nadi']));
    $respirasi = trim(mysqli_real_escape_string($con, $_POST['respirasi']));
    $suhu = trim(mysqli_real_escape_string($con, $_POST['suhu']));


    $terapi = trim(mysqli_real_escape_string($con, $_POST['terapi']));
    $saran = trim(mysqli_real_escape_string($con, $_POST['saran']));
    $total_harga = trim(mysqli_real_escape_string($con, $_POST['total-harga-obat']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));

    $tensiSerialized = implode(" , ",$tensi);

    mysqli_query($con, "INSERT INTO tb_rm (id_rm, id_pasien, keluhan, id_dokter, diagnosa, kepala, leher, thorak, abdomen, inguinal, 
                                            ekstremitas, tensi, nadi, respirasi, suhu, terapi, saran, total_harga_obat, tgl_periksa) 
                        VALUES ('$uuid','$pasien', '$keluhan', '$dokter','$diagnosa', '$kepala', '$leher', '$thorak', '$abdomen', '$inguinal', 
                        '$ekstremitas', '$tensiSerialized', '$nadi', '$respirasi', '$suhu', '$terapi', '$saran', '$total_harga', '$tgl')") 
                        
                        or die (mysqli_error($con));

    $obat = $_POST['obat'];
    echo $obat;
    var_dump($obat);
    foreach ($obat as $ob) {
        mysqli_query($con, "INSERT INTO tb_rm_obat (id_rm, id_obat) VALUES('$uuid','$ob')") or die(mysqli_error($con));
    }
    echo "<script>window.location='index.html';</script>";
}