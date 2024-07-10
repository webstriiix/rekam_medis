<?php 
require "_config/config.php";
require "_assets/libs/vendor/autoload.php";
if(!isset($_SESSION['user'])){
    echo "<script>window.location='".base_url('auth')."'</script>";
}

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../_assets/css/style.css">
    <link rel="stylesheet" href="../_assets/css/table.css">
    <link rel="stylesheet" href="../_assets/css/form.css">
    <link rel="stylesheet" href="../_assets/css/dashboard.css">
    <link rel="stylesheet" href="../_assets/css/select.css">
    <link rel="stylesheet" href="../_assets/css/details.css">
    <link rel="stylesheet" href="../_assets/css/menu.css">
</head>
<body>
    <div class="sidebar">
        <a href=""><h1>Rekam Medis</h1></a>
        <ul>
            <li class="<?= $page == "index.php"? 'active':'';?>"><a href="<?= base_url('dashboard')?>"> <i class="fa-solid fa-house-user"></i> Dashboard</a></li>
            <li class="<?=  $page == "pasien.php" || $page == "add_pasien.php" || $page == "details.php" || $page == "edit_pasien.php" ? 'active':'';?>"><a href="<?= base_url('pasien')?>"> <i class="fa-solid fa-hospital-user"></i> Data Pasien</a></li>
            <!-- <li ><a href=""> <i class="fa-solid fa-user-doctor"></i> Data Dokter</a></li> -->
            <li class="<?=  $page == "obat.php" || $page == "add_obat.php" || $page == "edit_obat_all.php" || $page == "edit_obat.php" ? 'active':'';?>"><a href="<?= base_url('obat')?>"> <i class="fa-solid fa-pills"></i> Data Obat</a></li>
            <li class="<?= $page == "data.php" || $page == "edit_data.php" || $page == "details_data.php" || $page == "add_data.php" || $page == "history.php" ? 'active':'';?>"><a href="<?= base_url('rm')?>"> <i class="fa-solid fa-notes-medical"></i> Rekam Medis</a></li>
            <li><a href="../auth/logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>
