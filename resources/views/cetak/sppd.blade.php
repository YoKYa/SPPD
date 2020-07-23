<?php
include(app_path().'\FPDF\fpdf.php');
include(app_path().'\FPDF\exfpdf.php');
include(app_path().'\FPDF\easyTable.php');

// On Off Border
$border = 0;
// Path Gambar Logp
$path = public_path() . '/img/logo.png';
//PDF
$pdf = new exFPDF('P', 'mm', array(330,210));
// Set Judul
$pdf->SetTitle('SPPD - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
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
// Header
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,'',$border,1,'C');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Lembar ke',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'..............................',$border,1,'L');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Kode No.',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'..............................',$border,1,'L');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Nomor',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'094 / '.$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat,$border,1,'L');

$pdf->Cell(0,3,'',$border,1,'C');
$pdf->SetFont('Arial','BU',15);
$pdf->Cell(0,6,'SURAT PERINTAH PERJALANAN DINAS (SPPD)',$border,1,'C');
$pdf->SetFont('Arial','',11);
$no = 1;
$pdf->Cell(0,5,'',0,1,'C');
// ================================================ Header

$pdf->SetFont('Arial','',10);
$tabelsppd = new easyTable($pdf, '{10,45,45,55,45}','border:1; paddingX:2');

$no = 1;
// 1

