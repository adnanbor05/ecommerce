<?php 
session_start();
include 'koneksi.php';
//jika pelanggan belum login
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan ogin dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
//mendapatkan id dari url
$idpem =$_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();
//mendapatkan id_plgn yg beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mndptkan id plgn yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];
if ($id_pelanggan_login !== $id_pelanggan_beli) 
{
	echo "<script>alert('Jangan nakal);</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css" media="screen">
		/* navbar */
		@font-face {
			font-family: fontnav;
			src: url(bootstrap/fonts/Viga-Regular.ttf);
		}
		.navbar-brand {
			font-family: 'fontnav';
			font-size: 17pt;
		}
		.nav-item{
			font-family: 'fontnav';
		}
		/* end navbar */
		/* body */
		@font-face {
			font-family: tulisan_keren;
			src: url(bootstrap/fonts/BebasNeue-webfont.ttf);
		}
		h2, h3, h4, h5, h6 {
			font-family: 'tulisan_keren';
			font-size: 20pt;
			font-variant: inherit;
		}
		h1{
			font-family: 'tulisan_keren';
			font-size: 40pt;
		}
		/* end body */
	</style>
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container"><br>
		<h2>konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran anda disini</p>
		<div class="alert alert-info">Total tagihan anda
			<strong>
				Rp. <?php echo number_format($detpem["total_pembelian"]) ?>
			</strong>
		</div>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama" required="" pattern="[A-Za-z]{1}+" title="Masukan huruf A-Z">
			</div>
			<div class="form-group">
				<label>BANK</label>
				<input type="text" class="form-control" name="bank" required="" pattern="[A-Za-z]+" title="Masukan huruf A-Z">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1" required="">
			</div>
			<div class="form-group">
				<label>Foto Bukti Pembayaran</label>
				<input type="file" class="form-control" name="bukti" required="">
				<p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

	<?php  
	//jika ada tombol kirim
	if (isset($_POST["kirim"])) 
	{
		//upload dulu foto bukti
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$namafiks = date("YmdHis").$namabukti;
		move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
		
		$nama = $_POST["nama"];
		$bank = $_POST["bank"];
		$jumlah = $_POST["jumlah"];
		$tanggal = date("y-m-d");

		//simpan pembayaran
		$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
			VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

		//update tble pembelian status
		$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran'
			WHERE id_pembelian='$idpem'");

		echo "<script>alert('Terimakasih sudah mengrim pembayaran);</script>";
		echo "<script>location='riwayat.php';</script>";
	}
	?>
<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>