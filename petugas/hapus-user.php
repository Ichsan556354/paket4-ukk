<?php
    include "../koneksi/koneksi.php";

    $id = $_GET['UserID'];
    $hapus = mysqli_query($con, "DELETE FROM user WHERE UserID=$id");

    if ($hapus) {
        echo "
        <script>
            alert('Pengguna Berhasil Dihapus');
            window.location.href='?page=user';
        </script>";
    } else {
        echo "
        <script>
            alert('Pengguna Gagal Dihapus. Harap Coba Lagi');
        </script>";
    }
?>