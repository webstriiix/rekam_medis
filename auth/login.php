<?php
include '../_config/config.php';

if (isset($_SESSION['user'])){
    echo "<script>window.location='../'</script>";
    echo "ada session";
}
$username = trim(mysqli_real_escape_string($con,$_POST['username']));
$password = trim(mysqli_real_escape_string($con,$_POST['password']));

$login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'") or die (mysqli_error($con));

if(isset($_POST["login"])){
    if (mysqli_num_rows($login) === 1) {
        $row  = mysqli_fetch_assoc($login);
        $id = $row['id_user'];
        $_SESSION['user'] = $id;
        echo "<script>window.location='../dashboard/'</script>";
        // echo $_SESSION['user'];
    }else{
        echo "<script>alert('username atau password salah')</script>";
    }

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../_assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <form class="main" method="post">
        <div class="head-login">
            <div class="user"><i class="fa-solid fa-user"></i></div>
            <h1>Login</h1>
        </div>
        <div class="username">
            <span class="user-icon icon"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="username" id="username" placeholder="username">
        </div>
        
        <div class="password">
            <span class="password-icon icon"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password" id="password" placeholder="password">
            <i class="fa-solid fa-eye" style="position:absolute;" id="eye"></i>
        </div>
         
        <input type="submit" class="button" value="Login" name="login">
        
    </form>


    <script src="https://kit.fontawesome.com/6b15f87bf3.js" crossorigin="anonymous"></script>
    <script>
        const eye = document.getElementById("eye");
        const password = document.getElementById("password")
        eye.onclick = function seePassword(){

            if (password.type === "password") {
                    password.type = "text";
                    eye.classList.remove('fa-eye');
                    eye.classList.add('fa-eye-slash')
                } else {
                    password.type = "password";
                    eye.classList.remove('fa-eye-slash')
                    eye.classList.add('fa-eye');
                }
            }
    </script>
</body>
</html>