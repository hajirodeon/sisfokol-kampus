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
require("../../inc/cek/admbaak.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "rumus.php";
$judul = "Rumus Nilai";
$judulku = "[$baak_session : $nip2_session. $nm2_session] ==> $judul";
$juduli = $judul;
$progdi = nosql($_REQUEST['progdi']);
$kelkd = nosql($_REQUEST['kelkd']);
$tapelkd = nosql($_REQUEST['tapelkd']);
$rukd = nosql($_REQUEST['rukd']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$kelkd = nosql($_POST['kelkd']);
	$tapelkd = nosql($_POST['tapelkd']);


	//data progdi
	$qku = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
							"ORDER BY no ASC");
	$rku = mysqli_fetch_assoc($qku);
	
	do
		{
		$ku_kd = nosql($rku['kd']);
		$ku_no = nosql($rku['no']);
		$ku_nama = balikin($rku['nama']);
		$xyz = md5("$x$ku_kd");
		$k = $ku_kd;


		//persen
		$xnh1 = "persen_absensi";
		$xnh2 = "$xnh1$k";
		$p_absensi = nosql($_POST["$xnh2"]);
		
		$xnh1 = "persen_tugas";
		$xnh2 = "$xnh1$k";
		$p_tugas = nosql($_POST["$xnh2"]);
		
		$xnh1 = "persen_uts";
		$xnh2 = "$xnh1$k";
		$p_uts = nosql($_POST["$xnh2"]);
		
		$xnh1 = "persen_uas";
		$xnh2 = "$xnh1$k";
		$p_uas = nosql($_POST["$xnh2"]);

		
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM set_rumus ".
							"WHERE kd_progdi = '$ku_kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_kelas = '$kelkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
	
		//nek sudah ada, update
		if ($tcc != 0)
			{
			mysqli_query($koneksi, "UPDATE set_rumus SET persen_absensi = '$p_absensi', ".
							"persen_tugas = '$p_tugas', ".
							"persen_uts = '$p_uts', ".
							"persen_uas = '$p_uas', ".
							"postdate = '$today' ".
							"WHERE kd_progdi = '$ku_kd' ".
							"AND kd_tapel = '$tapelkd' ".
							"AND kd_kelas = '$kelkd'");
			}
		else
			{
			mysqli_query($koneksi, "INSERT INTO set_rumus(kd, kd_progdi, kd_tapel, kd_kelas, ".
							"persen_absensi, persen_tugas, persen_uts, persen_uas, postdate) VALUES ".
							"('$xyz', '$ku_kd', '$tapelkd', '$kelkd', ".
							"'$p_absensi', '$p_tugas', '$p_uts', '$p_uas', '$today')");
			}
		}
	while ($rku = mysqli_fetch_assoc($qku));



	//re-direct
	$ke = "$filenya?progdi=$progdi&kelkd=$kelkd&tapelkd=$tapelkd&rukd=$rukd";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/admbaak.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Jenis : ';
echo "<select name=\"kelas\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qbtx = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd = '$kelkd'");
$rowbtx = mysqli_fetch_assoc($qbtx);
$btxkd = nosql($rowbtx['kd']);
$btxkelas = nosql($rowbtx['kelas']);

echo '<option value="'.$btxkd.'">'.$btxkelas.'</option>';

$qbt = mysqli_query($koneksi, "SELECT * FROM m_kelas ".
			"WHERE kd <> '$kelkd' ".
			"ORDER BY no ASC");
$rowbt = mysqli_fetch_assoc($qbt);

do
	{
	$btkd = nosql($rowbt['kd']);
	$btkelas = nosql($rowbt['kelas']);

	echo '<option value="'.$filenya.'?kelkd='.$btkd.'">'.$btkelas.'</option>';
	}
while ($rowbt = mysqli_fetch_assoc($qbt));

echo '</select>,


Tahun Akademik : ';
echo "<select name=\"tapel\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtpx = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd = '$tapelkd'");
$rowtpx = mysqli_fetch_assoc($qtpx);
$tpx_kd = nosql($rowtpx['kd']);
$tpx_thn1 = nosql($rowtpx['tahun1']);
$tpx_thn2 = nosql($rowtpx['tahun2']);

echo '<option value="'.$tpx_kd.'">'.$tpx_thn1.'/'.$tpx_thn2.'</option>';

$qtp = mysqli_query($koneksi, "SELECT * FROM m_tapel ".
			"WHERE kd <> '$tapelkd' ".
			"ORDER BY tahun1 ASC");
$rowtp = mysqli_fetch_assoc($qtp);

do
	{
	$tpkd = nosql($rowtp['kd']);
	$tpth1 = nosql($rowtp['tahun1']);
	$tpth2 = nosql($rowtp['tahun2']);

	echo '<option value="'.$filenya.'?kelkd='.$kelkd.'&tapelkd='.$tpkd.'">'.$tpth1.'/'.$tpth2.'</option>';
	}
while ($rowtp = mysqli_fetch_assoc($qtp));

echo '</select>


<input name="tapelkd" type="hidden" value="'.$tapelkd.'">
<input name="kelkd" type="hidden" value="'.$kelkd.'">
</td>
</tr>
</table>';




//jika null
if (empty($kelkd))
	{
	echo '<p>
	<font color="red">
	<strong>JENIS Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else if (empty($tapelkd))
	{
	echo '<p>
	<font color="red">
	<strong>TAHUN AKADEMIK Belum Dipilih...!!</strong>
	</font>
	</p>';
	}
else
	{
	//data progdi
	$qku = mysqli_query($koneksi, "SELECT * FROM m_progdi ".
							"ORDER BY no ASC");
	$rku = mysqli_fetch_assoc($qku);
	
	do
		{
		$ku_kd = nosql($rku['kd']);
		$ku_no = nosql($rku['no']);
		$ku_nama = balikin($rku['nama']);




		//datanya
		$qcc = mysqli_query($koneksi, "SELECT * FROM set_rumus ".
								"WHERE kd_tapel = '$tapelkd' ".
								"AND kd_progdi = '$ku_kd' ".
								"AND kd_kelas = '$kelkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_p_absensi = nosql($rcc['persen_absensi']);
		$cc_p_tugas = nosql($rcc['persen_tugas']);
		$cc_p_uts = nosql($rcc['persen_uts']);
		$cc_p_uas = nosql($rcc['persen_uas']);		
		$cc_postdate = $rcc['postdate'];


		echo '<p>
		<hr>
		<i>
		Per Entri Terakhir : '.$cc_postdate.'
		</i>
		<hr>
		</p>

		<p>
		<b>
		'.$ku_no.'. '.$ku_nama.'
		</b>
		<br>
		Absensi = <input name="persen_absensi'.$ku_kd.'" type="text" value="'.$cc_p_absensi.'" size="5">% .
		<br>
		Tugas = <input name="persen_tugas'.$ku_kd.'" type="text" value="'.$cc_p_tugas.'" size="5">% .
		<br>
		UTS = <input name="persen_uts'.$ku_kd.'" type="text" value="'.$cc_p_uts.'" size="5">% .
		<br>
		UAS = <input name="persen_uas'.$ku_kd.'" type="text" value="'.$cc_p_uas.'" size="5">% .
		<br>
		</p>

		<input name="btnSMP" type="submit" value="SIMPAN">
		<br>';	
		}
	while ($rku = mysqli_fetch_assoc($qku));

	}


echo '<br>
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