<?php
session_start();
//koneksi ke database
include 'koneksi.php';

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style type="text/css">
        .navbar-cls-top .navbar-brand {
            color: #fff;
            background: #06429b;
            width: 260px;
            text-align: center;
            height: 60px;
            font-size: 20px;
            font-weight: 700;
        }
        .navbar-cls-top .navbar-brand:hover {
            background: #black;
            color: #fff;
        }
        .navbar-cls-top {
            background: #275a7f;
            border-bottom: none;
        }
        .panel-back {
            background-color: #e1e6f3;
        }  
    </style>
    
    <!-- DATA TABLE --><!-- 
    <link rel="stylesheet" type="text/css" href="assets/datatable/datatable.min.css">
    <script type="text/javasript" src="assets/datatable/datatable.min.js"></script> -->
    <!-- coba filter -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Dashboard admin</a> 
                
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;">Date :
            <?php date_default_timezone_set('Asia/Jakarta');
            echo date('d-m-Y'); ?> &nbsp; &nbsp; 
            <!-- <a href="profil.php?halaman=profil" class="btn btn-danger square-btn-adjust">Profile</a> </div> -->
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">

                <?php $nomor=1; ?>
                <?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
                <?php while($pecah=$ambil->fetch_assoc()){?>
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            <img src="foto_admin/<?php echo $pecah['foto_admin'] ?>" class="user-image img-responsive"/>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=produk"><i class="fa fa-cubes"></i>Produk</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=kategori"><i class="fa fa-sliders"></i> Kategori Produk</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart"></i> Pembelian</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=laporan_pembelian"><i class="fa fa-file-text" aria-hidden="true"></i> Laporan</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=pelanggan"><i class="fa fa-users"></i>Pelanggan</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=profil"><i class="fa fa-user"></i> Profil Admin</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i>Logout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="produk") {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="pembelian") {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan") {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail") {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahproduk") {
                        include 'tambahproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapusproduk") {
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="ubahproduk") {
                        include 'ubahproduk.php';
                    }
                    elseif ($_GET['halaman']=="kategori") {
                        include 'kategori.php';
                    }
                    elseif ($_GET['halaman']=="tambahkategori") {
                        include 'tambahkategori.php';
                    }
                    elseif ($_GET['halaman']=="hapuskategori") {
                        include 'hapuskategori.php';
                    }
                    elseif ($_GET['halaman']=="ubahkategori") {
                        include 'ubahkategori.php';
                    }
                    elseif ($_GET['halaman']=="logout") {
                        include 'logout.php';
                    }
                    elseif ($_GET['halaman']=="pembayaran") {
                        include 'pembayaran.php';
                    }
                    elseif ($_GET['halaman']=="laporan_pembelian") {
                        include 'laporan_pembelian.php';
                    }
                    elseif ($_GET['halaman']=="profil") {
                        include 'profil.php';
                    }
                    elseif ($_GET['halaman']=="hapusprofil") {
                        include 'hapusprofil.php';
                    }
                    elseif ($_GET['halaman']=="ubahprofil") {
                        include 'ubahprofil.php';
                    }
                    elseif ($_GET['halaman']=="tambahadmin") {
                        include 'tambahadmin.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan") {
                        include 'hapuspelanggan.php';
                    }
                }
                else
                {
                    include 'home.php';
                }
                ?>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
