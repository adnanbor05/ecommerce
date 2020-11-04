<?php 
session_start();
include 'koneksi.php';
//jika pelanggan belum login
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan ogin dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>DAC STORE</title>
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
  	<link rel="stylesheet" href="bootstrap/css/style.css">
</head>
<body style="margin-bottom: 0px;">
	<?php include 'menu.php'; ?>

	<section class="riwayat">
		<div class="container"><br>
			<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3><br>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php  
					$nomor=1;
					//mendapatkan id_pelanggan
					$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					WHILE($pecah = $ambil->fetch_assoc()){
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
						<td>
							<?php echo $pecah["status_pembelian"]; ?>
							<br>
							<?php if (!empty($pecah['resi_pengiriman'])): ?>
								Resi: <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>
						</td>
						<td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
							<?php if ($pecah['status_pembelian']=="pending"):?>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" class="btn btn-success">
							Input Pembayaran
							</a>
							<?php else: ?>
								<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" class="btn btn-warning">Lihat Pembayaran</a>
							<?php endif ?>
						</td>
					</tr>
					<?php $nomor++; ?>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</section><br><br><br><br><br>

	<div id="footer" style="background: #e6ebf0; color: #000;" class="p-5">
		<!-- start: Container -->
		<div class="container">
			<!-- start: Row -->
			<div class="row">
				<!-- start: About -->
				<div class="col-md-3">
					<h3>Tentang DAC|STORE</h3>
					<p class="text-monospace">
						DAC Store adalah toko online yang bergerak di bidang fasion, sasaran kami semua kalangan baik muda maupun tua, mulai dari anak - anak dan orang dewasa.
					</p>
				</div>
				<!-- end: About -->
				
				<div class="col-md-3">
					<h3>Mitra Kerja Sama</h3>
					<ul class="text-monospace">
						<li>JNE</li>
						<li>J&T</li>
						<li>PT. POS Indonesia</li>
						<li>TIKI</li>
					</ul>
				</div>
				<!-- start: Photo Stream -->
				<div class="col-md-3">
					<h3>Alamat Kami</h3>
					<p class="text-monospace">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Perum taman lasrana RT07/22, Kabupaten Sleman, Yogyakarta 55284.
					</p>
					<p class="text-monospace">
						<i class="fa fa-envelope-open" aria-hidden="true"></i><a href="mailto:Dacstore@gmail.com"> Dacstore@gmail.com</a> / <a href="mailto:diennar@gmail.com"> diennar@gmail.com</a>
					</p>
				</div>
				<div class="col-md-3" >
					<img src="img/bri.png" alt="" style="height: 50px;">
					<img src="img/bca.png" alt="" style="height: 50px;">
					<img src="img/mandiri.png" alt="" style="height: 50px;">
				</div>
			</div>
		</div>
		<!-- start: Copyright -->
		<div id="copyright">
			<div class="container">
				<p class="text-center">
					Copyright &copy; <a href="">DAC|STORE 2019</a>
				</p>
			</div>
		</div>	
	</div

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>