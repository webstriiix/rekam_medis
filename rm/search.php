<?php
require_once "../_config/config.php";

$searchValue = $_GET['search'];
$dariTgl = $_GET['dari_tgl'];
$sampaiTgl = $_GET['sampai_tgl'];

$query = "SELECT * FROM tb_rm
            INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
            WHERE diagnosa LIKE '%$searchValue%'";


if (!empty($dariTgl) && !empty($sampaiTgl)) {
    $query .= " AND tgl_periksa BETWEEN '$dariTgl' AND '$sampaiTgl'";
}

$queryJml = $query;

$sql_data = mysqli_query($con, $query) or die(mysqli_error($con));

$output = '';


?>
    <table>
        <thead>
            <th>No</th>
            <th>Tanggal Periksa</th>
            <th>Pasien</th>
            <th>Diagnosa</th>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($sql_data) > 0) {
                while ($data = mysqli_fetch_array($sql_data)) {
            ?>
            <tr>
                <td><?=$data['no_rm']?></td>
                <td><?=$data['tgl_periksa']?></td>
                <td><?=$data['nama_pasien']?></td>
                <td><?=$data['diagnosa']?></td>
            </tr>
        <?php
                }
        ?>
        </tbody>
    </table>
<?php
    
} else {
    $output .= '<tr><td colspan="4" style="text-align:center;color:red;"><h1>Tidak ada Data</h1></td></tr>';
}

echo $output;
?>