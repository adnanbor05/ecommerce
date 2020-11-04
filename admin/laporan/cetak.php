<?php  
// Koneksi library FPDF
include "fpdf.php";
include "../koneksi.php";

// Setting halaman PDF
$pdf=new FPDF();
// Menambah halaman baru
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,5,'DAC STORE','0','1','C',false);
$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,5,'Alamat : Perum taman lasrana RT07/22, Kabupaten Sleman, Yogyakarta 55284.','0','1','C',false);
$pdf->Cell(0,5,'http://dacstore.com','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(190,0.6,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(50,5,'Laporan Data Transaksi Penjualan','0','1','L',false);
$pdf->Ln(3);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(8,6,'No.',1,0,'C');
$pdf->Cell(35,6,'Pelanggan',1,0,'C');
$pdf->Cell(37,6,'Tanggal',1,0,'C');
$pdf->Cell(35,6,'Jumlah',1,0,'C');
$pdf->Cell(40,6,'Status',1,0,'C');
$pdf->Ln(2);

$no = 0;
$total=0;
$ambil = $koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan
		ON pembelian.id_pelanggan=pelanggan.id_pelanggan ORDER BY id_pembelian");
	while ($pecah = $ambil->fetch_assoc()) {
	$no++;
	$total+=$pecah['total_pembelian'];
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(8,4,$no.".",1,0,'C');
	$pdf->Cell(35,4,$pecah['nama_pelanggan'],1,0,'C');
	$pdf->Cell(37,4,$pecah['tanggal_pembelian'],1,0,'C');
	$pdf->Cell(35,4,$pecah['total_pembelian'],1,0,'C');
	$pdf->Cell(40,4,$pecah['status_pembelian'],1,0,'C');
	
	}


$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(80,5,'Total :',1,0,'C');
$pdf->Cell(75,5,''.$total,1,0,'C');



$pdf->Output();
?>
