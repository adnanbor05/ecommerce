<?php 
$koneksi = new mysqli("localhost","root","","toko_online_dac");
$ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoadmin = $pecah['foto_admin'];
if (file_exists("../admin/foto_admin/$fotoadmin"))
{
	unlink("../admin/foto_admin/$fotoadmin");
}
$koneksi->query("DELETE FROM admin WHERE id_admin='$_GET[id]'");
echo "<script>alert('data Admin telah terhapus');</script>";
echo "<script>location='index.php?halaman=profil';</script>";
?>