<?php
require_once "../_config/config.php";

$sql = mysqli_query($con, "DELETE FROM tb_obat WHERE id_obat = '$_GET[id]'") or die (mysqli_error($con));

if($sql) {
    echo "<script>alert('Data berhasil dihapus')</script>";
} else {
    $errorCode = mysqli_errno($con);
    $errorMessage = mysqli_error($con);
    echo "<script>alert('Data gagal di hapus Error code: ".$errorCode." Error Message: ".$errorMessage."')</script>";
}

echo "<script>window.location='obat.php';</script>";
