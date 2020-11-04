<h1>Tambah Produk</h1>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">	
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
			<label>Harga (Rp)</label>
			<input type="number" class="form-control" name="harga">	
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea class="form-control" name="deskripsi" rows="10"></textarea>
		</div>	
		<div class="form-group">
			<label>Foto</label>
			<input type="file" class="form-control" name="foto">	
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
			<input type="number" class="form-control" name="stok">	
		</div>
		<a href="index.php?halaman=produk" class="btn btn-info">Batal</a>
		<button class="btn btn-primary" name="save">Simpan</button>
	</form>
	<?php  
	if (isset($_POST['save']))
	{
	//method nya post 
		$kategori=$_GET['kategori'];
		$ukuran=$_GET['ukuran'];
		$nama=$_FILES['foto']['name'];
		$lokasi=$_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto produk/".$nama);
		$koneksi->query("INSERT INTO produk
			(nama_produk,harga_produk,id_ukuran,foto_produk,deskripsi_produk,id_kategori,stok_produk)
			VALUES ('$_POST[nama]','$_POST[harga]','$_POST[ukuran]','$nama','$_POST[deskripsi]','$_POST[kategori]','$_POST[stok]')");
		echo "<script>alert('Data Tersimpan');</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
	?>