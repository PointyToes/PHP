<?php
session_start();
//koneksi ke SQLiteDatabase
include 'koneksi.php';

//jk tidak ada session pelanggan
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
  echo "<script>alert('silakan login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Riwayat Belanja | AnjasStore</title>
  <link rel="icon" href="img/favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

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

<section>
  <div class="container" style="padding-top:20px">
    <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

    <div class="table-responsive" style="padding-top:15px">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $nomor=1;
          // mendapatkan id_pelanggan yg login dari session
          $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

          $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
          while($pecah = $ambil->fetch_assoc()){
           ?>
          <tr>
            <td><?php echo $nomor ?></td>
            <td><?php echo $pecah["tanggal_pembelian"] ?></td>
            <td>
              <?php echo $pecah["status_pembelian"] ?>
              <br>
              <?php if(!empty($pecah['resi_pengiriman'])): ?>
                Resi : <?php echo $pecah['resi_pengiriman']; ?>
              <?php endif ?>
            </td>
            <td>Rp<?php echo number_format($pecah["total_pembelian"]) ?></td>
            <td>
              <a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
              <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-success">Pembayaran</a>
            </td>
          </tr>
        <?php $nomor++;  ?>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

</body>
</html>
