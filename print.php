<?php

include "koneksi/koneksi.php";

$result = mysqli_query($con, "SELECT * FROM penjualan ORDER BY PenjualanID DESC LIMIT 1");
$penjualan = mysqli_fetch_assoc($result);
$PenjualanID = $penjualan['PenjualanID'];
$PelangganID = $penjualan['PelangganID'];

$result2 = mysqli_query($con, "SELECT * FROM detailpenjualan WHERE PenjualanID=$PenjualanID");
$produkdetail = mysqli_fetch_assoc($result2); 
$totalharga = 0;
$totalharga += $produkdetail['Subtotal'];

$result3 = mysqli_query($con, "SELECT * FROM pelanggan WHERE PelangganID=$PelangganID");
$pelanggan = mysqli_fetch_assoc($result3); 
$namaPelanggan = $pelanggan['NamaPelanggan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>

    <style>
        body {
            width: 300px;
        }
        td, th {
            align:center;
        }
    </style>
</head>
<body>
    
    <center>
        <p>SB Online</p>
        <p>= = = = = = = = = = = = = = = = = = = = = = =</p>
    </center>
        <p>No Transaksi : <?php echo $PenjualanID; ?></p>
        <p>Tgl : <?php echo $penjualan['TanggalPenjualan']; ?></p>
        <p>Nama Pembeli : <?php echo $namaPelanggan; ?></p>   

        <br>

        <table cellspacing="8">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Harga</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <br>
            <tbody>
                <?php 
                    $queryUser = mysqli_query($con, "SELECT * FROM detailpenjualan WHERE PenjualanID=$PenjualanID");
                    $no = 1;
                    $totalharga = 0;
                    while ($dataDetail = mysqli_fetch_assoc($queryUser)) {
                        $produkID = $dataDetail['ProdukID'];
                        $sqlProduk = $con->query("SELECT * FROM produk WHERE ProdukID=$produkID");
                        while ($dataProduk = mysqli_fetch_assoc($sqlProduk)) {
                ?>
                <tr>
                    <center><td><?php echo $dataProduk['NamaProduk']; ?></td></center>
                    <center><td><?php echo $dataProduk['Harga']; ?></td></center>
                    <?php
                        }
                    ?>
                    <center><td><?php echo $dataDetail['JumlahProduk']; ?></td></center>
                    <center><td><?php echo $dataDetail['Subtotal']; ?></td></center>
                    
                </tr>
                <?php
                
                $totalharga += $dataDetail['Subtotal'];
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?php echo number_format($totalharga); ?></td>
                </tr>
            </tfoot>
        </table>

        <p>= = = = = = = = = = = = = = = = = = = = = = =</p>

    <script>
        window.print();
    </script>
</body>
</html>
