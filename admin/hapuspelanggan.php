<?php 
$koneksi = new mysqli("localhost","root","","toko_online_dac");
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('Akun Pelanggan Dihapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";
?>