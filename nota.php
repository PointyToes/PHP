<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nota Pembelian | AnjasStore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/w3.css">

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
<body id="myPage">

  <?php include 'menu.php' ?>

  <div class="container" style="padding-top:30px;padding-bottom:30px">
    <h2>Nota Pembelian</h2>
    <?php
      $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
      $detail = $ambil->fetch_assoc();
    ?>

    <!-- jk pelanggan yang beli tidak sama dengan pelanggan yg login, maka dilarikan ke riwayat.php karna dia tidak berhak melihat nota orang lain -->
    <?php
    //mendapatkan id_pelanggan yg beli
    $idpelangganyangbeli = $detail["id_pelanggan"];

    //mendapatkan id_pelanggan yg login
    $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

    if ($idpelangganyangbeli!==$idpelangganyanglogin)
    {
      echo "<script>alert('Not found!');</script>";
      echo "<script>location='riwayat.php';</script>";
      exit();
    }
    ?>


    <div class="row">
      <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong><br>
        Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
        Total : Rp<?php echo number_format($detail['total_pembelian']); ?>
      </div>
      <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
          <?php echo $detail['telepon_pelanggan']; ?> <br>
          <?php echo $detail['email_pelanggan']; ?>
        </p>
      </div>
      <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?php echo $detail['nama_kota'] ?></strong> <br>
        Ongkos Kirim : Rp<?php echo number_format($detail['tarif']); ?><br>
        Alamat : <?php echo $detail['alamat_pengiriman']; ?>
      </div>
    </div>

    <div class="table-responsive" style="padding-top:15px">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Subberat</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
          <?php while($pecah=$ambil->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td>Rp<?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo $pecah['berat']; ?> gr</td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td><?php echo $pecah['subberat']; ?> gr</td>
            <td>Rp<?php echo number_format($pecah['subharga']); ?></td>
          </tr>
          <?php $nomor++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="alert alert-info">
          <p>Silakan melakukan pembayaran Rp<?php echo number_format($detail['total_pembelian']);  ?></p>
          <strong>Bank BCA 6630567040 AN. Anjas Store</strong>
        </div>
      </div>
    </div>
  </div>

  <!-- Container (Footer Links) -->
 

  <footer class="container-fluid text-center">
    <p>&copy 2019 by Anjas Store</p>
  </footer>


  </body>
  </html>
