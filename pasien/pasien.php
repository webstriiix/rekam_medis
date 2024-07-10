<?php
include '../sidebar.php';
?>

<div class="content">
    <h1>Data Pasien</h1>
    <div class="item">
        <form class="search" action="" method="post">
            <input type="text" name="search" id="search" placeholder="Cari nama pasien">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <form class="search" action="" method="post">
            <input type="text" name="searchNumber" id="searchNumber" placeholder="Cari no Rekam Medis pasien">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <h4>
            <a href="" class="refresh"><i class="fa-solid fa-arrows-rotate"></i></a>
            <a href="add_pasien.php" class="add"><i class="fa-solid fa-file-circle-plus"></i>Tambah data</a>
        </h4>
    </div>
    <form method="post" name="process">
        <table>
            <thead>
                <tr class="head">
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th>Tgl Lahir</th>
                    <th style="text-align:center"><input type="checkbox" id="select_all" style="margin-right:5px">Select All</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $batas = 10;
                $hal = @$_GET['hal'];
                if (empty($hal)) {
                    $posisi = 0;
                    $hal = 1;
                } else {
                    $posisi = ($hal - 1) * $batas;
                }
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $pencarian = trim(mysqli_real_escape_string($con, $_POST['search']));
                    $searchNumber = trim(mysqli_real_escape_string($con, $_POST['searchNumber']));
                    if ($pencarian != '') {
                        $sql = "SELECT *
                                FROM tb_pasien 
                                WHERE tb_pasien.nama_pasien LIKE '%$pencarian%'
                                ";
                    } else if ($searchNumber != '') {
                        $sql = "SELECT *
                                FROM tb_pasien 
                                LEFT JOIN tb_rm ON tb_pasien.id_pasien = tb_rm.id_pasien
                                WHERE tb_rm.no_rm LIKE '%$searchNumber%'
                
                                ";
                    } else {
                        $sql = "SELECT *
                                FROM tb_pasien 
                                LIMIT $posisi, $batas";
                    }
                } else {
                    $sql = "SELECT *
                            FROM tb_pasien 
                            LIMIT $posisi, $batas";
                }
                $no = 1;
                $sql_obat = mysqli_query($con, $sql) or die(mysqli_error($con));
                if (mysqli_num_rows($sql_obat) > 0) :
                    while ($data = mysqli_fetch_array($sql_obat)) :
                        ?>
                        <tr>
                            <td><?= $data['NIK'] ?></td>
                            <?php
                                $sql_rm = mysqli_query($con, "SELECT * from tb_rm WHERE id_pasien = '".$data['id_pasien']."'");
                                while($rm = mysqli_fetch_array($sql_rm)):
                            ?>
                            <input type="hidden" name="no_rm" value="<?= $rm['no_rm'] ?>">
                            <?php endwhile; ?>
                            <td><?= $data['nama_pasien'] ?></td>
                            <td><?= $data['jenis_kelamin'] == "l" ? "Laki-laki" : "Perempuan"; ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['no_telp'] ?></td>
                            <td><?= $data['tgl_lahir'] ?></td>
                            <td class="edit">
                                <?php
                                $sql_idrm = mysqli_query($con, "SELECT no_rm FROM tb_rm WHERE id_pasien = '" . $data['id_pasien'] . "'");
                                if (mysqli_num_rows($sql_idrm) > 0) :
                                        echo "<div class='green'>Sudah dilayani</div>";
                                else :
                                    echo "<div class='danger'>Belum dilayani</div>";
                                endif;
                                ?>
                                <a href="details.php?id=<?= $data['id_pasien'] ?>" class="link-search-btn">Lihat detail</a>
                                <a href="edit_pasien.php?id=<?= $data['id_pasien'] ?>">
                                    <i class="fa-solid fa-pen-to-square edit"></i>
                                </a>
                                <a href="del.php?id=<?= $data['id_pasien'] ?>">
                                    <i class="fa-solid fa-trash delete"></i>
                                </a>
                                <input type="checkbox" name="checked[]" class="check" value="<?= $data['id_pasien'] ?>">
                            </td>
                        </tr>
                    <?php
                    endwhile;
                else :
                    ?>
                    <tr>
                        <td colspan="5" style="text-align:center;color:red;"><h1>Tidak ada Data</h1></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
    <div class="box">
        <button class="delete" onclick="del()"><i class="fa-solid fa-trash"></i> Delete All</button>
    </div>
    <?php
    if ($_POST['search'] == '') :
        ?>
        <div class="page-item">
            <div class="float-left">
                <?php
                $jml = mysqli_num_rows(mysqli_query($con, $sql));
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
    <?php else :
        echo "<div class=\"float-left\">";
        $jml = mysqli_num_rows(mysqli_query($con, $sql));
        echo "Data Hasil Pencarian : <b>$jml</b>";
        echo "</div>";
    endif;
    ?>
</div>

<?php
include '../footer.php';
?>
