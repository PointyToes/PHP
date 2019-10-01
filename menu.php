<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Anjas Store</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><span class="glyphicon glyphicon-home logo-extra-small"></span> Home</a></li>
        <li><a href="katalog.php"><span class="glyphicon glyphicon-th logo-extra-small"></span> Katalog Produk</a></li>
        <li><a href="keranjang.php"><span class="glyphicon glyphicon-shopping-cart logo-extra-small"></span> Keranjang</a></li>
        <!-- jk sudah login (ada session pelanggan) -->
        <?php if(isset($_SESSION["pelanggan"])): ?>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user logo-extra-small"></span></a>
          <ul class="dropdown-menu">
            <li><a href="riwayat.php">Riwayat Pembelian</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
          </ul>
        </li>
        <!-- selain itu (blm login||blm ada session pelanggan) -->
        <?php else: ?>
          <li><a href="login.php"><span class="glyphicon glyphicon-user logo-extra-small"></span> Masuk</a></li>
          <li><a href="daftar.php"><span class="glyphicon glyphicon-plus logo-extra-small"></span> Daftar</a></li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
