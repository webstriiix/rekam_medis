<?php
require_once "../_config/config.php";
require_once "../_assets/libs/vendor/autoload.php";
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])){
    $uuid = Uuid::Uuid4()->toString();
    $nama = trim(mysqli_real_escape_string($con, $_POST['name']));
    $ket = trim(mysqli_real_escape_string($con, $_POST['desc']));
    $harga = trim(mysqli_real_escape_string($con, $_POST['price']));
    mysqli_query($con, "INSERT INTO tb_obat (id_obat, nama_obat, ket_obat, harga_obat) VALUES ('$uuid','$nama', '$ket', '$harga')") or die (mysqli_error($con));
    echo "<script>window.location='obat.php';</script>";
}else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nama = trim(mysqli_real_escape_string($con, $_POST['name']));
    $ket = trim(mysqli_real_escape_string($con, $_POST['desc']));
    $harga = trim(mysqli_real_escape_string($con, $_POST['price']));
    mysqli_query($con, "UPDATE tb_obat SET nama_obat = '$nama', ket_obat = '$ket', harga_obat = '$harga' WHERE id_obat = '$id'");
    echo "<script>window.location='obat.php';</script>";
}else if(isset($_POST['edit_all'])){
    for($i=0; $i<count($_POST['id']); $i++){
        $id = $_POST['id'][$i];
        $name = $_POST['name'][$i];
        $ket = $_POST['ket'][$i];
        $harga = $_POST['price'][$i];


        mysqli_query($con,"UPDATE tb_obat SET nama_obat = '$name', ket_obat = '$ket', harga_obat = '$harga' WHERE id_obat = '$id'") or die (mysqli_error($con));
    }
    echo "<script>alert('Berhasil edit data'); window.location='obat.php'</script>";
}