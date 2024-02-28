<?php
    include "koneksi/koneksi.php";

    $id = $_GET['DetailID'];
    $hapus = mysqli_query($con, "DELETE FROM detailpenjualan WHERE DetailID=$id");

    if ($hapus) {
        echo "
        <script>
            alert('Produk Berhasil Dihapus');
            window.location.href='?page=transaksi';
        </script>";
    } else {
        echo "
        <script>
            alert('Produk Gagal Dihapus. Harap Coba Lagi');
        </script>";
    }
?>
