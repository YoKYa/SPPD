<script type="text/javascript">        
    function Play() {
        setInterval(tampilkanwaktu(),1000);
    }
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
        var waktu = new Date();            //membuat object date berdasarkan waktu saat 
        var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
        var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
        var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<?php
$hari   = date('l');
$tgl    = date('d');
$bulan  = date('F');
$tahun  = date('Y');

if ($hari=="Sunday") {
    $hari = "Minggu";
}elseif ($hari=="Monday") {
    $hari = "Senin";
}elseif ($hari=="Tuesday") {
    $hari = "Selasa";
}elseif ($hari=="Wednesday") {
    $hari = "Rabu";
}elseif ($hari=="Thursday") {
    $hari =("Kamis");
}elseif ($hari=="Friday") {
    $hari = "Jum'at";
}elseif ($hari=="Saturday") {
    $hari = "Sabtu";
}

if ($bulan=="January") {
    $bulan = " Januari ";
}elseif ($bulan=="February") {
    $bulan = " Februari ";
}elseif ($bulan=="March") {
    $bulan = " Maret ";
}elseif ($bulan=="April") {
    $bulan = " April ";
}elseif ($bulan=="May") {
    $bulan = " Mei ";
}elseif ($bulan=="June") {
    $bulan = " Juni ";
}elseif ($bulan=="July") {
    $bulan = " Juli ";
}elseif ($bulan=="August") {
    $bulan = " Agustus ";
}elseif ($bulan=="September") {
    $bulan = " September ";
}elseif ($bulan=="October") {
    $bulan = " Oktober ";
}elseif ($bulan=="November") {
    $bulan = " November ";
}elseif ($bulan=="December") {
    $bulan = " Desember ";
}
?>

<nav aria-label="breadcrumb" style="margin:0;">
    <ol class="breadcrumb shadow d-flex justify-content-between" style="background-color: rgb(0, 183, 255);" onload="Play();">
        <li class="breadcrumb-item text-white" aria-current="page"> 
            {{-- Path posisi link --}}
            <a  class="text-white">{{ request()->path() }} </a>&nbsp;-&nbsp;
            {{-- Role Multi User --}}
            {{ $user->role }}
        </li>
        <div class="text-white">
            <span id="clock"></span> - 
            {{ $hari }}, {{ $tgl }} {{ $bulan }} {{ $tahun }}
        </div>
    </ol>
</nav>