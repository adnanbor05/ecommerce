<?php 
session_start();

include 'koneksi.php';

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) 
{
	echo "<script>alert('keranjang kosong, silahkan belanja dahulu')</script>";
	echo "<script>location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
  	<link rel="stylesheet" href="bootstrap/css/style.css">
</head>
<body style="margin-bottom: 0px;">
	<!-- navbar -->
	<?php include 'menu.php'; ?>
	<br>
	<section class="conten">
		<div class="container">
			<h1>Keranjang belanja anda</h1><br>
			<table class="table table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="text-center" scope="col">No</th>
						<th class="text-center" scope="col">Produk</th>
						<th class="text-center" scope="col">Harga</th>
						<th class="text-center" scope="col">Jumlah</th>
						<th class="text-center" scope="col">Subharga</th>
						<th class="text-center" scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja =0; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<!--menampilkan produk yang sedang dibeli di keranjang berdasarkan id_produk-->
						<?php
						$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah["harga_produk"]*$jumlah; 
						?>
						<tr>
							<th align="center" class="text-center"><?php echo $nomor; ?></th>
							<td align="center"><?php echo $pecah["nama_produk"]; ?></td>
							<td align="center">Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
							<td align="center"><?php echo $jumlah; ?></td>
							<td align="center">Rp. <?php echo number_format($subharga); ?></td>
							<td align="center">
								<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i> Hapus</a>
							</td>
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja += $subharga; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot class="thead-light">
					<tr>
						<th colspan="4">Total Belanja</th>
						<th colspan="2">RP. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>	
			<a href="index.php" class="btn btn-info"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">CheckOut</a>


		</div>
	</section><br><br><br><br><br><br><br><br>

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
					<img src="img/bri.png" alt="" style="height: 50px;">
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
	</div>


	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>