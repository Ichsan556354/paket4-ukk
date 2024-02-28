<?php
    include "../koneksi/koneksi.php";

    error_reporting(0);
    session_start();

    if (isset($_POST['login'])) {
        $username = $_POST['namauser'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM user WHERE NamaUser='$username' AND password='$password'";

        $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0) {
            $datalogin = mysqli_fetch_assoc($result);

            $_SESSION['NamaUser'] = $datalogin['NamaUser'];
            $_SESSION['Level'] = $datalogin['Level'];

            echo "
            <script>
                alert('Behasil Login');
                window.location.href='index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Gagal Login');
            </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>

    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">

    <style>
        
        body {
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="bg-primary">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="kotak col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3 mt-3">
                                <label class="form-label" for="">Username</label>
                                <input type="text" name="namauser" class="form-control" id="">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="">
                            </div>
                            <div class="mb-3 mt-3">
                                <center><button name="login" class="btn btn-block btn-primary">Login</button></center>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>