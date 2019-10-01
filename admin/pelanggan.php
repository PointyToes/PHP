<h2>Daftar Pelanggan</h2>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Pelanggan</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $nomor=1; ?>
      <?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
      <?php while($pecah = $ambil->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $pecah['nama_pelanggan']; ?></td>
        <td><?php echo $pecah['email_pelanggan']; ?></td>
        <td><?php echo $pecah['telepon_pelanggan']; ?></td>
        <td><?php echo $pecah['alamat_pelanggan']; ?></td>
        <td>
          <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
        </td>
      </tr>
      <?php $nomor++; ?>
      <?php } ?>
    </tbody>
  </table>
</div>
