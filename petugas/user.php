<div class="grid-margin">
    <div class="card">
            <div class="card-body col-sm-3">
                <h3 class="card-title">Daftar User</h3>
                <div class="row">
                    <form class="" action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="" placeholder="Cari">
                        </div>
                    </form>
                </div>
                <?php
                if ($level == "Administrator") {
                ?>
                <a href="?page=tambah-user" class=" text-center btn btn-block btn-primary">Tambah Pengguna</a>
                <?php 
                }
                ?>
            </div>


        <table class="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Level</th>
                    <?php
                    if ($level == "Administrator") {
                    ?>
                    <th class="text-center">Opsi</th>
                    <?php
                    }
                    ?>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../koneksi/koneksi.php";

                    if (isset($_POST['search'])) {
                        $queryUser = mysqli_query($con, "SELECT * FROM user WHERE NamaUser LIKE '%" . $_POST['search'] . "%'");

                        $no = 1;
                    while ($dataProduk = mysqli_fetch_assoc($queryUser)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo $dataProduk['NamaUser']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Password']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Level']; ?></td>
                    <td class="text-center " width="18%">
                        <a href="?page=edit-user&UserID=<?php echo $dataProduk['UserID']; ?>" class="col-sm-6 btn btn-warning">Edit</a><a href="?page=hapus-user&UserID=<?php echo $dataProduk['UserID']; ?>" class="col-sm-6 btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                    } 
                } else {
                ?>

                <?php

                    $queryUser = mysqli_query($con, "SELECT * FROM user");
                    $no = 1;
                    while ($dataProduk = mysqli_fetch_assoc($queryUser)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo $dataProduk['NamaUser']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Password']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Level']; ?></td>
                    <td class="text-center " width="18%">
                        <a href="?page=edit-user&UserID=<?php echo $dataProduk['UserID']; ?>" class="col-sm-6 btn btn-warning">Edit</a><a href="?page=hapus-user&UserID=<?php echo $dataProduk['UserID']; ?>" onclick="return confirmDelete();" class="col-sm-6 btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus Kolom ini?");
    }
</script>