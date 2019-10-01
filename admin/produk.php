<h2>Data Produk</h2>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Berat (gr)</th>
        <th>Stok</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $nomor=1; ?>
      <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
      <?php while($pecah = $ambil->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $pecah['nama_produk']; ?></td>
        <td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
        <td><?php echo $pecah['berat_produk']; ?></td>
        <td><?php echo $pecah['stok_produk']; ?></td>
        <td>
          <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
        </td>
        <td>
          <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger">Hapus</a>
          <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-info">Ubah</a>
        </td>
      </tr>
      <?php $nomor++; ?>
      <?php } ?>
    </tbody>
  </table>
</div>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>
