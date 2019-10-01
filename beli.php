<?php
session_start();
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// Jika sudah ada produk itu di keranjang, maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_produk]))
{
  $_SESSION['keranjang'][$id_produk]+=1;
}

// Selain itu (blm ada di keranjang), maka produk itu dianggap dibeli 1
else {
  $_SESSION['keranjang'][$id_produk]=1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

// Larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>
