<?php
session_start();
include 'koneksi.php';

//mendapatkan id dari url
$id_produk = $_GET["id"];
//ambil data
$ambil =$koneksi->query("SELECT * FROM produk 
	JOIN kategori ON produk.id_kategori=kategori.id_kategori
	JOIN ukuran ON produk.id_ukuran=ukuran.id_ukuran
	WHERE id_produk='$id_produk'");
$detail =$ambil->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
	<style type="text/css" media="screen">
		img {
			vertical-align: middle;
			border-style: none;
			
		}
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
		/* zoom */
		* {box-sizing: border-box;}

		.img-magnifier-container {
		  position:relative;
		}

		.img-magnifier-glass {
		  position: absolute;
		  border: 0px solid #000;
		  border-radius: 50%;
		  cursor: none;
		  /*Set the size of the magnifier glass:*/
		  width: 200px;
		  height: 200px;
		}
		/* end zoom */
		
	</style>
	<script>
	  function magnify(imgID, zoom) {
	  var img, glass, w, h, bw;
	  img = document.getElementById(imgID);
	  /*create magnifier glass:*/
	  glass = document.createElement("DIV");
	  glass.setAttribute("class", "img-magnifier-glass");
	  /*insert magnifier glass:*/
	  img.parentElement.insertBefore(glass, img);
	  /*set background properties for the magnifier glass:*/
	  glass.style.backgroundImage = "url('" + img.src + "')";
	  glass.style.backgroundRepeat = "no-repeat";
	  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
	  bw = 3;
	  w = glass.offsetWidth / 2;
	  h = glass.offsetHeight / 2;
	  /*execute a function when someone moves the magnifier glass over the image:*/
	  glass.addEventListener("mousemove", moveMagnifier);
	  img.addEventListener("mousemove", moveMagnifier);
	  /*and also for touch screens:*/
	  glass.addEventListener("touchmove", moveMagnifier);
	  img.addEventListener("touchmove", moveMagnifier);
	  function moveMagnifier(e) {
	    var pos, x, y;
	    /*prevent any other actions that may occur when moving over the image*/
	    e.preventDefault();
	    /*get the cursor's x and y positions:*/
	    pos = getCursorPos(e);
	    x = pos.x;
	    y = pos.y;
	    /*prevent the magnifier glass from being positioned outside the image:*/
	    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
	    if (x < w / zoom) {x = w / zoom;}
	    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
	    if (y < h / zoom) {y = h / zoom;}
	    /*set the position of the magnifier glass:*/
	    glass.style.left = (x - w) + "px";
	    glass.style.top = (y - h) + "px";
	    /*display what the magnifier glass "sees":*/
	    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
	  }
	  function getCursorPos(e) {
	    var a, x = 0, y = 0;
	    e = e || window.event;
	    /*get the x and y positions of the image:*/
	    a = img.getBoundingClientRect();
	    /*calculate the cursor's x and y coordinates, relative to the image:*/
	    x = e.pageX - a.left;
	    y = e.pageY - a.top;
	    /*consider any page scrolling:*/
	    x = x - window.pageXOffset;
	    y = y - window.pageYOffset;
	    return {x : x, y : y};
	  }
	}
	</script>
</head>
<body>
	<!-- navbar -->
	<?php include 'menu.php'; ?>
	<br>

	<section class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="card"  style=" margin: auto;"> 
						<img id="myimage" src="foto produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-thumbnail" style="height: 500px;">
					</div>					
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail["nama_produk"]; ?></h2>
					<h4>Kategori : <?php echo $detail["kategori"]; ?></h4>
					<h5>Stok : <?php echo $detail['stok_produk'] ?></h5>
					<h5>Ukuran : <?php echo $detail['ukuran_produk']; ?></h5>
					<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

					<form method="post">
						<div class="form-group">
							<div class="input-group">								
								<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>" required>
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>

					<?php
					//jika produk dibeli
					if (isset($_POST["beli"])) 
					{
						//mendapatkan jumlah yang diinputkan
						$jumlah=$_POST["jumlah"];

						//masukan kekeranjang
						$_SESSION["keranjang"][$id_produk] = $jumlah;

						echo "<script>alert('produk telah masuk keranjang belanja');</script>";
						echo "<script>location='keranjang.php';</script>";
					}
					?>
					<p><?php echo $detail ["deskripsi_produk"]; ?></p>
				</div>
			</div>
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
	<script>
	/* Initiate Magnify Function
	with the id of the image, and the strength of the magnifier glass:*/
	magnify("myimage", 3);
	</script>

	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>