<?php
include(app_path().'\FPDF\fpdf.php');

// On Off Border
$border = 0;
// Path Gambar Logp
$path = public_path() . '/img/logo.png';
//PDF
$pdf = new FPDF('P', 'mm', array(330,210));
// Set Judul
$pdf->SetTitle('SPT - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
//  Tambah Halaman
$pdf->AddPage();
// Font
$pdf->SetFont('Arial','B',12);
$pdf->image($path,15,12,16);
$pdf->Cell(0,2,'',$border,1);
$pdf->Cell(0,6,'PEMERINTAH PROVINSI JAWA TIMUR',$border,1,'C');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,6,'DINAS PEKERJAAN UMUM SUMBER DAYA AIR',$border,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,4,'JL. Gayung Kebonsari No. 169 Telp. (031) 8292419, 8292234, 8291711, 8295822',$border,1,'C');
$pdf->Cell(0,4,'Faks.(031) 8292047 E-mail : pengairan@jatimprov.go.id Website : www.dpuairjatimprov.go.id',$border,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,6,'SURABAYA',$border,1,'C');
$pdf->Cell(0,6,'Kode Pos 60235               ',$border,1,'R');
$pdf->Cell(0,6,'',$border,1,'C');
$pdf->SetFont('Arial','BU',15);
$pdf->Cell(0,6,'SURAT PERINTAH TUGAS',$border,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,10,'Nomor : 094 / '.$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat,$border,1,'C');
$pdf->Cell(0,3,'',$border,1,'C');
$a = 1;
foreach ($sppd->dasar_surat as $sppd_data) {
    if ($a == 1) {
        $pdf->Cell(25,5,'DASAR     :',$border,0,'L');
        $pdf->Cell(5,5,$a++.'. ',$border,0,'R');
        $pdf->Multicell(160,5, $sppd_data->dasar_surat ?? '',$border,'J');
        
    }else {
        $pdf->Cell(30,5,$a++.'. ',$border,0,'R');
        $pdf->Multicell(160,5, $sppd_data->dasar_surat ?? '',$border,'J');
    }
    $pdf->Cell(0,2,'',$border,1,'C');
}
$pdf->Cell(0,2,'',$border,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,'MEMERINTAHKAN',$border,1,'C');
$pdf->Cell(0,4,'',$border,1,'C');
$pdf->SetFont('Arial','',10);
$b = 1;
foreach ($sppduser as $sppd_data2) {
    foreach ($sppduserpegawai as $sppd_data) {
        if ($sppd_data->id == $sppd_data2->users_id) {
            if ($b == 1) {
                $pdf->Cell(25,5,'KEPADA    :',$border,0,'L');
                $pdf->Cell(5,5,$b++.'. ',$border,0,'R');
                $pdf->Cell(35,5,'Nama / NIP',$border,0,'L');
                $pdf->Cell(5,5,':',$border,0,'L');
                $pdf->Multicell(120,5, $sppd_data->nama." / NIP. ".$sppd_data->nip ,$border,'J');
            }else {
                $pdf->Cell(25,5,'',$border,0,'L');
                $pdf->Cell(5,5,$b++.'. ',$border,0,'R');
                $pdf->Cell(35,5,'Nama / NIP',$border,0,'L');
                $pdf->Cell(5,5,':',$border,0,'L');
                $pdf->Multicell(120,5, $sppd_data->nama." / NIP. ".$sppd_data->nip ,$border,'J');
            }
            $pdf->Cell(30,5,'',$border,0,'R');
            $pdf->Cell(35,5,'Pangkat / Golongan',$border,0,'L');
            $pdf->Cell(5,5,':',$border,0,'L');
            $pdf->Multicell(120,5, $sppd_data->golongan->golongan ?? " - " ,$border,'J');
            $pdf->Cell(30,5,'',$border,0,'R');
            $pdf->Cell(35,5,'Jabatan',$border,0,'L');
            $pdf->Cell(5,5,':',$border,0,'L');
            $pdf->Multicell(120,5, $sppd_data->jabatan->jabatan ?? " - " ,$border,'J');
            $Y=$pdf->GetY();
            $pdf->Cell(0,1,'',$border,1,'C');
        }
    }
}
$Y=$pdf->GetY();
// if ($Y >= 230) {
//     $pdf->AddPage();
// }
$pdf->Cell(25,5,'UNTUK     :',$border,0,'L');
$pdf->Cell(165,5,$sppd->acara,$border,1,'L');
$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(25,5,'',$border,0,'L');
$pdf->Cell(25,5,'Ke',$border,0,'L');
$pdf->Cell(140,5,$sppd->tempat->tempat_tujuan,$border,1,'L');
$pdf->Cell(25,5,'',$border,0,'L');
$pdf->Cell(25,5,'Tanggal',$border,0,'L');
$pdf->Cell(35,5,date('d-m-Y',strtotime($sppd->tgl_pergi)),$border,0,'L');
$pdf->Cell(10,5,'s/d',$border,0,'L');
$pdf->Cell(35,5,date('d-m-Y',strtotime($sppd->tgl_kembali)),$border,0,'L');
$pdf->Cell(60,5,'selama '.$lama.' hari',$border,1,'L');
$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(110,5,'',$border,0,'L');
$pdf->Cell(30,5,'Dikeluarkan di',$border,0,'L');
$pdf->Cell(50,5,$sppd->tempat->tempat_berangkat,$border,1,'L');
$pdf->Cell(110,5,'',$border,0,'L');
$pdf->Cell(30,5,'Pada Tanggal',$border,0,'L');
$pdf->Cell(50,5, date('d-m-Y',strtotime($sppd->tgl_surat)),$border,1,'L');
$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Cell(105,5,'KEPALA BIDANG '.strtoupper($bidang->nama_bidang),$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Cell(105,5,'DINAS PU SUMBER DAYA AIR PROVINSI JAWA TIMUR',$border,1,'C');
$pdf->Cell(0,20,'',$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,5,$sppd->kabid->nama_kabid,$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,5,$sppd->kabid->jabatan ?? '-',$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,5,'NIP. '.$sppd->kabid->nip ,$border,'C');

$pdf->Output('I','SPT - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
exit;
?>
