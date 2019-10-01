<?php
session_start();
//koneksi ke SQLiteDatabase
include '../koneksi.php';

if (!isset($_SESSION['admin']))
{
  echo "<script>alert('Anda harus login');</script>";
  echo "<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard | AnjasStore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/dashboard.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

</head>
<body>

  <!-- Fixed Top Navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">AnjasStore</a>
      </div>

      <!-- Collection of nav links and other content for toggling -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown nav-account">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Admin <i class="fas fa-caret-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?halaman=logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  <!-- /. End Fixed Top Navbar -->
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar Nav -->
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li style="padding:5px 20px 20px 20px"><h3 style="margin-bottom:0">Admin</h3>Role: Administrator</li>
          <li class="active"><a href="index.php"><i class="fas fa-tachometer-alt" style="margin-left:1.5px;margin-right:1.5px"></i> Overview<span class="sr-only">(current)</span></a></li>
          <li><a href="index.php?halaman=produk"><i class="fas fa-box-open" style="margin-right:1.5px"></i> Data Produk</a></li>
          <li><a href="index.php?halaman=pembelian"><i class="fas fa-shopping-cart" style="margin-left:1px;margin-right:2px"></i> Data Penjualan</a></li>
          <li><a href="index.php?halaman=pelanggan"><i class="fas fa-user" style="margin-left:3.5px;margin-right:3.5px"></i> Data Pelanggan</a></li>
        </ul>
      <!-- /. End Sidebar Nav -->
      </div>

      <!-- Main Dashboard -->
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php
        if (isset($_GET['halaman']))
        {
          if ($_GET['halaman']=="produk")
          {
            include 'produk.php';
          }
          elseif ($_GET['halaman']=="pembelian")
          {
            include 'pembelian.php';
          }
          elseif ($_GET['halaman']=="pelanggan")
          {
            include 'pelanggan.php';
          }
          elseif ($_GET['halaman']=="detail")
          {
            include 'detail.php';
          }
          elseif ($_GET['halaman']=="tambahproduk")
          {
            include 'tambahproduk.php';
          }
          elseif ($_GET['halaman']=="hapusproduk")
          {
            include 'hapusproduk.php';
          }
          elseif ($_GET['halaman']=="ubahproduk")
          {
            include 'ubahproduk.php';
          }
          elseif ($_GET['halaman']=="logout")
          {
            include 'logout.php';
          }
          elseif ($_GET['halaman']=="pembayaran")
          {
            include 'pembayaran.php';
          }
          elseif ($_GET['halaman']=="hapuspelanggan")
          {
            include 'hapuspelanggan.php';
          }
        }
        else
        {
          include 'home.php';
        }
        ?>
      </div>

    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/all.min.js"></script>


</body>
</html>
