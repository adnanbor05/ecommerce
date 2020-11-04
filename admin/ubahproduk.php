<h2>Ubah Produk</h2>
<?php 
include 'koneksi.php';
$ambil =$koneksi->query("SELECT * FROM produk 
	JOIN kategori ON produk.id_kategori=kategori.id_kategori
	JOIN ukuran ON produk.id_ukuran=ukuran.id_ukuran
	WHERE id_produk='$_GET[id]'");
$pecah =$ambil->fetch_assoc();
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Rp</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">	
	</div>

	<div class="form-group">
    <label for="exampleFormControlSelect1">Ukuran</label>
    <select class="form-control" id="exampleFormControlSelect1" name="ukuran">
      <option>--pilih ukuran--</option>
      <?php $row=array(); ?>
      <?php $ambil=$koneksi->query("SELECT * FROM ukuran"); ?>
      <?php while ($row = $ambil->fetch_assoc()) { ?>
			<?php
			echo "<option value='".$row['id_ukuran']."'>".$row['ukuran_produk']."</option>";
			?>
		<?php } ?>
    </select>
  	</div>
	<div class="form-group">
		<label>Ganti foto</label>
		<input type="file" name="foto" class="form-control">		
	</div>
	<div class="form-group">
    <label for="exampleFormControlSelect1">Kategori</label>
    <select class="form-control" id="exampleFormControlSelect1" name="kategori">
      <option>--pilih kategori--</option>
      <?php $row=array(); ?>
      <?php $ambil=$koneksi->query("SELECT * FROM kategori"); ?>
      <?php while ($row = $ambil->fetch_assoc()) { ?>
			<?php
			echo "<option value='".$row['id_kategori']."'>".$row['kategori']."</option>";
			?>
		<?php } ?>
    </select>
  	</div>
  	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>">	
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="10">
		<?php echo $pecah['deskripsi_produk']; ?>
		</textarea>		
	</div>
	<a href="index.php?halaman=produk" class="btn btn-primary">Batal</a>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php  
if (isset($_POST['ubah']))
{
	$kategori=$_GET['kategori'];
	$ukuran=$_GET['ukuran'];
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	//jika foto dibuah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto produk/$namafoto");

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',id_ukuran='$_POST[ukuran]',
			foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]',
			id_kategori='$_POST[kategori]',stok_produk='$_POST[stok]'
			WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',id_ukuran='$_POST[ukuran]',
			deskripsi_produk='$_POST[deskripsi]',id_kategori='$_POST[kategori]',
			stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('Data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>