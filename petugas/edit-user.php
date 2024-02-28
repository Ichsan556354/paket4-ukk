<?php
    include "../koneksi/koneksi.php";

    if (isset($_POST['Update'])) {
        $id = $_GET['UserID'];

        $nama = $_POST['namaUser'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        $update = mysqli_query($con, "UPDATE user SET NamaUser='$nama', Password='$password', Level='$level' WHERE UserID=$id");

        if ($update) {
            echo "
            <script>
                alert('Pengguna Berhasil Diedit');
                window.location.href='?page=user';
            </script>";
        } else {
            echo "
            <script>
                alert('Pengguna Gagal Diedit. Harap Coba Lagi');
            </script>";
        }
    }


    $id = $_GET['UserID'];

    $result = mysqli_query($con, "SELECT * FROM user WHERE UserID=$id");

    $user_data = mysqli_fetch_assoc($result);

?>

<div class="row justify-content-center">
    <div class="col-sm4">
        <div class="card well">
            <div class="card-header">
                <h3 class="card-title">Form Edit Pengguna</h3>
            </div>
            <div class="body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="namaUser" class="form-control" id="" value="<?php echo $user_data['NamaUser']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <?php
                            if ($user_data['Level'] == "Administrator") {
                        ?>

                        <label for="" class="form-label">Pilih Level Pekerjaan</label>
                        <select name="level" class="form-control" id="">
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas">Petugas</option>
                        </select>

                        <?php
                            } elseif ($user_data['Level'] = "Petugas") {
                        ?>
                        <label for="" class="form-label">Pilih Level Pekerjaan</label>
                        <select name="level" class="form-control" id="">
                            <option value="Petugas">Petugas</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                        <?php 
                            } else {
                        ?>
                        <label for="" class="form-label">Pilih Level Pekerjaan</label>
                        <select name="level" class="form-control" id="">
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                        <?php
                            }
                        ?>
                        
                    </div>

                    <div class="form-group">
                        <button type="submit" name="Update" class="btn btn-block btn-primary" id="">Edit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>