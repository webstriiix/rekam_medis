<?php
require_once "../_config/config.php";

$chk = $_POST['checked'];
if(!isset($chk)) {
    echo "<script>alert('Tidak ada data yang dipilih'); window.location='pasien.php'</script>";
} else {
    foreach($chk as $id){
        $sql = mysqli_query($con, "DELETE FROM tb_pasien WHERE id_pasien = '$id'") or die (mysqli_error($con));
    }

    if($sql) {
        echo "<script>alert('".count($chk)." data berhasil dihapus');window.location='pasien.php'</script>";
    } else {
        $errorCode = mysqli_errno($con);
        $errorMessage = mysqli_error($con);
        echo "<script>alert('Data gagal di hapus Error code: ".$errorCode." Error Message: ".$errorMessage."');window.location='pasien.php'</script>";
    }
}