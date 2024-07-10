<?php
include '../sidebar.php';

?>
<div class="content">
    <h1>Data Rekam Medis</h1>
    <div class="item">
        <form class="search" action="" method="post">
            <input type="text" name="search" id="search" placeholder="Cari No Rekam Medis">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <h4>
            <a href="index.html" class="refresh"><i class="fa-solid fa-arrows-rotate"></i></a>
            <a href="add_data.php" class="add"><i class="fa-solid fa-file-circle-plus"></i>Tambah data</a>
            <a href="history.php" class="add"><i class="fa-solid fa-chart-line"></i> Lihat Riwayat Penyakit</a>
        </h4>
    </div>
    <form method="post" name="process">
        <table>
            <thead>
            <tr class="head">
                <th>No</th>
                <th>Tanggal Periksa</th>
                <th>Pasien</th>
                <th>Keluhan</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
                <th>Tensi</th>
                <th>Nadi</th>
                <th>Respirasi</th>
                <th>Suhu</th>
                <th>Obat</th>
                <th>Total Harga <br> Obat</th>
                <th style="text-align:center"><i class="fa-solid fa-gear"></i></th>
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
            
            if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET" ){
                $pencarian = trim(mysqli_real_escape_string($con, $_POST['search'] ?? $_GET['search']));
                if($pencarian != ''){
                    $sql = "SELECT * FROM tb_rm INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                            INNER JOIN tb_user ON tb_rm.id_dokter = tb_user.id_user
                            WHERE no_rm LIKE '%$pencarian%'
                            
                    ";
                    $query = $sql;
                    $queryjml = $sql;
                }else {
                    $query = "SELECT * FROM tb_rm 
                            INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                            INNER JOIN tb_user ON tb_rm.id_dokter = tb_user.id_user
                            ORDER BY no_rm ASC
                            LIMIT $posisi, $batas";
                    $queryjml = "SELECT * FROM tb_rm
                                INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                                INNER JOIN tb_user ON tb_rm.id_dokter = tb_user.id_user
                                ORDER BY no_rm ASC
                                ";
                    $no = $posisi +1;
                }
            } else {
                $query = "SELECT * FROM tb_rm 
                        INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                        INNER JOIN tb_user ON tb_rm.id_dokter = tb_user.id_user
                        ORDER BY no_rm ASC
                        LIMIT $posisi, $batas";
                $queryjml = "SELECT * FROM tb_rm
                            INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                            ORDER BY no_rm ASC
                            ";
                $no = $posisi + 1;
            }
            $sql_data = mysqli_query($con, $query) or die (mysqli_error($con));
            if (mysqli_num_rows($sql_data) > 0){
                while($data = mysqli_fetch_array($sql_data)):
            ?>
            <tr>
                <td><?=$data['no_rm']?></td>
                <td><?=$data['tgl_periksa']?></td>
                <td><?=$data['nama_pasien']?></td>
                <td><?=$data['keluhan']?></td>
                <td><?=$data['nama_user']?></td>
                <td><?=$data['diagnosa']?></td>
                <?php $tensi = explode(",",$data['tensi']);?>
                <td><?= $tensi[0]?>/<?= $tensi[1]?> mmHg</td>
                <td><?= $data['nadi']?>/mnt</td>
                <td><?= $data['respirasi']?>/mnt</td>
                <td><?= $data['suhu']?> &#8451</td>
                <td>
                    <?php
                        $sql_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat INNER JOIN tb_obat ON tb_rm_obat.id_obat = tb_obat.id_obat 
                                                        WHERE id_rm = '$data[id_rm]'");
                        while($obat = mysqli_fetch_array($sql_obat)){
                            echo $obat['nama_obat']."<br>";
                        }
                    ?>
                </td>
                <td><?= $data['total_harga_obat'] ?></td>
                <td class="edit">
                    <a href="del.php?id=<?=$data['id_rm']?>" onclick="return confirm('Yakin hapus data?')">
                        <i class="fa-solid fa-trash delete"></i>            
                    </a>
                    <a href="details_data.php?id=<?=$data['id_rm']?>" class="link-search-btn">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>            
                    </a>
                    
                </td>
            </tr>
            <?php endwhile;?>
            <?php }else {?>
                <tr><td colspan="8" style="text-align:center;color:red;"><h1>Tidak ada Data</h1></td></tr>
            <?php }?>
            </tbody>
        </table>
    </form>
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