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
$tpl = LoadTpl("../../template/window.html");


nocache;

//nilai
$filenya = "per_tgl_terima_ijazah_prt.php";
$judul = "Data Alumni per Tgl.Terima Ijazah";
$judulku = $judul;
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$a = nosql($_REQUEST['a']);
$tapelkd = nosql($_REQUEST['tapelkd']);

$ke = "$filenya?tapelkd=$tapelkd";







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//re-direct print...
$ke = "per_tgl_terima_ijazah.php?tapelkd=$tapelkd";
$diload = "window.print();location.href='$ke'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();


//js
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">';
xheadline($judul);
echo '<br>
Tahun Pelajaran : ';

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo ''.$tpx_thn1.'/'.$tpx_thn2.'
</td>
</tr>
</table>
<br>';

//query
$qdata = mysqli_query($koneksi, "SELECT m_mahasiswa.*, ".
				"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%d') AS tgl, ".
				"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%m') AS bln, ".
				"DATE_FORMAT(m_mahasiswa.tgl_lahir, '%Y') AS thn, ".
				"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%d') AS 2tgl, ".
				"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%m') AS 2bln, ".
				"DATE_FORMAT(m_mahasiswa_alumni.tgl_terima_ijazah, '%Y') AS 2thn, ".
				"m_mahasiswa.kd AS mskd, ".
				"mahasiswa_kelas.*, m_smt.*, m_mahasiswa_alumni.* ".
				"FROM m_mahasiswa, mahasiswa_kelas, m_smt, m_mahasiswa_alumni ".
				"WHERE mahasiswa_kelas.kd_mahasiswa = m_mahasiswa.kd ".
				"AND m_mahasiswa_alumni.kd_mahasiswa = m_mahasiswa.kd ".
				"AND mahasiswa_kelas.kd_smt = m_smt.kd ".
				"AND m_smt.no = '6' ".
				"AND mahasiswa_kelas.kd_tapel = '$tapelkd' ".
				"AND m_mahasiswa_alumni.alumni = 'true' ".
				"ORDER BY m_mahasiswa_alumni.tgl_terima_ijazah ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);

echo '<p>
<table width="100%" border="1" cellpadding="3" cellspacing="0">
<tr bgcolor="'.$warnaheader.'">
<td width="150"><strong>Tgl.Terima</strong></td>
<td width="50"><strong>NIM</strong></td>
<td width="150"><strong>Nama</strong></td>
<td width="5"><strong>L/P</strong></td>
<td width="150"><strong>TTL.</strong></td>
<td width="150"><strong>No.Ijazah</strong></td>
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

	$kd = nosql($rdata['mskd']);
	$kelkd = nosql($rdata['kd_kelas']);
	$nim = nosql($rdata['nim']);
	$nama = balikin($rdata['nama']);
	$no_sttb = balikin($rdata['no_sttb']);
	$kd_kelamin = nosql($rdata['kd_kelamin']);
	$tmp_lahir = balikin2($rdata['tmp_lahir']);
	$tgl_lahir = $rdata['tgl'];
	$bln_lahir = $rdata['bln'];
	$thn_lahir = $rdata['thn'];
	$tgl_terima = $rdata['2tgl'];
	$bln_terima = $rdata['2bln'];
	$thn_terima = $rdata['2thn'];


	//kelamin
	$qmin = mysqli_query($koneksi, "SELECT * FROM m_kelamin ".
							"WHERE kd = '$kd_kelamin'");
	$rmin = mysqli_fetch_assoc($qmin);
	$min_kelamin = balikin2($rmin['kelamin']);




	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td valign="top">
		'.$tgl_terima.' '.$arrbln1[$bln_terima].' '.$thn_terima.'
	</td>
	<td valign="top">
	'.$nim.'
	</td>
	<td valign="top">
	'.$nama.'
	</td>
	<td valign="top">
	'.$min_kelamin.'
	</td>
	<td valign="top">
	'.$tmp_lahir.', '.$tgl_lahir.' '.$arrbln1[$bln_lahir].' '.$thn_lahir.'
	</td>
	<td valign="top">
	'.$no_ijazah.'
	</td>
	</tr>';
	}
while ($rdata = mysqli_fetch_assoc($qdata));

echo '</table>
</p>

<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();


require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>