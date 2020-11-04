<?php  
include 'koneksi.php';
if (!isset($_SESSION['admin']))
{
    echo "<script>alert('anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>
<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<caption>Data pelanggan yang terdaftar</caption>
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Nama</th>
			<th class="text-center">E-mail</th>
			<th class="text-center">Telepon</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){?>
		<tr>
			<td align="center"><?php echo $nomor; ?></td>
			<td align="center"><?php echo $pecah['nama_pelanggan']; ?></td>
			<td align="center"><?php echo $pecah['email_pelanggan']; ?></td>
			<td align="center"><?php echo $pecah['telepon_pelanggan']; ?></td>
			<td align="center">
				<a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger"><i class="fa fa-remove"></i> Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>