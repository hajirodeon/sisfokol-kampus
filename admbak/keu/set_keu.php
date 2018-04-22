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
require("../../inc/cek/admak.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "set_keu.php";
$kelkd = nosql($_REQUEST['kelkd']);
$progdi = nosql($_REQUEST['progdi']);
$tapelkd = nosql($_REQUEST['tapelkd']);





//judul halaman
$judul = "Nilai Keuangan";
$judulku = "[$bak_session : $nip11_session. $nm11_session] ==> $judul";
$juduli = $judul;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$tapelkd = nosql($_POST['tapelkd']);
	$progdi = nosql($_POST['progdi']);
	$kelkd = nosql($_POST['kelkd']);


	//daftar jenis
	$qst = mysql_query("SELECT * FROM m_keu_jenis ".
							"ORDER BY nama ASC");
	$rowst = mysql_fetch_assoc($qst);

	do
		{
		//nilai
		$nomer = $nomer + 1;
		$xyz = md5("$x$nomer");
		$st_kd = nosql($rowst['kd']);

		$xnnilku = "nilku";
		$xnnilku1 = "$st_kd$xnnilku";
		$xnnilkuxx = nosql($_POST["$xnnilku1"]);



		//cek
		$qcc = mysql_query("SELECT * FROM m_keu ".
								"WHERE kd_jenis = '$st_kd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_progdi = '$progdi' ".
								"AND kd_tapel = '$tapelkd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//jika ada, update aja
		if ($tcc != 0)
			{
			mysql_query("UPDATE m_keu SET biaya = '$xnnilkuxx' ".
							"WHERE kd_jenis = '$st_kd' ".
							"AND kd_progdi = '$progdi' ".
							"AND kd_kelas = '$kelkd' ".
							"AND kd_tapel = '$tapelkd'");
			}
		else
			{
			mysql_query("INSERT INTO m_keu (kd, kd_jenis, kd_progdi, ".
							"kd_tapel, kd_kelas, biaya) VALUES ".
							"('$xyz', '$st_kd', '$progdi', ".
							"'$tapelkd', '$kelkd', '$xnnilkuxx')");
			}
		}
	while ($rowst = mysql_fetch_assoc($qst));


	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/number.js");
require("../../inc/menu/admak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Program Studi : ';
echo "<select name=\"progdi\" onChange=\"MM_jumpMenu('self',this,0)\">";
//terpilih
$qtpx = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd = '$progdi'");
$rowtpx = mysql_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_nama = balikin($rowtpx['nama']);

echo '<option value="'.$tpx_kd.'" selected>'.$tpx_nama.'</option>';

$qtp = mysql_query("SELECT * FROM m_progdi ".
			"WHERE kd <> '$progdi' ".
			"ORDER BY nama ASC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpnama = balikin($rowtp['nama']);

	echo '<option value="'.$filenya.'?progdi='.$tpkd.'">'.$tpnama.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>,

Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysql_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysql_query("SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysql_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysql_fetch_assoc($qbt));

echo '</select>,

Tahun Akademik : ';
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
						"ORDER BY tahun1 DESC");
$rowtp = mysql_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?progdi='.$progdi.'&kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysql_fetch_assoc($qtp));

echo '</select>
</td>
</tr>
</table>';


if (empty($progdi))
	{
	echo '<p>
	<font color="#FF0000"><strong>PROGRAM PENDIDIKAN Belum Dipilih...!</strong></font>
	</p>';
	}

	else if (empty($kelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>KELAS Belum Dipilih...!</strong></font>
	</p>';
	}

else if (empty($tapelkd))
	{
	echo '<p>
	<font color="#FF0000"><strong>TAHUN AKADEMIK Belum Dipilih...!</strong></font>
	</p>';
	}

else
	{
	//daftar 
	$qst = mysql_query("SELECT * FROM m_keu_jenis ".
							"ORDER BY nama ASC");
	$rowst = mysql_fetch_assoc($qst);

	echo '<br>
	<table width="350" border="1" cellpadding="3" cellspacing="0">
	<tr bgcolor="'.$warnaheader.'">
	<td width="150"><strong>Nama</strong></td>
	<td valign="top"><strong>Biaya Bulanan</strong></td>
	</tr>';


	do
		{
		//nilai
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

		$btkd = nosql($rowst['kd']);
		$btnama = balikin($rowst['nama']);



		//nilai uangnya...
		$qku = mysql_query("SELECT * FROM m_keu ".
								"WHERE kd_progdi = '$progdi' ".
								"AND kd_jenis = '$btkd' ".
								"AND kd_kelas = '$kelkd' ".
								"AND kd_tapel = '$tapelkd'");
		$rku = mysql_fetch_assoc($qku);
		$tku = mysql_num_rows($qku);
		$ku_nilai = nosql($rku['biaya']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna01';\">";
		echo '<td valign="top">'.$btnama.'</td>
		<td valign="top">
		Rp.	<input name="'.$btkd.'nilku" type="text" size="10" value="'.$ku_nilai.'" style="text-align:right" onKeyPress="return numbersonly(this, event)">,00
		</td>
		</tr>';
		}
	while ($rowst = mysql_fetch_assoc($qst));

	echo '</table>

	<input name="jnskd" type="hidden" value="'.$jnskd.'">
	<input name="progdi" type="hidden" value="'.$progdi.'">
	<input name="kelkd" type="hidden" value="'.$kelkd.'">
	<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
	<input name="btnSMP" type="submit" value="SIMPAN">
	<input name="btnBTL" type="submit" value="BATAL">';
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