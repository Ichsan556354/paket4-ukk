<?php
    include "../koneksi/koneksi.php";

    session_start();

    $username = $_SESSION['NamaUser'];
    $level = $_SESSION['Level'];

    if ($_SESSION['NamaUser'] == "") {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/bootstrap.min.css">

    <style>
        div.tes {
            color: #fff;
            height: 100%;
        } 
        .row.content {
            height: 633px;
        }
        .nav li a {
            color: #fff;
        }
        .nav li:hover a {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="tes col-sm-3 hidden-xs bg-primary">
                <h2><?php echo $level; ?></h2>
                <ul class="nav navbar nav-pills nav-stacked d-block">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="?page=stok">Stok</a></li>
                    <li><a href="?page=user">User</a></li>
                </ul>
            </div>
            <div class="col-sm-9">
                <nav class="nav navbar navbar-expand-lg navbar-light bg-light" style="margin: 0 -15px 10px -15px;">
                    <div class="container-fluid collapse navbar-collapse">
                        <div class="row">
                        <h3 class="col-sm-6"><?php echo $username ?></h3>
                        <a class="col-sm-6 nav-link text-end text-dark" href="logout.php"><i class="btn btn-primary">Logout</i></a>
                        </div>
                    </div>
                </nav>
                <?php
                    if (isset($_GET['page'])) {
                        $laman = $_GET['page'];

                        switch ($laman) {
                            case 'user':
                                include "user.php";
                                break;

                            case 'stok':
                                include "stok.php";
                                break;

                            case 'logout':
                                include "logout.php";
                                break;

                            case 'tambah-user':
                                include "tambah-user.php";
                                break;

                            case 'tambah-produk':
                                include "tambah-produk.php";
                                break;

                            case 'hapus-produk':
                                include "hapus-produk.php";
                                break;

                            case 'hapus-user':
                                include "hapus-user.php";
                                break;

                            case 'edit-produk':
                                include "edit-produk.php";
                                break;

                            case 'edit-user':
                                include "edit-user.php";
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    } else {
                        include "dashboard.php";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>