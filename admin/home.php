<?php  

//koneksi ke database
$koneksi = new mysqli("localhost","root","","toko_online_dac");

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$sql = mysqli_query($koneksi, "SELECT SUM(jumlah) as jumlah_produk_dibeli, nama FROM pembelian_produk GROUP BY nama ORDER BY jumlah_produk_dibeli ASC");
while($data=mysqli_fetch_assoc($sql)) {

    $top = $data['nama'];
    $toptot = $data['jumlah_produk_dibeli'];
}
$sql = mysqli_query($koneksi, "SELECT * FROM pembelian");
while($data=mysqli_fetch_assoc($sql)) {
	$jml = $data['total_pembelian'];
    $total = $total+$jml;
}
$sql = mysqli_query($koneksi, "SELECT * FROM pembelian_produk");
while($data=mysqli_fetch_assoc($sql)) {

    $jml = $data['jumlah'];
    $total_terjual = $total_terjual+$jml;
}

// echo "<pre>";
// print_r($top);
// echo "</pre>";

?>

<marquee behavior="" direction="" style="font-size: 19px; color: #171752;">Selamat Datang Di Sistem Informasi E-Commerce </marquee>
<h1>Halaman Utama</h1>
<h4>Selamat Datang <b><?php echo ucwords($_SESSION["username"]); ?></b></h4>

<div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-red set-icon">
                    <i class="glyphicon glyphicon-floppy-open"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text">
                            <?php echo $top; ?> 
                            Terjual <?php echo $toptot ?>
                        </p>
                        <p class="text-muted">Top Seller</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text">
                            <?php echo "Rp. " . number_format($total); ?>,-</p>
                            <h4></h4>
                        <p class="text-muted">Total Pendapatan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text">
                            <?php echo "" . number_format($total_terjual); ?> Produk</p>
                            <h4></h4>
                        <p class="text-muted">Total Produk terjual</p>
                    </div>
                </div>
            </div>
 </div>
