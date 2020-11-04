<?php  

$semuadata=array();
include 'koneksi.php';
if (!isset($_SESSION['admin']))
{
    echo "<script>alert('anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
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
	}else
	{
		if (isset($_POST["cetak"])) 
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
		}
	}
?>

<h2>Laporan Penjualan dari <strong> <?php echo $tgl_mulai ?> </strong> hingga <strong><?php echo $tgl_selesai ?></strong></h2>
<hr>
<form method="post">
	<div class="col-md-5">
		<div class="form-group">
			<label>Dari Tanggal</label>
			<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
		</div>
	</div>
	<div class="col-md-5">
		<div class="form-group">
			<label>Sampai Tanggal</label>
			<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
		</div>
	</div>
	<div class="col-md-2">
		<label>&nbsp;</label><br>
		<button class="btn btn-primary" name="kirim"><i class="fa fa-eye"></i> Lihat</button>
		<a href="cetak_laporan.php" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Print</a>
	</div>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Pelanggan</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Jumlah</th>
			<th class="text-center">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value):?>
		<?php $total+=$value['total_pembelian'] ?>
		<tr>
			<td align="center"><?php echo $key+1 ?></td>
			<td align="center"><?php echo $value["nama_pelanggan"]; ?></td>
			<td align="center"><?php echo $value["tanggal_pembelian"]; ?></td>
			<td align="center">Rp. <?php echo number_format($value["total_pembelian"]) ?></td>
			<td align="center"><?php echo $value["status_pembelian"]; ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="text-center" colspan="3">Total</t>
			<th class="text-center">Rp. <?php echo number_format($total) ?></th>
			<th></th>
		</tr>
	</tfoot>
</table>
