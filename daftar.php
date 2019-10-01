<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Daftar | Anjas Store</title>
    <link rel="icon" href="img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="admin/assets/css/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.min.js"></script>
  </head>
  <body style="padding-top:0">

    <div class="col-md-4 col-md-offset-4">
      <center>
        <a href="index.php"><h2 style="font-family:'Lobster', cursive;font-size:50px;color:#b49dc2">AnjasStore</h2></a>
        <h2 style="margin-top:10px;margin-bottom:20px">SIGN UP</h2>
      </center>

      <div class="panel panel-default">
        <div class="panel-body" style="padding-top:30px">
          <form method="post">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
              <label>Email :</label>
              <input class="form-control" type="email" name="email" required>
            </div>
            <div class="form-group">
              <label>Password :</label>
              <input class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
              <label>Address :</label>
              <textarea class="form-control" name="alamat" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input class="form-control" type="text" name="telepon" required>
            </div>
            <div class="form-group">
              <span>
                Sudah punya akun ? Login
                <a href="login.php"> disini.</a>
              </span>
              <button name="daftar" class="btn btn-main pull-right">Daftar</button>
            </div>
          </form>
          <?php
          // jk ada tombol daftar (tombol daftar ditekan)
            if (isset($_POST["daftar"]))
            {
              // mengambil isian nama,email,password,alamat,telepon
              $nama = $_POST["nama"];
              $email = $_POST["email"];
              $password = $_POST["password"];
              $alamat = $_POST["alamat"];
              $telepon = $_POST["telepon"];

              //cek apakah email sudah digunakan
              $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");

              $yangcocok = $ambil->num_rows;

              if ($yangcocok==1)
              {
                echo "<script>alert alert-danger('Pendaftaran gagal, email sudah digunakan');</script>";
                echo "<script>location='daftar.php';</script>";
              }
              else
              {
                // query insert into pelanggan
                $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");

                echo "<script>alert('Pendaftaran sukses, silakan login');</script>";
                echo "<script>location='login.php';</script>";
              }
            }
          ?>
        </div>
      </div>
    </div>

  </body>
</html>
