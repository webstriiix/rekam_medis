<?php
require_once "../_config/config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission and update user details
if (isset($_POST['edit'])) {
    // Retrieve user ID from the hidden input field
    $userId = $_POST['user_id'];

    // Sanitize and validate form input (You should add further validation and security measures here)
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['alamat']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $spesialis = mysqli_real_escape_string($con, $_POST['spesialis']);
    $notlp = mysqli_real_escape_string($con, $_POST['no_telp']);


    // Handle image upload (if a new image is selected)
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarFileName = $_FILES['avatar']['name'];
        $avatarTempPath = $_FILES['avatar']['tmp_name'];

        // Move the uploaded file to a folder on your server (make sure the folder is writable)
        // $uploadDir = base_url('uploads/');
        
        $uploadDir = 'uploads/';
        $avatarFilePath = $uploadDir . $avatarFileName;

        echo $avatarFilePath;

        if (move_uploaded_file($avatarTempPath, $avatarFilePath)) {
            echo 'File uploaded successfully!';
            $sql = "UPDATE tb_user SET nama_user = '$name', username ='$username',password='$password', alamat = '$address', spesialis='$spesialis', no_telp='$notlp', avatar = '$avatarFilePath' WHERE id_user = '$userId'";
        } else {

            echo 'Failed to upload the file.';
        }
        // Update the user details in the database, including the new image URL
    } else {
        // Update the user details in the database (without changing the image URL)
        $sql = "UPDATE tb_user SET nama_user = '$name', username ='$username',password='$password', alamat = '$address', spesialis='$spesialis', no_telp='$notlp' WHERE id_user = '$userId'";
    }

    $result = mysqli_query($con, $sql);

    echo $result;
    if ($result) {
        // Redirect back to the dashboard or any other page upon successful update
        echo "<script>window.location='index.php'</script>";
        exit();
    } else {
        // Handle error if the update query fails
        $error = mysqli_error($con);
        echo "Error updating user details: $error";
    }
} else {
    echo "<script>window.location='index.php'</script>";

}

// Close the database connection
mysqli_close($con);
?>
