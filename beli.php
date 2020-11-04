<?php 
session_start();
//mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// jk produk di krnjang, maka produk jmlah +1
if (isset($_SESSION['keranjang']['$id_produk'])) 
{
	$_SESSION['keranjang']['$id_produk'] += 1;
}
//seain itu (blm ada dikeranjang), mka produk dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}

//masuk ke keranjang belanja
echo "<script>alert('produk telah masuk keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>