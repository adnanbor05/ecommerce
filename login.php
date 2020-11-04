<?php 
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Member Pelanggan</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- BOOTSTRAP STYLES-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
<body>
	<?php include 'menu.php'; ?>
	<section class="container">
		<div class="row text-center ">
			<div class="col-md-12">
				<br /><br />
				<h1> Login Pelanggan</h1>
				<br />
			</div>
		</div>
	<div class="row ">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>Login sebagai Member</strong>
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group ">
									<label><i class="fa fa-tag"  ></i> E-mail</label>
									<input type="email" class="form-control" name="email" placeholder="E-mail" required="" pattern="[^ @]*@[^ @]*.[a-zA-Z]{2,}" title="Masukan email yang valid">
								</div>
								<div class="form-group">
									<label><i class="fa fa-lock"  ></i> Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" required="">
								</div>
								<button class="btn btn-primary" name="login">Login</button>

							</form>
							<?php
							//jika tombol login ditekan
							if (isset($_POST["login"]))
							{
								$email = $_POST["email"];
								$password = $_POST["password"];
								//cek database pelanggan
								$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

								//hitung akun yang diambil
								$akunyangcocok = $ambil->num_rows;

								//jika 1 akun yang cocok, maka login
								if ($akunyangcocok==1) 
								{
									//anda sudah login
									//mendapatkan akun dlm bntuk array
									$akun = $ambil->fetch_assoc();
									//simpan di session pelanggan
									$_SESSION["pelanggan"] = $akun;
									echo "<script>alert('anda sukses login');</script>";
									if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
									{
										echo "<script>location='checkout.php';</script>";
									}
									else
									{
										echo "<script>location='riwayat.php';</script>";
									}

								}
								else
								{
									//anda gagal login
									echo "<script>alert('anda gagal login, periksa akun anda');</script>";
									echo "<script>location='login.php';</script>";
								}
							}  
							?>
						</div>
					</div>
				</div>
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

	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="assets/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="assets/js/custom.js"></script>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>