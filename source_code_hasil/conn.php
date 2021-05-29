<?php 
// DB Local
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "webinar_hmti_crud";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}

//fungsi format rupiah 
function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".");
	return $hasil;
}

// fungsi tanggal indoensia
function tanggal_indo($tanggal, $cetak_tanggal = FALSE, $cetak_hari = FALSE)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	
	if ($cetak_tanggal == TRUE) {
		$tgl_indo = $bulan[ (int)$split[1] ] . ' ' . $split[0];
	} else {		
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
?>