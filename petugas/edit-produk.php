<?php
    include "../koneksi/koneksi.php";

    if (isset($_POST['Update'])) {
        $id = $_GET['ProdukID'];

        $nama = $_POST['namaProduk'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $rand = rand();
        $ekstensi =  array('png','jpg','jpeg', 'gif');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(!in_array($ext,$ekstensi) ) {
            echo "
            <script>
                alert('Foto gagal diambil');
            </script>";
        } else{
            if($ukuran < 1044070){		
                $foto = $rand.'_'.$filename;
                move_uploaded_file($_FILES['foto']['tmp_name'], '../foto/'.$rand.'_'.$filename);

                $update = mysqli_query($con, "UPDATE produk SET NamaProduk='$nama', Harga='$harga', Stok='$stok', Foto='$foto' WHERE ProdukID=$id");

                if ($update) {
                    echo "
                    <script>
                        alert('Produk Berhasil Diedit');
                        window.location.href='?page=stok';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('Produk Gagal Diedit. Harap Coba Lagi');
                    </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Mohon maaf ada gangguan, coba periksa foto yang akan di upload!');
                    </script>";
            }
        }
    }

    $id = $_GET['ProdukID'];
    $result = mysqli_query($con, "SELECT * FROM produk WHERE ProdukID=$id");
    $produk_data = mysqli_fetch_assoc($result);
?>

<div class="row justify-content-center">
    <div class="col-sm4">
        <div class="card well">
            <div class="card-header">
                <h3 class="card-title">Form Edit Pengguna</h3>
            </div>
            <div class="body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="namaProduk" class="form-control" id="" value="<?php echo $produk_data['NamaProduk']; ?>">
                        </div>
                        <div class="image-top-content col-md-6">
                            <center><label for="">Foto Lama</label></center>
                            <center><img src="../foto/<?php echo $produk_data['Foto'] ?>" alt="Foto Produk Lama" width="200" height="150"></center>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" id="" value="<?php echo $produk_data['Harga']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" id="" value="<?php echo $produk_data['Stok']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="" value="<?php echo $produk_data['Foto']; ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="Update" class="btn btn-block btn-primary" id="">Edit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>