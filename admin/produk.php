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
<h2>Data Produk</h2>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Produk</a>
<table class="table table-bordered">
	<caption>Data produk yang ada</caption><br><br>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<thead>
		<tr>
			<th>No</th>
			<th class="text-center">Nama</th>
			<th class="text-center">Harga</th>
			<th class="text-center">Ukuran</th>
			<th class="text-center">Foto</th>
			<th class="text-center">Kategori</th>
			<th class="text-center">Stok</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody id="myTable">
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM produk 
		JOIN kategori ON produk.id_kategori=kategori.id_kategori
		JOIN ukuran ON produk.id_ukuran=ukuran.id_ukuran"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td align="center"><?php echo $nomor; ?></td>
			<td align="center"><?php echo $pecah['nama_produk']; ?></td>
			<td align="center"><?php echo $pecah['harga_produk']; ?></td>
			<td align="center"><?php echo $pecah['ukuran_produk']; ?></td>
			<td align="center">
				<img src="../foto produk/<?php echo $pecah['foto_produk'] ?>" width="100">
			</td>
			<td align="center"><?php echo $pecah['kategori']; ?></td>
			<td align="center"><?php echo $pecah['stok_produk']; ?></td>
			<td align="center">
				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn"><i class="fa fa-remove"></i> Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>