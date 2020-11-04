<h2>Tambah Kategori</h2>
<form method="POST" >
	<div class="col-md-3">
	<div class="form-group">
		<label>kategori</label>
		<input type="text" class="form-control" name="kategori">
	</div>
	<a href="index.php?halaman=kategori" class="btn btn-info">Batal</a>
	<button type="submit" name="save" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
	</div>
</form><br>
<?php  
//jika tbl save ditekan, ojek menjalankan simpan_kategori(data dari form)
if (isset($_POST['save'])) 
{
	$kategori=$_POST['kategori'];
	$koneksi->query("INSERT INTO kategori
		(kategori) VALUES ('$_POST[kategori]')");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
}
?>