<div class="bg-light py-5">
    <div class="container">
        <h1 class="text-center">Selamat data di Restoran Barokah Online</h1>
        <h5 class="text-center">Buka halaman Transaksi untuk melakukan transaksi pembelian</h5>
    </div>
</div>

<div class="container mt-5">
    <section>
        <h2 class="text-center light">Daftar Produk yang Tersedia</h2>
    </section>

    <style>
        .main-content {
            margin-top: 60px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .card-container {
            margin-bottom: 20px;
        }
    </style>

    <div class="main-content">
        <div class="card-container">
            <?php
            include "koneksi/koneksi.php";

            $sql = $con->query("SELECT * FROM produk");
            while ($data = $sql->fetch_assoc()) {
            ?>
            <div class="card">
                <img class='card-img-top' src='foto/<?php echo $data['Foto']; ?>' width="230px" height="200px">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['NamaProduk']?></h5>
                    <p class="card-text"><?php echo $data['Harga']?></p>
                    <p class="card-text">Stok: <?php echo $data['Stok']?></h5>
                    <a class="btn btn-primary" href="?page=transaksi">Beli</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<footer class="bg-dark text-light py-4">
    <div class="container text-center">
        <p>Hak Cipta &copy; 2024 | RB Online</p>
    </div>
</footer>