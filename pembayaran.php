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

// mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli)
{
  echo "<script>alert('Not Found!');</script>";
  echo "<script>location='riwayat.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pembayaran | AnjasStore</title>
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
  <div class="container">
    <h3>Konfirmasi Pembayaran</h3>
    <p>Kirim bukti pembayaran Anda disini</p>
    <div class="alert alert-info">Total tagihan Anda <strong>Rp<?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Penyetor</label>
        <input type="text" name="nama" class="form-control">
      </div>
      <div class="form-group">
        <label>Bank</label>
        <input type="text" name="bank" class="form-control">
      </div>
      <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jumlah" min="1" class="form-control">
      </div>
      <div class="form-group">
        <label>Foto Bukti Pembayaran</label>
        <input type="file" name="bukti" class="form-control">
        <p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
      </div>
      <button class="btn btn-primary" name="kirim">Kirim</button>
    </form>
  </div>

  <?php
  // jika ada tombol Kirim
  if (isset($_POST["kirim"]))
  {
    //upload dulu foto bukti
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti,"bukti_pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    // simpan pembayaran
    $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

    // update status pembelian
    $koneksi->query("UPDATE pembelian SET status_pembelian='Belum Terima No. Resi' WHERE id_pembelian='$idpem'");

    echo "<script>alert('Terima kasih sudah mengirimkan bukti pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
  }
  ?>
</section>

</body>
</html>
