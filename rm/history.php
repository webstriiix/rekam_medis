<?php
include '../sidebar.php'
?>
<div class="content">
    <h1>Riwayat Penyakit</h1>
    <div class="item">
        <h4>
            <a href="index.html" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
            <a href="" class="refresh"><i class="fa-solid fa-arrows-rotate"></i></a>

        </h4>
    </div>
    <form method="post">
        <table style="min-width: 100px">
            <tr>
                <td>Dari tanggal</td>
                <td><input type="date" name="dari_tgl" id="dari_tgl" required></td>
                <td>sampai tanggal</td>
                <td><input type="date" name="sampai_tgl" id="sampai_tgl" required></td>
            </tr>
        </table>
    </form>
    <table style="min-width:100px">
        <tr>
            <td><input type="text" name="search" id="search" style="width:20vw;" placeholder="input penyakit"></td>
            <td><button class="add search-button" id="searchButton">Cari</button></td>
        </tr>
    </table>

    <div class="table-container">
        
        <table>
                <thead>
                <tr class="head">
                    <th>No</th>
                    <th>Tanggal Periksa</th>
                    <th>Pasien</th>
                    <th>Diagnosa</th>
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
                if(isset($_POST['filter'])){
                    $dari_tgl = mysqli_real_escape_string($con, $_POST['dari_tgl']);
                    $sampai_tgl = mysqli_real_escape_string($con, $_POST['sampai_tgl']);
    
                    $query = "  SELECT * FROM tb_rm 
                                INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                                WHERE tgl_periksa BETWEEN '$dari_tgl' AND '$sampai_tgl'";
                    $queryjml = $query;
                }else{
                $query = "SELECT * FROM tb_rm
                            INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
                            ORDER BY no_rm ASC
                            LIMIT $posisi, $batas";
                
                $queryjml = "SELECT * FROM tb_rm
                             INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien";
                }
                
                $sql_data = mysqli_query($con, $query) or die (mysqli_error($con));
                if (mysqli_num_rows($sql_data) > 0){
                    while($data = mysqli_fetch_array($sql_data)):
                ?>
                <tr>
                    <td><?=$data['no_rm']?></td>
                    <td><?=$data['tgl_periksa']?></td>
                    <td><?=$data['nama_pasien']?></td>
                    <td><?=$data['diagnosa']?></td>
                </tr>
                <?php endwhile;?>
                <?php }else {?>
                    <tr><td colspan="8" style="text-align:center;color:red;"><h1>Tidak ada Data</h1></td></tr>
                <?php }?>
                </tbody>
            </table>
    </div>


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
?>
 
 

</div>
<?php
include '../footer.php'
?>
<div>
<script>
$(document).ready(function() {
            function loadData() {
                var searchValue = $("#search").val();
                var dariTgl = $("#dari_tgl").val();
                var sampaiTgl = $("#sampai_tgl").val();

                $.ajax({
                    url: "search.php",
                    method: "GET",
                    data: {
                        search: searchValue,
                        dari_tgl: dariTgl,
                        sampai_tgl: sampaiTgl
                    },
                    success: function(response) {
                        $(".table-container").html(response);
                        $(".page-item").hide();
                    }
                });
            }


            // Search button click event
            $("#searchButton").click(function() {
                loadData();
            });

            // Date filter change event
            $("#dari_tgl, #sampai_tgl").on("change", function() {
                loadData();
            });
        });

</script>
</div>