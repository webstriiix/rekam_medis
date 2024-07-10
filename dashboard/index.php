<?php
include '../sidebar.php';

?>
<div class="content">
    <div class="dashboard">
        <div class="user-profile">
        <?php
                $sql = mysqli_query($con, "SELECT * FROM tb_user") or die (mysqli_error($con));
                if(mysqli_num_rows($sql) > 0 ){
                    while($data = mysqli_fetch_array($sql)){
                        
                    
            ?>
            <div class="user-avatar">
                <img src="<?=$data['avatar']?>" alt="User Avatar">
            </div>
            <div class="user-details">
                <input type="hidden" name="">
                <h2><?=$data['nama_user']?></h2>
                <p>Alamat: <?=$data['alamat']?></p>
                <p>username: <?=$data['username']?></p>
                <p>password: <?=$data['password']?></p>
                <p>Spesialis: <?=$data['spesialis']?></p>
                <p>No telp: <?=$data['no_telp']?></p>
            </div>
            <?php
                }
            }
            ?>
            <div class="edit-btn">
                <button id="editButton">Edit</button>
            </div>
        </div>
        <div class="edit-form" id="userForm">
            <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <?php
                $sql = mysqli_query($con, "SELECT * FROM tb_user") or die (mysqli_error($con));
                if(mysqli_num_rows($sql) > 0 ){
                    while($data = mysqli_fetch_array($sql)){
                        
                    
            ?>
                <input type="hidden" name="user_id" value="<?=$data['id_user']?>">

                <label for="editAvatar">Avatar:</label>
                <input type="file" id="editAvatar" name="avatar" accept="image/*">
                <img src="<?=$data['avatar']?>" alt="User Avatar" id="avatarImg" class="avatar-preview" style="width:100px;height:100px">

                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="<?=$data['nama_user']?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?=$data['username']?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" value="<?=$data['password']?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?=$data['alamat']?>" required>
                </div>
                <div class="form-group">
                    <label for="spesialis">Spesialis:</label>
                    <input type="text" id="spesialis" name="spesialis" value="<?=$data['spesialis']?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telepon:</label>
                    <input type="text" id="no_telp" name="no_telp" value="<?=$data['no_telp']?>" required>
                </div>

                <button type="submit" name="edit">Save</button>
                <button type="button" id="cancelButton">Cancel</button>

            <?php
                    }
                } 
            ?>
            </form>
        </div>
    </div>

</div>

<?php 
include '../footer.php'
?>