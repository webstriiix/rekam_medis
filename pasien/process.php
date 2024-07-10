<?php
require_once "../_config/config.php";
require_once "../_assets/libs/vendor/autoload.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])){
    $uuid = Uuid::Uuid4()->toString();
    $nama = trim(mysqli_real_escape_string($con, $_POST['name']));
    $NIK = trim(mysqli_real_escape_string($con, $_POST['nik']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $notlp = trim(mysqli_real_escape_string($con, $_POST['notlp']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));
    mysqli_query($con, "INSERT INTO tb_pasien (id_pasien, NIK, nama_pasien, jenis_kelamin, tgl_lahir, alamat, no_telp) VALUES ('$uuid',$NIK ,'$nama', '$jk', '$tgl', '$alamat', '$notlp')") or die (mysqli_error($con));
    echo "<script>window.location='pasien.php';</script>";
}else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $NIK = trim(mysqli_real_escape_string($con, $_POST['nik']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['name']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $notlp = trim(mysqli_real_escape_string($con, $_POST['notlp']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));
    
    mysqli_query($con, "UPDATE tb_pasien SET NIK = '$NIK', nama_pasien = '$nama', jenis_kelamin = '$jk', tgl_lahir='$tgl', alamat = '$alamat', no_telp='$notlp' WHERE id_pasien = '$id'");
    echo "<script>window.location='pasien.php';</script>";
}