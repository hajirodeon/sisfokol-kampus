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
require("../../inc/cek/admdrk.php");
$tpl = LoadTpl("../../template/window.html");


nocache;

//nilai
$filenya = "lap_hr.php";
$jnskd = nosql($_REQUEST['jnskd']);
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);
$s = nosql($_REQUEST['s']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);


//ketahui jenis keuangan
$qdt = mysqli_query($koneksi, "SELECT * FROM m_keu_jenis ".
			"WHERE kd = '$jnskd'");
$rdt = mysqli_fetch_assoc($qdt);
$dt_kd = nosql($rdt['kd']);
$dt_jenis = balikin($rdt['nama']);




//judul halaman
$judul = "Lap.Harian : $dt_jenis";
$judulku = "$judul  [$drk_session : $nip1_session. $nm1_session]";
$juduli = $judul;
$ke = "$filenya?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&smtkd=$smtkd&uthn=$uthn&ubln=$ubln&utgl=$utgl";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "lap_hr.php?jnskd=$jnskd&progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&uthn=$uthn&ubln=$ubln&utgl=$utgl";
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
<strong>LAPORAN HARIAN</strong>
</big>
</p>

<p>
<big>
<strong>PEMBAYARAN UANG '.strtoupper($dt_jenis).'</strong>
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
<br>
<br>

Hari, Tanggal : <strong>'.$arrhari[$hari].', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'</strong>';


//query
$qcc = mysqli_query($koneksi, "SELECT mahasiswa_keu.*, ".
			"mahasiswa_keu.kd_mahasiswa AS swkd, ".
			"mahasiswa_keu.kd AS pkd, ".
			"m_mahasiswa.* ".
			"FROM mahasiswa_keu, m_mahasiswa ".
			"WHERE mahasiswa_keu.kd_mahasiswa = m_mahasiswa.kd ".
			"AND mahasiswa_keu.kd_jenis = '$jnskd' ".
			"AND mahasiswa_keu.nilai <> '' ".
			"AND round(DATE_FORMAT(mahasiswa_keu.tgl_bayar, '%d')) = '$utgl' ".
			"AND round(DATE_FORMAT(mahasiswa_keu.tgl_bayar, '%m')) = '$ubln' ".
			"AND round(DATE_FORMAT(mahasiswa_keu.tgl_bayar, '%Y')) = '$uthn' ".
			"ORDER BY round(m_mahasiswa.nim) ASC");
$rcc = mysqli_fetch_assoc($qcc);
$tcc = mysqli_num_rows($qcc);


echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">NIM</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Semester</font></strong></td>
<td width="200" align="center"><strong><font color="'.$warnatext.'">Nominal</font></strong></td>
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

	$i_nomer = $i_nomer + 1;
	$i_pkd = nosql($rcc['pkd']);
	$i_swkd = nosql($rcc['swkd']);
	$i_nim = nosql($rcc['nim']);
	$i_nama = balikin($rcc['nama']);


	//jumlah bayar
	$qjmx = mysqli_query($koneksi, "SELECT * FROM mahasiswa_keu ".
				"WHERE nilai <> '' ".
				"AND round(DATE_FORMAT(tgl_bayar, '%d')) = '$utgl' ".
				"AND round(DATE_FORMAT(tgl_bayar, '%m')) = '$ubln' ".
				"AND round(DATE_FORMAT(tgl_bayar, '%Y')) = '$uthn' ".
				"AND mahasiswa_keu.kd_jenis = '$jnskd' ".
				"AND kd_mahasiswa = '$i_swkd' ".
				"AND kd = '$i_pkd'");
	$rjmx = mysqli_fetch_assoc($qjmx);
	$tjmx = mysqli_num_rows($qjmx);
	$jmx_nilai = nosql($rjmx['nilai']);



	//ketahui kode mahasiswa, dari suatu mahasiswa_kelas
	$qske = mysqli_query($koneksi, "SELECT mahasiswa_kelas.*, m_tapel.* ".
				"FROM mahasiswa_kelas, m_tapel ".
				"WHERE mahasiswa_kelas.kd_tapel = m_tapel.kd ".
				"AND mahasiswa_kelas.kd_mahasiswa = '$i_swkd' ".
				"AND m_tapel.kd = '$tapelkd'");
	$rske = mysqli_fetch_assoc($qske);
	$tske = mysqli_num_rows($qske);


	//semester terakhir
	$qnil = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas ".
				"WHERE kd_progdi = '$progdi' ".
				"AND kd_kelas = '$kelkd' ".
				"AND kd_tapel = '$tapelkd' ".
				"AND kd_mahasiswa = '$i_swkd'");
	$rnil = mysqli_fetch_assoc($qnil);
	$tnil = mysqli_num_rows($qnil);
	$nil_smtkd = nosql($rnil['kd_smt']);

	//smt
	$qkelx = mysqli_query($koneksi, "SELECT * FROM m_smt ".
				"WHERE kd = '$nil_smtkd'");
	$rkelx = mysqli_fetch_assoc($qkelx);
	$kelx_smt = balikin($rkelx['smt']);
	$kelx_no = nosql($rkelx['no']);


	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>'.$i_nim.'</td>
	<td>'.$i_nama.'</td>
	<td>'.$kelx_smt.'</td>
	<td align="right">'.xduit2($jmx_nilai).'</td>
	</tr>';
	}
while ($rcc = mysqli_fetch_assoc($qcc));


//ketahui jumlah uang nya...
$qjmx1 = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
			"FROM mahasiswa_keu ".
			"WHERE nilai <> '' ".
			"AND kd_jenis = '$jnskd' ".
			"AND round(DATE_FORMAT(tgl_bayar, '%d')) = '$utgl' ".
			"AND round(DATE_FORMAT(tgl_bayar, '%m')) = '$ubln' ".
			"AND round(DATE_FORMAT(tgl_bayar, '%Y')) = '$uthn'");
$rjmx1 = mysqli_fetch_assoc($qjmx1);
$tjmx1 = mysqli_num_rows($qjmx1);
$jmx1_total = nosql($rjmx1['total']);

echo '<tr bgcolor="'.$warnaover.'">
<td></td>
<td></td>
<td></td>
<td align="right"><strong>'.xduit2($jmx1_total).'</strong></td>
</tr>
</table>
<br>
<br>
<br>
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