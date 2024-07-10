<?php
include '../sidebar.php';

?>
<div class="content">
    <h1>Data Obat</h1>
    <div class="item">
        <form class="search" action="" method="post">
            <input type="text" name="search" id="search">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form  action="" method="post">
        <h4>
            <a href="" class="refresh"><i class="fa-solid fa-arrows-rotate"></i></a>
            <a href="add_obat.php" class="add"><i class="fa-solid fa-file-circle-plus"></i>Tambah data</a>
        </h4>
    </div>
    <form method="post" name="process">
        <table>
            <thead>
            <tr class="head">
                <th>No</th>
                <th>Nama Obat</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th style="text-align:center"><input type="checkbox" id="select_all" style="margin-right:5px">Select All</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $batas = 10;
            $hal = @$_GET['hal'];
            if(empty($hal)){
                $posisi = 0;
                $hal = 1;
            } else {
                $posisi = ($hal - 1) * $batas;
            }
            $no = 1;
            if($_SERVER['REQUEST_METHOD'] == "POST" ){
                $pencarian = trim(mysqli_real_escape_string($con, $_POST['search']));
                if($pencarian != ''){
                    $sql = "SELECT * FROM tb_obat WHERE nama_obat LIKE '%$pencarian%'";
                    $query = $sql;
                    $queryjml = $sql;
                }else {
                    $query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
                    $queryjml = "SELECT * FROM tb_obat";
                    $no = $posisi +1;
                }
            } else {
                $query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
                $queryjml = "SELECT * FROM tb_obat";
                $no = $posisi + 1;
            }
            $sql_obat = mysqli_query($con, $query) or die (mysqli_error($con));
            if (mysqli_num_rows($sql_obat) > 0){
                while($data = mysqli_fetch_array($sql_obat)):
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$data['nama_obat']?></td>
                <td><?=$data['ket_obat']?></td>
                <td><?=$data['harga_obat']?></td>
                <td class="edit">
                    <a href="edit_obat.php?id=<?=$data['id_obat']?>">
                        <i class="fa-solid fa-pen-to-square edit"></i>
                    </a>
                    <a href="del.php?id=<?=$data['id_obat']?>">
                        <i class="fa-solid fa-trash delete"></i>            
                    </a>
                    <input type="checkbox" name="checked[]" class="check" value="<?=$data['id_obat']?>">
                </td>
            </tr>
            <?php endwhile;?>
            <?php }else {?>
                <tr><td colspan="5" style="text-align:center;color:red;"><h1>Tidak ada Data</h1></td></tr>
            <?php }?>
            </tbody>
        </table>
    </form>
    <div class="box">
        <button class="edit" onclick="edit()"><i class="fa-solid fa-pen-to-square"></i> Edit All</button>
        <button class="delete" onclick="del()"><i class="fa-solid fa-trash"></i> Delete All</button>
    </div>
    <?php 
if($_POST['search'] == '') { ?>
    <div class="page-item">
        <div class="float-left">
            <?php 
            $jml = mysqli_num_rows(mysqli_query($con, $queryjml));
            echo "Jumlah Data : <b>$jml</b>";
            ?>
        </div>
        <div class="float-right">
            <ul class="pagination">
            <?php
            $jml_hal = ceil($jml / $batas);
            $numPageLinks = 3; // jumlah nomor yang ditampilkan di pagination
            $startPage = max(1, $hal - floor($numPageLinks / 2));
            $endPage = min($jml_hal, $startPage + $numPageLinks - 1);

            if ($endPage - $startPage + 1 < $numPageLinks) {
                if ($startPage > 1) {
                    $startPage = max(1, $endPage - $numPageLinks + 1);
                } else {
                    $endPage = min($jml_hal, $startPage + $numPageLinks - 1);
                }
            }

            if ($hal > 1) {
                echo "<li><a class=\"active\" href=\"?hal=1\">First</a></li>";
                echo "<li><a class=\"active\" href=\"?hal=" . ($hal - 1) . "\">Prev</a></li>";
            }

            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $hal) {
                    echo "<li><a class=\"active\">$i</a></li>";
                } else {
                    echo "<li><a href=\"?hal=$i\">$i</a></li>";
                }
            }

            if ($hal < $jml_hal) {
                echo "<li><a class=\"active\" href=\"?hal=" . ($hal + 1) . "\">Next</a></li>";
                echo "<li><a class=\"active\" href=\"?hal=$jml_hal\">Last</a></li>";
            }
            ?>
            </ul>
        </div>
    </div>
    
<?php
}else { 
    
    echo "<div class=\"float-left\">";
    $jml = mysqli_num_rows(mysqli_query($con, $queryjml));
    echo "Data Hasil Pencarian : <b>$jml</b>";
    echo "</div>";
}
    ?>
    
    
</div>


<?php

include '../footer.php'
?>
<div>
    <script>
function edit() {
    if($('.check:checked').length >  0){
        document.process.action = 'edit_obat_all.php';
        document.process.submit();
    }else {
        alert('Pilih data dulu')
    }
}
    </script>
</div>