<?php
include "koneksi/koneksi.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SB Online</title>

    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    

    <style>
        a.nav-link, a.navbar-brand {
            color: #fff;
        }
        a.nav-link:hover, a.navbar-brand:hover {
            color: #fff111;
        }
        button a.nav-link:hover {
            color: #000000;
        }
    </style>
</head>
<body>
    <nav class="nav navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid collapse navbar-collapse">
            <h3><a class="navbar-brand" href="index.php">RB Online</a></h3>
            <ul class="navbar-nav">
                <li class=""><a class="nav-link" href="index.php">Beranda</a></li>
                <li class=""><a class="nav-link" href="?page=transaksi">Transaksi</a></li>
            </ul>
            <button class="btn btn-block btn-sm btn-warning"><a class="nav-link" href="petugas/login.php">Login Petugas</a></button>
        </div>
    </nav>

    <?php
        if (isset($_GET['page'])) {
            $laman = $_GET['page'];

            switch ($laman) {
                case 'transaksi':
                    include "transaksi.php";
                    break;

                case 'hapus-detail':
                    include "hapus-transaksi-menu.php";
                    break;
                
                case 'print':
                    include "print.php";
                    break;

                            
            }
        } else {
            include "home.php";
        }
    ?>
</body>
</html>