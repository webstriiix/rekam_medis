<?php
include '../sidebar.php';
$id = $_GET['id'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<div class="content">
    <h1>Riwayat Medis</h1>
    <div class="item">
        <h4>
            <button id="go-back" class="add"><i class="fa-solid fa-left-long"></i> Kembali</button>
        </h4>
    </div>
    <div class="personal-info" style="width: 50vw;">
        <h2>Data Pasien</h2>
        <hr>
        <div class="client-details"><br>
            <?php
            $sql_data = mysqli_query($con, "SELECT * FROM tb_rm
            INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
            INNER JOIN tb_user ON tb_rm.id_dokter = tb_user.id_user
            WHERE id_rm='$id'")
                or die(mysqli_error($con));

            if (mysqli_num_rows($sql_data) > 0) :
                while ($data = mysqli_fetch_array($sql_data)) :
                    $id_pasien = $data['id_pasien'];

                    $jenis_kelamin = ($data['jenis_kelamin'] == "l") ? "Laki-laki" : "Perempuan";
            ?>
                    <p>Nama Pasien: <?= $data['nama_pasien'] ?></p>
                    <p>NIK: <?= $data['NIK'] ?></p>
                    <p>Jenis Kelamin: <?= $jenis_kelamin ?></p>
                    <p>Tanggal Lahir: <?= $data['tgl_lahir'] ?></p>
                    <p>Alamat: <?= $data['alamat'] ?></p>
                    <p>No Telpon: <?= $data['no_telp'] ?></p>

            <br>
        </div>
        <div class="riwayat-medis">
            <h2>Riwayat Medis</h2>
            <hr><br>
            <h3>Keluhan : </h3>
            <p><?=$data["keluhan"]?></p><br>

            <h3>Pemeriksaan Fisik:</h3>
            <p>Kepala : <?=$data['kepala']?></p>
            <p>Leher : <?=$data['leher']?></p>
            <p>Thorak : <?=$data['thorak']?></p>
            <p>Abdomen : <?=$data['abdomen']?></p>
            <p>Inguinal : <?=$data['inguinal']?></p>
            <p>Ekstremitas : <?=$data['ekstremitas']?></p>

            <br>
            <h3>Vital Sign :</h3>
            <p>Nadi : <?=$data['nadi']?></p>
            <p>Respirasi : <?=$data['respirasi']?></p>
            <p>Tensi : <?=$data['tensi']?></p>
            <p>Suhu : <?=$data['suhu']?></p>

            <br>
            <h3>Diagnosa :</h3>
            <p><?=$data['diagnosa']?></p><br>

            <h3>Terapi :</h3>
            <p><?=$data['terapi']?></p><br>

            <h3>Saran :</h3>
            <p><?=$data['saran']?></p>

            <br>
            <h3>Tanggal Periksa : <?=$data['tgl_periksa']?></h3>

        </div>
        <?php
                endwhile;
            endif;
            ?>
    </div>
</div>
<script>
    document.getElementById("go-back").addEventListener("click", () => {
        history.back();
    });
</script>

<?php
include '../footer.php'
?>
