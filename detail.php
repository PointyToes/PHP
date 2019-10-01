<?php session_start(); ?>

<?php
include 'koneksi.php';
 ?>

<?php
 // mendapatkan id_produk dari url
 $id_produk = $_GET["id"];

 //query ambil data
 $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
 $detail = $ambil->fetch_assoc();
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <title>Detail Produk | AnjasStore</title>
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
 <body id="myPage">

   <?php include 'menu.php' ?>

    <!-- Product Details Container -->
     <div class="container" style="padding-top:30px;padding-bottom:40px">
       <div class="product-details-container">
         <div class="row">
           <!-- Product Viewer -->
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px">
               <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
             </div>
           <!-- /. End Product Viewer -->
           </div>
           <!-- Product Details -->
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:15px">
             <div>
               <h2><?php echo $detail["nama_produk"]; ?></h2>
               <h3 style="color:#b49dc2"><b>Rp<?php echo number_format($detail["harga_produk"]);  ?></b></h3>
               <h6 style="margin-top:10px">Stok : <?php echo $detail['stok_produk'] ?></h6>

             </div>
             <hr style="margin-bottom:10px">
             <form method="post">
               <div class="form-group">
                 <div class="input-group">
                   <label>Jumlah Beli :</label>
                   <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
                 </div>
                 <div style="padding-top:10px">
                   <button name="beli" class="btn btn-main">Beli</button>
                 </div>
               </div>
             </form>

             <?php
             // jk ada tombol Beli
             if (isset($_POST["beli"]))
             {
               // mendapatkan jumlah yg diinputkan
               $jumlah = $_POST["jumlah"];
               //masukkan di keranjang Belanja
               $_SESSION["keranjang"][$id_produk] = $jumlah;

               echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
               echo "<script>location='keranjang.php';</script>";
             }

              ?>

             <hr style="margin-top:30px">
             <div>
               <h4>Deskripsi Produk</h4>
               <p><?php echo $detail["deskripsi_produk"]; ?></p>
             </div>
           </div>
         </div>
       </div>
     <!-- /. End Product Details Container -->
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
