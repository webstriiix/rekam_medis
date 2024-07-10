<?php
include '../sidebar.php';

$id = $_GET['id'];
echo $id;
?>

<div class="content">
    <h1>Tambah Data Rekam Medis</h1>
    <div class="item">
        <h4>
            <button id="go-back" class="add"><i class="fa-solid fa-left-long"></i> Kembali</button>
        </h4>
    </div>
    <form action="process_rm.php" method="post" class="form">
        <div class="form-group">
            <label>Nama Pasien</label>
            <div class="custom-select">
    <div class="select-selected">Pilih pasien</div>
    <div class="select-items select-hide">
        <input type="text" id="search-input" placeholder="Search...">
        <?php
        $sql_pasien = mysqli_query($con, "SELECT * FROM tb_pasien WHERE id_pasien = '$id'") or die(mysqli_error($con));
        while ($data_pasien = mysqli_fetch_array($sql_pasien)):
            $id_pasien = $data_pasien['id_pasien'];
            $sql_diagnosa = mysqli_query($con, "SELECT diagnosa FROM tb_rm WHERE id_pasien = '$id_pasien'") or die(mysqli_error($con));
            $diagnosas = [];
            while ($row = mysqli_fetch_assoc($sql_diagnosa)) {
                $diagnosas[] = $row['diagnosa'];
            }
            $diagnosa_list = implode(", ", $diagnosas);
        ?>
        <div class="select-item" data-value="<?=$data_pasien['id_pasien']?>" data-diagnosa="<?=$diagnosa_list?>">
            <?=$data_pasien['nama_pasien']?>
        </div>

    </div>
    <div class="select-icon">
        <i class="fa-solid fa-chevron-down"></i>
    </div>
    
    <?php endwhile;?>
    <input type="hidden" id="selected-option" name="pasien"><br>
</div>  
        <div class="form-group">
            <p id="selected-diagnosa"></p>
        </div>
        </div>
        <div class="form-group">
            <label for="keluhan">Keluhan</label>
            <textarea id="keluhan" name="keluhan" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="tgl">Tanggal Periksa</label>
            <input type="date" name="tgl" id="tgl" value="<?=date('Y-m-d')?>">
        </div>
        <div class="form-group">
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" rows="4"></textarea>
        </div>
        <div class="form-group">
            <h3>Tes Fisik</h3>
            <label for="kepala">Kepala</label>
            <textarea name="kepala" id="kepala" cols="30" rows="1"></textarea>
            <label for="leher">Leher</label>
            <textarea name="leher" id="leher" cols="30" rows="1"></textarea>
            <label for="thorak">Thorak</label>
            <textarea name="thorak" id="thorak" cols="30" rows="1"></textarea>
            <label for="abdomen">Abdomen</label>
            <textarea name="abdomen" id="abdomen" cols="30" rows="1"></textarea>
            <label for="inguinal">Inguinal</label>
            <textarea name="inguinal" id="inguinal" cols="30" rows="1"></textarea>
            <label for="ekstremitas">Ekstremitas</label>
            <textarea name="ekstremitas" id="ekstremitas" cols="30" rows="1"></textarea>
        </div>
        <div class="form-group">
            <h3>Tensi</h3>
            <label for="sys">SYS</label>
            <input type="number" name="sys" id="sys">
            <label for="dia">DIA</label>
            <input type="number" name="dia" id="dia">
        </div>

        <div class="form-group">
            <label for="nadi">Nadi</label>
            <input type="number" name="nadi" id="nadi">
        </div>
        <div class="form-group">
            <label for="respirasi">Respirasi</label>
            <input type="number" name="respirasi" id="respirasi">
        </div>
        <div class="form-group">
            <label for="suhu">Suhu</label>
            <input type="number" name="suhu" id="suhu">
        </div>
        <div class="form-group">
            <label for="terapi">Terapi</label>
            <textarea name="terapi" id="terapi" cols="30" rows="1"></textarea>
        </div>
        <div class="form-group">
            <label for="saran">Saran</label>
            <textarea name="saran" id="saran" cols="30" rows="1"></textarea>
        </div>

        <div class="form-group">
            <label for="obat">Obat</label>
            <div class="custom-select">
                <select name="obat[]" id="mySelect" multiple style="width: 300px;" required>
                    <?php
                        $sql_obat = mysqli_query($con,"SELECT * FROM tb_obat") or die (mysqli_error($con));
                        while($data_obat = mysqli_fetch_array($sql_obat)):
                    ?>
                    <option value="<?=$data_obat['id_obat']?>"><?=$data_obat['nama_obat']?></option>
                    <?php endwhile;?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="total-harga-obat">Total Harga</label>
            <input type="text" id="total-amount-input" name="total-harga-obat" readonly>
        </div>


        <div class="form-group">
            <input type="submit" class="button" name="add" value="Tambah" />
        </div>
    </form>
</div>

<script>
    document.getElementById("go-back").addEventListener("click", () => {
        history.back();
    });
    
    const obatPrices = {
        <?php
            $sql_obat = mysqli_query($con,"SELECT * FROM tb_obat") or die (mysqli_error($con));
            while($data_obat = mysqli_fetch_array($sql_obat)):
                echo "'{$data_obat['id_obat']}': {$data_obat['harga_obat']},";
            endwhile;
        ?>
    };

    const originalSearchInputValue = searchInput.value;
    const selectItems = document.querySelectorAll('.select-item');
    const selectedOption = document.getElementById('selected-option');
    const searchInput = document.getElementById('search-input');
    const selectedDiagnosa = document.getElementById('selected-diagnosa');

    selectItems.forEach(item => {
        item.addEventListener('click', () => {
            const selectedValue = item.getAttribute('data-value');
            const diagnosaValue = item.getAttribute('data-diagnosa');

            selectedOption.value = selectedValue;
            searchInput.value = item.textContent;
            selectedDiagnosa.textContent = `Riwayat Penyakit: ${diagnosaValue}`;
        });
    });

    searchInput.addEventListener('input', function () {
        if (searchInput.value === originalSearchInputValue) {
            const selectedOptionText = $('#mySelect option:selected').text();
            searchInput.value = selectedOptionText;
        }
    });


</script>




<?php
include "../footer.php";
?>