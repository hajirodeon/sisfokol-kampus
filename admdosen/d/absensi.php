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

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admdosen.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "absensi.php";
$judul = "Data Absensi";
$judulku = "$judul  [$dosen_session : $nip5_session. $nm5_session]";
$juduli = $judul;
$tapelkd = nosql($_REQUEST['tapelkd']);
$smtkd = nosql($_REQUEST['smtkd']);



//isi *START
ob_start();

//js
require("../../inc/menu/admdosen.php");
require("../../inc/js/jumpmenu.js");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Tahun Pelajaran : ';

echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd = '$tapelkd'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysql_query("SELECT * FROM m_tapel ".
						"WHERE kd <> '$tapelkd' ".
						"ORDER BY tahun1 ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,

Semester : ';
echo "<select name=\"smt\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM m_smt ".
						"WHERE kd = '$smtkd'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['kd']);
$stx_smt = nosql($rowstx['smt']);

echo '<option value="'.$stx_kd.'">'.$stx_smt.'</option>';

$qst = mysql_query("SELECT * FROM m_smt ".
						"WHERE kd <> '$smtkd' ".
						"ORDER BY smt ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['kd']);
	$st_smt = nosql($rowst['smt']);

	echo '<option value="'.$filenya.'?tapelkd='.$tapelkd.'&smtkd='.$st_kd.'">'.$st_smt.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
</td>
</tr>
</table>';




//nek drg
if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN PELAJARAN Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($smtkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>SEMESTER Belum Dipilih...!</strong></font>
	</p>';
	}

else
	{
	echo '<br>
	<table border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">';

	//daftar absensi
	$qabs = mysql_query("SELECT * FROM m_absen ".
				"ORDER BY absen ASC");
	$rabs = mysql_fetch_assoc($qabs);

	do
		{
		//nilai
		$abs_kd = nosql($rabs['kd']);
		$abs_absensi2 = nosql($rabs['absen']);

		echo '<td width="50"><strong>Jml. '.$abs_absensi2.'</strong></td>';
		}
	while ($rabs = mysql_fetch_assoc($qabs));

	echo '</tr>';

	//nilai ne...
	$qxnil = mysql_query("SELECT m_absen.*, m_absen.kd AS makd, ".
				"pegawai_absen.* ".
				"FROM m_absen, pegawai_absen ".
				"WHERE pegawai_absen.kd_absen = m_absen.kd ".
				"AND pegawai_absen.kd_tapel = '$tapelkd' ".
				"AND pegawai_absen.kd_smt = '$smtkd' ".
				"AND pegawai_absen.kd_pegawai = '$std_kd'");
	$rxnil = mysql_fetch_assoc($qxnil);
	$txnil = mysql_num_rows($qxnil);
	$xnil_makd = nosql($rxnil['makd']);
	$xnil_absensi2 = nosql($rxnil['absen']);


	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";

	//daftar absensi
	$qabs = mysql_query("SELECT * FROM m_absen ".
				"ORDER BY absen ASC");
	$rabs = mysql_fetch_assoc($qabs);

	do
		{
		//nilai
		$abs_kd = nosql($rabs['kd']);

		//total...
		$qsubx = mysql_query("SELECT * FROM pegawai_absen ".
					"WHERE kd_tapel = '$tapelkd' ".
					"AND kd_smt = '$smtkd' ".
					"AND kd_absen = '$abs_kd' ".
					"AND kd_pegawai = '$kd5_session'");
		$rsubx = mysql_fetch_assoc($qsubx);
		$tsubx = mysql_num_rows($qsubx);

		echo '<td width="50">'.$tsubx.'</td>';
		}
	while ($rabs = mysql_fetch_assoc($qabs));


	echo '</tr>
	</table>';
	}


echo '</form>';
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