<?php  
$semuadata=array();

$tgl_mulai="-";
$tgl_selesai="-";

if (isset($_POST["kirim"])) 
{
	$tgl_mulai= $_POST["tglm"];
	$tgl_selesai=$_POST['tgls'];
	$ambil= $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl
		ON pm.id_pelanggan=pl.id_pelanggan 
		WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
	while ($pecah = $ambil->fetch_assoc()) 
	{
		$semuadata[]=$pecah;
	}

	// echo "<pre>";
	// print_r($semuadata);		
	// echo "</pre>";
}
else
{
	if (isset($_POST["kirim"])) 
	{
	$tgl_mulai= $_POST["tglm"];
	$tgl_selesai=$_POST['tgls'];
	$ambil= $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl
		ON pm.id_pelanggan=pl.id_pelanggan 
		WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
	while ($pecah = $ambil->fetch_assoc()) 
	{
		$semuadata[]=$pecah;
	}

	// echo "<pre>";
	// print_r($semuadata);		
	// echo "</pre>";
	}
}

?>

<h2>Laporan Penjualan dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h2>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value):?>
			<?php $total+=$value['total_pembelian'] ?>
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_pelanggan"]; ?></td>
			<td><?php echo $value["tanggal_pembelian"]; ?></td>
			<td>Rp. <?php echo number_format($value["total_pembelian"]) ?></td>
			<td><?php echo $value["status_pembelian"]; ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>

	<tfoot>
		<tr>
			<th colspan="3">Total</t>
			<th>Rp. <?php echo number_format($total) ?></th>
			<th></th>
		</tr>
	</tfoot>
</table>
<script>
	window.print();
</script>
