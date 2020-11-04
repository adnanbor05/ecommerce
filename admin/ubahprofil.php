<h2>Ubah Profil Admin</h2>
<?php 
include 'koneksi.php';
$ambil =$koneksi->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah =$ambil->fetch_assoc();
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Admin Baru</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_lengkap']; ?>">
	</div>
	<div class="form-group">
		<label>E-mail</label>
		<input type="text" class="form-control" name="user" value="<?php echo $pecah['username']; ?>" placeholder="E-mail">	
	</div>
		<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="password" value="<?php echo $pecah['password']; ?>">
	</div>
	<div class="form-group">
	<label>Ganti foto</label>
	<input type="file" name="foto" class="form-control">		
	</div>
	<a href="index.php?halaman=profil" class="btn btn-primary">Batal</a>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php  
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	//jika foto dibuah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../admin/foto_admin/$namafoto");

		$koneksi->query("UPDATE admin SET nama_lengkap='$_POST[nama]',
			username='$_POST[user]',password='$_POST[password]',
			foto_admin='$namafoto'
			WHERE id_admin='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE admin SET nama_lengkap='$_POST[nama]',
			username='$_POST[user]',password='$_POST[password]',
			WHERE id_admin='$_GET[id]'");
	}
	echo "<script>alert('Data profil Admin telah diubah');</script>";
	echo "<script>location='index.php?halaman=profil';</script>";
}
?>