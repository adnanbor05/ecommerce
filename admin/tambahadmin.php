<h2>Tambah Admin Baru</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Admin Baru</label>
		<input type="text" name="nama" class="form-control" >
	</div>
	<div class="form-group">
		<label>E-mail</label>
		<input type="text" class="form-control" name="user" placeholder="E-mail">	
			
	</div>
		<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="password" required="@">
	</div>

	<div class="form-group">
	<label>Ganti foto</label>
	<input type="file" name="foto" class="form-control">		
	</div>


	<a href="index.php?halaman=profil" class="btn btn-primary">Batal</a>
	<button class="btn btn-primary" name="simpan">Simpan</button>


</form>

<?php  
if (isset($_POST['simpan']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasifoto, "../admin/foto_admin/$namafoto");
	$koneksi->query("INSERT INTO admin (nama_lengkap,username,password,foto_admin) VALUES 
		('$_POST[nama]','$_POST[user]','$_POST[password]','$namafoto')");

	echo "<script>alert('Data Admin Baru Tersimpan');</script>";
	echo "<script>location='index.php?halaman=profil';</script>";
}
?>
