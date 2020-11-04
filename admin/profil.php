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
<h3>halaman profile</h3>
<a href="index.php?halaman=tambahadmin" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah admin</a>
<table class="table table-bordered">
	<caption>Data Admin</caption>
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Foto</th>
			<th class="text-center">Nama</th>
			<th class="text-center">E-mail / Username</th>
			<th class="text-center">password</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){?>
		<tr>
			<td align="center"><?php echo $nomor; ?></td>
			<td align="center">
				<img src="../admin/foto_admin/<?php echo $pecah['foto_admin'] ?>" width="100">
			</td>
			<td align="center"><?php echo $pecah['nama_lengkap']; ?></td>
			<td align="center"><?php echo $pecah['username']; ?></td>
			<td align="center"><?php echo $pecah['password']; ?></td>
			<td align="center">
				<a href="index.php?halaman=ubahprofil&id=<?php echo $pecah['id_admin']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
				<a href="index.php?halaman=hapusprofil&id=<?php echo $pecah['id_admin']; ?>" class="btn-danger btn"><i class="fa fa-remove"></i> Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
