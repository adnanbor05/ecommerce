<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <h3><i class="fa fa-cart-plus text-success mr-2"></i></h3>
    <a class="navbar-brand font-weight-bold" href="index.php">DAC STORE</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto mr-4">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategori
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php $row=array(); ?>
            <?php $ambil=$koneksi->query("SELECT * FROM kategori"); ?>
            <?php while ($row = $ambil->fetch_assoc()) { ?>
              <a class="dropdown-item" href="kategori.php?id=<?php echo $row['id_kategori'] ?>"> <?php echo "<option value='".$row['id_kategori']."'>".$row['kategori']."</option>";?> </a>
            <?php } ?>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="carabelanja.php">Cara Belanja</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php">keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php">Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="riwayat.php">Riwayat</a>
        </li>
        <li>&nbsp;</li>

        <!--jika sudah login(ada session pelanggan)-->
        <?php if (isset($_SESSION["pelanggan"])): ?>
          <li class="nav-item">
          	<a class="nav-link navbar-right" href="logout.php">Logout</a>
          </li>
          <!--jika blom login( blom ada session pelanggan)-->
          <?php else: ?>
            <li class="nav-item">
            	<a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
            	<a class="nav-link" href="daftar.php">Daftar</a>
            </li>
          <?php endif ?>
        </ul>
        <form action="pencarian.php" method="get" class="form-inline">
          <input class="form-control mr-sm-2" type="text" name="keyword">
          <button class="btn btn-primary" >Cari</button>
        </form> 
    </div>
  </div>
</nav>
