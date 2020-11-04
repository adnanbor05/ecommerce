<?php 
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>DAC STORE</title>
	<!-- font -->
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
	<!-- end font -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="bootstrap/css/style.css">

	<style type="text/css">
		.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
			position: relative;
			width: auto;
			padding-right: 15px;
			padding-left: 15px;
			padding-block-end: 30px;
		}
		element.style {
			font-size: large;
		}
		
		
	</style>
</head>
<body style="margin-bottom: 0px;">
	<?php include 'menu.php'; ?><br>
	<section class="konten">
		<div class="container">
			<div class="col-md-12 ml-6 sm-6">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="admin/slider/banner1.png" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">

							</div>
						</div>
						<div class="carousel-item">
							<img src="admin/slider/banner2.png" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								
							</div>
						</div>
						<div class="carousel-item">
							<img src="admin/slider/banner3.png" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<h1>Produk Terbaru</h1>
			<div class="row">
				<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
				<?php while($perproduk=$ambil->fetch_assoc()) { ?>
					<div class="col-md-3">
						
						<div class="card">
							<img src="foto produk/<?php echo $perproduk['foto_produk']; ?>" class="card-img-top" alt="">
							<div class="card-body">
								<h5 class="card-title"><?php echo $perproduk['nama_produk']; ?></h5>
								<h3>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h3>
								<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Beli</a>
								<a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-warning">Detail</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section><br><br><br>

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
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>