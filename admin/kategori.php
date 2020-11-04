<?php  
include 'koneksi.php';
if (!isset($_SESSION['admin']))
{
  echo "<script>alert('anda harus login terlebih dahulu');</script>";
  echo "<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>
<h2>Kategori Produk</h2>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="bootstrap/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/datatable/datatable.min.css">
  <script type="text/javasript" src="assets/datatable/datatable.min.js"></script>
</head>
<body>
  <a href="index.php?halaman=tambahkategori" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Kategori</a>
  <br>
  <div class="container">
    <div class="col-md-6">
      <h3>Data Tabel Kategori</h3>
      <table class="table table-hover table-bordered" id="data">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Kategori</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
          <?php $nomor=1; ?>
          <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
              <td align="center"><?php echo $nomor++; ?></td>
              <td align="center"><?php echo $pecah['kategori']; ?></td>
              <td align="center">
                <a href="index.php?halaman=ubahkategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
                <a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn-danger btn"><i class="fa fa-remove"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <h3>Kategori Dengan Produk</h3>
      <div class="list-group" id="list-tab" role="tablist">

        <!-- SUDAH BENAR -->
        <?php $jumlah=$koneksi->query("SELECT COUNT(p.nama_produk) AS jumlah_produk, k.kategori FROM produk p LEFT JOIN kategori k ON p.id_kategori=k.id_kategori GROUP BY k.kategori"); ?>
        <?php while ($pisah = $jumlah->fetch_assoc()) { ?>
          <!-- menampilkan daftar kategori -->
          <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" role="tab" aria-controls="<?php echo $pisah['id_kategori'] ?>"><?php echo $pisah['kategori']; ?>
          <!-- menampilkan banyak produk pada id_kategori -->
          <span class="badge badge-primary badge-pill"><?php echo $pisah['jumlah_produk']; ?> </span>
        </a>
      <?php } ?>
    </div>
  </div>
</div>
</body>




