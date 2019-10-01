<?php
session_start();
//koneksi ke SQLiteDatabase
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home | Anjas Store</title>
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
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php include 'menu.php' ?>

<div class="jumbotron text-center">
  <h1>Anjas Store</h1>
  <p>Karena Kami Selalu Berinovasi untuk menciptakan yang terbaru untuk anda </p>
</div>

<!-- Container (Services Section) -->
<div class="container-fluid text-center">
    <h1 class="title-product">Katalog Produk Kami</h1>
</div>

<div id="shop" class="container-fluid">
  <div class="row">
    <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
    <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
      <div class="item">
        <div class="panel panel-default text-center">
          <div class="panel-heading">
            <img class="img-responsive" src="foto_produk/<?php echo $perproduk['foto_produk'] ?>">
          </div>
          <div class="panel-body">
            <h3><?php echo $perproduk['nama_produk'] ?></h3>
          </div>
          <div class="panel-footer">
            <h3>IDR <?php echo number_format ($perproduk['harga_produk']); ?></h3>
            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-lead">Beli</a>
            <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-main">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
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

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
