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
<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<caption>Data tabel pembelian</caption>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Nama Pelanggan</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Status Pembelian</th>
			<th class="text-center">Total</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody id="myTable">
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td align="center"><?php echo $nomor; ?></td>
			<td align="center"><?php echo $pecah['nama_pelanggan']; ?></td>
			<td align="center"><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td align="center"><?php echo $pecah['status_pembelian'];?></td>
			<td align="center"><?php echo $pecah['total_pembelian']; ?></td>
			<td align="center">
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Detail</a>
			<?php if ($pecah['status_pembelian']!=="pending"): ?>
			<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
			<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>