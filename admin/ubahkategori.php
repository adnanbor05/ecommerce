<h2>ubah produk</h2>
<?php 
include 'koneksi.php';
$ambil =$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah =$ambil->fetch_assoc();

?>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['kategori']; ?>">
	</div>
	<a href="index.php?halaman=kategori" class="btn btn-info">Batal</a>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php  
if (isset($_POST['ubah']))
{
	$koneksi->query("UPDATE kategori SET kategori='$_POST[nama]'
		WHERE id_kategori='$_GET[id]'");
	echo "<script>alert('Data kategori telah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}
?>