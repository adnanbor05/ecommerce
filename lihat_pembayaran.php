<?php  
session_start();
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

//falidasi untuk mengambil id lain
if (empty($detbay)) 
{
	echo "<script>alert('anda tidak berhak');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
//falidasi pengambilan id orang lain
if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]) 
{
	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain!');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
	<link rel="stylesheet" href="bootstrap/css/style.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<br><br>
	<div class="container">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<thead>
						<tr>
							<div class="col-md-6"></div>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nama</td>
							<td><?php echo $detbay["nama"]; ?></td>
						</tr>
						<tr>
							<td>BANK</td>
							<td><?php echo $detbay["bank"]; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td><?php echo $detbay["tanggal"]; ?></td>
						</tr>
						<tr>
							<td><strong>JUMLAH</strong></td>
							<td><strong>Rp. <?php echo number_format($detbay["jumlah"]); ?></strong></td>
						</tr>
					</tbody>
				</table>
				<a align="center" href="Riwayat.php" class="btn btn-primary">Kembali</a><br>
			</div>
			<div class="col-md-6">
				<p>Gambar Bukti Pembayaran</p>
				<div class="card"  style=" margin: auto;"> 
				<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" style="height: 500px;">
				</div>
			</div>
		</div>
		
	</div><br><br><br>


	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>