<?php
include '../sidebar.php';

$id = @$_GET['id'];
$sql_obat = mysqli_query($con, "SELECT * FROM tb_pasien WHERE id_pasien = '$id'") or die (mysqli_error($con));
$data = mysqli_fetch_array($sql_obat);
?>

<div class="content">
    <h1>Edit Data Pasien</h1>
    <div class="item">
        <h4>
            <a href="pasien.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <form action="process.php" method="post" class="form">
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" id="nik" name="nik" value="<?=$data['NIK']?>" required>
        </div>
        <div class="form-group">
            <label for="name">Nama Pasien</label>
            <input type="text" id="name" name="name" value="<?=$data['nama_pasien']?>" required>
            <input type="hidden" name="id" value="<?=$data['id_pasien']?>">
        </div>
        <div class="form-group">
            <label for="jk">Jenis Kelamin</label>
            <div class="radio">
                <label for="jk" class="radio-inline"><input type="radio" name="jk" id="jk" value="L" required <?=$data['jenis_kelamin'] == "l"? "checked": null;?>>Laki-laki</label>
                <label for="jk" class="radio-inline"><input type="radio" name="jk" id="jk" value="P" <?=$data['jenis_kelamin'] == "p"? "checked": null;?>>Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" required><?=$data['alamat']?></textarea>
        </div>
        <div class="form-group">
            <label for="notlp">No telepon</label>
            <input type="number" id="notlp" name="notlp" value="<?=$data['no_telp']?>" required>
        </div>
        <div class="form-group">
            <label for="tgl">Tanggal Lahir</label>
            <input type="date" id="tgl" name="tgl" value="<?=$data['tgl_lahir']?>" required>
        </div>
        <div class="form-group">
            <input type="submit" class="button" name="edit" value="Edit" />
        </div>
    </form>
</div>





<?php
include "../footer.php";
?>