<?php  
include 'koneksi.php';


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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Cetak Laporan Data transaksi Penjualan </title>

  <!-- START DATA TABLE -->
  <!-- css data table -->
    <link rel="stylesheet" type="text/css" href="bootstrap3/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap3/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap3/datatables.min.css">
  <!-- js data table -->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <!-- END DATA TABLE -->
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<hr>
<div>

</form>
<div class="container">
    <h1 align="center">CETAK LAPORAN</h1>
    <div class="alert alert-info">
        <h3>Laporan Penjualan dari <strong><?php echo $tgl_mulai ?></strong> hingga <strong><?php echo $tgl_selesai ?></strong></h2><br>
    </div>

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
        <button class="btn btn-primary" name="kirim">Lihat</button>
    </div><br><br>
    <td></td>
    <table id="example" class="table table-striped table-bordered" style="width:100%" >

    <div class="container">
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
    <tfoot>
        <tr>
            <th colspan="3">Total</t>
            <th>Rp. <?php echo number_format($total) ?></th>
            <th></th>
        </tr>
    </tfoot>
    </tbody>

    
</table>
</div>
</div>
</div>
<script>
        $(document).ready(function() {
    var printCounter = 0;
 
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Laporan Penjualan dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?>'
            },
            {
                extend: 'pdf',
                messageTop: 'Laporan Penjualan dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?>',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: 'Laporan Penjualan dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?>',
                messageBottom: null
            }
        ]
    } );
} );
</script>

</body>
</html>