<?php  
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
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
	<!-- navbar -->
	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container"><br>
			<!--nota sama saja dengan admin-->
			<h2>Detail Nota Pembelian</h2><br>
<?php 
$ambil=$koneksi->query("SELECT  * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc();
?>
<!--keamanan data pembelian jika id pelanggan berbeda-->
<?php  
//mendapatkan id_pelanggan yg beli
$idpelangganyangbeli = $detail["id_pelanggan"];
//mendaptkan id_pelnggan yang login
$idpelangganyagnlogin = $_SESSION["pelanggan"]["id_pelanggan"];
if ($idpelangganyangbeli!==$idpelangganyagnlogin) 
{
	echo "<script>alert('jangan nakal!');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>



<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong><br>
		tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
		Total : Rp. <?php echo number_format($detail['total_pembelian']) ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
		<p>
			No.HP   : <?php echo $detail['telepon_pelanggan']; ?> <br>
			E-mail  : <?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
	<h3>Pengiriman</h3>
	<strong><?php echo $detail['nama_kota'] ?></strong><br>
	<p>
	Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
	Alamat : <?php echo $detail['alamat_pengiriman']; ?>
	</p>
	</div>
</div>

<table class="table table-bordered">
	<caption>Detail Pembelian</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Ukuran</th>
			<th>Jumlah</th>
			<th>Sub Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['ukuran']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
<div class="row" align="center">
	<div class="col-md-12" align="center">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran senilai Rp. 
				<?php echo number_format($detail['total_pembelian']);?> Ke <br>
				<strong>BANK BRI XXX-XXX-XXX-XXX AN. DAC STORE</strong>
			</p>
		</div>
	</div>
</div>
<div class="row" align="center">
	<div class="col-md-12">
		<div class="alert alert-info">
			<p>
				Setelah melakukan pembayaran, Tunggu konfirmasi untuk mendapatkan
				<strong>No RESI PENGIRIMAN BARANG</strong>
			</p>
		</div>
	</div>
</div>
<a align="center" href="riwayat.php" class="btn btn-primary">kembali</a><br><br><br>
			
</div>

	</section>

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>