<?php 
include '_config/config.php';
if(!isset($_SESSION['user'])){
    echo "<script>window.location='auth/login.php'</script>";
}else {
    echo "<script>window.location='dashboard/index.php'</script>";
}
?>