<?php
include '../sidebar.php';


?>

<div class="content">
    <h1>Tambah Data Pasien</h1>
    <div class="item">
        <h4>
            <a href="pasien.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <form action="process.php" method="post" class="form">
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" id="nik" name="nik" required>
        </div>
        <div class="form-group">
            <label for="name">Nama Pasien</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="jk">Jenis Kelamin</label>
            <div class="radio">
                <label for="jk" class="radio-inline"><input type="radio" name="jk" id="jk" value="L" required>Laki-laki</label>
                <label for="jk" class="radio-inline"><input type="radio" name="jk" id="jk" value="P">Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label for="notlp">No Telepon</label>
            <input type="number" id="notlp" name="notlp" required>
        </div>
        <div class="form-group">
            <label for="tgl">Tgl Lahir</label>
            <input type="date" id="tgl" name="tgl" required>
        </div>
        <div class="form-group">
            <input type="submit" class="button" name="add" value="Tambah" />
        </div>
    </form>
</div>





<?php
include "../footer.php";
?>