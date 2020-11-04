<?php  
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftat Member</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
<body style="margin-bottom: 0px;">

	<?php include 'menu.php'; ?>

	<div class="container">
		<div class="row text-center ">
			<div class="col-md-12">
				<br /><br />
				<h1> Form Pendaftaran Member</h1>
				<br />
			</div>
		</div>
	</div>

	<section class="container">
		<div class="row">
			<div class="col-md-10 offset-md-3">
				<div class="panel panel-heading">
					<div class="panel-body">
						<form method="post" class="form-horizontal" >
							<div class="form-group">
								<label class="control-label col-md-3">Nama Lengkap</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" pattern="[A-Za-z ]+" title="Masukan huruf A-Z">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">E-mail</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email" required="" pattern="[^ @]*@[^ @]*.[a-zA-Z]{2,}" title="Masukan email yang valid">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="password" required="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat" required=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Telp/HP</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="telepon" required="" pattern="[0-9]+{13}" title="Masukan angka 0-9">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar">Daftar</button>
								</div>							
							</div>

						</form>
						<?php  
					//jika ada pendaftaran baru
						if (isset($_POST["daftar"])) 
						{
						//mengambil inputan data
							$nama =$_POST["nama"];
							$email =$_POST["email"];
							$password =$_POST["password"];
							$alamat =$_POST["alamat"];
							$telepon =$_POST["telepon"];

							$ambil=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
							$cek = mysqli_num_rows($ambil);
							if ($cek>0) 
							{
								$data=mysqli_fetch_assoc($ambil);
								echo "<script>alert('Pendaftaran gagal, E-mail sudah digunakan');</script>";
								echo "<script>location='daftar.php';</script>";
							} else {
								mysqli_query($koneksi,"INSERT INTO pelanggan(
									email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
									VALUES ('$email','$password','$nama','$telepon','$alamat')");

								echo "<script>alert('Pendaftaran SUKSES, Silahkan Login');</script>";
								echo "<script>location='login.php';</script>";
							}

						}

						?>



					</div>
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