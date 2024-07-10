<?php
include '../sidebar.php';

$id = @$_GET['id'];
$sql_obat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$id'") or die (mysqli_error($con));
$data = mysqli_fetch_array($sql_obat);
?>

<div class="content">
    <h1>Edit Data Obat</h1>
    <div class="item">
        <h4>
            <a href="obat.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <form action="process.php" method="post" class="form">
        <div class="form-group">
            <label for="name">Nama Obat</label>
            <input type="text" id="name" name="name" value="<?=$data['nama_obat']?>" required>
            <input type="hidden" name="id" value="<?=$data['id_obat']?>">
        </div>
        <div class="form-group">
            <label for="desc">Keterangan</label>
            <textarea id="desc" name="desc" rows="4" required><?=$data['ket_obat']?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="<?=$data['harga_obat']?>" required>
        </div>
        <div class="form-group">
            <input type="submit" class="button" name="edit" value="Edit" />
        </div>
    </form>
</div>





<?php
include "../footer.php";
?>