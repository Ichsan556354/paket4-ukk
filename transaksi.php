
<?php
include "koneksi/koneksi.php";

$query1 = mysqli_query($con, "SELECT max(PenjualanID) as kodeTerbesar FROM penjualan");
$data1 = mysqli_fetch_array($query1);
$kodePenjualan = $data1['kodeTerbesar'];

$urutan = (int) substr($kodePenjualan, 3, 3);
$urutan++;
$depan = "437";
$PenjualanID = $depan . sprintf("%03s", $urutan);


// PelangganID
$query2 = mysqli_query($con, "SELECT max(PelangganID) as kodeTerbesar FROM pelanggan");
$data2 = mysqli_fetch_array($query2);
$kodePelanggan = $data2['kodeTerbesar'];

$urutan2 = (int) substr($kodePelanggan, 3, 3);
$urutan2++;
$depan2 = "194";
$PelangganID = $depan2 . sprintf("%03s", $urutan2);


// Detail Penjualan ID
$query3 = mysqli_query($con, "SELECT max(DetailID) as kodeTerbesar FROM detailpenjualan");
$data3 = mysqli_fetch_array($query3);
$kodeDetail = $data3['kodeTerbesar'];

$urutan3 = (int) substr($kodeDetail, 3, 3);
$urutan3++;
$depan3 = "914";
$DetailID = $depan3 . sprintf("%03s", $urutan3);


// Simpan data Transaksi 
$totalHarga = 0;
if (isset($_POST['tambah'])) {

    

    $namaProduk = $_POST['namaProduk'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $totalHarga = $harga * $jumlah;

    $sqlproduk1 = $con->query("SELECT * FROM produk WHERE NamaProduk='$namaProduk'");
    $produk = mysqli_fetch_assoc($sqlproduk1);

    $idproduk = $produk['ProdukID'];

    if ($produk['Stok'] < 1) {
        echo "
        <script>
            alert('Stok Habis!');
            window.location.href='?page=transaksi';
        </script>
        ";
    } elseif ($produk['Stok'] < $jumlah) {
        echo "
        <script>
            alert('Stok tidak mencukupi!');
            window.location.href='?page=transaksi';
        </script>
        ";
    } 
    else {
        $stok = $produk['Stok'];
        $tambahPesanan = mysqli_query($con, "INSERT INTO detailpenjualan (DetailID, PenjualanID, ProdukID, JumlahProduk, Subtotal) VALUES ($DetailID, $PenjualanID, $idproduk, $jumlah, $totalHarga)");

        // sisa stok
        $sisaStok = $stok - $jumlah;
        $simpansisaStok = mysqli_query($con, "UPDATE produk SET stok=$sisaStok WHERE ProdukID=$idproduk");
        if ($simpansisaStok) {
            $_POST['namaProduk'] = "";
            $_POST['harga'] = "";
            $_POST['jumlah'] = "";

            echo "
            <script>
                alert('Berhasil Ditambahkan');
                window.location.href='?page=transaksi';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Gagal Ditambahkan');
                window.location.href='?page=transaksi';
            </script>
            ";
        }
    }   
}


$sqlhargaTotal = $con->query("SELECT * FROM detailpenjualan WHERE PenjualanID=$PenjualanID");
$totalHarga = 0;
while ($data = $sqlhargaTotal->fetch_assoc()) {
    $subtotal = $data['Subtotal'];
    $totalHarga = $totalHarga + $subtotal;
}


$date = date("Y-m-d");
if (isset($_POST['print'])) {
    $namaPelanggan = $_POST['namaPelanggan'];
    
    $tambahPelanggan = mysqli_query($con, "INSERT INTO pelanggan VALUES ($PelangganID, '$namaPelanggan', '', '')");

    $tambahPenjualan = mysqli_query($con, "INSERT INTO penjualan VALUES ($PenjualanID, '$date', '$totalHarga', '$PelangganID')");

    $produkTerjual = 0;
    if ($tambahPelanggan && $tambahPenjualan) {
        echo "
        <script>
            alert('Berhasil');
            window.location.href='print.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal');
        </script>
        ";
    }
}
?>


<div class="container py-3">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-8 well">
                <h2>Transaksi</h2>
                <div class="form-group col-sm-6">
                    <p>Nomor Transaksi :  <?php echo $PenjualanID; ?></p>
                    <p>Tanggal : <?php echo $date; ?></p>
                </div>
                
                <br>

                <div class="form-group">
                    <label for="">Pilih</label>

                    <?php 
                        $result = mysqli_query($con, "SELECT * FROM produk");
                        $jsArray = "var prdName = new Array();\n";

                        echo '<select name="namaProduk" class="form-control" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]">
                            <option>Pilih --</option>';

                        while ($data = mysqli_fetch_array($result)) {
                            echo '<option value="' . $data['NamaProduk'] . '">'. $data['NamaProduk'] . ' - Stok : ' . $data['Stok'] . '</option>';
                            $jsArray .= "prdName['". $data['NamaProduk'] . "'] = '". addslashes($data['Harga'])."'\n";
                        }
                        

                        echo '
                        </select>';
                    ?>
                </div>
                <script type="text/javascript">
                    <?php echo $jsArray; ?>
                </script>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Harga</label>
                        <input type="number" name="harga" class="form-control" value="" id="prd_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Quantity</label>
                        <input type="number" name="jumlah" class="form-control" value="" required>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="form-group col-md-5">
                        <button name="tambah" class="btn btn-block btn-primary">Tambah</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 well p-3 text-center">
                <h4>Total Harga</h4>
                <h1 class="card-header">Rp. <?php echo number_format($totalHarga)?></h1>
            </div>
        </div>

        <br>
        <table class="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $queryUser = mysqli_query($con, "SELECT * FROM detailpenjualan WHERE PenjualanID=$PenjualanID");
                    $no = 1;
                    while ($dataDetail = mysqli_fetch_assoc($queryUser)) {
                        $produkID = $dataDetail['ProdukID'];
                        $sqlProduk = $con->query("SELECT * FROM produk WHERE ProdukID=$produkID");
                        while ($dataProduk = mysqli_fetch_assoc($sqlProduk)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><img src="foto/<?php echo $dataProduk['Foto']?>" width="150" height="100" alt="Produk"></td>
                    <td class="text-center"><?php echo $dataProduk['NamaProduk']; ?></td>
                    <td class="text-center"><?php echo $dataProduk['Harga']; ?></td>
                    <?php
                        }
                    ?>
                    <td class="text-center"><?php echo $dataDetail['JumlahProduk']; ?></td>
                    <td class="text-center " width="18%">
                        <a href="?page=hapus-detail&DetailID=<?php echo $dataDetail['DetailID']; ?>" class="col-sm-6 btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table></form>

        <form name="tes" action="" method="post">

        <br>
        <div class="form-group col-md-4">
            <label for="">Nama Pelanggan</label>
            <input type="text" name="namaPelanggan" class="form-control" id="" required>
        </div>
        <br>
        <div class="form-group col-md-3">
            <button name="print" class="btn btn-block btn-primary">Print</button>
        </div>
    </form>
</div>

