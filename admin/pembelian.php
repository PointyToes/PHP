<h2>Data Penjualan</h2>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal</th>
        <th>Status Pembelian</th>
        <th>Total Penjualan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $nomor=1; ?>
      <?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
      <?php while($pecah = $ambil->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $pecah['nama_pelanggan']; ?></td>
        <td><?php echo $pecah['tanggal_pembelian']; ?></td>
        <td><?php echo $pecah['status_pembelian']; ?></td>
        <td>Rp<?php echo number_format($pecah['total_pembelian']); ?></td>
        <td>
          <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-primary">Detail</a>

          <a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
        </td>
      </tr>
      <?php $nomor++; ?>
      <?php } ?>
    </tbody>
  </table>
</div>
