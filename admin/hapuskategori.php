<?php 
$koneksi = new mysqli("localhost","root","","toko_online_dac");
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$koneksi->query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

echo "<script>alert('Kategori terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";
?>