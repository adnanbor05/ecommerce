<?php include 'koneksi.php'; ?>
<?php 
$keyword=$_GET["keyword"];
$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' 
	OR deskripsi_produk LIKE '%$keyword%'");
while ($pecah=$ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/css/style.css">
		<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
</head>
<body style="margin-bottom: 0px;">
	<?php include 'menu.php'; ?><br>
	<section class="konten">
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3><br>
		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> tidak ditemukan </div>
		<?php endif ?>
		<div class="row">

			<?php foreach ($semuadata as $key => $value):?>
			<div class="col-md-3">
				<div class="card">
					<img src="foto produk/<?php echo $value["foto_produk"] ?>" alt="" class="card-img-top">
					<div class="card-body">
					<h3 class="card-title"><?php echo $value["nama_produk"] ?></h3>
					<h5><?php echo number_format($value['harga_produk']) ?></h5>
					<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Beli</a>
					<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-warning">Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>			
		</div>
	</div>
	</section>

	<br><br><br>
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

</body>
</html>