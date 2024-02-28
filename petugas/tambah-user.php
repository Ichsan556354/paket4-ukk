<div class="row justify-content-center">
    <div class="col-sm4">
        <div class="card well">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Pengguna</h3>
            </div>
            <div class="body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="" class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="namaUser" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Pilih Level Pekerjaan</label>
                        <select name="level" class="form-control" id="">
                            <option value="">Pilih</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addUser" class="btn btn-block btn-primary" id="">Tambah</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
    include "../koneksi/koneksi.php";

    if (isset($_POST['addUser'])) {
        $id = $_POST['id'];
        $namaUser = $_POST['namaUser'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        $sql = "INSERT INTO user (UserID, NamaUser, Password, Level) VALUES ($id, '$namaUser', '$password', '$level')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "
            <script>
                alert('Pengguna Baru Berhasil Ditambahkan');
                window.location.href='?page=user';
            </script>";
        } else {
            echo "
            <script>
                alert('Pengguna Baru Gagal Ditambahkan. Harap Coba Lagi');
            </script>";
        }
    }
?>