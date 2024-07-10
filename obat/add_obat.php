<?php
include '../sidebar.php';


?>

<div class="content">
    <h1>Tambah Data Obat</h1>
    <div class="item">
        <h4>
            <a href="obat.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <form action="process.php" method="post" class="form">
        <div class="form-group">
            <label for="name">Nama Obat</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="desc">Keterangan</label>
            <textarea id="desc" name="desc" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <input type="submit" class="button" name="add" value="Tambah" />
        </div>
    </form>
</div>





<?php
include "../footer.php";
?>