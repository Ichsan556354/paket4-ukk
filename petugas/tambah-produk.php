<?php 
include '../koneksi/koneksi.php';

    if (isset($_POST['addProduk'])) {
        $id = $_POST['id'];
        $namaProduk = $_POST['namaProduk'];
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

                $sql = "INSERT INTO produk (ProdukID, NamaProduk, Harga, Stok, Foto) VALUES ($id, '$namaProduk', '$harga', $stok, '$foto')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo "
                    <script>
                        alert('Produk Baru Berhasil Ditambahkan');
                        window.location.href='?page=stok';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('Pengguna Baru Gagal Ditambahkan. Harap Coba Lagi');
                    </script>";
                }
            } else {
                # code...
            }
        }
    }
?>

<div class="row justify-content-center">
    <div class="col-sm4">
        <div class="card well">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Produk</h3>
            </div>
            <div class="body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Produk</label>
                        <input type="text" name="namaProduk" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Foto</label>
                        <input type="file" name="foto" class="form-control-file form-control" id="contohupload1">                            
                        <p class="card-description"><code>Format gambar .jpg .png</code></p>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addProduk" class="btn btn-block btn-primary" id="">Tambah</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
