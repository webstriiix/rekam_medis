<?php
include '../sidebar.php';
$id = $_GET['id'];

?>

<div class="content">
    <div class="item">
        <h4>
            <a href="pasien.php" class="add"><i class="fa-solid fa-left-long"></i> Kembali</a>
        </h4>
    </div>
    <div class="personal-info">
        <div class="user"><i class="fa-solid fa-user"></i></div>
        <div class="client-details">
            <?php
            $sql_data = mysqli_query($con, "SELECT * FROM tb_pasien WHERE id_pasien='$id'")
                or die(mysqli_error($con));

            if (mysqli_num_rows($sql_data) > 0) :
                while ($data = mysqli_fetch_array($sql_data)) :
                    $id_pasien = $data['id_pasien'];

                    $jenis_kelamin = ($data['jenis_kelamin'] == "l") ? "Laki-laki" : "Perempuan";
            ?>
                    <h2><?= $data['nama_pasien'] ?></h2>
                    <p>NIK: <?= $data['NIK'] ?></p>
                    <p>Jenis Kelamin: <?= $jenis_kelamin ?></p>
                    <p>Tanggal Lahir: <?= $data['tgl_lahir'] ?></p>
                    <p>Alamat: <?= $data['alamat'] ?></p>
                    <p>No Telpon: <?= $data['no_telp'] ?></p>
                    <br>
            <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
    <div class="container-table">

    <?php
        include 'data_tables.php'
    ?>
    </div>
</div>

<?php
include '../footer.php'
?>
