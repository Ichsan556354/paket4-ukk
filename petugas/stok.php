<div class="grid-margin">
    <div class="card">
            <div class="card-body col-sm-3">
                <h3 class="card-title">Daftar Produk</h3>
                <br>
                <div class="row">
                    <form class="" action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="" placeholder="Cari">
                        </div>
                    </form>
                </div>
                <a href="?page=tambah-produk" class="col-md-6 text-center btn btn-block btn-primary">Tambah Produk</a>

                <br>
            </div>

        <table class="table" width="100%" border="2">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Terjual</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../koneksi/koneksi.php";
                    if (isset($_POST['search'])) {
                        $queryUser = mysqli_query($con, "SELECT * FROM produk WHERE NamaProduk LIKE '%" . $_POST['search'] . "%'");

                        $no = 1;
                    while ($dataProduk = mysqli_fetch_assoc($queryUser)) {
                        $ProdukID = $dataProduk['ProdukID'];
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><img src="<?php echo "../foto/" .$dataProduk['Foto']?>" width="100px" height="70px" alt="Produk"></td>
                    <td class="text-center"><?php echo $dataProduk['NamaProduk']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Harga']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Stok']; ?></td>
                    <?php
                    $terjual = mysqli_query($con, "SELECT * FROM detailpenjualan WHERE ProdukID=$ProdukID");
                    $totalTerjual = 0;
                    while ($dataterjual = mysqli_fetch_array($terjual)) {
                        $totalTerjual += $dataterjual['JumlahProduk'];
                    }
                    ?>
                    <td class="text-center"><?php echo $totalTerjual; ?></td>
                    <td class="text-center " width="18%">
                        <a href="?page=edit-produk&ProdukID=<?php echo $dataProduk['ProdukID']; ?>" class="col-sm-6 btn btn-warning">Edit</a><a href="?page=hapus-produk&ProdukID=<?php echo $dataProduk['ProdukID']; ?>" class="col-sm-6 btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php 
                    } 
                } else {
                ?>
                <?php

                    $queryUser = mysqli_query($con, "SELECT * FROM produk");
                    $no = 1;
                    while ($dataProduk = mysqli_fetch_assoc($queryUser)) {
                        $ProdukID = $dataProduk['ProdukID'];
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><img src="<?php echo "../foto/" .$dataProduk['Foto']?>" width="100px" height="70px" alt="Produk"></td>
                    <td class="text-center"><?php echo $dataProduk['NamaProduk']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Harga']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Stok']; ?></td>
                    <?php 
                    $terjual = mysqli_query($con, "SELECT * FROM detailpenjualan WHERE ProdukID=$ProdukID");
                    $totalTerjual = 0;
                    while ($dataterjual = mysqli_fetch_array($terjual)) {
                        $totalTerjual += $dataterjual['JumlahProduk'];
                    }
                    ?>
                    <td class="text-center"><?php echo $totalTerjual; ?></td>
                    <td class="text-center " width="18%">
                        <a href="?page=edit-produk&ProdukID=<?php echo $dataProduk['ProdukID']; ?>" class="col-sm-6 btn btn-warning">Edit</a><a href="?page=hapus-produk&ProdukID=<?php echo $dataProduk['ProdukID']; ?>" class="col-sm-6 btn btn-danger">Hapus</a>
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