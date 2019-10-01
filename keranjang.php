<?php
session_start();

//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";

include 'koneksi.php';


if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
  echo "<script>alert('keranjang kosong, silakan belanja dulu');</script>";
  echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Keranjang | AnjasStore</title>
  <link rel="icon" href="img/favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/w3.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.min.css">

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/all.min.js"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php include 'menu.php' ?>

<div class="container" style="padding-top:30px;padding-bottom:30px">
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
            <td width="15%" style="padding-top:15px;padding-bottom:15px"></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
          <!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
          <?php
          $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
          $pecah = $ambil->fetch_assoc();
          $subharga = $pecah["harga_produk"]*$jumlah;

          //echo "<pre>";
          //print_r($pecah);
          //echo "</pre>";
          ?>
          <tr>
            <td><a href="#">
              <div class="media">
                <div class="media-left">
                  <img src="foto_produk/<?php echo $pecah["foto_produk"]; ?>" alt="" width="80px">
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
            <td>
              <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
            <!--td colspan="5" style="text-align:center">No Results!</td-->
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <!-- /. End Shopping Cart -->
  </div>
  <div class="" style="text-align:right;padding-bottom:20px">
    <a href="index.php" class="btn btn-default">Continue Shopping</a>
    <a href="checkout.php" class="btn btn-main">Checkout</a>
  </div>
</div>

<footer class="page-footer text-center font-small pt-4">
    <div class"text-center">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
    </div>

   <!-- Footer Links -->
  <div class="container-fluid">

    <!-- Grid row -->
    <div class="row col-md-12">

      <!-- Grid column -->
      <div class="text-left col-md-6 mt-md-0 mt-5" style="padding-left: 150px;">

        <!-- Content -->
        <h5 class="text-uppercase">Anjas Store</h5>
        <p>Sebuah Brand Apparel lokal yang dibuat dengan bahan berkualitas tinggi dan mengikuti trend masa kini, kami akan selalu berinovasi untuk menciptakan yang terbaru untuk anda.</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="text-left col-md-6 mt-md-0 mt-5" style="padding-left: 150px;">

        <!-- Content -->
        <h5 class="text-uppercase">Kontak Kami</h5>
        <p>📲 WhatsApp/SMS  : +62 838-0824-0280 (no call)</p>
        <p>📩 Email : Anjasstore.id@gmail.com</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright By
        <a href="http://anjas.second-handed.store/"> AnjasStore</a>
    </div>
  <!-- Copyright -->

</footer>

</body>
</html>
