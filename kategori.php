<?php 
session_start();
include 'koneksi.php';


// echo "<pre>";
// print_r($id);
// echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kategori</title>
  <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="bootstrap/css/style.css">
  <style type="text/css" media="screen">
    img {
      vertical-align: middle;
      border-style: none;
      height: 290px;
    }
  </style>
</head>
<body style="margin-bottom: 0px;">
  <?php include 'menu.php'; ?>
  <br>
  <div class="container">
    <h3>KATEGORI PRODUK </font></h3>
    <br>
    <div class="row">
    <!-- TINGGAL MENAMPILKAN DATA BARANG SESUAI KATEGORI (cari idnya dulu) -->
    <?php $id = $_GET["id"]; ?>
    <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_kategori='$id'"); ?>
    <?php while($perproduk=$ambil->fetch_assoc()) { ?>
      <div class="col-md-3">
        <div class="card">
          <img src="foto produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
          <div class="card-body">
            <h3><?php echo $perproduk['nama_produk']; ?></h3>
            <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Beli</a>
            <a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-warning">Detail</a>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
</div>
</div>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>