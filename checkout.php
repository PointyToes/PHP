<?php
session_start();
include 'koneksi.php';

// jk tidak ada session pelanggan (blm login) maka dilarikan ke login.php
if (!isset($_SESSION["pelanggan"]))
{
  echo "<script>alert('Silakan Login');</script>";
  echo "<script>location='login.php';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checkout | AnjasStore</title>
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
  <div class="row">
    <div class="col-lg-8 col-md-12">
      <!-- Shopping Cart -->
      <div class="col-lg-12" style="background-color:#b49dc2;font-weight:bold;padding:15px;color:#fffffe">
        <i class="fas fa-shopping-cart"></i> Shopping Cart
      </div>
      <div class="col-lg-12" style="background-color:#fffffe;padding:0;color:#333;border:1px solid #b49dc2;margin-bottom:20px">
        <div class="table-responsive">
          <table id="productCartTable" class="table">
            <thead>
              <tr style="font-weight:bold">
                <td width="40%" style="padding-top:15px;padding-bottom:15px">Product</td>
                <td width="15%" style="padding-top:15px;padding-bottom:15px">Price</td>
                <td width="15%" style="padding-top:15px;padding-bottom:15px;text-align:center">Qty</td>
                <td width="15%" style="padding-top:15px;padding-bottom:15px">Total</td>
              </tr>
            </thead>
            <tbody>
              <?php $totalbelanja = 0; ?>
              <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
              <!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
              <?php
              $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
              $pecah = $ambil->fetch_assoc();
              $subharga = $pecah["harga_produk"]*$jumlah;
              ?>
              <tr>
                <td><a href="#">
                  <div class="media">
                    <div class="media-left">
                      <img src="foto_produk/<?php echo $pecah["foto_produk"]; ?>" alt="" width="75px">
                    </div>
                    <div class="media-body">
                      <p><?php echo $pecah["nama_produk"]; ?></p>
                    </div>
                  </div>
                </a></td>
                <td>Rp<?php echo number_format ($pecah["harga_produk"]); ?></td>
                <td style="text-align:center">
                  <?php echo $jumlah; ?>
                </td>
                <td>Rp<?php echo number_format($subharga); ?></td>
              </tr>
              <?php $totalbelanja+=$subharga; ?>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <th colspan="3">Total Belanja</th>
              <th>Rp<?php echo number_format($totalbelanja) ?></th>
            </tfoot>
          </table>
        </div>
      <!-- /. End Shopping Cart -->
      </div>
    </div>
    <div class="col-lg-4 col-md-12">
      <!-- Shipping Details -->
      <div class="col-lg-12 col-sm-12" style="background-color:#b49dc2;font-weight:bold;padding:15px;color:#fffffe">
        <i class="fas fa-truck"></i> Shipping Details
      </div>
      <div class="col-lg-12 col-sm-12" style="border:1px solid #b49dc2;padding:15px">
        <form method="post">
          <div class="form-group">
            <input class="form-control" type="text" value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" readonly>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap Pengiriman</label>
            <textarea class="form-control" name="alamat_pengiriman" rows="5" placeholder="Masukkan alamat lengkap pengiriman" required></textarea>
          </div>
          <div class="form-group">
            <select class="form-control pull-right" name="id_ongkir" style="width:100%">
              <option value="base">- Select Region -</option>
              <?php
              $ambil = $koneksi->query("SELECT * FROM ongkir");
              while($perongkir = $ambil->fetch_assoc()) {
              ?>
              <option value="<?php echo $perongkir["id_ongkir"] ?>">
                <?php echo $perongkir['nama_kota'] ?> -
                Rp<?php echo number_format($perongkir['tarif']) ?>
              </option>
              <?php } ?>
            </select>
          </div>
          <div style="text-align:right">
            <button name="checkout" class="btn btn-main" style="margin-top:15px">Checkout</button>
          </div>
        </form>
        <?php
        if (isset($_POST["checkout"]))
        {
          $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
          $id_ongkir = $_POST["id_ongkir"];
          $tanggal_pembelian = date("Y-m-d");
          $alamat_pengiriman = $_POST['alamat_pengiriman'];

          $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
          $arrayongkir = $ambil->fetch_assoc();
          $nama_kota = $arrayongkir['nama_kota'];
          $tarif = $arrayongkir['tarif'];

          $total_pembelian = $totalbelanja + $tarif;

          // 1. menyimpan data ke tabel pembelian_produk
          $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

          // mendapatkan id_pembelian barusan terjadi
          $id_pembelian_barusan = $koneksi->insert_id;

          foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
          {
            //mendapatkan data produk berdasarkan id_produk
            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $perproduk = $ambil->fetch_assoc();

            $nama = $perproduk['nama_produk'];
            $harga = $perproduk['harga_produk'];
            $berat = $perproduk['berat_produk'];

            $subberat = $perproduk['berat_produk']*$jumlah;
            $subharga = $perproduk['harga_produk']*$jumlah;

            $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

            // skrip update stok
            $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
          }

          // mengkosongkan keranjang belanja
          unset($_SESSION["keranjang"]);

          // tampilan dialihkan ke halaman nota, nota dari pembelian barusan
          echo "<script>alert('Pembelian Sukses');</script>";
          echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
        ?>
      <!-- /. End Shipping Details -->
      </div>
    </div>
  </div>
</div>


<footer class="container-fluid text-center">
  <p>&copy 2019 by AnjasStore</p>
</footer>


</body>
</html>
