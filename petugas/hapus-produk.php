<?php
    include "../koneksi/koneksi.php";

    $id = $_GET['ProdukID'];
    $hapus = mysqli_query($con, "DELETE FROM produk WHERE ProdukID=$id");

    if ($hapus) {
        echo "
        <script>
            alert('Produk Berhasil Dihapus');
            window.location.href='?page=stok';
        </script>";
    } else {
        echo "
        <script>
            alert('Produk Gagal Dihapus. Harap Coba Lagi');
        </script>";
    }
?>