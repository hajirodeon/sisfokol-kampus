<?php
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
/////// SISFOKOL-KAMPUS         ///////
///////////////////////////////////////////////////////////
/////// Dibuat oleh :                               ///////
/////// Agus Muhajir, S.Kom                         ///////
/////// URL 	: http://sisfokol.wordpress.com     ///////
/////// E-Mail	:                                   ///////
///////     * hajirodeon@yahoo.com                  ///////
///////     * hajirodeon@gmail.com                  ///////
/////// HP/SMS	: 081-829-88-54                     ///////
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////






session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admak.php");
$tpl = LoadTpl("../../template/window.html");


nocache;

//nilai
$filenya = "lap_mhs.php";
$jnskd = nosql($_REQUEST['jnskd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);


//ketahui jenis keuangan
$qdt = mysqli_query($koneksi, "SELECT * FROM m_keu_jenis ".
			"WHERE kd = '$jnskd'");
$rdt = mysqli_fetch_assoc($qdt);
$dt_kd = nosql($rdt['kd']);
$dt_jenis = balikin($rdt['nama']);




//judul halaman
$judul = "Lap.Sumbangan Sukarela Mahasiswa";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;
$ke = "$filenya?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "lap_mhs.php?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//js
require("../../inc/js/swap.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">
<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr valign="top" align="center">
<td>

<p>
<big>
<strong>LAPORAN SUMBANGAN SUKARELA MAHASISWA</strong>
</big>
</p>

<p>
<big>
<strong>'.$sek_nama.'</strong>
</big>
</p>

</td>
</tr>
<table>
<hr>

<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Akademik : ';

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
						"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<strong>'.$tpx_thn1.'/'.$tpx_thn2.'</strong>,


Program Studi : ';
//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<strong>'.$tpx_nama.'</strong>,

Jenis : ';
//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<strong>'.$btxkelas.'</strong>
</td>
</tr>
</table>
<hr>';


//query
$qdtu = mysqli_query($koneksi, "SELECT DISTINCT(m_mahasiswa.nim) AS nim ".
			"FROM m_mahasiswa, mahasiswa_kelas ".
			"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
			"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
			"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
			"ORDER BY round(m_mahasiswa.nim) ASC");
$rdtu = mysqli_fetch_assoc($qdtu);
$tdtu = mysqli_num_rows($qdtu);

echo '<table width="600" border="1" cellpadding="3" cellspacing="0">
<tr bgcolor="'.$warnaheader.'">
<td width="50"><strong>NIM</strong></td>
<td><strong>Nama</strong></td>
<td width="150" align="center"><strong>Jumlah Sumbangan</strong></td>
<td width="100" align="center"><strong>Tgl.Bayar</strong></td>
</tr>';

do
	{
	if ($warna_set ==0)
		{
		$warna = $warna01;
		$warna_set = 1;
		}
	else
		{
		$warna = $warna02;
		$warna_set = 0;
		}

	$nomer = $nomer + 1;
	$i_nim = nosql($rdtu['nim']);


	//detail
	$qdt = mysqli_query($koneksi, "SELECT m_mahasiswa.*, m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, mahasiswa_kelas.kd AS mkkd ".
				"FROM m_mahasiswa, mahasiswa_kelas ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND mahasiswa_kelas.kd_progdi = '$progdi' ".
				"AND mahasiswa_kelas.kd_kelas = '$kelkd' ".
				"AND m_mahasiswa.nim = '$i_nim'");
	$rdt = mysqli_fetch_assoc($qdt);
	$dt_kd = nosql($rdt['mskd']);
	$dt_mkkd = nosql($rdt['mkkd']);
	$dt_nama = balikin($rdt['nama']);
	$i_kd = $dt_kd;
	$i_mkkd = $dt_mkkd;
	$i_nama = $dt_nama;



	//yang telah dibayar
	$qccx = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$dt_kd'");
	$rccx = mysqli_fetch_assoc($qccx);
	$ccx_nilai = nosql($rccx['nilai']);


	//tgl.bayar
	$qccx2 = mysqli_query($koneksi, "SELECT * FROM mahasiswa_keu ".
				"WHERE kd_jenis = '$jnskd' ".
				"AND kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$dt_kd'");
	$rccx2 = mysqli_fetch_assoc($qccx2);
	$ccx2_tgl_bayar = $rccx2['tgl_bayar'];


	//jika null
	if (empty($ccx2_tgl_bayar))
		{
		$ccx2_tgl_bayar = "-";
		}


	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td valign="top">'.$i_nim.'</td>
	<td valign="top">'.$i_nama.'</td>
	<td valign="top" align="right">';

	//jika null
	if (empty($ccx_nilai))
		{
		echo "-";
		}
	else
		{
		echo xduit2($ccx_nilai);
		}

	echo '</td>
	<td valign="top" align="right">
	'.$ccx2_tgl_bayar.'
	</td>
	</tr>';
	}
while ($rdtu = mysqli_fetch_assoc($qdtu));


//jumlah total
$qccx4 = mysqli_query($koneksi, "SELECT SUM(nilai) AS nilai FROM mahasiswa_keu ".
			"WHERE kd_jenis = '$jnskd' ".
			"AND kd_progdi = '$progdi' ".
			"AND kd_kelas = '$kelkd' ".
			"AND kd_tapel = '$tapelkd'");
$rccx4 = mysqli_fetch_assoc($qccx4);
$ccx4_nilai = nosql($rccx4['nilai']);


echo '<tr bgcolor="'.$warnaheader.'">
<td>&nbsp;</td>
<td align="right"><strong>Total :</strong></td>
<td width="150" align="right"><strong>'.xduit2($ccx4_nilai).'</strong></td>
<td>&nbsp;</td>
</tr>
</table>
<br>


<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td valign="top" width="200" align="center">
<p>
</p>
</td>

<td valign="top" width="200" align="center">
</td>

<td valign="top" width="200" align="center">
<p>
<strong>'.$sek_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'</strong>
</p>
<p>
<strong>AK</strong>
<br>
<br>
<br>
<br>
<br>
(<strong>'.$nm11_session.'</strong>)
</p>
</td>
</tr>
<table>

</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();


require("../../inc/niltpl.php");


//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>