<?php  
session_start();
include 'koneksi.php';
//jka tidak ada session pelanggan, maka tidak dapat cekout (login dahulu)
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Ups! silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) 
{
	echo "<script>alert('Ups! keranjang kosong, silahkan belanja dahulu')</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
  	<link rel="stylesheet" href="bootstrap/css/style.css">
</head>
<body>
<?php include 'menu.php'; ?>
	<br>
	<section class="conten">
		<div class="container">
			<h1>Keranjang belanja anda</h1><br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
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
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah["nama_produk"]; ?></td>
							<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo $jumlah; ?></td>
							<td>Rp. <?php echo number_format($subharga); ?></td>
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja += $subharga; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>RP. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>

			<form method="post">

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
				<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
			</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
				<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
			</div>
				</div>
				<div class="col-md-4">
					<select class="form-control" name="id_ongkir">
						<option value="">Pilih Ongkis Kirim</option>
						<?php  
						$ambil=$koneksi->query("SELECT * FROM ongkir");
						while ($perongkir = $ambil->fetch_assoc()) {
						?>
						<option value="<?php echo $perongkir["id_ongkir"] ?>">
							<?php echo $perongkir['nama_kota']; ?> -
							Rp. <?php echo number_format($perongkir['tarif']) ?>
						</option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat Lengkap Pengiriman</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="masukan alamat lenkap pengiriman( TERMASUK KODE POS ! )" required=""></textarea>
				
			</div>

			<a href="keranjang.php" class="btn btn-primary">Kembali</a>
			<button class="btn btn-success" name="checkout">Checkout</button>
			</form>

			<?php
			if (isset($_POST["checkout"])) 
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = $_POST["id_ongkir"];
				$tanggal_pembelian = date("y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$nama_kota=$arrayongkir['nama_kota'];
				$tarif = $arrayongkir['tarif'];
				$total_pembelian = $totalbelanja + $tarif;
				//1. menyimpan data ke tbl pembelian
				$koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
					VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");
				//mendpatkan id_pembelian_barusan
				$id_pembelian_barusan = $koneksi->insert_id;
				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
				{
					//mendapatkan data produk id_pembelian jika kenaikan harga
					$ambil=$koneksi->query("SELECT * FROM produk JOIN ukuran ON produk.id_ukuran=ukuran.id_ukuran  WHERE id_produk='$id_produk'");
					$perproduk=$ambil->fetch_assoc();
					$nama =$perproduk['nama_produk'];
					$harga =$perproduk['harga_produk'];
					$ukuran=$perproduk['ukuran_produk'];
					// //beda		
					// $subukuran=$perproduk['ukuran_produk'];
					$subharga=$perproduk['harga_produk']*$jumlah;

					$koneksi->query("INSERT INTO pembelian_produk (
						id_pembelian,id_produk,nama,harga,ukuran,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$ukuran','$subharga','$jumlah')");
					//update stok
					$koneksi->query("UPDATE produk SET stok_produk=stok_produk - $jumlah WHERE id_produk='$id_produk'");
				}
				//megkosongkan keranjang
				unset($_SESSION["keranjang"]);
				//tampilan dialihkan kehalaman nota pembelian
				echo "<script>alert('pembelian sukses!');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
			}
			?>
		</div>
	</section>


	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>