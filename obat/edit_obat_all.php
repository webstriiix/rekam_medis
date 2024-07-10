<?php
$chk = $_POST['checked'];
if(!isset($chk)){
    echo "<script>alert('Tidak ada data yang dipilih'); window.location='obat.php'</script>";
}
include '../sidebar.php';

?>
<div class="content">
<h1>Edit Data Obat</h1>
    <div class="item">
        <h4>
            <a href="obat.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <form action="process.php" method="post">
        <table>
            <thead>
                <tr class="head">
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Keterangan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($chk as $id) {
                    $sql_obat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$id'") or die (mysqli_error($con));
                    while ($data = mysqli_fetch_array($sql_obat)) {
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td>
                        <input type="text" name="name[]" id="name" value="<?=$data['nama_obat']?>" required>
                        <input type="hidden" name="id[]" value="<?=$data['id_obat']?>">
                    </td>
                    <td><textarea name="ket[]" id="ket" cols="20" rows="1"><?=$data['ket_obat']?></textarea></td>
                    <td><input type="number" name="price[]" id="price" value="<?=$data['harga_obat']?>" required></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="form-group">
            <input type="submit" class="button" name="edit_all" value="Edit" />
        </div>
    </form>
</div>


<?php

include '../footer.php'
?>