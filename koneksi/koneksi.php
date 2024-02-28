<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "kasir";

    $con = new mysqli ($server, $user, $password, $db);

    if (!$con) {
        die("<script>alert('Gagal terhubung ke database')</script>");
    }
?>