$tabelsppd->easyCell($no++.". ", 'valign:T;'); 
$tabelsppd->easyCell('Kuasa Pengguna Anggaran', 'colspan:2');
$tabelsppd->easyCell('Bidang '.$bidang->nama_bidang,'colspan:2');
$tabelsppd->printRow();
// 2
$tabelsppd->easyCell($no++.". ",'valign:T');
$tabelsppd->easyCell('Nama Pegawai Yang Diperintahkan','colspan:2');
$a = 0;
foreach ($sppduser as $sppd_data2) {
    foreach ($sppduserpegawai as $sppd_data) {
        if ($sppd_data->id == $sppd_data2->users_id) {
            if (++$a == 1) {
                $nama       = $sppd_data->nama;
                $golongan   = $sppd_data->golongan->golongan;
                $jabatan    = $sppd_data->jabatan->jabatan; 
                $nama_eselon     = $sppd_data->eselon->nama_eselon; 
                if ($nama_eselon == "Eselon II") {
                    $klutser = "C";
                }elseif ($nama_eselon == "Eselon III" || $nama_eselon == "PJFT Gol IV/c") {
                    $klutser = "D";
                }elseif ($nama_eselon == "Eselon IV" || $nama_eselon == "PJFT Gol IV/b" || $nama_eselon == "PJFT Gol IV/a" || $nama_eselon == "PJFT Gol III") {
                    $klutser = "E";
                }elseif ($nama_eselon == "Staf Gol IV/III" || $nama_eselon == "Staf Gol II/I" || $nama_eselon == "PTT S2/S3" || $nama_eselon == "PTT S1" || $nama_eselon == "PTT D3" || $nama_eselon == "PTT D1/SMK" || $nama_eselon == "PTT SMA" || $nama_eselon == "PTT SMP/SD") {
                    $klutser = "F";
                }else {
                    $klutser = "";
                }
            }
            
        }
    }
}
$tabelsppd->easyCell($nama,'colspan:2');
$tabelsppd->printRow();
// 3
$tabelsppd->easyCell($no++.". ", 'rowspan:3;valign:T');
$tabelsppd->easyCell('a. Pangkat dan Golongan','border:0;colspan:2');
$tabelsppd->easyCell('a. '.$golongan ?? '-','border:LR;colspan:2');
$tabelsppd->printRow();
// 4 
$tabelsppd->easyCell('b. Jabatan / Instansi','border:0;colspan:2');
$tabelsppd->easyCell('b. '.$jabatan ?? '-','border:LR;colspan:2');
$tabelsppd->printRow();
// 5
$tabelsppd->easyCell('c. Tingkat Biaya Perjalanan Dinas','border:B;colspan:2');
if ($nama_eselon != null) {
    $tabelsppd->easyCell('c. '.$klutser.' ('.$nama_eselon.')','border:LRB;colspan:2');
}else {
    $tabelsppd->easyCell('c. ','border:LRB;colspan:2');
}
$tabelsppd->printRow();
// 6
$tabelsppd->easyCell($no++.". ", 'valign:T');
$tabelsppd->easyCell('Maksud Perjalanan Dinas','colspan:2');
$tabelsppd->easyCell($sppd->acara,'colspan:2');
$tabelsppd->printRow();
// 7
$angkutan = '';
if ($sppd->angkutan->angkutan == "Angkutan Dinas") {
    if ($sppd->angkutan->jenis == "Roda Dua") {
        if ($sppd->angkutan->plat != null) {
            $angkutan = "Sepeda Motor Dinas - " .$sppd->angkutan->plat; 
        }else {
            $angkutan = "Sepeda Motor Dinas ";
        }
    }elseif ($sppd->angkutan->jenis == "Roda Empat") {
        if ($sppd->angkutan->plat != null) {
            $angkutan = "Mobil Dinas - ".$sppd->angkutan->plat;
        }else {
            $angkutan = "Mobil Dinas ";
        }
    }
}elseif ($sppd->angkutan->angkutan == "Angkutan Pribadi") {
    if ($sppd->angkutan->jenis == "Roda Dua") {
        if ($sppd->angkutan->plat != null) {
            $angkutan = "Sepeda Motor Pribadi - " .$sppd->angkutan->plat; 
        }else {
            $angkutan = "Sepeda Motor Pribadi ";
        }
    }elseif ($sppd->angkutan->jenis == "Roda Empat") {
        if ($sppd->angkutan->plat != null) {
            $angkutan = "Mobil Pribadi - ".$sppd->angkutan->plat;
        }else {
            $angkutan = "Mobil Pribadi ";
        }
    }
}elseif ($sppd->angkutan->angkutan == "Angkutan Umum") {
    $angkutan = $sppd->angkutan->angkutan_umum." (PP)";
}elseif ($sppd->angkutan->angkutan == "Angkutan Sewa") {
    if ($sppd->angkutan->sewa == "Roda Enam/Bus Besar") {
        $angkutan = "Bus Besar Sewa";
    }elseif ($sppd->angkutan->sewa == "Roda Enam/Bus Sedang") {
        $angkutan = "Bus Sedang Sewa";
    }elseif ($sppd->angkutan->sewa == "Roda Empat/Bus Mini") {
        $angkutan = "Bus Mini Sewa";
    }elseif ($sppd->angkutan->sewa == "Roda Empat") {
        $angkutan = "Mobil Sewa";
    }elseif ($sppd->angkutan->sewa == "Roda Dua") {
        $angkutan = "Sepeda Motor Sewa";
    }
}
$tabelsppd->easyCell($no++.". ", 'valign:T;border:LR');
$tabelsppd->easyCell('Alat Angkutan Yang Dipergunakan','border:0;colspan:2');
$tabelsppd->easyCell($angkutan, 'border:LR;colspan:2');
$tabelsppd->printRow();
// 8 
$tabelsppd->easyCell($no++.". ", 'rowspan:2;valign:T;border:LRB');
$tabelsppd->easyCell('a. Tempat Berangkat','border:0;colspan:2');
$tabelsppd->easyCell('a. '.$sppd->tempat->tempat_berangkat ?? '-','border:LR;colspan:2');
$tabelsppd->printRow();
// 9
$tabelsppd->easyCell('b. Tempat Tujuan','border:B;colspan:2');
$tabelsppd->easyCell('b. '.$sppd->tempat->tempat_tujuan ?? '-','border:LRB;colspan:2');
$tabelsppd->printRow();
// 10
$tabelsppd->easyCell($no++.". ", 'rowspan:3;valign:T;border:LRB');
$tabelsppd->easyCell('a. Lamanya Perjalanan Dinas','border:0;colspan:2');
$tabelsppd->easyCell('a. '.$lama.' hari','border:LR;colspan:2');
$tabelsppd->printRow();
// 11
$tabelsppd->easyCell('b. Tanggal Berangkat','border:0;colspan:2');
$tabelsppd->easyCell('b. '.date('d-m-Y',strtotime($sppd->tgl_pergi)),'border:LR;colspan:2');
$tabelsppd->printRow();
// 12
$tabelsppd->easyCell('c. Tanggal Harus Kembali','border:RB;colspan:2');
$tabelsppd->easyCell('c. '.date('d-m-Y',strtotime($sppd->tgl_kembali)),'border:RB;colspan:2');
$tabelsppd->printRow();
// 13
$span = $a;
if ($span == 1) {
    $bordered = "B";
}else {
    $bordered = 0;
}
$tabelsppd->easyCell($no++.". ", 'rowspan:'.$span.';valign:T;border:LRB');
$tabelsppd->easyCell('Pengikut :','border:'.$bordered.';');
$tabelsppd->easyCell('Nama/NIP','border:'.$bordered.';');
$tabelsppd->easyCell('Pangkat/Golongan','border:'.$bordered.'L;');
$tabelsppd->easyCell('Keterangan','border:'.$bordered.'LR;');
$tabelsppd->printRow();
// 14 
$b = 0;
foreach ($sppduser as $sppd_data2) {
    foreach ($sppduserpegawai as $sppd_data) {
        if ($sppd_data->id == $sppd_data2->users_id) {
            if (++$b != 1) {
                
                if ($a == $b) {
                    $border = "LRB";
                }else {
                    $border = "LR";
                }
                $tabelsppd->easyCell(($b-1)." ".$sppd_data->nama." / NIP. ".$sppd_data->nip,'border:'.$border.';colspan:2');
                $tabelsppd->easyCell($sppd_data->golongan->golongan ?? '-','border:'.$border.';');
                $tabelsppd->easyCell('Staf Pelaksana','border:'.$border.';');
                $tabelsppd->printRow();
            }
        }
    }
}
// 15
$tabelsppd->easyCell($no++.". ", 'rowspan:5;valign:T');
$tabelsppd->easyCell('Pembebanan Anggaran','border:0;colspan:2');
$tabelsppd->easyCell('','border:LR;colspan:2');
$tabelsppd->printRow();
// 16 
$tabelsppd->easyCell('a. Satuan Kerja Perangkat Daerah','border:0;colspan:2');
$tabelsppd->easyCell($sppd->bbsppd->skpd,'border:LR;colspan:2');
$tabelsppd->printRow();
// 17
$tabelsppd->easyCell('b. Program','border:0;colspan:2');
$tabelsppd->easyCell($sppd->bbsppd->program,'border:LR;colspan:2');
$tabelsppd->printRow();
// 18
$tabelsppd->easyCell('c. Kegiatan','border:0;colspan:2');
$tabelsppd->easyCell($sppd->bbsppd->kegiatan,'border:LR;colspan:2');
$tabelsppd->printRow();
// 19 
$tabelsppd->easyCell('d. Kode Rekening','border:B;colspan:2');
$tabelsppd->easyCell($sppd->bbsppd->rekening,'border:LRB;colspan:2');
$tabelsppd->printRow();
// 20
$tabelsppd->easyCell($no++.". ", 'valign:T');
$tabelsppd->easyCell('KETERANGAN LAIN-LAIN','border:1;colspan:2');
$tabelsppd->easyCell($sppd->keterangan->keterangan,'border:LRB;colspan:2');
$tabelsppd->printRow();

$tabelsppd->endTable(4);

$border = 0;
$Y = $pdf->GetY();
if ($Y >= 267) {
    $pdf->AddPagePage();
}

$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(30,5,'Dikeluarkan di',$border,0,'L');
$pdf->Cell(60,5,$sppd->tempat->tempat_berangkat,$border,1,'L');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(30,5,'Pada Tanggal',$border,0,'L');
$pdf->Cell(60,5, date('d-m-Y',strtotime($sppd->tgl_surat)),$border,1,'L');
$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(105,5,'KUASA PENGGUNA ANGGARAN',$border,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,12,'',$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,$sppd->kabid->nama_kabid,$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,$sppd->kabid->jabatan ?? '-',$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,'NIP. '.$sppd->kabid->nip ,$border,'C');

$pdf->Output('I','SPT - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
exit;
?>
