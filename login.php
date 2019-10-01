<?php
session_start();
//Skrip koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | AnjasStore</title>
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
  <body>

    <div class="col-md-4 col-md-offset-4" style="margin-top:50px">
      <center>
        <a href="index.php"><h2 style="font-family:'Lobster', cursive;font-size:50px;color:#b49dc2">AnjasStore</h2></a>
        <h2 style="margin-top:10px;margin-bottom:20px">CUSTOMER LOGIN</h2>
      </center>

      <div class="panel panel-default">
        <div class="panel-body" style="padding-top:30px">
          <form role="form" method="post">
            <div class="form-group">
              <label>Email :</label>
              <input class="form-control" type="email" name="email" required>
            </div>
            <div class="form-group">
              <label>Password :</label>
              <input class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
              <span>
                Tidak punya akun? Daftar
                <a href="daftar.php"> disini.</a>
              </span>
              <button name="login" class="btn btn-main pull-right">Login</button>
            </div>
          </form>
          <?php
          // jk ada tombol simpan (tombol simpan ditekan)
            if (isset($_POST["login"]))
            {
              $email = $_POST["email"];
              $password = $_POST["password"];
              // lakukan query cek akun di tabel pelanggan di db
              $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

              // hitung akun yg terambil
              $akunyangcocok = $ambil->num_rows;

              // jika 1 akun yang cocok, maka diloginkan
              if ($akunyangcocok==1)
              {
                // anda sukses login
                // mendapatkan akun dlm bentuk array
                $akun = $ambil->fetch_assoc();
                // simpan di session pelanggan
                $_SESSION["pelanggan"] = $akun;
                echo "<script>alert('Login berhasil');</script>";

                // jk sudah belanja
                if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                {
                  echo "<script>location='checkout.php';</script>";
                }
                else
                {
                  echo "<script>location='index.php';</script>";
                }
              }
              else
              {
                // anda gagal login
                echo "<script>alert alert-danger('Login gagal, periksa kembali akun Anda');</script>";
                echo "<script>location='login.php';</script>";
              }
            }
          ?>
        </div>
      </div>
    </div>

  </body>
</html>
